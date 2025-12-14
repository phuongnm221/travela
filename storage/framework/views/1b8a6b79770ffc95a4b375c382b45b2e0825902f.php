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
            <?php if($booking->paymentMethod == 'momo-payment'): ?>
                <img src="<?php echo e(asset('admin/assets/images/icon/icon_momo.png')); ?>" class="icon_payment" alt="">
            <?php elseif($booking->paymentMethod == 'paypal-payment'): ?>
                <img src="<?php echo e(asset('admin/assets/images/icon/icon_paypal.png')); ?>" class="icon_payment" alt="">
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
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(71px, 38px, 0px);">
                    <?php if($booking->bookingStatus == 'b'): ?>
                    <a class="dropdown-item confirm-booking" href="javascript:void(0)" data-bookingId="<?php echo e($booking->bookingId); ?>"
                        data-urlConfirm="<?php echo e(route('admin.confirm-booking')); ?>">Xác nhận</a>
                    <?php endif; ?>
                    <a class="dropdown-item finish-booking <?php echo e($booking->hide); ?>" href="javascript:void(0)" data-bookingId="<?php echo e($booking->bookingId); ?>"
                        data-urlfinish="<?php echo e(route('admin.finish-booking')); ?>">Đã hoàn thành</a>
                    <a class="dropdown-item" href="<?php echo e(route('admin.booking-detail',['id' => $booking->bookingId])); ?>">Xem chi tiết</a>
                </div>
            </div>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/partials/list-booking.blade.php ENDPATH**/ ?>