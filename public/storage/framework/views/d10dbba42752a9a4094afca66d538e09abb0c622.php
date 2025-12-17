<h3>Đánh giá của khách hàng</h3>
<div class="clients-reviews bgc-black mt-30 mb-60">
    <div class="left">
        <b><?php echo e(number_format($avgStar, 1)); ?></b>
        <span>(<?php echo e($countReview); ?> đánh giá)</span>
        <div class="ratting">
            <?php for($i = 0; $i < 5; $i++): ?>
                <?php if($avgStar && $i < $avgStar): ?>
                    <i class="fas fa-star"></i>
                <?php else: ?>
                    <i class="far fa-star"></i>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="right">

    </div>
</div>

<h3>Ý kiến ​​của khách hàng</h3>
<div class="comments mt-30 mb-60">
    <?php $__currentLoopData = $getReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="author-thumb">
                <img src="<?php echo e(asset('admin/assets/images/user-profile/' . $review->avatar)); ?>" alt="">
            </div>
            <div class="content">
                <h6><?php echo e($review->fullName); ?></h6>
                <div class="ratting">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <?php if($review->rating && $i < $review->rating): ?>
                            <i class="fas fa-star"></i>
                        <?php else: ?>
                            <i class="far fa-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>

                </div>
                <span class="time"><?php echo e($tourDetail->time); ?></span>
                <p><?php echo e($review->comment); ?></p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/clients/partials/reviews.blade.php ENDPATH**/ ?>