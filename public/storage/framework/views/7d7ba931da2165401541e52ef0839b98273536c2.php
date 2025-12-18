<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('clients.blocks.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Contact Info Area start -->
<section class="contact-info-area pt-100 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="contact-info-content mb-30 rmb-55" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title mb-30">
                        <h2>Hãy nói chuyện với các hướng dẫn viên du lịch chuyên nghiệp của chúng tôi</h2>
                    </div>
                    <p>Đội ngũ hỗ trợ tận tâm của chúng tôi luôn sẵn sàng hỗ trợ bạn giải đáp mọi thắc mắc hoặc vấn đề,
                        cung cấp
                        các giải pháp nhanh chóng và được cá nhân hóa để đáp ứng nhu cầu của bạn.</p>
                    <div class="features-team-box mt-40">
                        <h6>85+ Thành viên nhóm chuyên gia</h6>
                        <div class="feature-authors">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author1.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author2.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author3.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author4.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author5.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author6.jpg')); ?>" alt="Author">
                            <img src="<?php echo e(asset('clients/assets/images/features/feature-author7.jpg')); ?>" alt="Author">
                            <span>+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                            data-aos-delay="50">
                            <div class="icon"><i class="fas fa-envelope"></i></div>
                            <div class="content">
                                <h5>Cần trợ giúp và hỗ trợ</h5>
                                <div class="text"><i class="far fa-envelope"></i> <a
                                        href="mailto:https://www.facebook.com/mai.nguyen.81792">pngatink29cbg@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                            data-aos-delay="100">
                            <div class="icon"><i class="fas fa-phone"></i></div>
                            <div class="content">
                                <h5>Cần bất kỳ việc khẩn cấp nào</h5>
                                <div class="text"><i class="far fa-phone"></i> <a href="callto:+0001234588">+000 (123)
                                        45 88</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                            data-aos-delay="50">
                            <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="content">
                                <h5>Hà Nội</h5>
                                <div class="text"><i class="fal fa-map-marker-alt"></i> 12 Chùa Bộc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                            data-aos-delay="100">
                            <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="content">
                                <h5>Travela</h5>
                                <div class="text"><i class="fal fa-map-marker-alt"></i> 12 Chùa Bộc, Đống Đa,
                                    Thành phố Hà Nội</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Info Area end -->


<!-- Contact Form Area start -->
<section class="contact-form-area py-70 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="comment-form bgc-lighter z-1 rel mb-30 rmb-55">
                    <form id="contactForm" class="contactForm" name="contactForm" action="<?php echo e(route('create-contact')); ?>"
                        method="post" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                        <?php echo csrf_field(); ?>
                        <div class="section-title">
                            <h2>Liên hệ</h2>
                        </div>
                        <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu <span style="color: red">*</span></p>
                        <div class="row mt-35">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên <span style="color: red">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Họ và tên" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại <span style="color: red">*</span></label>
                                       <input type="tel" id="phone_number" name="phone_number" class="form-control"
                                        inputmode="numeric" maxlength="10" placeholder="Nhập 10 chữ số" value=""
                                        pattern="^\d{10}$" 
                                        title="Số điện thoại phải gồm 10 chữ số"
                                        required>
                                    <small class="form-text text-muted">Số điện thoại phải gồm đúng 10 chữ số</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Địa chỉ Email <span style="color: red">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Nhập email" value="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Nội dung <span style="color: red">*</span></label>
                                    <textarea name="message" id="message" class="form-control" rows="5" placeholder="Nội dung" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <button type="submit" class="theme-btn style-two">
                                        <span data-hover="Send Comments">Gửi</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                    <div id="msgSubmit" class="hidden"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="contact-images-part" data-aos="fade-right" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="row">
                        <div class="col-12">
                            <img src="<?php echo e(asset('clients/assets/images/contact/contact1.jpg')); ?>" alt="Contact">
                        </div>
                        <div class="col-6">
                            <img src="<?php echo e(asset('clients/assets/images/contact/contact2.jpg')); ?>" alt="Contact">
                        </div>
                        <div class="col-6">
                            <img src="<?php echo e(asset('clients/assets/images/contact/contact3.jpg')); ?>" alt="Contact">
                        </div>
                    </div>
                    <div class="circle-logo">
                        <img src="<?php echo e(asset('clients/assets/images/contact/icon.png')); ?>" alt="Logo">
                        <span class="title h2">Travela</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form Area end -->


<!-- Contact Map Start -->
<div class="contact-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61349.64701146602!2d108.16542067386848!3d16.047164798501537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c792252a13%3A0xfc14e3a044436487!2sDa%20Nang%2C%20H%E1%BA%A3i%20Ch%C3%A2u%20District%2C%20Da%20Nang%2C%20Vietnam!5e0!3m2!1sen!2s!4v1729087157388!5m2!1sen!2s"
        style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- Contact Map End -->


<script>
(function(){
    var phone = document.getElementById('phone_number');
    if (!phone) return;
    // Ensure attributes are present in case browser doesn't honor changed markup
    phone.setAttribute('inputmode','numeric');
    phone.setAttribute('maxlength','10');
    phone.type = 'tel';

    function cleanAndLimit(val){
        return val.replace(/\D/g,'').slice(0,10);
    }

    phone.addEventListener('input', function(){
        var cleaned = cleanAndLimit(this.value);
        if (this.value !== cleaned) this.value = cleaned;
    });

    phone.addEventListener('paste', function(e){
        e.preventDefault();
        var paste = (e.clipboardData || window.clipboardData).getData('text') || '';
        this.value = cleanAndLimit(paste);
    });
})();
</script>

<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/contact.blade.php ENDPATH**/ ?>