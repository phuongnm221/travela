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

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Chỉnh sửa nhân sự</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ($errors && is_object($errors) && $errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.staff.update', $staff->adminId) }}" method="POST" class="form-horizontal form-label-left">
                            @csrf

                            <div class="form-group">
                                <label for="fullName" class="control-label col-md-3 col-sm-3 col-xs-12">Họ và tên <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="fullName" name="fullName" required class="form-control" value="{{ $staff->fullName }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" required class="form-control" value="{{ $staff->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Mật khẩu mới</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Để trống nếu không muốn thay đổi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber" class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ $staff->phoneNumber ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="address" name="address" class="form-control" value="{{ $staff->address ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Hủy</a>
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
