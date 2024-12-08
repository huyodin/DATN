<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng bạn</title>
</head>
<body>
<h1>Chào mừng, {{ $name }}!</h1>
<p>Cảm ơn bạn đã đăng ký tài khoản tại hệ thống của chúng tôi. Email của bạn: {{ $email }}</p>
<p>Chúng tôi rất vui khi có bạn đồng hành!</p>
<p>Để hoàn tất đăng ký, vui lòng xác thực email của bạn bằng cách nhấp vào nút dưới đây:</p>
<a href="{{ $verificationUrl }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Xác thực Email</a>
</body>
</html>
