<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Admin</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('admin/assets/images/user-profile/avt_admin.jpg') }}" alt="..."
                    class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                @php
                    $adminData = session('admin');
                    if (is_array($adminData)) {
                        $displayName = $adminData['fullName'] ?? $adminData['username'] ?? 'Admin';
                    } else {
                        $displayName = $adminData ?? 'Admin';
                    }
                @endphp
                <h2>{{ $displayName }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Tổng quan</h3>
                <ul class="nav side-menu">
                    @php
                        $adminUser = session()->get('admin');
                        $isAdmin = false;
                        $userRole = 'staff';
                        
                        if (is_array($adminUser)) {
                            $userRole = $adminUser['role'] ?? 'staff';
                            $isAdmin = ($userRole === 'admin');
                        } elseif (is_string($adminUser)) {
                            // Old format - assume admin for backward compatibility
                            $isAdmin = true;
                        }
                    @endphp
                    
                    {{-- Dashboard - Admin only --}}
                    @if($isAdmin)
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @endif
                    
                    {{-- Thông tin cá nhân - All users --}}
                    <li><a href="{{ route('admin.profile') }}"><i class="fa fa-user"></i> Thông tin cá nhân</a></li>
                    
                    {{-- Quản lý nhân sự - Admin only --}}
                    @if($isAdmin)
                    <li><a><i class="fa fa-users"></i> Quản lý nhân sự<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.staff.create') }}">Thêm nhân sự</a></li>
                            <li><a href="{{ route('admin.staff.index') }}">Danh sách nhân sự</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    {{-- Thông tin tài khoản - Admin only --}}
                    @if($isAdmin)
                    <li><a href="{{ route('admin.admin') }}"><i class="fa fa-table"></i> Thông tin tài khoản</a></li>
                    @endif
                    
                    {{-- Quản lý người dùng - Admin only --}}
                    @if($isAdmin)
                    <li><a href="{{ route('admin.users') }}"><i class="fa fa-table"></i> Quản lý người dùng</a></li>
                    @endif
                    
                    {{-- Quản lý Tours - All users --}}
                    <li><a><i class="fa fa-table"></i> Quản lý Tours<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.page-add-tours') }}">Thêm Tours</a></li>
                            <li><a href="{{ route('admin.tours') }}">Danh sách Tours</a></li>
                        </ul>
                    </li>

                    {{-- Quản lý Booking - All users --}}
                    <li><a href="{{ route('admin.booking') }}"><i class="fa fa-home"></i> Quản lý Booking</a></li>
                    
                    {{-- Liên hệ - All users --}}
                    <li><a href="{{ route('admin.contact') }}"><i class="fa fa-envelope-o"></i> Liên hệ</a></li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin.logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/user-profile/avt_admin.jpg') }}" alt="">
                        @if (session()->has('admin'))
                            @php
                                $adminData = session('admin');
                                // Handle both array and string formats
                                if (is_array($adminData)) {
                                    $displayName = $adminData['fullName'] ?? $adminData['username'] ?? 'Admin';
                                } else {
                                    // Fallback for old string format
                                    $displayName = $adminData ?? 'Admin';
                                }
                            @endphp
                            {{ $displayName }}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"> Thông tin cá nhân</a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                class="fa fa-sign-out pull-right"></i> Đăng xuất</a>
                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">{{ $unreadCount }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        @foreach ($unreadContacts->take(3) as $item)
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('admin.contact') }}">
                                    <span>
                                        <b><span>{{ $item->fullName }}</span></b>
                                        <span class="time">{{ $item->phoneNumber }}</span>
                                    </span>
                                    <span class="message text-contact-truncate" >{{ $item->message }} </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
