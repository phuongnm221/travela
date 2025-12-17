<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class BookingController extends Controller
{
    private $tour;
    private $booking;
    private $checkout;

    public function __construct()
    {
        parent::__construct();
        $this->tour = new Tours();
        $this->booking = new Booking();
        $this->checkout = new Checkout();
    }

    public function index($id)
    {
        $title = 'Đặt Tour';
        $tour = $this->tour->getTourDetail($id);
        $user = null;
        $userId = $this->getUserId();
        if ($userId) {
            $user = $this->user->getUser($userId);
        }
        return view('clients.booking', compact('title', 'tour', 'user'));
    }

    public function createBooking(Request $req)
    {
        // dd($req);
        $address = $req->input('address');
        $email = $req->input('email');
        $fullName = $req->input('fullName');
        $numAdults = $req->input('numAdults');
        $numChildren = $req->input('numChildren');
        $paymentMethod = $req->input('payment_hidden');
        $tel = $req->input('tel');
        $totalPrice = $req->input('totalPrice');
        $tourId = $req->input('tourId');
        $userId = $this->getUserId();
        $totalPeople=$numAdults + $numChildren;
        /**
         * Xử lý booking và checkout
         */
        // 1️⃣ Validate dữ liệu
        $req->validate([
            'fullName' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'numAdults' => 'required|integer|min:1',
            'payment_hidden' => 'required',
        ]);


        DB::beginTransaction();
        try {
            // 1️⃣ Lock tour + kiểm tra chỗ
            $tour = Tours::where('tourId', $tourId)
            ->lockForUpdate()
            ->firstOrFail();


            if ($tour->quantity < $totalPeople) {
                DB::rollBack();
                toastr()->error('Tour không đủ chỗ');
                return redirect()->back();
            }

        // 3️⃣ Tạo booking (PENDING)
             $booking =  [
                'tourId' => $tourId,
                'userId' => $userId,
                'address' => $address,
                'fullName' => $fullName,
                'email' => $email,
                'numAdults' => $numAdults,
                'numChildren' => $numChildren,
                'phoneNumber' => $tel,
                'totalPrice' => $totalPrice,
                'bookingStatus' => 'b', // booked
            ];
        
            $bookingId = $this->booking->createBooking($booking);

            // 4️⃣ Tạo checkout (PENDING)
            $checkout = [
                'bookingId' => $bookingId,
                'paymentMethod' => $paymentMethod,
                'amount' => $totalPrice,
                'paymentStatus' => 'n', // Chưa thanh toán
            ];
            
            $checkoutId = $this->checkout->createCheckout($checkout);
            DB::commit();

             } catch (\Throwable $e) {
                DB::rollBack();
                dd($e->getMessage()); // DEBUG RÕ LỖI
            }

        
            // 5️⃣ Rẽ nhánh theo phương thức thanh toán
        switch ($paymentMethod) {
            case 'stripe-payment':
                return redirect()->route('stripe.checkout', [
                    'tourId'     => $tourId,
                    'bookingId'  => $bookingId,
                    'checkoutId' => $checkoutId,
                    'amountVnd'  => $totalPrice,
                ]);
            case 'vnpay-payment':
                // Redirect sang route xử lý VNPay
                return redirect()->route('createVnpayPayment', [
                    'bookingId' => $bookingId,
                    'checkoutId' => $checkoutId 
               ]);

            case 'office-payment':
                $this->confirmAfterPaid($bookingId);
                toastr()->success('Đặt tour thành công!');
                return redirect()->route('tour-booked', [
                    'bookingId' => $bookingId,
                    'checkoutId' => $checkoutId,
                ]);

            default:
                toastr()->error('Phương thức thanh toán không hợp lệ.');
                return redirect()->back();
        }

        $title = 'Thanh toán thất bại';
        return view('clients.booking', compact('title', 'tour'));
    }

    public function confirmAfterPaid(int $bookingId)
    {
        DB::transaction(function () use ($bookingId) {

            $booking = Booking::lockForUpdate()->findOrFail($bookingId);

            if ($booking->bookingStatus === 'b') {
                return;
            }

            $booking->update([
                'bookingStatus' => 'b'
            ]);

            Checkout::where('bookingId', $bookingId)
                ->update(['paymentStatus' => 'n']);

            // Trừ số lượng tour
            $tour = Tours::lockForUpdate()->find($booking->tourId);
            if ($tour) {
                $tour->decrement('quantity', $totalPeople);
            }
            
        });
    }


    //Kiểm tra người dùng đã đặt và hoàn thành tour hay chưa để đánh giá
    public function checkBooking(Request $req){
        $tourId = $req->tourId;
        $userId = $this->getUserId();
        $check = $this->booking->checkBooking($tourId, $userId);

        return response()->json(['success' => (bool)$check]);
    }
}

