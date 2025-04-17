<!DOCTYPE html>
<html>
<head>
    <title>Chúc mừng sinh nhật!</title>
</head>
<body>
    <p>Để cảm ơn bạn, chúng tôi tặng bạn mã giảm giá đặc biệt:</p>
    <h2>{{ $coupon->code }}</h2>
    <p>Giảm: {{ $coupon->gia_tri }}%</p>
    <p>Hết hạn: {{ $coupon->ngay_ket_thuc->format('d/m/Y') }}</p>
    <p>Giảm tối đa: {{ number_format($coupon->muc_giam_toi_da,0,'','.') }}đ</p>
    <p>Đơn giá áp dụng tối thiểu: {{ number_format($coupon->muc_gia_toi_thieu,0,'','.')  }}đ</p>
    <a style="text-decoration: none; color: #0da487;" href="http://127.0.0.1:8000/">Truy cập website và sử dụng mã này khi thanh toán để nhận ưu đãi !</a>
    <p>Trân trọng!</p>
</body>
</html>
