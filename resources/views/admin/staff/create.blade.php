@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>{{ $title }}</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel" style="width: 100%; max-width: 100%; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.08); padding: 32px 24px;">
                    <div class="x_title" style="text-align: center; margin-bottom: 32px;">
                        <h2 style="font-weight: 700; color: #2a3f54; letter-spacing: 1px;">Thêm nhân sự mới</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ($errors && is_object($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4>Lỗi:</h4>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.staff.store') }}" method="POST" class="form-horizontal form-label-left" role="form" autocomplete="off">
                            @csrf

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="fullName" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Họ và tên <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="fullName" name="fullName" required class="form-control" placeholder="Nhập họ và tên" value="{{ old('fullName') }}" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="username" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Tên đăng nhập <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="username" name="username" required class="form-control" placeholder="Nhập tên đăng nhập" value="{{ old('username') }}" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="email" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Email <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="email" id="email" name="email" required class="form-control" placeholder="Nhập email" value="{{ old('email') }}" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="password" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Mật khẩu <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" id="password" name="password" required class="form-control" placeholder="Nhập mật khẩu" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="phoneNumber" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phoneNumber') }}" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 28px;">
                                <label for="address" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Địa chỉ</label>
                                <div class="col-sm-8">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" value="{{ old('address') }}" style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="ln_solid" style="margin: 32px 0 24px 0;"></div>
                            <div class="form-group row" style="text-align: center;">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success" style="min-width: 140px; font-weight: 600; font-size: 16px; border-radius: 6px; margin-right: 12px;">Thêm nhân sự</button>
                                    <a href="{{ route('admin.staff.index') }}" class="btn btn-default" style="min-width: 100px; font-size: 16px; border-radius: 6px;">Hủy</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
@include('admin.blocks.footer')
