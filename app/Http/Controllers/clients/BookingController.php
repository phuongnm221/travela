<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $tour  = $this->tour->getTourDetail($id);
        $transIdMomo = null;
        $user = null;
        $userId = $this->getUserId();
        if ($userId) {
            $user = $this->user->getUser($userId);
        }
        return view('clients.booking', compact('title','tour','transIdMomo','user'));

    }

    public function createBooking(Request $req)
    {
        $address       = $req->input('address');
        $email         = $req->input('email');
        $fullName      = $req->input('fullName');
        $numAdults     = (int)$req->input('numAdults', 0);
        $numChildren   = (int)$req->input('numChildren', 0);
        $paymentMethod = $req->input('payment_hidden') ?? $req->input('payment'); // stripe-payment | momo-payment | offline
        $tel           = $req->input('tel');
        $totalPrice    = (int)$req->input('totalPrice', 0);
        $tourId        = (int)$req->input('tourId');
        $userId        = $this->getUserId();

        if (empty($paymentMethod)) {
            toastr()->error('Vui lòng chọn phương thức thanh toán!');
            return redirect()->back();
}

        if ($tourId <= 0 || $totalPrice <= 0 || ($numAdults + $numChildren) <= 0) {
            toastr()->error('Thông tin đặt tour không hợp lệ!');
            return redirect()->back();
        }

        $tour = $this->tour->getTourDetail($tourId);
        if (!$tour) {
            toastr()->error('Tour không tồn tại!');
            return redirect()->back();
        }
        if ((int)$tour->quantity < ($numAdults + $numChildren)) {
            toastr()->error('Số chỗ còn lại không đủ!');
            return redirect()->back();
        }

        // 1) Tạo booking (pending)
        $dataBooking = [
            'tourId'      => $tourId,
            'userId'      => $userId,
            'address'     => $address,
            'fullName'    => $fullName,
            'email'       => $email,
            'numAdults'   => $numAdults,
            'numChildren' => $numChildren,
            'phoneNumber' => $tel,
            'totalPrice'  => $totalPrice
        ];

        $bookingId = $this->booking->createBooking($dataBooking);
        if (empty($bookingId)) {
            toastr()->error('Có vấn đề khi tạo booking!');
            return redirect()->back();
        }

        // 2) Tạo checkout (pending)
        $dataCheckout = [
            'bookingId'     => $bookingId,
            'paymentMethod' => $paymentMethod,
            'amount'        => $totalPrice,
            'paymentStatus' => 'n',   // CHƯA thanh toán
            'transactionId' => null,
        ];

        $checkoutId = $this->checkout->createCheckout($dataCheckout);
        if (empty($checkoutId)) {
            toastr()->error('Có vấn đề khi tạo checkout!');
            return redirect()->back();
        }

        // 3) Stripe: redirect sang Stripe Checkout
        if ($paymentMethod === 'stripe-payment') {
            return $this->redirectToStripe($tourId, $bookingId, $checkoutId, $totalPrice);
        }

        // 4) MoMo: (giữ nguyên flow hiện tại của bạn: payment trước)
        // Bạn có thể giữ như cũ: bấm MoMo sẽ gọi createMomoPayment bằng AJAX.
        // Tại đây vẫn cho đặt tour thành công, còn thanh toán MoMo xử lý riêng.
        if ($paymentMethod === 'momo-payment') {
            toastr()->success('Đặt tour thành công! Vui lòng hoàn tất thanh toán MoMo.');
            return redirect()->route('tour-booked', [
                'bookingId'  => $bookingId,
                'checkoutId' => $checkoutId,
            ]);
        }

        // 5) Offline
        toastr()->success('Đặt tour thành công! (Thanh toán sau)');
        return redirect()->route('tour-booked', [
            'bookingId'  => $bookingId,
            'checkoutId' => $checkoutId,
        ]);
    }

    private function redirectToStripe(int $tourId, int $bookingId, int $checkoutId, int $amountVnd)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $tour = $this->tour->getTourDetail($tourId);
        $tourName = $tour->name ?? 'Thanh toán tour';

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

        if ($checkoutId <= 0 || $bookingId <= 0 || $tourId <= 0) {
            toastr()->error('Không xác định được đơn thanh toán.');
            return redirect()->route('home');
        }

        if (($session->payment_status ?? '') !== 'paid') {
            toastr()->error('Thanh toán chưa hoàn tất.');
            return redirect()->route('tour-booked', [
                'bookingId'  => $bookingId,
                'checkoutId' => $checkoutId,
            ]);
        }

        $transactionId = $session->payment_intent ?? $session->id;

        Checkout::where('checkoutId', $checkoutId)->update([
    'paymentStatus' => 'y',
    'transactionId' => $transactionId,
]);
// Auto confirm booking vì đã thanh toán online
Booking::where('bookingId', $bookingId)->update([
    'bookingStatus' => 'y', // confirmed
]);



        // Trừ quantity sau khi paids
        $bk = Booking::find($bookingId);

        if ($bk) {
            $minus = (int)$bk->numAdults + (int)$bk->numChildren;

            $tour = $this->tour->getTourDetail($tourId);
            if ($tour) {
                $newQty = max(0, (int)$tour->quantity - $minus);
                $this->tour->updateTours($tourId, ['quantity' => $newQty]);
            }
        }

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

    // =========================
    // MoMo giữ nguyên (chỉ chỉnh URL callback cho đúng route)
    // =========================
    public function createMomoPayment(Request $request)
    {
        session()->put('tourId', $request->tourId);

        try {
            $amount = 10000; // NOTE: bạn nên lấy amount thật từ request

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = "MOMOBKUN20180529";
            $accessKey = "klm05TvNBzhg7h7j";
            $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";

            $orderInfo = "Thanh toán đơn hàng";
            $requestId = time();
            $orderId = time();
            $extraData = "";

            // ✅ SỬA: dùng route callback momo
            $redirectUrl = route('momo.callback');
            $ipnUrl      = route('momo.callback');

            $requestType = 'payWithATM';

            $rawHash = "accessKey=" . $accessKey .
                "&amount=" . $amount .
                "&extraData=" . $extraData .
                "&ipnUrl=" . $ipnUrl .
                "&orderId=" . $orderId .
                "&orderInfo=" . $orderInfo .
                "&partnerCode=" . $partnerCode .
                "&redirectUrl=" . $redirectUrl .
                "&requestId=" . $requestId .
                "&requestType=" . $requestType;

            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                'storeId' => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $response = Http::post($endpoint, $data);

            if ($response->successful()) {
                $body = $response->json();
                if (isset($body['payUrl'])) {
                    return response()->json(['payUrl' => $body['payUrl']]);
                }
                return response()->json(['error' => 'Invalid response from MoMo', 'details' => $body], 400);
            }

            return response()->json(['error' => 'Lỗi kết nối với MoMo', 'details' => $response->body()], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function handlePaymentMomoCallback(Request $request)
    {
        $resultCode = $request->input('resultCode');
        $transIdMomo = $request->query('transId');

        $tourId = session()->get('tourId');
        $tour = $this->tour->getTourDetail($tourId);
        session()->forget('tourId');

        if ($resultCode == '0') {
            $title = 'Đã thanh toán';
            return view('clients.booking', compact('title', 'tour', 'transIdMomo'));
        }

        $title = 'Thanh toán thất bại';
        return view('clients.booking', compact('title', 'tour'));
    }

    public function checkBooking(Request $req)
    {
        $tourId = $req->tourId;
        $userId = $this->getUserId();
        $check = $this->booking->checkBooking($tourId, $userId);

        return response()->json(['success' => (bool)$check]);
    }
}
