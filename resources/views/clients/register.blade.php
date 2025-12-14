@include('clients.blocks.header')

<style>
    .signup {
        display: block !important;
    }
</style>

<div class="login-template">
    <div class="main">
        <!-- Sign up form -->
        <section class="signup show">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký</h2>
                        <div class="loader"></div>
                        <form action="{{ route('register.store') }}" method="POST" class="register-form" id="register-form" style="margin-top: 15px">
                            <div class="form-group">
                                <label for="fullname_register"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" name="fullname_register" id="fullname_register" placeholder="Họ và tên" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_fullname_regis"></div>
                            <div class="form-group">
                                <label for="email_register"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email_register" id="email_register" placeholder="Email" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_email_regis"></div>
                            @csrf
                            <input type="hidden" name="username_register" id="username_register"/>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_email_regis"></div>
                            <div class="form-group">
                                <label for="password_register"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_register" id="password_register" placeholder="Mật khẩu" required/>
                            </div>
                            <small style="color:#999;margin-top:-10px;display:block;margin-bottom:10px;">
                                ✓ Tối thiểu 8 ký tự | ✓ 1 chữ in hoa | ✓ 1 chữ thường | ✓ 1 ký tự đặc biệt (!@#$%^&*...)
                            </small>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_password_regis"></div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_repass"></div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="Đăng ký" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('clients/assets/images/login/signup-image.jpg') }}"
                                alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">Tôi đã có tài khoản rồi</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@include('clients.blocks.footer')
