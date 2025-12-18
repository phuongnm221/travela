<?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($tour->title); ?></td>
        <td><?php echo e($tour->time); ?></td>
        <td><?php echo $tour->description; ?></td>
        <td><?php echo e($tour->quantity); ?></td>
        <td><?php echo e(number_format($tour->priceAdult, 0, ',', '.')); ?></td>
        <td><?php echo e(number_format($tour->priceChild, 0, ',', '.')); ?></td>
        <td><?php echo e($tour->destination); ?></td>
        <td><?php echo e($tour->availability); ?></td>
        <td><?php echo e(date('d-m-Y', strtotime($tour->startDate))); ?></td>
        <td><?php echo e(date('d-m-Y', strtotime($tour->endDate))); ?></td>
        <td>
            <button type="button" class="btn-action-listTours edit-tour" data-toggle="modal" data-target="#edit-tour-modal"
                data-tourId="<?php echo e($tour->tourId); ?>" data-urledit = "<?php echo e(route('admin.tour-edit')); ?>">
                <span class="glyphicon glyphicon-edit" style="color: #26B99A; font-size:24px" aria-hidden="true"></span>
            </button>
        </td>
        <td>
            <a href="<?php echo e(route('admin.delete-tour')); ?>" data-tourId="<?php echo e($tour->tourId); ?>" class="delete-tour">
                <span class="glyphicon glyphicon-trash" style="color: red; font-size:24px" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/partials/list-tours.blade.php ENDPATH**/ ?>