<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy</title>
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .error-container {
            text-align: center;
            color: white;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 30px;
        }
        .error-description {
            font-size: 16px;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        .btn-home {
            padding: 12px 30px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Không tìm thấy trang</div>
        <div class="error-description">Xin lỗi, trang bạn đang tìm không tồn tại hoặc đã bị xóa.</div>
        <a href="{{ route('admin.login') }}" class="btn btn-light btn-home">Quay lại đăng nhập</a>
    </div>
</body>
</html>
