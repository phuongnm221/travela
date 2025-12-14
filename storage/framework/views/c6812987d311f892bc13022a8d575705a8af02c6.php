<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3><?php echo e($title); ?></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Chỉnh sửa nhân sự</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if($errors && is_object($errors) && $errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('admin.staff.update', $staff->adminId)); ?>" method="POST" class="form-horizontal form-label-left">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="fullName" class="control-label col-md-3 col-sm-3 col-xs-12">Họ và tên <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="fullName" name="fullName" required class="form-control" value="<?php echo e($staff->fullName); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" required class="form-control" value="<?php echo e($staff->email); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Mật khẩu mới</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Để trống nếu không muốn thay đổi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber" class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo e($staff->phoneNumber ?? ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="address" name="address" class="form-control" value="<?php echo e($staff->address ?? ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                    <a href="<?php echo e(route('admin.staff.index')); ?>" class="btn btn-secondary">Hủy</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/staff/edit.blade.php ENDPATH**/ ?>