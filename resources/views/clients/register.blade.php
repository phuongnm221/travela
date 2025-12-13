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
                            {{-- hidden token set after captcha success --}}
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" />
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
<!-- Captcha modal (v2 checkbox) -->
<div class="modal fade" id="captchaModal" tabindex="-1" aria-labelledby="captchaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="captchaModalLabel">Xác thực</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Vui lòng xác thực bạn không phải là robot</p>
                <div id="recaptcha-widget" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    // Render widget when modal shown. Poll for grecaptcha if API hasn't loaded yet.
    var recaptchaWidgetId = null;
    var recaptchaRendered = false;
    document.addEventListener('DOMContentLoaded', function() {
        $('#captchaModal').on('shown.bs.modal', function () {
            var attempts = 0;
            var maxAttempts = 20; // ~6s if interval 300ms
            var interval = setInterval(function() {
                attempts++;
                if (typeof grecaptcha !== 'undefined') {
                    clearInterval(interval);
                    if (!recaptchaRendered) {
                        try {
                            var sitekey = document.getElementById('recaptcha-widget').getAttribute('data-sitekey');
                            recaptchaWidgetId = grecaptcha.render('recaptcha-widget', {
                                'sitekey': sitekey,
                                'callback': function(token) {
                                    document.getElementById('g-recaptcha-response').value = token;
                                    // mark that this submit comes from captcha
                                    try { window.submissionFromCaptcha = true; window.captchaInProgress = false; } catch(e){}
                                    $('#captchaModal').modal('hide');
                                    // small delay then trigger jQuery submit so handler sees token
                                    setTimeout(function(){
                                        $('#register-form').trigger('submit');
                                    }, 120);
                                }
                            });
                            recaptchaRendered = true;
                        } catch (e) {
                            console.error('recaptcha render error', e);
                        }
                    }
                } else if (attempts >= maxAttempts) {
                    clearInterval(interval);
                    console.error('reCAPTCHA API failed to load after multiple attempts');
                }
            }, 300);
        });
    });
</script>
