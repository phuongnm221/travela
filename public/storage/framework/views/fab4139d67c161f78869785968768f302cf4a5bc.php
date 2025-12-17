<?php $__currentLoopData = $list_booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($booking->title); ?></td>
        <td><?php echo e($booking->fullName); ?></td>
        <td><?php echo e($booking->email); ?></td>
        <td><?php echo e($booking->phoneNumber); ?></td>
        <td><?php echo e($booking->address); ?></td>
        <td><?php echo e(date('d-m-Y', strtotime($booking->bookingDate))); ?></td>
        <td><?php echo e($booking->numAdults); ?></td>
        <td><?php echo e($booking->numChildren); ?></td>
        <td><?php echo e(number_format($booking->totalPrice, 0, ',', '.')); ?></td>
        <td>
            <?php if($booking->bookingStatus == 'c'): ?>
                <span class="badge badge-danger">Đã hủy</span>
            <?php elseif($booking->bookingStatus == 'b'): ?>
                <span class="badge badge-warning">Chưa xác nhận</span>
            <?php elseif($booking->bookingStatus == 'y'): ?>
                <span class="badge badge-primary">Đã xác nhận</span>
            <?php elseif($booking->bookingStatus == 'f'): ?>
                <span class="badge badge-success">Đã hoàn thành</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if($booking->paymentMethod == 'vnpay-payment'): ?>
                <img src="<?php echo e(asset('clients/assets/images/booking/vnpay.png')); ?>" class="icon_payment" alt="">
            <?php elseif($booking->paymentMethod == 'stripe-payment'): ?>
                <img src="<?php echo e(asset('clients/assets/images/booking/Stripe-Logo.png')); ?>" class="icon_payment" alt="">
            <?php else: ?>
                <img src="<?php echo e(asset('admin/assets/images/icon/icon_office.png')); ?>" class="icon_payment" alt="">
            <?php endif; ?>
        </td>

        <td>
            <?php if($booking->paymentStatus == 'n'): ?>
                <span class="badge badge-danger">Chưa thanh toán</span>
            <?php else: ?>
                <span class="badge badge-success">Đã thanh toán</span>
            <?php endif; ?>
        </td>

        <td>
            <a href="<?php echo e(route('admin.booking-detail', ['id' => $booking->bookingId])); ?>"
            class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Xem chi tiết
            </a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/partials/list-booking.blade.php ENDPATH**/ ?>