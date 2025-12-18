<p style="font-size: 16px; font-family: Arial, sans-serif; color: #333;">Chào <?php echo e($invoice_booking->fullName); ?>,</p>
<p style="font-size: 16px; font-family: Arial, sans-serif; color: #333;">Cảm ơn bạn đã đặt tour tại Travela. Vui lòng xem chi tiết hóa đơn trong file đính kèm.</p>
<p style="font-size: 16px; font-family: Arial, sans-serif; color: #333;">Chúc bạn một chuyến đi vui vẻ!</p>

<div class="invoice_booking" style="border: 1px solid #ddd; padding: 20px; background-color: #f9f9f9;">
    <div class="x_title" style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; color: #2c3e50; font-family: Arial, sans-serif;">Hóa đơn chi tiết</h2>
    </div>
    <div class="x_content" style="font-family: Arial, sans-serif; color: #333;">
        <section class="content invoice">
            <!-- title row -->
            <div class="row" style="margin-bottom: 20px;">
                <div class="invoice-header">
                    <h3 style="font-size: 20px; font-weight: bold;">
                        <img src="<?php echo e(asset('admin/assets/images/icon/icon_office.png')); ?>" alt="" style="margin-right: 10px; vertical-align: middle;">
                        <?php echo e($invoice_booking->title); ?>

                        <small style="float: right; font-size: 14px;">Ngày: <?php echo e(date('d-m-Y', strtotime($invoice_booking->bookingDate))); ?></small>
                    </h3>
                </div>
            </div>

            <!-- info row -->
            <div class="row invoice-info" style="margin-bottom: 20px;">
                <div class="col-sm-4 invoice-col" style="font-size: 14px;">
                    Từ
                    <address>
                        <strong><?php echo e($invoice_booking->fullName); ?></strong><br>
                        <?php echo e($invoice_booking->address); ?><br>
                        Số điện thoại: <?php echo e($invoice_booking->phoneNumber); ?><br>
                        Email: <?php echo e($invoice_booking->email); ?>

                    </address>
                </div>
                <div class="col-sm-4 invoice-col" style="font-size: 14px;">
                    Đến
                    <address>
                        <strong>Công ty Travela</strong><br>
                        470 Trần Đại Nghĩa<br>
                        Ngũ Hành Sơn, Đà Nẵng<br>
                        Phone: 1 (804) 123-9876<br>
                        Email: minhdien.dev@gmail.com
                    </address>
                </div>
                <br>
                <div class="col-sm-4 invoice-col" style="font-size: 14px;">
                    <b>Mã hóa đơn #<?php echo e($invoice_booking->checkoutId); ?></b><br>
                    <b>Mã giao dịch:</b> <?php echo e($invoice_booking->transactionId); ?><br>
                    <b>Ngày thanh toán:</b> <?php echo e($invoice_booking->paymentDate); ?><br>
                    <b>Tài khoản:</b> <?php echo e($invoice_booking->userId); ?><br>
                    <b>Tình trạng thanh toán:</b>
                    <?php if($invoice_booking->paymentStatus == 'y'): ?>
                        <span style="color: green; font-weight: bold;">Đã thanh toán</span>
                    <?php else: ?>
                        <span style="color: orange; font-weight: bold;">Chưa thanh toán</span>
                    <?php endif; ?>
                    <br>
                </div>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="table" style="width: 100%; margin-bottom: 20px;">
                    <table class="table table-striped" style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th style="padding: 8px; text-align: left;">Loại</th>
                                <th style="padding: 8px; text-align: left;">Số lượng</th>
                                <th style="padding: 8px; text-align: left;">Đơn giá</th>
                                <th style="padding: 8px; text-align: left;">Điểm đến</th>
                                <th style="padding: 8px; text-align: left;">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #ddd;">
                                <td style="padding: 8px;">Người lớn</td>
                                <td style="padding: 8px;"><?php echo e($invoice_booking->numAdults); ?></td>
                                <td style="padding: 8px;"><?php echo e(number_format($invoice_booking->priceAdult, 0, ',', '.')); ?> vnđ</td>
                                <td style="padding: 8px;"><?php echo e($invoice_booking->destination); ?></td>
                                <td style="padding: 8px;"><?php echo e(number_format($invoice_booking->priceAdult * $invoice_booking->numAdults, 0, ',', '.')); ?> vnđ</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #ddd;">
                                <td style="padding: 8px;">Trẻ em</td>
                                <td style="padding: 8px;"><?php echo e($invoice_booking->numChildren); ?></td>
                                <td style="padding: 8px;"><?php echo e(number_format($invoice_booking->priceChild, 0, ',', '.')); ?> vnđ</td>
                                <td style="padding: 8px;"><?php echo e($invoice_booking->destination); ?></td>
                                <td style="padding: 8px;"><?php echo e(number_format($invoice_booking->priceChild * $invoice_booking->numChildren, 0, ',', '.')); ?> vnđ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- payment method row -->
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6">
                    <p style="font-size: 16px; font-weight: bold;">Phương thức thanh toán:</p>
                    <?php if($invoice_booking->paymentMethod == 'vnpay-payment'): ?>
                    <h3 style="color: red; font-weight: bold;">Thanh toán qua VNpay</h3>
                    <?php elseif($invoice_booking->paymentMethod == 'stripe-payment'): ?>
                    <h3 style="color: red; font-weight: bold;">Thanh toán qua Stripe</h3>
                    <?php else: ?>
                    <h3 style="color: red; font-weight: bold;">Thanh toán tại văn phòng</h3>
                    <?php endif; ?>
                    <p style="font-size: 14px; color: #555; margin-top: 10px;">Vui lòng hoàn tất thanh toán theo hướng dẫn hoặc liên hệ với chúng tôi nếu cần hỗ trợ.</p>
                </div>
                <div class="col-md-6">
                    <p style="font-size: 16px; font-weight: bold;">Số tiền phải trả trước <?php echo e(date('d-m-Y', strtotime($invoice_booking->startDate))); ?></p>
                    <div class="table-responsive">
                        <table class="table" style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <th style="width: 50%; padding: 8px; text-align: left;">Tổng tiền:</th>
                                    <td style="padding: 8px;"><?php echo e(number_format($invoice_booking->totalPrice, 0, ',', '.')); ?> vnđ</td>
                                </tr>
                                <tr>
                                    <th style="padding: 8px; text-align: left;">Tax (0%)</th>
                                    <td style="padding: 8px;">0 vnđ</td>
                                </tr>
                                <tr>
                                    <th style="padding: 8px; text-align: left;">Giảm giá</th>
                                    <td style="padding: 8px;">0 vnđ</td>
                                </tr>
                                <tr>
                                    <th style="padding: 8px; text-align: left;">Tổng tiền:</th>
                                    <td style="padding: 8px; 
                                        color: <?php echo e($invoice_booking->paymentStatus == 'y' ? 'green' : 'red'); ?>">
                                        <?php echo e(number_format($invoice_booking->amount, 0, ',', '.')); ?> vnđ
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/emails/invoice.blade.php ENDPATH**/ ?>