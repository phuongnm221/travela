<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Hóa đơn <small>đặt tour du lịch</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="invoice_booking">
                                <div class="x_title">
                                    <h2>Hóa đơn chi tiết</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <section class="content invoice" id="print-area">
                                        <!-- title row -->
                                        <div class="invoice-header-fixed">
    <div class="invoice-title">
        <img src="<?php echo e(asset('admin/assets/images/icon/icon_office.png')); ?>"
            style="margin-right:10px">
        <?php echo e($invoice_booking->title); ?>

    </div>

    <div class="invoice-date">
        Ngày: <?php echo e(date('d-m-Y', strtotime($invoice_booking->bookingDate))); ?>

    </div>
</div>





                                            <!-- /.col -->
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                Từ
                                                <address>
                                                    <strong><?php echo e($invoice_booking->fullName); ?></strong>
                                                    <br><?php echo e($invoice_booking->address); ?>

                                                    <br>Số điện thoại: <?php echo e($invoice_booking->phoneNumber); ?>

                                                    <br>Email:<?php echo e($invoice_booking->email); ?>

                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                Đến
                                                <address>
                                                    <strong>Công ty Travela</strong>
                                                    <br>470 Trần Đại Nghĩa
                                                    <br>Ngũ Hành Sơn, Đà Nẵng
                                                    <br>Phone: 1 (804) 123-9876
                                                    <br>Email: minhdien.dev@gmail.com
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Mã hóa đơn #<?php echo e($invoice_booking->checkoutId); ?></b>
                                                <br>
                                                <br>
                                                <b>Mã giao dịch:</b> <?php echo e($invoice_booking->transactionId ?? 'Thanh toán tại công ty Travela'); ?>


                                                <br>
                                                <b>Ngày thanh toán:</b>
                                                <?php echo e($invoice_booking->paymentDate ? date('d-m-Y', strtotime($invoice_booking->paymentDate)) : '---'); ?>

                                                <br>
                                                <b>Tài khoản:</b> <?php echo e($invoice_booking->userId); ?>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="  table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Số lượng</th>
                                                            <th>Đơn giá</th>
                                                            <th>Điểm đến</th>
                                                            <th>Tổng tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Người lớn</td>
                                                            <td><?php echo e($invoice_booking->numAdults); ?></td>
                                                            <td><?php echo e(number_format($invoice_booking->priceAdult, 0, ',', '.')); ?>

                                                                vnđ</td>
                                                            <td><?php echo e($invoice_booking->destination); ?></td>
                                                            <td><?php echo e(number_format($invoice_booking->priceAdult * $invoice_booking->numAdults, 0, ',', '.')); ?>

                                                                vnđ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trẻ em</td>
                                                            <td><?php echo e($invoice_booking->numChildren); ?></td>
                                                            <td><?php echo e(number_format($invoice_booking->priceChild, 0, ',', '.')); ?>

                                                                vnđ</td>
                                                            <td><?php echo e($invoice_booking->destination); ?></td>
                                                            <td><?php echo e(number_format($invoice_booking->priceChild * $invoice_booking->numChildren, 0, ',', '.')); ?>

                                                                vnđ</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-md-6">
                                                <p class="lead">Phương thức thanh toán:</p>
                                                <?php if($invoice_booking->paymentMethod == 'vnpay-payment'): ?>
                                                    <img src="<?php echo e(asset('clients/assets/images/booking/vnpay.png')); ?>"
                                                        class="invoice_payment-method" alt="">
                                                    <span class="badge badge-info">Thanh toán bằng VNpay</span>
                                                <?php elseif($invoice_booking->paymentMethod == 'stripe-payment'): ?>
                                                    <img src="<?php echo e(asset('clients/assets/images/booking/Stripe-Logo.png')); ?>"
                                                        class="invoice_payment-method" alt="">
                                                    <span class="badge badge-info">Thanh toán bằng Stripe</span>
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('admin/assets/images/icon/icon_office.png')); ?>"
                                                        alt="">
                                                    <span class="badge badge-info">Thanh toán tại văn phòng</span>
                                                <?php endif; ?>
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    Vui lòng hoàn tất thanh toán theo hướng dẫn hoặc liên hệ với chúng
                                                    tôi nếu cần hỗ trợ.
                                                </p>
                                                <?php if($invoice_booking->paymentStatus === 'y'): ?>
                                                    <span class="badge badge-success">Đã thanh toán</span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">Chưa thanh toán</span>
                                                <?php endif; ?>

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <p class="lead">Số tiền phải trả trước
                                                    <?php echo e(date('d-m-Y', strtotime($invoice_booking->startDate))); ?></p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Tổng tiền:</th>
                                                                <td><?php echo e(number_format($invoice_booking->totalPrice, 0, ',', '.')); ?>

                                                                    vnđ</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tax (0%)</th>
                                                                <td>0 vnđ</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Giảm giá</th>
                                                                <td>0 vnđ</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tổng tiền:</th>
                                                                <td><?php echo e(number_format($invoice_booking->amount, 0, ',', '.')); ?>

                                                                    vnđ</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->


                                    </section>
                                </div>
                            </div>
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class=" ">
                                    <button class="btn btn-default" onclick="window.print();"><i
                                            class="fa fa-print"></i> Print</button>
                                    <button id="send-pdf-btn" data-bookingid= "<?php echo e($invoice_booking->bookingId); ?>"
                                        data-email="<?php echo e($invoice_booking->email); ?>"
                                        data-urlSendMail=<?php echo e(route('admin.send.pdf')); ?>

                                        class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                            class="fa fa-send"></i> Gửi hóa đơn cho khách hàng</button>
                                    <button id="received-money" data-bookingid= "<?php echo e($invoice_booking->bookingId); ?>"
                                         data-urlPaid="<?php echo e(route('admin.received')); ?>"
                                        class="btn btn-info pull-right <?php echo e($hide); ?>" style="margin-right: 5px;"><i
                                            class="glyphicon glyphicon-usd"></i> Xác nhận đã nhận tiền</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #print-area,
    #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}

</style>



<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/booking-detail.blade.php ENDPATH**/ ?>