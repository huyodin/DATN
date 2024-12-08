<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
<h1>Xin chào, {{ $name }}</h1>
<p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
<p>Bạn có thể đặt lại mật khẩu bằng cách nhấp vào liên kết dưới đây:</p>
<a href="{{ $resetUrl }}">Đặt lại mật khẩu</a>
<p>Nếu bạn không yêu cầu điều này, vui lòng bỏ qua email này.</p>
</body>
</html>
