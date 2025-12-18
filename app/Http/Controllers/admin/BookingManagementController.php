<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\BookingModel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use Illuminate\Support\Facades\DB;

class BookingManagementController extends Controller
{

    private $booking;

    public function __construct()
    {
        $this->booking = new BookingModel();
    }
    public function index()
    {
        $title = 'Quản lý đặt Tour';
        DB::table('tbl_booking as b')
            ->join('tbl_tours as t', 'b.tourId', '=', 't.tourId')
            ->where('b.bookingStatus', 'y')
            ->whereDate('t.endDate', '<', now())
            ->update(['bookingStatus' => 'f']);
        $list_booking = $this->booking->getBooking();
        $list_booking = $this->updateHideBooking($list_booking);

        // dd($list_booking);

        return view('admin.booking', compact('title', 'list_booking'));
    }


    public function showDetail($bookingId)
    {
        $title = 'Chi tiết đơn đặt';

        $invoice_booking = $this->booking->getInvoiceBooking($bookingId);
        // dd($invoice_booking);
        $hide='hide';
        if ($invoice_booking->paymentMethod === 'office-payment'
            && $invoice_booking->paymentStatus === 'n') {
            $hide = '';
        }
        return view('admin.booking-detail', compact('title', 'invoice_booking','hide'));
    }


    public function sendPdf(Request $request)
    {
        $bookingId = $request->input('bookingId');
        $email = $request->input('email');
        $title = 'Hóa đơn';
        $invoice_booking = $this->booking->getInvoiceBooking($bookingId);

        if ($invoice_booking->transactionId == null) {
            $invoice_booking->transactionId = 'Thanh toán tại công ty Travela';
        }

        try {
            Mail::send('admin.emails.invoice', compact('invoice_booking'), function ($message) use ($invoice_booking) {
                $message->to($invoice_booking->email)
                    ->subject('Hóa đơn đặt tour của khách hàng ' . $invoice_booking->fullName);
            });

            return response()->json([
                'success' => true,
                'message' => 'Hóa đơn đã được gửi qua email thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi email: ' . $e->getMessage(),
            ], 500);
        }

    }


    public function receivedMoney(Request $request)
    {
        $bookingId = (int) $request->bookingId;

        DB::beginTransaction();
        try {
            // 1️⃣ Lock booking
            $booking = Booking::lockForUpdate()->findOrFail($bookingId);

            // Nếu đã confirm rồi → bỏ qua
            if ($booking->bookingStatus === 'y') {
                DB::rollBack();
                return response()->json([
                    'success' => true,
                    'message' => 'Booking đã được xác nhận trước đó.',
                ]);
            }

            // 2️⃣ Lock checkout
            $checkout = Checkout::lockForUpdate()
                ->where('bookingId', $bookingId)
                ->firstOrFail();
            
            if ($checkout->paymentMethod !== 'office-payment') {
                    throw new \Exception('Đơn này không thanh toán tại văn phòng.');
                }

            // 3️⃣ Update checkout (đã nhận tiền)
            $checkout->update([
                'paymentStatus' => 'y'
            ]);

            // 4️⃣ Confirm booking
            $booking->update([
                'bookingStatus' => 'y'
            ]);

            // 5️⃣ Trừ số lượng tour
            $totalPeople = $booking->numAdults + $booking->numChildren;

            $tour = Tours::lockForUpdate()->findOrFail($booking->tourId);

            if ($tour->quantity < $totalPeople) {
                throw new \Exception('Tour không đủ chỗ.');
            }

            $tour->decrement('quantity', $totalPeople);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Xác nhận nhận tiền và booking thành công.',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    private function updateHideBooking($list_booking)
    {
        // Lấy ngày hiện tại
        $currentDate = date('Y-m-d');

        foreach ($list_booking as $booking) {
            // So sánh endDate của booking với ngày hiện tại
            if ($booking->endDate < $currentDate) {
                $hide = '';
            } else {
                $hide = 'hide';
            }

            // Gán giá trị $hide vào mỗi booking
            $booking->hide = $hide;
        }

        return $list_booking;
    }

}
