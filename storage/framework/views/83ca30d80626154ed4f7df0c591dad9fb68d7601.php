<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Travela - <?php echo e($title); ?></title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="<?php echo e(asset('clients/assets/images/logos/favicon.png')); ?>" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- Flaticon -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/flaticon.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/fontawesome-5.14.0.min.css')); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/bootstrap.min.css')); ?>">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/magnific-popup.min.css')); ?>">
    <!-- Nice Select -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/nice-select.min.css')); ?>">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/jquery-ui.min.css')); ?>">
    <!-- Animate -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/aos.css')); ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/slick.min.css')); ?>">
    <!-- Main Style -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/style.css')); ?>">

    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    
    <!-- Font Icon -->
    <link rel="stylesheet"
        href="<?php echo e(asset('clients/assets/css/css-login/fonts/material-icon/css/material-design-iconic-font.min.css')); ?>">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/css-login/style.css')); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/custom-css.css')); ?>" />

    
    <link rel="stylesheet" href="<?php echo e(asset('clients/assets/css/user-profile.css')); ?>" />

    <!-- Import CSS for Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader">
            <div class="custom-loader"></div>
        </div>

        <!-- main header -->
        <header class="main-header header-one">
            <!--Header-Upper-->
            <div class="header-upper bg-white py-30 rpy-0">
                <div class="container-fluid clearfix">

                    <div class="header-inner rel d-flex align-items-center">
                        <div class="logo-outer">
                            <div class="logo"><a href="<?php echo e(route('home')); ?>"><img
                                        src="<?php echo e(asset('clients/assets/images/logos/logo-two.png')); ?>" alt="Logo"
                                        title="Logo"></a></div>
                        </div>

                        <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-lg">
                                <div class="navbar-header">
                                    <div class="mobile-logo">
                                        <a href="<?php echo e(route('home')); ?>">
                                            <img src="<?php echo e(asset('clients/assets/images/logos/logo-two.png')); ?>"
                                                alt="Logo" title="Logo">
                                        </a>
                                    </div>

                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li class="<?php echo e(Request::url() == route('home') ? 'active' : ''); ?>"><a
                                                href="<?php echo e(route('home')); ?>">Trang chủ</a></li>
                                        <li class="<?php echo e(Request::url() == route('about') ? 'active' : ''); ?>"><a
                                                href="<?php echo e(route('about')); ?>">Giới thiệu</a></li>
                                        <li
                                            class="dropdown <?php echo e(Request::is('tours') || Request::is('team') || Request::is('tour-detail/*') ? 'active' : ''); ?>">
                                            <a href="#">Tours</a>
                                            <ul>
                                                <li><a href="<?php echo e(route('tours')); ?>">Tours</a></li>
                                                <li><a href="<?php echo e(route('team')); ?>">Hướng dẫn viên</a></li>
                                            </ul>
                                        </li>
                                        <li class="<?php echo e(Request::url() == route('destination') ? 'active' : ''); ?>"><a
                                                href="<?php echo e(route('destination')); ?>">Điểm đến</a></li>
                                        <li class="<?php echo e(Request::url() == route('contact') ? 'active' : ''); ?>"><a
                                                href="<?php echo e(route('contact')); ?>">Liên Hệ</a></li>
                                    </ul>
                                </div>

                            </nav>
                            <!-- Main Menu End-->
                        </div>

                        <!-- Menu Button -->
                        <div class="menu-btns py-10">
                            <a href="<?php echo e(route('tours')); ?>" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Đặt Ngay">Book Now</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                            <!-- menu sidbar -->
                            <div class="menu-sidebar">
                                <li class="drop-down">
                                    <button class="dropdown-toggle bg-transparent" id="userDropdown"
                                        style="color: black">
                                        <?php if(session()->has('avatar')): ?>
                                            <?php
                                                $avatar = session()->get('avatar');
                                                // Determine avatar URL: external or local
                                                $isExternal = preg_match('/^https?:\/\//', $avatar);
                                                if ($isExternal) {
                                                    $avatarUrl = $avatar;
                                                } elseif (Str::startsWith($avatar, 'clients/')) {
                                                    $avatarUrl = asset($avatar);
                                                } else {
                                                    $avatarUrl = asset('clients/assets/images/user-profile/' . $avatar);
                                                }
                                            ?>
                                            <img id="avatarPreview" class="img-account-profile rounded-circle"
                                                src="<?php echo e($avatarUrl); ?>"
                                                style="width: 36px; height: 36px; object-fit:cover;">
                                        <?php else: ?>
                                            <i class='bx bxs-user bx-tada' style="font-size: 36px; color: black;"></i>
                                        <?php endif; ?>
                                    </button>

                                    <ul class="dropdown-menu" id="dropdownMenu">
                                        <?php if(session()->has('username')): ?>
                                            <li><a href="<?php echo e(route('user-profile')); ?>">Thông tin cá nhân</a></li>
                                            <li><a href="<?php echo e(route('my-tours')); ?>">Tour đã đặt</a></li>
                                            <li><a href="<?php echo e(route('logout')); ?>">Đăng xuất</a></li>
                                        <?php else: ?>
                                            <li><a href="<?php echo e(route('login')); ?>">Đăng nhập</a></li>
                                            <li><a href="<?php echo e(route('register')); ?>">Đăng ký</a></li>
                                        <?php endif; ?>
                                    </ul>

                                </li>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->
        </header>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/clients/blocks/header.blade.php ENDPATH**/ ?>