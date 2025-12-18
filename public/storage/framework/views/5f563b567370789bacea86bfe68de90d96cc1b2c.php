<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('clients.blocks.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Tour List Area start -->
<section class="tour-list-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                <div class="shop-sidebar mb-30">
                    <?php if(!$toursPopular->isEmpty()): ?>
                        <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Phổ biến Tours</h6>
                            <?php $__currentLoopData = $toursPopular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="destination-item tour-grid style-three bgc-lighter">
                                    <div class="image">
                                        <img src="<?php echo e(asset('admin/assets/images/gallery-tours/' . $tour->images[0])); ?>"
                                            alt="Tour">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                <?php echo e($tour->destination); ?></span>
                                            <div class="ratting">
                                                <i class="fas fa-star"></i>
                                                <span><?php echo e($tour->rating); ?></span>
                                            </div>
                                        </div>
                                        <h6><a
                                                href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"><?php echo e($tour->title); ?></a>
                                        </h6>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="col-lg-9">
                <?php $__currentLoopData = $myTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="destination-item style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            <?php if($tour->bookingStatus == 'b'): ?>
                                <span class="badge">Đợi xác nhận</span>
                            <?php elseif($tour->bookingStatus == 'y'): ?>
                                <span class="badge bgc-pink">Sắp khởi hành</span>
                            <?php elseif($tour->bookingStatus == 'f'): ?>
                                <span class="badge bgc-primary">Hoàn thành</span>
                            <?php elseif($tour->bookingStatus == 'c'): ?>
                                <span class="badge" style="background-color: red">Đã hủy</span>
                            <?php endif; ?>


                            <img src="<?php echo e(asset('admin/assets/images/gallery-tours/' . $tour->images[0] . '')); ?>"
                                alt="Tour List">
                        </div>
                        <div class="content">
                            <div class="destination-header">
                                <span class="location"><i
                                        class="fal fa-map-marker-alt"></i><?php echo e($tour->destination); ?></span>
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
                                    href="<?php echo e(route('tour-booked', ['bookingId' => $tour->bookingId, 'checkoutId' => $tour->checkoutId])); ?>"><?php echo e($tour->title); ?></a>
                            </h5>
                            <div class="truncate-3-lines">
                                <?php echo $tour->description; ?>

                            </div>

                            <ul class="blog-meta">
                                <li><i class="far fa-clock"></i><?php echo e($tour->time); ?></li>
                                <li><i class="far fa-user"></i> <?php echo e($tour->numAdults + $tour->numChildren); ?> người</li>
                            </ul>
                            <div class="destination-footer">
                                <span class="price"><span><?php echo e(number_format($tour->totalPrice, 0)); ?></span>/vnđ</span>
                                <?php if($tour->bookingStatus == 'f'): ?>
                                    <a href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"
                                        class="theme-btn style-two style-three">
                                        <?php if($tour->rating): ?>
                                            <span data-hover="Đã đánh giá">Đã đánh giá</span>
                                        <?php else: ?>
                                            <span data-hover="Đánh giá">Đánh giá</span>
                                        <?php endif; ?>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<!-- Tour List Area end -->
<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/my-tours.blade.php ENDPATH**/ ?>