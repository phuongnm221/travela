@foreach ($list_booking as $booking)
    <tr>
        <td>{{ $booking->title }}</td>
        <td>{{ $booking->fullName }}</td>
        <td>{{ $booking->email }}</td>
        <td>{{ $booking->phoneNumber }}</td>
        <td>{{ $booking->address }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->bookingDate)) }}</td>
        <td>{{ $booking->numAdults }}</td>
        <td>{{ $booking->numChildren }}</td>
        <td>{{ number_format($booking->totalPrice, 0, ',', '.') }}</td>
        <td>
            @if ($booking->bookingStatus == 'c')
                <span class="badge badge-danger">Đã hủy</span>
            @elseif ($booking->bookingStatus == 'b')
                <span class="badge badge-warning">Chưa xác nhận</span>
            @elseif ($booking->bookingStatus == 'y')
                <span class="badge badge-primary">Đã xác nhận</span>
            @elseif ($booking->bookingStatus == 'f')
                <span class="badge badge-success">Đã hoàn thành</span>
            @endif
        </td>
        <td>
            @if ($booking->paymentMethod == 'vnpay-payment')
                <img src="{{ asset('clients/assets/images/booking/vnpay.png') }}" class="icon_payment" alt="">
            @elseif ($booking->paymentMethod == 'stripe-payment')
                <img src="{{ asset('clients/assets/images/booking/Stripe-Logo.png') }}" class="icon_payment" alt="">
            @else
                <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}" class="icon_payment" alt="">
            @endif
        </td>

        <td>
            @if ($booking->paymentStatus == 'n')
                <span class="badge badge-danger">Chưa thanh toán</span>
            @else
                <span class="badge badge-success">Đã thanh toán</span>
            @endif
        </td>

        <td>
            <a href="{{ route('admin.booking-detail', ['id' => $booking->bookingId]) }}"
            class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Xem chi tiết
            </a>
        </td>
    </tr>
@endforeach
