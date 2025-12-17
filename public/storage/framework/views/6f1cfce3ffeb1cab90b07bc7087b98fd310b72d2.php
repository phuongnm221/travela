<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập</title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('admin/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('admin/vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo e(asset('admin/vendors/animate.css/animate.min.css')); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('admin/build/css/custom.min.css')); ?>" rel="stylesheet">
        <!-- Import CSS for Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    
    <link href="<?php echo e(asset('admin/assets/css/custom-css.css')); ?>" rel="stylesheet" />
</head>

<body class="login">
    <div>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?php echo e(route('admin.login-account')); ?>" method="POST" id="formLoginAdmin">
                        <h1>Đăng nhập</h1>
                        <?php echo csrf_field(); ?>
                        <div>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Tài khoản" required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Mật khẩu" required />
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit">Đăng nhập</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>

                </section>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\travela\resources\views/admin/login.blade.php ENDPATH**/ ?>