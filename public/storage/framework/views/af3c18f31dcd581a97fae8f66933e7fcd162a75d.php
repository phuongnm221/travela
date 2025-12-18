<?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-md-6" style="margin-bottom: 30px">
        <div class="destination-item tour-grid style-three bgc-lighter block_tours equal-block-fix" data-aos="fade-up"
            data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <span class="badge bgc-pink">Featured</span>
                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                <img src="<?php echo e(asset('admin/assets/images/gallery-tours/' . $tour->images[0] . '')); ?>" alt="Tour List">
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
                <h6><a href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"><?php echo e($tour->title); ?></a> </h6>
                <ul class="blog-meta">
                    <li><i class="far fa-clock"></i><?php echo e($tour->time); ?></li>
                    <li><i class="far fa-user"></i><?php echo e($tour->quantity); ?></li>
                </ul>
                <div class="destination-footer">
                    <span class="price"><span><?php echo e(number_format($tour->priceAdult, 0, ',', '.')); ?></span>
                        VND / người</span>
                    <a href="<?php echo e(route('tour-detail', ['id' => $tour->tourId])); ?>"
                        class="theme-btn style-two style-three">
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="col-lg-12">
    <ul class="pagination justify-content-center pt-15 flex-wrap pagination-tours" data-aos="fade-up"
        data-aos-duration="1500" data-aos-offset="50">
        <!-- Previous Page Link -->
        <?php if($tours->onFirstPage()): ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-left"></i></span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($tours->previousPageUrl()); ?>"><i class="far fa-chevron-left"></i></a>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for($i = 1; $i <= $tours->lastPage(); $i++): ?>
            <li class="page-item <?php if($i == $tours->currentPage()): ?> active <?php endif; ?>">
                <a class="page-link" href="<?php echo e($tours->url($i)); ?>"><?php echo e($i); ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next Page Link -->
        <?php if($tours->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($tours->nextPageUrl()); ?>"><i class="far fa-chevron-right"></i></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-right"></i></span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\travela\resources\views/clients/partials/filter-tours.blade.php ENDPATH**/ ?>