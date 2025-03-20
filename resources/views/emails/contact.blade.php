<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ từ khách hàng</title>
</head>
<body>
    <h2>Thông tin liên hệ</h2>
    <p><strong>Họ tên:</strong> {{ $details['name'] }}</p>
    <p><strong>Email:</strong> {{ $details['email'] }}</p>
    <p><strong>Số điện thoại:</strong> {{ $details['phone'] }}</p>
    <p><strong>Tin nhắn:</strong> {{ $details['message'] }}</p>
</body>
</html>
