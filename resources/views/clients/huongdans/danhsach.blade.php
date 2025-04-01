@extends('layouts.client')

@section('title')
    Hướng Dẫn Đặt Hàng
@endsection

@section('content')
<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .title {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .step, .sub-step {
        margin-bottom: 30px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
    }

    .step h2, .sub-step h3, .sub-step h4 {
        color: #007bff;
    }

    .step img, .sub-step img {
        width: 100%;
        max-width: 600px;
        display: block;
        margin: 10px auto;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    p {
        font-size: 16px;
        color: #555;
    }

    .sub-step {
        margin-left: 20px;
        border-left: 4px solid #007bff;
        padding-left: 15px;
    }
</style>

<div class="container">
    <h1 class="title">Hướng Dẫn Đặt Hàng</h1>

    <div class="step">
        <h2>Bước 1: Đăng nhập vào trang web</h2>
        <p>Truy cập vào trang web và đăng nhập bằng tài khoản của bạn.</p>
        <img src="{{ asset('storage/images/buoc1.png') }}" alt="Bước 1 - Đăng nhập">
        </div>

    <div class="step">
        <h2>Bước 2: Tìm sản phẩm bạn muốn mua</h2>
        <p>Sử dụng thanh tìm kiếm hoặc danh mục để tìm sản phẩm bạn muốn.</p>
        <img src="{{ asset('storage/images/buoc2.png') }}" alt="Bước 2 - Tìm sản phẩm">
    </div>

    <div class="step">
        <h2>Bước 3: Ấn vào phần thêm sản phẩm</h2>
        <p>Nhấp vào sản phẩm mong muốn và bấm nút "Thêm vào giỏ hàng".</p>
        <img src="{{ asset('storage/images/b3.png') }}" alt="Bước 3 - Thêm sản phẩm">
    </div>

    <div class="step">
        <h2>Bước 4: Chọn kích thước, màu sắc và thêm vào giỏ hàng</h2>
        <p>Chọn các tùy chọn phù hợp và bấm "Thêm vào giỏ hàng".</p>
        <img src="{{ asset('storage/images/b4.png') }}" alt="Bước 4 - Chọn kích thước, màu sắc">
    </div>

    <div class="step">
        <h2>Bước 5: Truy cập giỏ hàng và chọn thanh toán</h2>
        <p>Kiểm tra giỏ hàng và bấm nút "Thanh toán".</p>
        <img src="{{ asset('storage/images/b5.png') }}" alt="Bước 5 - Giỏ hàng">
    </div>

    <div class="step">
        <h2>Bước 6: Nhập thông tin địa chỉ và số điện thoại</h2>
        <p>Điền đầy đủ thông tin người nhận để đảm bảo giao hàng chính xác.</p>
        <img src="{{ asset('storage/images/b6.png') }}" alt="Bước 6 - Nhập địa chỉ">
    </div>

    <div class="step">
        <h2>Bước 7: Chọn hình thức thanh toán</h2>
        <p>Bạn có thể chọn thanh toán tiền mặt hoặc qua VNPay.</p>
        <img src="{{ asset('storage/images/b7.png') }}" alt="Bước 7 - Chọn thanh toán">
        
        <div class="sub-step">
            <h3>Bước 7.1: Thanh toán tiền mặt</h3>
            <p>Chọn thanh toán tiền mặt và bấm "Đặt hàng".</p>
            <img src="{{ asset('storage/images/b7.1.png') }}" alt="Bước 7.1 - Thanh toán tiền mặt">
        </div>



            <div class="sub-step">
                <h4>Bước 7.2.2: Quay lại website sau khi thanh toán</h4>
                <p>Sau khi thanh toán thành công, hệ thống sẽ đưa bạn quay lại trang web.</p>
                <img src="{{ asset('storage/images/b7.2.2.png') }}" alt="Bước 7.2.2 - Quay lại website">
            </div>
        </div>
    </div>
</div>
@endsection
