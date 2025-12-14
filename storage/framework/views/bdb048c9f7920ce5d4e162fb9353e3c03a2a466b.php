<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3><?php echo e($title); ?></h3>
                    </div>
                    <div class="title_right">
                        <a href="<?php echo e(route('admin.staff.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Thêm nhân sự
                        </a>
                    </div>
                </div>

                <div class="clearfix"></div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Danh sách nhân sự</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($s->adminId); ?></td>
                                            <td><?php echo e($s->fullName); ?></td>
                                            <td><?php echo e($s->username); ?></td>
                                            <td><?php echo e($s->email); ?></td>
                                            <td><?php echo e($s->phoneNumber ?? 'N/A'); ?></td>
                                            <td><?php echo e($s->address ?? 'N/A'); ?></td>
                                            <td>
                                                <?php
                                                    $date = is_string($s->createdDate) ? \Carbon\Carbon::parse($s->createdDate) : $s->createdDate;
                                                    echo $date->format('d/m/Y');
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.staff.edit', $s->adminId)); ?>" class="btn btn-info btn-xs">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>
                                                <form action="<?php echo e(route('admin.staff.destroy', $s->adminId)); ?>" method="POST" style="display: inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Không có nhân sự nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>