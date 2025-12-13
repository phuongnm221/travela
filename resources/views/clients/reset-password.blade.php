@include('clients.blocks.header')

<style>
    .signin-content,
    .signup-content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .reset-password-form {
        width: 100%;
        max-width: 400px;
    }
</style>

<div class="login-template">
    <div class="main">
        <!-- Reset Password Form -->
        <section class="sign-in show">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-form reset-password-form">
                        <h2 class="form-title">Đặt Lại Mật Khẩu</h2>
                        <form action="{{ route('reset-password.store') }}" method="POST" class="reset-form" id="reset-form" style="margin-top: 15px">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="password_reset"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_reset" id="password_reset" placeholder="Mật khẩu mới" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_password_reset"></div>
                            <div class="form-group">
                                <label for="password_confirm"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirm" id="password_confirm" placeholder="Xác nhận mật khẩu" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_confirm_reset"></div>
                            <div class="form-group form-button">
                                <input type="submit" name="reset" id="reset" class="form-submit"
                                    value="Đặt Lại Mật Khẩu" />
                            </div>
                        </form>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('login') }}" style="color: #63AB45; font-size: 14px; text-decoration: none;">Quay lại đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@include('clients.blocks.footer')
