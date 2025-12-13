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
                    <div class="title_right">
                        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Thêm nhân sự
                        </a>
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
                                    @forelse ($staff as $s)
                                        <tr>
                                            <td>{{ $s->adminId }}</td>
                                            <td>{{ $s->fullName }}</td>
                                            <td>{{ $s->username }}</td>
                                            <td>{{ $s->email }}</td>
                                            <td>{{ $s->phoneNumber ?? 'N/A' }}</td>
                                            <td>{{ $s->address ?? 'N/A' }}</td>
                                            <td>
                                                @php
                                                    $date = is_string($s->createdDate) ? \Carbon\Carbon::parse($s->createdDate) : $s->createdDate;
                                                    echo $date->format('d/m/Y');
                                                @endphp
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.staff.edit', $s->adminId) }}" class="btn btn-info btn-xs">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.staff.destroy', $s->adminId) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Không có nhân sự nào</td>
                                        </tr>
                                    @endforelse
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
@include('admin.blocks.footer')
