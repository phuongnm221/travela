<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #63AB45;
            margin: 0;
        }
        .content {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .reset-link {
            display: inline-block;
            background-color: #63AB45;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .reset-link:hover {
            background-color: #52A535;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 12px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Travela</h1>
            <p>Dịch vụ du lịch hàng đầu</p>
        </div>

        <div class="content">
            <p>Xin chào {{ $user->fullName ?? $user->username }},</p>
            
            <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Vui lòng nhấp vào liên kết dưới đây để tiếp tục:</p>

            <div style="text-align: center;">
                <a href="{{ route('reset-password', ['token' => $reset_token]) }}" class="reset-link">
                    Đặt Lại Mật Khẩu
                </a>
            </div>

            <p>Hoặc sao chép và dán URL này vào trình duyệt của bạn:</p>
            <p style="word-break: break-all; background-color: #f5f5f5; padding: 10px; border-radius: 4px;">
                {{ route('reset-password', ['token' => $reset_token]) }}
            </p>

            <div class="warning">
                <strong>⚠️ Lưu ý bảo mật:</strong> Liên kết này sẽ hết hạn vào <strong>{{ isset($expires) ? $expires : 'sau 30 phút' }}</strong>. Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.
            </div>

            <p>Nếu bạn gặp vấn đề, vui lòng liên hệ với chúng tôi qua email: support@travela.com</p>
        </div>

        <div class="footer">
            <p>© 2025 Travela - Tất cả quyền được bảo lưu.</p>
            <p>Địa chỉ: 12 Chùa Bộc, Đống Đa, Hà Nội | Điện thoại: (+84) 123456789</p>
        </div>
    </div>
</body>
</html>
