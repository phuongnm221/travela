<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;


class PaymentController extends Controller
{
    private $booking;
    private $checkout;
    private $tour;


        public function __construct(Checkout $checkout, Booking $booking, Tours $tour)
    {
        $this->checkout = $checkout;
        $this->booking = $booking;
        $this->tour = $tour;


    }

    public function createVnpayPayment(Request $request)
    {  
        $checkoutId = $request->checkoutId;
        $checkout = $this->checkout->getCheckoutById($checkoutId);
        $amount = (int)$checkout->amount;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('handleVnpayReturn');
        $vnp_TmnCode = "12ZA7A73";//Mã website tại VNPAY 
        $vnp_HashSecret = "10WCURVRQ3TPWYQYPU5ES5ATGWOM10I7"; //Chuỗi bí mật
        
        $vnp_TxnRef = $checkoutId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "other";
        $vnp_Amount = $amount*100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_ExpireDate = date('YmdHis',strtotime('+15 minutes'));
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate,
            "vnp_BankCode" => $vnp_BankCode,
          
        );
    
        
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
    
        //var_dump($inputData);
        ksort($inputData);
        $hashdata = "";
        $query = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                $query    .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $query    .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;

        return redirect()->away($vnp_Url);
    }

    public function handleVnpayReturn(Request $request)
    {
        //1. verify secure hash
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        //Lấy tất cả dữ liệu được trả về từ VNPAY
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);

        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            $hashdata .= ($i ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }

        $secureHash = hash_hmac(
            'sha512',
            $hashdata,
            '10WCURVRQ3TPWYQYPU5ES5ATGWOM10I7'
        );

        //2. lấy thông tin thanh toán
        $checkoutId = $request->vnp_TxnRef;

        // 3️⃣ Lấy bookingId từ checkout
        $checkout = Checkout::where('checkoutId', $checkoutId)->first();
        $bookingId = $checkout->bookingId;

        if (!$checkout) {
            toastr()->error('Không tìm thấy đơn thanh toán');
            return redirect('/');
        }

        if ($checkout->paymentStatus === 'y') {
            return redirect()->route('tour-booked', [
            'bookingId'  => $checkout->bookingId,
            'checkoutId' => $checkoutId,
        ]);
        }

        //4. Kiểm tra trạng thái và cập nhật
        //thanh toán thất bại
        if ($request->vnp_ResponseCode !== '00') {
            toastr()->error('Thanh toán VNPAY thất bại');
            return redirect()->route('home');
        }
        
        //thanh toán thành công
        
        DB::transaction(function () use ($request, $checkout) {
        
        //LẤY BOOKING

        $booking = Booking::where('bookingId', $checkout->bookingId)
                ->lockForUpdate()
                ->first();
        
        //TRỪ SỐ LƯỢNG TOUR
        $totalPeople = $booking->numAdults + $booking->numChildren;

        Tours::where('tourId', $booking->tourId)
            ->lockForUpdate()
            ->decrement('quantity', $totalPeople); 
        
        // 5️⃣ Update checkout 
        $checkout->update([
            'paymentStatus' => 'y',
            'transactionId' => $request->vnp_TransactionNo,
        ]);

        // 6️⃣ Confirm booking
        Booking::where('bookingId', $checkout->bookingId)->update([ 'bookingStatus' => 'y', ]);
        });

        toastr()->success('Thanh toán VNPAY thành công!');
        return redirect()->route('tour-booked', [
            'bookingId'  => $checkout->bookingId,
            'checkoutId' => $checkout->checkoutId,
        ]);
    }

    public function createStripePayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $tourId = $request->tourId;
        $tour = $this->tour->getTourDetail($tourId);
        $tourName = $tour->name ?? 'Thanh toán tour';
        $bookingId = $request->bookingId;
        $checkoutId = $request->checkoutId;
        $amountVnd = $request->amountVnd;


        $session = StripeSession::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => $tourName,
                    ],
                    'unit_amount' => $amountVnd, // VND zero-decimal
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('stripe.cancel') . '?checkoutId=' . $checkoutId,
            'metadata' => [
                'tourId'     => (string)$tourId,
                'bookingId'  => (string)$bookingId,
                'checkoutId' => (string)$checkoutId,
            ],
        ]);

        return redirect()->away($session->url);
    }
    
    public function stripeSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            toastr()->error('Thiếu session_id.');
            return redirect()->route('home');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = StripeSession::retrieve($sessionId);

        $checkoutId = (int)($session->metadata->checkoutId ?? 0);
        $bookingId  = (int)($session->metadata->bookingId ?? 0);
        $tourId     = (int)($session->metadata->tourId ?? 0);

        $transactionId = $session->payment_intent ?? $session->id;
        $checkout = Checkout::where('checkoutId', $checkoutId)->first();
        $booking= Booking::where('bookingId', $bookingId)->first();

        $totalPeople = $booking->numAdults + $booking->numChildren;
        if ($checkout->paymentStatus === 'y') {
            return redirect()->route('tour-booked', [
            'bookingId'  => $checkout->bookingId,
            'checkoutId' => $checkoutId,
        ]);
        }

        if (($session->payment_status ?? '') !== 'paid') {
            toastr()->error('Thanh toán chưa hoàn tất.');
            return redirect()->route('tour-booked', [
                'bookingId'  => $bookingId,
                'checkoutId' => $checkoutId,
            ]);
        }


        Tours::where('tourId', $booking->tourId)
            ->lockForUpdate()
            ->decrement('quantity', $totalPeople); 
        
        // 5️⃣ Update checkout 
        $checkout->update([
            'paymentStatus' => 'y',
            'transactionId' => $request->vnp_TransactionNo,
        ]);

        // 6️⃣ Confirm booking
        Booking::where('bookingId', $bookingId)->update([ 'bookingStatus' => 'y', ]);;

        toastr()->success('Thanh toán Stripe thành công!');
        return redirect()->route('tour-booked', [
            'bookingId'  => $bookingId,
            'checkoutId' => $checkoutId,
        ]);
    }

    public function stripeCancel(Request $request)
    {
        toastr()->warning('Bạn đã hủy thanh toán Stripe.');
        return redirect()->route('home');
    }


}
