<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="row" style="display: inline-block;width: 100%">
                <div class="tile_count">
                    <div class="col-md-3 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Tổng số tours đang hoạt động</span>
                        <div class="count green"><i class="fa fa-sort-asc"></i> <?php echo e($summary['tourWorking']); ?></div>
                    </div>
                    <div class="col-md-3 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i> Tổng số lượt booking</span>
                        <div class="count green"><i class="fa fa-sort-asc"></i> <?php echo e($summary['countBooking']); ?></div>
                    </div>
                    <div class="col-md-3 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Số người dùng đăng ký</span>
                        <div class="count green"><i class="fa fa-sort-asc"></i> 2,500</div>
                    </div>
                    <div class="col-md-3 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Tổng doanh thu</span>
                        <div class="count red"><?php echo e(number_format($summary['totalAmount'], 0, ',', '.')); ?> vnđ</div>
                        <span class="sparkline_two" style="height: 160px;"><canvas width="196" height="40"
                                style="display: inline-block; width: 196px; height: 40px; vertical-align: top;"></canvas></span>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6 col-sm-4 ">
                    <div class="x_panel tile fixed_height_320 overflow_hidden">
                        <div class="x_title">
                            <h2>Điểm đến </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="" style="width:100%">
                                <tr>
                                    <th style="width:37%;">
                                        <p>Tổng hợp danh sách tours</p>
                                    </th>
                                    <th>
                                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                                            <p class="">Tên</p>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 " style="text-align: center">
                                            <p class="">Số lượng</p>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <canvas class="canvasDoughnut" height="140" width="140"
                                            style="margin: 15px 10px 10px 0"
                                            data-chart-values="<?php echo e(json_encode($dataDomain['values'])); ?>"></canvas>
                                    </td>
                                    <td>
                                        <table class="tile_info">
                                            <tr>
                                                <td>
                                                    <p><i class="fa fa-square red"></i>Miền Bắc </p>
                                                </td>
                                                <td><?php echo e($dataDomain['values'][0]); ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><i class="fa fa-square green"></i>Miền Trung </p>
                                                </td>
                                                <td><?php echo e($dataDomain['values'][1]); ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><i class="fa fa-square purple"></i>Miền Nam </p>
                                                </td>
                                                <td><?php echo e($dataDomain['values'][2]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-4  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Đặt tour</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div id="echart_donut" data-payment-method='<?php echo e(json_encode($paymentStatus)); ?>'
                                style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background-color: transparent;"
                                _echarts_instance_="ec_1733563825119">
                                <div
                                    style="position: relative; overflow: hidden; width: 380px; height: 350px; cursor: default;">
                                    <canvas width="380" height="350" data-zr-dom-id="zr_0"
                                        style="position: absolute; left: 0px; top: 0px; width: 380px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tours <small>được đặt nhiều nhất</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Số chỗ đã đặt</th>
                                        <th>Số chỗ còn trống</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $toursBooked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($item->tourId); ?></th>
                                            <td><?php echo e($item->title); ?></td>
                                            <td><?php echo e($item->booked_quantity); ?></td>
                                            <td><?php echo e($item->quantity); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Đơn đặt mới</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Tên tours</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $newBooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row">
                                                <a href="<?php echo e(route('admin.booking-detail',['id' => $item->bookingId])); ?>"><?php echo e($item->bookingId); ?></a>
                                            </th>
                                            <td><?php echo e($item->fullName); ?></td>
                                            <td><?php echo e($item->tour_name); ?></td>
                                            <td><?php echo e(number_format($item->totalPrice, 0, ',', '.')); ?></td>
                                            <td>
                                                <span class="badge badge-warning">Chưa xác nhận</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Doanh thu theo tháng</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="lineChart" data-revenue-per-month = <?php echo e(json_encode($revenue)); ?>></canvas>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
        <!-- /page content -->
    </div>
</div>

<?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>