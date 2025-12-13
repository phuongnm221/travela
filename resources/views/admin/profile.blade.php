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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thông tin cá nhân</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">ID</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userData->adminId }}" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="fullName" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Họ và tên <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="fullName" name="fullName" required class="form-control" value="{{ old('fullName', $userData->fullName) }}" style="border-radius: 6px;">
                                    @error('fullName')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Tên đăng nhập</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userData->username }}" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="email" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Email <span class="required" style="color: #e74c3c;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="email" id="email" name="email" required class="form-control" value="{{ old('email', $userData->email) }}" style="border-radius: 6px;">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Vai trò</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ ucfirst($userData->role ?? 'admin') }}" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="phoneNumber" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $userData->phoneNumber ?? '') }}" placeholder="Nhập số điện thoại" style="border-radius: 6px;">
                                    @error('phoneNumber')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="address" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Địa chỉ</label>
                                <div class="col-sm-8">
                                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $userData->address ?? '') }}" placeholder="Nhập địa chỉ" style="border-radius: 6px;">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label for="password" class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Mật khẩu mới (để trống nếu không thay đổi)</label>
                                <div class="col-sm-8">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" style="border-radius: 6px;">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 20px;">
                                <label class="col-sm-4 col-form-label" style="font-weight: 600; color: #34495e;">Ngày tạo</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($userData->createdDate)->format('d/m/Y H:i') }}" disabled style="border-radius: 6px;">
                                </div>
                            </div>

                            <div class="ln_solid" style="margin: 32px 0 24px 0;"></div>
                            <div class="form-group row" style="text-align: center;">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success" style="min-width: 140px; font-weight: 600; font-size: 16px; border-radius: 6px; margin-right: 12px;">Cập nhật</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-default" style="min-width: 100px; font-size: 16px; border-radius: 6px;">Hủy</a>
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
