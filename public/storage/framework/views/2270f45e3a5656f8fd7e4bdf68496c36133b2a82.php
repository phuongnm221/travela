<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Thông tin cá nhân</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-3 col-sm-3  profile_left">
                                    <div class="profile_img">
                                        <div id="crop-avatar">
                                            <!-- Current avatar -->
                                            <img id="avatarAdminPreview" class="img-responsive avatar-view"
                                                src="<?php echo e(asset('admin/assets/images/user-profile/avt_admin.jpg')); ?>"
                                                alt="Avatar" style="width:100%" title="Change the avatar">
                                            <input type="file" name="avatarAdmin" id="avatarAdmin" style="display: none"
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <br>
                                    <label for="avatarAdmin" id="btn_avatar" class="btn btn-success"
                                        style=" align-items: center; text-align: center; width: 78%;margin: 10px 24px;" action=<?php echo e(route('admin.update-avatar')); ?>>
                                        <i class="fa fa-edit m-right-xs"></i>Tải ảnh lên</label>
                                    <h3 id="nameAdmin"><?php echo e($admin->fullName); ?></h3>

                                    <ul class="list-unstyled user_data">
                                        <li>
                                            <i class="fa fa-map-marker user-profile-icon"></i> <span
                                                id="emailAdmin"><?php echo e($admin->address); ?></span>
                                        </li>
                                        <li>
                                            <i class="fa fa-briefcase user-profile-icon"></i> <span
                                                id="addressAdmin"><?php echo e($admin->email); ?></span>
                                        </li>

                                    </ul>
                                    <br />

                                </div>
                                <div class="col-md-9 col-sm-9 ">
                                    <form action="<?php echo e(route('admin.update-admin')); ?>" id="formProfileAdmin"
                                        class="form-horizontal form-label-left">
                                        <?php echo csrf_field(); ?>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="fullName">Tên admin <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="fullName" name="fullName" required
                                                    class="form-control" placeholder="Nhập tên admin"
                                                    value="<?php echo e($admin->fullName); ?>">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="password">Mật khẩu <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="password" id="password" name="password" required
                                                    class="form-control" placeholder="Nhập mật khẩu"
                                                    value="<?php echo e($admin->password); ?>">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="email"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="email" class="form-control" type="email" name="email"
                                                    required placeholder="Nhập email" value="<?php echo e($admin->email); ?>">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="address"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Địa chỉ</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="address" class="form-control" type="text"
                                                    name="address" required placeholder="Nhập địa chỉ"
                                                    value="<?php echo e($admin->address); ?>">
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button type="submit" class="btn btn-success">Cập nhật</button>
                                            </div>
                                        </div>

                                    </form>

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
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/profile-admin.blade.php ENDPATH**/ ?>