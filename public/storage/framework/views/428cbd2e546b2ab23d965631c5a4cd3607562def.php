<!-- footer area start -->
<footer class="main-footer bgs-cover overlay rel z-1 pb-25"
    style="background-image: url(<?php echo e(asset('clients/assets/images/backgrounds/footer.jpg')); ?>);">
    <div class="container">
        <div class="footer-top pt-100 pb-30">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-text">
                        <div class="footer-logo mb-25">
                            <a href="index.html"><img src="<?php echo e(asset('clients/assets/images/logos/logo.png')); ?>"
                                    alt="Logo"></a>
                        </div>
                        <p>Chúng tôi biên soạn các hành trình riêng biệt phù hợp với sở thích của bạn, đảm bảo mọi
                            chuyến đi đều
                            liền mạch và làm phong phú thêm những viên ngọc ẩn giấu</p>
                        <div class="social-style-one mt-15">
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-youtube"></i></a>
                            <a href="contact.html"><i class="fab fa-pinterest"></i></a>
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-35">
                        <h2>Đăng ký nhận bản tin</h2>
                        <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải
                            nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                    </div>
                    <form class="newsletter-form mb-50" action="#">
                        <input id="news-email" type="email" placeholder="Email Address" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Đăng ký">Đăng ký</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area pt-95 pb-45">
        <div class="container">
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
                <div class="col col-small" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-links">
                        <div class="footer-title">
                            <h5>Dịch vụ</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="<?php echo e(route('team')); ?>">Hướng dẫn viên du lịch tốt nhất</a></li>
                            <li><a href="<?php echo e(route('tours')); ?>">Đặt tour</a></li>
                            <li><a href="<?php echo e(route('tours')); ?>">Đặt vé</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links">
                        <div class="footer-title">
                            <h5>Công ty</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="<?php echo e(route('about')); ?>">Giới thiệu về công ty</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Việc làm và nghề nghiệp</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Liên hệ với chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links">
                        <div class="footer-title">
                            <h5>Điểm đến</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="<?php echo e(route('destination')); ?>">Miền Bắc</a></li>
                            <li><a href="<?php echo e(route('destination')); ?>">Miền Trung</a></li>
                            <li><a href="<?php echo e(route('destination')); ?>">Miền Nam</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links">
                        <div class="footer-title">
                            <h5>Thể loại</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="<?php echo e(route('contact')); ?>">Phiêu lưu</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Tour gia đình</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Tour động vật hoang dã</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-6 col-10 col-small" data-aos="fade-up" data-aos-delay="200"
                    data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-contact">
                        <div class="footer-title">
                            <h5>Liên hệ</h5>
                        </div>
                        <ul class="list-style-one">
                            <li><i class="fal fa-map-marked-alt"></i> 12 Chùa Bộc, Đống Đa, Hà Nội</li>
                            <li><i class="fal fa-envelope"></i> <a
                                    href="mailto:support@travela.com">support@travela.com</a></li>
                            <li><i class="fal fa-clock"></i> Thứ 2 - Thứ 6, 08am - 05pm</li>
                            <li><i class="fal fa-phone-volume"></i> <a href="callto:+88012334588">(+84)123456789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pt-20 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="copyright-text text-center text-lg-start">
                        <p>@Copy 2025 <a href="<?php echo e(route('home')); ?>">Travela</a>, All rights reserved</p>
                    </div>
                </div>
                <div class="col-lg-7 text-center text-lg-end">
                    <ul class="footer-bottom-nav">
                        <li><a href="<?php echo e(route('about')); ?>">Điều khoản</a></li>
                        <li><a href="<?php echo e(route('about')); ?>">Chính sách bảo mật</a></li>
                        <li><a href="<?php echo e(route('about')); ?>">Thông báo pháp lý</a></li>
                        <li><a href="<?php echo e(route('about')); ?>">Khả năng truy cập</a></li>
                    </ul>
                </div>
            </div>
            <!-- Scroll Top Button -->
            <button class="scroll-top scroll-to-target" data-target="html"><img
                    src="<?php echo e(asset('clients/assets/images/icons/scroll-up.png')); ?>" alt="Scroll  Up"></button>
        </div>
    </div>
</footer>
<!-- footer area end -->

</div>
<!--End pagewrapper-->

<?php if(session('error')): ?>
    <script>
        alert("<?php echo e(session('error')); ?>");
    </script>
<?php endif; ?>
<!-- Jquery -->
<script src="<?php echo e(asset('clients/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('clients/assets/js/bootstrap.min.js')); ?>"></script>
<!-- Appear Js -->
<script src="<?php echo e(asset('clients/assets/js/appear.min.js')); ?>"></script>
<!-- Slick -->
<script src="<?php echo e(asset('clients/assets/js/slick.min.js')); ?>"></script>
<!-- Magnific Popup -->
<script src="<?php echo e(asset('clients/assets/js/jquery.magnific-popup.min.js')); ?>"></script>
<!-- Nice Select -->
<script src="<?php echo e(asset('clients/assets/js/jquery.nice-select.min.js')); ?>"></script>
<!-- Image Loader -->
<script src="<?php echo e(asset('clients/assets/js/imagesloaded.pkgd.min.js')); ?>"></script>
<!-- Skillbar -->
<script src="<?php echo e(asset('clients/assets/js/skill.bars.jquery.min.js')); ?>"></script>
<!-- Jquery UI -->
<script src="<?php echo e(asset('clients/assets/js/jquery-ui.min.js')); ?>"></script>
<!-- Isotope -->
<script src="<?php echo e(asset('clients/assets/js/isotope.pkgd.min.js')); ?>"></script>
<!--  AOS Animation -->
<script src="<?php echo e(asset('clients/assets/js/aos.js')); ?>"></script>
<!-- Custom script -->
<script src="<?php echo e(asset('clients/assets/js/script.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script src="https://www.paypal.com/sdk/js?client-id=<?php echo e(env('PAYPAL_SANDBOX_CLIENT_ID')); ?>"></script>
<!-- Custom script by Dev dien-->
<script src="<?php echo e(asset('clients/assets/js/custom-js.js')); ?>"></script>
<script src="<?php echo e(asset('clients/assets/js/jquery.datetimepicker.full.min.js')); ?>"></script>

</body>

</html>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/blocks/footer_home.blade.php ENDPATH**/ ?>