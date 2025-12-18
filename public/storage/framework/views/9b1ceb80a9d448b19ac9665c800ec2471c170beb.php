<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- 404 Error Area start -->
<section class="error-area pt-70 pb-100 rel z-1">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-5 col-lg-6">
                <div class="error-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                    <h1>OPPS! </h1>
                    <div class="section-title mt-15 mb-25">
                        <h2>Không tìm thấy trang này</h2>
                    </div>
                    <p>Xin lỗi, chúng tôi không thể tìm thấy trang bạn đang tìm kiếm.  
                        Bạn có thể kiểm tra lại URL hoặc quay về <a href="/">trang chủ</a>.  
                        Nếu cần hỗ trợ, vui lòng liên hệ với chúng tôi.</p>
                        
                    <form class="newsletter-form mt-40 mb-50" action="<?php echo e(route('search-voice-text')); ?>">
                        <input  type="text" name="keyword" placeholder="Search" class="searchbox" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Search">Tìm kiếm</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                    <div class="keywords">
                        <a href="<?php echo e(route('about')); ?>">Giới thiệu</a>
                        <a href="<?php echo e(route('tours')); ?>">Tours</a>
                        <a href="<?php echo e(route('destination')); ?>">Điểm Đến</a>
                        <a href="<?php echo e(route('contact')); ?>">Liên hệ</a>
                        <a href="<?php echo e(route('home')); ?>">Trang Chủ</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="error-images" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <img src="<?php echo e(asset('clients/assets/images/newsletter/404.png')); ?>" alt="404 Error">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 404 Error Area end -->

<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela\resources\views/clients/errors/404.blade.php ENDPATH**/ ?>