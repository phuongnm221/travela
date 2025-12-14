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

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thông tin cá nhân</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">ID</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo e($userData->adminId); ?>" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="fullName" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Họ và tên <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="fullName" name="fullName" required class="form-control" value="<?php echo e(old('fullName', $userData->fullName)); ?>" style="border-radius: 6px;">
                                    <?php $__errorArgs = ['fullName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Tên đăng nhập</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo e($userData->username); ?>" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="email" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Email <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="email" id="email" name="email" required class="form-control" value="<?php echo e(old('email', $userData->email)); ?>" style="border-radius: 6px;">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Vai trò</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo e(ucfirst($userData->role ?? 'admin')); ?>" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="phoneNumber" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo e(old('phoneNumber', $userData->phoneNumber ?? '')); ?>" placeholder="Nhập số điện thoại" style="border-radius: 6px;">
                                    <?php $__errorArgs = ['phoneNumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="address" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Địa chỉ</label>
                                <div class="col-sm-8">
                                    <input type="text" id="address" name="address" class="form-control" value="<?php echo e(old('address', $userData->address ?? '')); ?>" placeholder="Nhập địa chỉ" style="border-radius: 6px;">
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="password" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Mật khẩu mới (để trống nếu không thay đổi)</label>
                                <div class="col-sm-8">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" style="border-radius: 6px;">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Ngày tạo</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo e(\Carbon\Carbon::parse($userData->createdDate)->format('d/m/Y H:i')); ?>" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="ln_solid" style="margin: 32px 0 24px 0;"></div>
                            <div class="form-group row" style="text-align: center;">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success" style="min-width: 140px; font-weight: 600; font-size: 16px; border-radius: 6px; margin-right: 12px;">Cập nhật</button>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-default" style="min-width: 100px; font-size: 16px; border-radius: 6px;">Hủy</a>
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
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/profile.blade.php ENDPATH**/ ?>