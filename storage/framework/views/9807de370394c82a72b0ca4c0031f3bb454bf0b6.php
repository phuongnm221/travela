<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .signin-content,
    .signup-content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .forgot-password-form {
        width: 100%;
        max-width: 400px;
    }
    .form-title {
        text-align: center;
    }
    .form-group.form-button {
        text-align: center;
    }
</style>

<div class="login-template">
    <div class="main">
        <!-- Forgot Password Form -->
        <section class="sign-in show">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-form forgot-password-form">
                        <h2 class="form-title">Quên Mật Khẩu</h2>
                        <p style="color: #777; margin-bottom: 30px; text-align: center;">Nhập email hoặc tên đăng nhập của bạn, chúng tôi sẽ gửi hướng dẫn đặt lại mật khẩu</p>
                        <form action="<?php echo e(route('forgot-password.store')); ?>" method="POST" class="forgot-form" id="forgot-form" style="margin-top: 15px">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="email_forgot"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email_forgot" id="email_forgot" placeholder="Email hoặc Tên đăng nhập" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_email_forgot"></div>
                            <div class="form-group form-button">
                                <input type="submit" name="send" id="send" class="form-submit"
                                    value="Gửi Yêu Cầu" />
                            </div>
                        </form>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="<?php echo e(route('login')); ?>" style="color: #63AB45; font-size: 14px; text-decoration: none;">Quay lại đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/clients/forgot-password.blade.php ENDPATH**/ ?>