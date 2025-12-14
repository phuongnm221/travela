<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    /* Make all cards equal height and width */
    .x_content.row {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .col-md-4.profile_details {
        display: flex;
        flex-direction: column;
        padding: 10px;
    }
    .col-md-4.profile_details .well.profile_view {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .profile_view > .col-sm-12:first-child {
        flex: 0 0 auto;
    }
    .profile-bottom {
        margin-top: auto;
        width: 100%;
    }
</style>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý người dùng</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-6 col-sm-6  form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Tìm kiếm theo tên, username">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="searchBtn">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel">
                    <div class="x_content row">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief"><i><?php echo e($user->isActive); ?></i></h4>
                                        <div class="left col-md-7 col-sm-7">
                                            <h2><?php echo e($user->fullName); ?></h2>
                                            <p><strong>About: </strong> <?php echo e($user->username); ?> </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Address: <?php echo e($user->address); ?></li>
                                                <li><i class="fa fa-phone"></i> Phone #: <?php echo e($user->phoneNumber); ?></li>
                                            </ul>
                                        </div>
                                        <div class="right col-md-5 col-sm-5 text-center">
                                            <img src="<?php echo e(asset('admin/assets/images/user-profile/' . $user->avatar)); ?>"
                                                alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class=" profile-bottom text-center">
                                        <div class=" col-sm-12 emphasis" style="display: flex; justify-content: end">
                                            <?php if($user->isActive == 'Chưa kích hoạt'): ?>
                                                <button type="button" class="btn btn-primary btn-sm btn-active"
                                                    data-attr='{"userId": "<?php echo e($user->userId); ?>", "action": "<?php echo e(route('admin.active-user')); ?>"}'>
                                                    <i class="fa fa-check"> </i> Kích hoạt
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-primary btn-warning btn-ban"
                                                data-attr='{"userId": "<?php echo e($user->userId); ?>", "action": "<?php echo e(route('admin.status-user')); ?>", "status": "b"}'
                                                style="<?php echo e($user->status === 'b' ? 'display: none;' : ''); ?>">
                                                <i class="fa fa-ban"> </i> Chặn
                                            </button>

                                            <button type="button" class="btn btn-primary btn-warning btn-unban"
                                                data-attr='{"userId": "<?php echo e($user->userId); ?>", "action": "<?php echo e(route('admin.status-user')); ?>", "status": ""}'
                                                style="<?php echo e($user->status !== 'b' ? 'display: none;' : ''); ?>">
                                                <i class="fa fa-ban"> </i> Bỏ chặn
                                            </button>

                                            <button type="button" class="btn btn-primary btn-danger btn-delete"
                                                data-attr='{"userId": "<?php echo e($user->userId); ?>", "action": "<?php echo e(route('admin.status-user')); ?>", "status": ""}'
                                                style="<?php echo e($user->status === 'd' ? 'display: none;' : ''); ?>">
                                                <i class="fa fa-close"> </i> Xóa
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var searchBtn = document.getElementById('searchBtn');
    
    function filterUsers() {
        var searchText = searchInput.value.toLowerCase();
        var profileDetails = document.querySelectorAll('.profile_details');
        
        profileDetails.forEach(function(profile) {
            var h2 = profile.querySelector('h2');
            var fullName = h2 ? h2.textContent.toLowerCase() : '';
            
            var listItems = profile.querySelectorAll('.list-unstyled li');
            var username = listItems.length > 0 ? listItems[0].textContent.toLowerCase() : '';
            var address = listItems.length > 1 ? listItems[1].textContent.toLowerCase() : '';
            
            var found = fullName.includes(searchText) || username.includes(searchText) || address.includes(searchText);
            
            if (searchText === '' || found) {
                profile.style.display = '';
            } else {
                profile.style.display = 'none';
            }
        });
    }
    
    if (searchInput) {
        searchInput.addEventListener('keyup', filterUsers);
    }
    
    if (searchBtn) {
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            filterUsers();
        });
    }
});
</script>
<?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/users.blade.php ENDPATH**/ ?>