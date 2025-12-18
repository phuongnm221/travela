<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('clients.blocks.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-2">
    <div class="container">
        <div class="row">
            <?php if($tours->isEmpty()): ?>
                <h4 class="alert alert-danger">Không có tour nào liên quan đến tìm kiếm của bạn. Thử tìm kiếm với từ khóa khác nhé!</h4>
            <?php else: ?>
                <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-4 col-md-6" style="margin-bottom: 30px">
                        <div class="destination-item tour-grid style-three bgc-lighter equal-block-fix" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <?php if(count($tour->images) > 0): ?>
                                    <img src="<?php echo e(asset('admin/assets/images/gallery-tours/' . $tour->images[0])); ?>"
                                        alt="Tour List">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('admin/assets/images/no-image.jpg')); ?>" alt="No Image Available">
                                <?php endif; ?>
                            </div>
                            <div class="content equal-content-fix">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i>
                                        <?php echo e($tour->destination); ?></span>
                                    <div class="ratting">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <?php if($tour->rating && $i < $tour->rating): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <h5><a
                                        href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"><?php echo e($tour->title); ?></a>
                                </h5>
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i><?php echo e($tour->time); ?></li>
                                    <li><i class="far fa-user"></i><?php echo e($tour->quantity); ?></li>
                                </ul>
                                <div class="destination-footer">
                                    <span
                                        class="price"><span><?php echo e(number_format($tour->priceAdult, 0, ',', '.')); ?></span>
                                        VND / người</span>
                                    <a href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"
                                        class="theme-btn style-two style-three">
                                        <span data-hover="Đặt ngay">Đặt ngay</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>
    </div>
</section>
<!-- Tour Grid Area end -->

<?php echo $__env->make('clients.blocks.new_letter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/search.blade.php ENDPATH**/ ?>