<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .sign-in {
        display: block !important;
    }
</style>

<div class="login-template">
    <div class="main">
        <!-- Sign in  Form -->
        <section class="sign-in show">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?php echo e(asset('clients/assets/images/login/signin-image.jpg')); ?>"
                                alt="sing up image"></figure>
                        <a href="<?php echo e(route('register')); ?>" class="signup-image-link">Tạo tài khoản</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập</h2>
                        <form action="<?php echo e(route('user-login')); ?>" method="POST" class="login-form" id="login-form" style="margin-top: 15px">
                            <div class="form-group">
                                <label for="username_login"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_login" id="username_login" placeholder="Tên đăng nhập hoặc Email" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_username"></div>
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="password_login"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_login" id="password_login" placeholder="Mật khẩu" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_password"></div>
                            <div style="text-align: right; margin-bottom: 20px;">
                                <a href="<?php echo e(route('forgot-password')); ?>" style="color: #63AB45; font-size: 14px; text-decoration: none;">Quên mật khẩu?</a>
                                <span style="color: #999; margin: 0 5px;">|</span>
                                <a href="#" id="resend-activation-link" style="color: #63AB45; font-size: 14px; text-decoration: none; display: none;">Gửi lại email xác nhận?</a>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit"
                                    value="Đăng nhập" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Hoặc đăng nhập bằng</span>
                            <ul class="socials">
                                <li><a href="<?php echo e(route('login-google')); ?>"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/login.blade.php ENDPATH**/ ?>