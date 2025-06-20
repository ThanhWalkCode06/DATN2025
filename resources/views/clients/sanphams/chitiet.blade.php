@extends('layouts.client')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        /* Cấu hình chung */
        .option {
            display: inline-block;
            margin-right: 10px;
        }

        .option-box {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        input[type="radio"].variant-color-selector {
            opacity: 0;
            position: absolute;
            width: 1px;
            height: 1px;
        }

        /* Tùy chỉnh màu sắc sản phẩm */

        #selected-color {
            margin-left: 5px;
            /* Tạo khoảng cách giữa chữ "Màu Sắc:" và màu được chọn */
        }

        .mb-3 strong {
            display: block;
            margin-bottom: 10px;
            /* Tạo khoảng cách giữa tiêu đề và các nút chọn màu */
        }

        .color-option {
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border: 1px solid #16A085;
            border-radius: 50%;
            font-size: 12px;
            /* nhỏ lại để không bị tràn */
            line-height: 1.2;
            font-weight: bold;
            text-align: center;
            padding: 4px;
            /* giữ khoảng cách đều */
            box-sizing: border-box;
            white-space: normal;
            /* cho xuống dòng nếu cần */
        }

        .color-option.active {
            background-color: #16A085;
            color: white;
            border-color: #16A085;
        }

        .color-option:hover {

            border-color: #000;
            /* Thêm viền màu đen khi hover */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Thêm bóng đổ */
        }



        .color-option input[type="radio"]:checked {
            border: 3px solid #1abc9c;
            /* Thêm viền màu khi được chọn */
        }

        /* Hộp chứa sản phẩm */
        .product-box-3 {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Phần đánh giá */
        .product-rating {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .product-rating ul.rating {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .product-rating ul.rating li {
            margin-right: 3px;
        }

        .product-rating ul.rating i {
            color: #ffcc00;
            font-size: 14px;
        }

        .product-rating span {
            font-size: 14px;
            color: #666;
        }

        /* Tên sản phẩm */
        .product-detail h5.name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        /* Swiper */
        .swiper-container {
            width: 100%;
            overflow: hidden;
            padding: 10px;
            position: relative;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            width: auto;
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: black;
            font-size: 24px;
            background: rgba(255, 255, 255, 0.8);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            color: #1abc9c;
        }

        /* Giá sản phẩm */
        #product-price {
            color: #e74c3c;
            font-size: 20px;
            font-weight: bold;
        }

        #default-old-price {
            color: #7f8c8d;
            text-decoration: line-through;
            font-size: 18px;
            margin-left: 5px;
        }

        .offer-top {
            font-size: 16px;
            font-weight: bold;
        }

        /* Hình ảnh sản phẩm */
        .left-slider-image .slick-track {
            display: flex !important;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-image img {
            width: 100px;
            height: auto;
            cursor: pointer;
        }

        #main-image {
            display: block !important;
            width: 100%;
            max-height: 400px;
            object-fit: contain;
        }

        .slick-slide {
            opacity: 1 !important;
            filter: none !important;
        }

        .slick-slide[aria-hidden="true"] {
            opacity: 1 !important;
        }

        .product-left-box img:not(#main-image) {
            width: 150px;
            height: 100px;
            object-fit: cover;
        }

        /* Đánh giá */
        .rating i {
            font-size: 24px;
            cursor: pointer;
            color: #ccc;
        }

        .rating i.selected {
            color: #f39c12;
        }

        /* Màu sắc lựa chọn */
        #color-options {
            display: flex;
            gap: 10px;
        }

        /* Wrapper sản phẩm */
        .product-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .product-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .product-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .name {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        /* Điều chỉnh khoảng cách giá */
        .product-review-rating {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 5px;
        }

        .product-rating {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: left;
            gap: 5px;
        }

        .theme-color {
            color: #009970;
            font-weight: bold;
            font-size: 16px;
            display: inline-block;
            width: auto;
        }

        del {
            color: gray;
            font-size: 14px;
            margin-top: 2px;
            display: inline-block;
            width: auto;
        }

        .review-box {
            margin: 5px 0;
        }


        .product-main {
            width: 100%;
            max-width: 500px;
            height: 500px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .main-product-img {
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            display: block;
        }







        .slick-slider .slick-slide {
            padding: 0 5px;
            /* Điều chỉnh khoảng cách giữa các ảnh thumbnail */
        }

        /* Thêm hiệu ứng zoom nhẹ khi hover vào ảnh thumbnail trong slider */
        .slick-slider .slick-slide img {
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .slick-slider .slick-slide:hover img {
            transform: scale(1.1);
            /* Phóng to nhẹ khi hover */
            filter: brightness(1.1);
            /* Làm ảnh sáng lên một chút */
        }

        .review-images img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .review-video {
            margin-top: 10px;
            max-width: 200px;
            /* Giảm kích thước tối đa của video */
        }

        .review-video video {
            width: 100%;
            height: auto;
            max-height: 150px;
            /* Giới hạn chiều cao video */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            /* Đảm bảo video không bị méo */
        }

        #imagePreviewModal .modal-content {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #imagePreviewModal .modal-body {
            padding: 0;
        }

        #previewImage {
            width: 100%;
            max-height: 70vh;
            object-fit: contain;
            border-radius: 8px;
        }

        .people-comment .reply p {
            word-break: break-word;
            /* Đảm bảo từ dài sẽ bị ngắt để xuống dòng */
            overflow-wrap: break-word;
            /* Hỗ trợ xuống dòng tự động */
            max-width: 100%;
            /* Giới hạn chiều rộng tối đa bằng chiều rộng của phần tử cha */
            margin: 0;
            /* Loại bỏ margin mặc định nếu cần */
        }

        .payment-methods {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .payment-methods li {
            display: inline-block;
        }

        .payment-logo {
            width: 60px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .payment-logo:hover {
            transform: scale(1.1);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            color: #009970;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 10px;
            cursor: pointer;
        }

        .pagination .page-link:hover {
            background-color: #009970;
            color: #fff;
        }

        .pagination .active .page-link {
            background-color: #009970;
            color: #fff;
            border-color: #009970;
        }

        .pagination .disabled .page-link {
            color: #ccc;
            cursor: not-allowed;
        }

        .gap-2{
            gap: .4rem !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Chi tiết sản phẩm</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Product Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-3 justify-content-center">
                                    <!-- Ảnh chính -->
                                    <div class="col-12 text-center">
                                        <div class="product-main zoom-container">
                                            <img id="main-image" src="{{ asset('storage/' . $sanPhams->hinh_anh) }}"
                                                class="main-product-img" alt="Ảnh sản phẩm">
                                        </div>
                                    </div>

                                    <!-- Slider ảnh thumbnail -->
                                    <div class="col-12">
                                        <div class="left-slider-image slick-slider">
                                            <div class="thumbnail-item">
                                                <img src="{{ asset('storage/' . $sanPhams->hinh_anh) }}"
                                                    class="img-fluid image-thumbnail active" alt="Ảnh chính"
                                                    data-large="{{ asset('storage/' . $sanPhams->hinh_anh) }}">
                                            </div>

                                            @foreach ($sanPhams->anhSP as $anh)
                                                <div class="thumbnail-item">
                                                    <img src="{{ asset('storage/' . $anh->link_anh_san_pham) }}"
                                                        class="img-fluid image-thumbnail" alt="Ảnh phụ"
                                                        data-large="{{ asset('storage/' . $anh->link_anh_san_pham) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp">
                            <!-- Ví dụ trong chitiet.blade.php -->
                            <h2 class="product-name">
                                {{ $sanPhams->ten_san_pham }}
                            </h2>
                            <br>
                            <div class="right-box-contain">
                                <h6 class="offer-top">Giảm giá {{ $phanTramGiamGia }}% </h6> <!-- Giữ mặc định -->
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <strong class="price-label"></strong>
                                    <span id="product-price" class="theme-color price"
                                        style="font-size: 20px; font-weight: bold;">0₫</span>

                                    <span id="default-price" class="theme-color price"
                                        style="font-size: 20px; font-weight: bold;">
                                        {{ number_format($sanPhams->giaThapNhatCuaSP(), 0, ',', '.') }}₫
                                    </span>

                                    <del id="default-old-price" class="text-content text-muted" style="font-size: 18px;">
                                        {{ number_format($sanPhams->gia_cu, 0, ',', '.') }}₫
                                    </del>
                                </div>


                                <div class="product-contain">
                                    <p class="w-100"></p>
                                </div>

                                <div class="product-package">
                                    <!-- Hiển thị danh sách màu sắc -->
                                    <div class="mb-3">
                                        <strong>Màu Sắc: <span id="selected-color"></span></strong>
                                        <div class="d-flex flex-wrap" id="color-options">
                                            @foreach ($mauSac as $index => $mau)
                                                <label
                                                    class="color-option rounded-circle d-flex align-items-center justify-content-center"
                                                    style="cursor: pointer; width: 50px; height: 50px; position: relative; border: 1px solid #009970;"
                                                    data-color-name="{{ $mau['gia_tri'] }}"
                                                    data-index="{{ $index }}">

                                                    <input type="radio" name="color"
                                                        class="d-none variant-color-selector" value="{{ $index }}"
                                                        data-mau="{{ $mau['gia_tri'] }}"
                                                        data-bienthes='@json($mau['bien_thes'])'
                                                        {{ $index === 0 ? 'checked' : '' }}>

                                                    <!-- Replace image with text (color name) -->
                                                    <span class="color-name">{{ $mau['gia_tri'] }}</span>
                                                    <!-- Added color name here -->
                                                </label>
                                            @endforeach

                                        </div>
                                    </div>

                                    <!-- Hiển thị danh sách kích thước -->
                                    <div class="mb-3">
                                        <strong>Size:</strong>
                                        <div class="d-flex flex-wrap" id="size-options">
                                            <!-- Kích thước sẽ cập nhật bằng JavaScript -->
                                        </div>
                                    </div>


                                    <!-- Hiển thị giá sản phẩm -->
                                    <div class="mt-3">
                                        {{-- <strong>GIÁ:</strong>
                                            <span id="product-price">0 VNĐ</span><br> --}}
                                        <strong>Số lượng:</strong>
                                        <span id="product-quantity"></span>

                                    </div>
                                </div>


                                <div class="note-box product-package d-flex align-items-center gap-3">
                                    <!-- Hộp nhập số lượng -->
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <div class="number-input d-flex align-items-center">
                                                <button onclick="decreaseValue()">−</button>
                                                <input type="number" name="quantity" id="quantity" value="1"
                                                    min="1" style="width: 50px; text-align: center;">
                                                <button onclick="increaseValue()">+</button>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($sanPhams['trang_thai'] == 1)
                                        <a class="btn btn-quick-view btn-add-cart addcart-button d-flex align-items-center text-white fw-bold"
                                            href="javascript:void(0)" data-id="{{ $sanPhams['id'] }}"
                                            style="background-color: #1abc9c; padding: 10px 15px; border-radius: 5px;">
                                            <span class="add-icon bg-light-gray me-2">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </span>
                                            Thêm vào giỏ hàng
                                        </a>
                                    @endif

                                </div>


                                <div class="buy-box">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="">
                                        <a href="#" class="notifi-wishlist">
                                            <i data-feather="heart"></i>Thêm vào danh sách sản phẩm yêu thích
                                        </a>
                                        <form action="{{ route('add.wishlist', $sanPhams['id']) }}" method="POST"
                                            class="wishlist-form">
                                            @csrf
                                        </form>
                                    </li>

                                </div>

                                <div class="pickup-box">

                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>Danh mục :
                                                <a href="javascript:void(0)">
                                                    {{ $sanPhams->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}
                                                </a>
                                            </li>

                                            <li>Ngày thêm :
                                                <a href="javascript:void(0)">
                                                    {{ $sanPhams->created_at->format('d/m/Y') }}
                                                </a>
                                            </li>


                                            </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>


                                <div class="payment-option">
                                    <div class="product-title">
                                        <h4>Phương thức thanh toán</h4>
                                    </div>
                                    <ul class="payment-methods d-flex gap-3 align-items-center">
                                        <li>
                                            <a href="javascript:void(0)" title="Thanh toán qua VNPAY">
                                                <img src="https://static.cdnlogo.com/logos/v/99/vnpay.svg" alt="VNPAY"
                                                    class="payment-logo" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" title="Ví của trang web">
                                                <img src="https://static.vecteezy.com/ti/vetor-gratis/p1/42147641-cartao-forma-de-pagamento-e-transacao-icone-vetor.jpg"
                                                    alt="Ví điện tử" class="payment-logo" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" title="Thanh toán khi nhận hàng (COD)">
                                                <img src="https://img.freepik.com/premium-vector/free-shipping-delivery-truck-icon_342036-1710.jpg?w=360"
                                                    alt="Thanh toán khi nhận hàng" class="payment-logo" />
                                            </a>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-list">
                                    <ul>
                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="headphones"></i>
                                                <h5>Liên hệ: <span class="text-content">0387660612
                                                    </span></h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="map-pin"></i>
                                                <h5>Địa chỉ: </h5>
                                            </div> <br>
                                            <div
                                                style="width: 100%; max-width: 600px; height: 400px; margin: 0 auto; overflow: hidden; border: 1px solid #ccc;">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863806021129!2d105.74468151095591!3d21.038134787375412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1sen!2sus!4v1742563208168!5m2!1sen!2sus"
                                                    width="100%" height="100%" style="border:0;" allowfullscreen=""
                                                    loading="lazy">
                                                </iframe>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pt-25">
                                <div class="hot-line-number">
                                    <h5>Thời gian làm việc:</h5>
                                    <h6>Thứ Hai - Thứ Sáu: 7:00 sáng - 8:30 tối
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product End -->

    <!-- Related Product Section Start -->

    <!-- Related Product Section End -->

    <!-- Nav Tab Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="product-section-box m-0">
                        <div class="accordion accordion-box" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1">Mô tả</button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                {!! $sanPhams->mo_ta !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse4">Đánh giá</button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="review-box">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="product-rating-box">
                                                        <div class="row">
                                                            @php
                                                                $tongDanhGia = $sanPhams->danhGias->count(); // Tổng lượt đánh giá
                                                                $trungBinhDanhGia =
                                                                    $tongDanhGia > 0
                                                                        ? round($sanPhams->danhGias->avg('so_sao'), 1)
                                                                        : 0; // Làm tròn 1 chữ số thập phân
                                                            @endphp

                                                            <div class="product-main-rating">
                                                                <h2>({{ $trungBinhDanhGia }} / 5)</h2>
                                                                <h5>{{ $tongDanhGia }} lượt đánh giá</h5>
                                                            </div>


                                                            @php
                                                                $tongDanhGia = $sanPhams->danhGias->count(); // Tổng lượt đánh giá
                                                                $soSao = [5, 4, 3, 2, 1]; // Các mức sao từ 5 đến 1
                                                                $danhGiaSao = [];

                                                                foreach ($soSao as $sao) {
                                                                    $danhGiaSao[$sao] = $sanPhams->danhGias
                                                                        ->where('so_sao', $sao)
                                                                        ->count();
                                                                }
                                                            @endphp

                                                            <div class="col-xl-12">
                                                                <ul class="product-rating-list">
                                                                    @foreach ($soSao as $sao)
                                                                        @php
                                                                            $soLuong = $danhGiaSao[$sao] ?? 0;
                                                                            $tiLe =
                                                                                $tongDanhGia > 0
                                                                                    ? round(
                                                                                        ($soLuong / $tongDanhGia) * 100,
                                                                                        1,
                                                                                    )
                                                                                    : 0;
                                                                        @endphp
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>{{ $sao }}<i
                                                                                        data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $tiLe }}%;">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $soLuong }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                                <div class="review-title-2">
                                                                    {{-- <h4 class="fw-bold">Đánh giá sản phẩm này</h4> --}}
                                                                    {{-- <p>Hãy cho chúng tôi biết đánh giá của bạn</p> --}}
                                                                    @if ($chophep_danhgia)
                                                                        {{-- <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#writereview">Viết đánh giá</button> --}}
                                                                    @else
                                                                        <p
                                                                            style="background-color: #fff3cd; color: #dc3545; padding: 10px; border-radius: 5px; text-align: center;">
                                                                            Vui lòng mua sản phẩm để đánh giá
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-7">
                                                    <div class="review-people">
                                                        <ul class="review-list" id="review-list"></ul>
                                                        <nav aria-label="Page navigation" id="pagination">
                                                            <ul class="pagination"></ul>
                                                        </nav>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Nav Tab Section End -->

    <!-- Related Product Section Start -->
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Sản phẩm liên quan</h2>
                <span class="title-leaf">
                </span>
            </div>
            <div class="row">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($sanPhamLienQuan as $item)
                            <div class="swiper-slide">
                                <div class="product-box-3 wow fadeInUp">
                                    <div class="product-header">
                                        <!-- Hiển thị % giảm giá nếu có -->
                                        @if ($item->gia_cu > $item->giaThapNhatCuaSP())
                                            <span class="badge bg-danger">
                                                -{{ round((($item->gia_cu - $item->giaThapNhatCuaSP()) / $item->gia_cu) * 100) }}%
                                            </span>
                                        @endif
                                        <div class="product-image">
                                            <a href="{{ route('sanphams.chitiet', $item->id) }}">
                                                <img src="{{ Storage::url($item->hinh_anh) }}"
                                                    class="img-fluid rounded shadow-sm" alt="{{ $item->ten_san_pham }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span
                                                class="span-name">{{ $item->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</span>

                                            <a href="{{ route('sanphams.chitiet', $item->id) }}">
                                                <h5 class="name">{{ $item->ten_san_pham }}</h5>
                                            </a>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            <i data-feather="star"
                                                                class="{{ $i <= $item->tinhDiemTrungBinh() ? 'fill' : '' }}"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                <span>({{ number_format($item->tinhDiemTrungBinh(), 1) }} / 5)</span>
                                                <span class="text-muted">({{ $item->soLuongDanhGia() }} đánh giá)</span>
                                            </div>

                                            <h5 class="price">
                                                <span
                                                    class="theme-color">{{ number_format($item->giaThapNhatCuaSP(), 0, ',', '.') }}
                                                    ₫</span>
                                                <del>{{ number_format($item->gia_cu, 0, ',', '.') }} ₫</del>
                                            </h5>

                                            <!-- Nút thêm vào giỏ hàng -->
                                            {{-- <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </span> Thêm vào giỏ hàng
                                                </button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Nút điều hướng -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>


            </div>

        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Review Modal Start -->
    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Viết đánh giá sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                @if (session('error_binhluan'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                title: "Lỗi bình luận!",
                                text: "{{ session('error_binhluan') }}",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        });
                    </script>
                @endif
                <div class="modal-body pt-0">
                    <form id="reviewForm" method="POST"
                        action="{{ route('sanphams.themdanhgia', ['san_pham_id' => $sanPhams->id]) }}">
                        @csrf
                        <input type="hidden" name="san_pham_id" id="san_pham_id" value="{{ $sanPhams->id }}">
                        <input type="hidden" name="so_sao" id="so_sao" value="5">

                        {{-- Nếu có biến thể đã mua, hiển thị danh sách để chọn --}}
                        @if ($chophep_danhgia && !empty($bienTheDaMua))
                            @if (count($bienTheDaMua) > 1)
                                <div class="review-box mt-3">
                                    <label for="bien_the_id" 
                                    
                                    class="form-label">Chọn biến thể đã mua *</label>
                                    <select name="bien_the_id" id="bien_the_id" class="form-select" required>
                                        @foreach ($bienTheDaMua as $bienTheId => $soLanMua)
                                            @php
                                                $bienThe = App\Models\BienThe::find($bienTheId);
                                            @endphp
                                            @if ($bienThe)
                                                <option value="{{ $bienTheId }}">{{ $bienThe->ten_bien_the }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="bien_the_id" value="{{ array_key_first($bienTheDaMua) }}">
                            @endif
                        @else
                            <p style="background-color: #fff3cd; color: #dc3545; padding: 10px; border-radius: 5px;">Vui
                                lòng mua sản phẩm để đánh giá.</p>
                        @endif

                        <div class="product-wrapper">
                            <div class="product-image">
                                <img src="{{ Storage::url($sanPhams->hinh_anh) }}" class="img-fluid rounded shadow-sm"
                                    style="width:100%; height:100%;" alt="{{ $sanPhams->ten_san_pham }}">
                            </div>
                            <div class="product-content">
                                {{-- <h5 class="name">{{ $sanPhams->ten_san_pham }}</h5> --}}
                                {{-- <div class="product-review-rating">
                                    <div class="product-rating">
                                        <span class="theme-color">{{ number_format($sanPhams->giaThapNhatCuaSP(), 0, ',', '.') }} ₫</span>
                                        <del>{{ number_format($sanPhams->gia_cu, 0, ',', '.') }} ₫</del>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="review-box">
                            <label>Đánh giá của bạn *</label>
                            <div class="rating" id="ratingStars">
                                <i class="fa fa-star" data-value="1"></i>
                                <i class="fa fa-star" data-value="2"></i>
                                <i class="fa fa-star" data-value="3"></i>
                                <i class="fa fa-star" data-value="4"></i>
                                <i class="fa fa-star" data-value="5"></i>
                            </div>
                        </div>

                        <div class="review-box">
                            <label for="nhan_xet" class="form-label">Nhận xét của bạn *</label>
                            <textarea id="nhan_xet" name="nhan_xet" rows="3" class="form-control"
                                placeholder="Viết nhận xét của bạn..."></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                                data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Xem ảnh đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" class="img-fluid"
                        style="max-height: 70vh; object-fit: contain;" alt="Ảnh đánh giá">
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal End -->
@endsection

@section('js')
    <script>
        function formatDateTime(dateString) {
            const date = new Date(dateString);

            // Lấy ngày, tháng, năm
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
            const year = date.getFullYear();

            // Lấy giờ, phút
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            // Trả về định dạng "ngày trước giờ sau": 02/05/2025 14:30
            return `${day}/${month}/${year} ${hours}:${minutes}`;

            // const date = new Date(dateString);
            // return date.toLocaleString('vi-VN', {
            //     day: '2-digit',
            //     month: '2-digit',
            //     year: 'numeric',
            //     hour: '2-digit',
            //     minute: '2-digit'
            // });
            // const [time, datePart] = formatted.split(' ');
            // return `${datePart} ${time}`;
        }

        function loadReviews(page = 1) {
            fetch(`/san-pham/{{ $sanPhams->id }}/danh-gia?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const reviewList = document.getElementById('review-list');
                    reviewList.innerHTML = '';

                    if (data.danhGias.length === 0) {
                        reviewList.innerHTML = '<p style="color: red">Chưa có đánh giá nào.</p>';
                    } else {
                        data.danhGias.forEach(danhGia => {
                            let stars = '';
                            for (let i = 1; i <= 5; i++) {
                                stars +=
                                    `<li><i data-feather="star" class="${i <= danhGia.so_sao ? 'fill' : ''}"></i></li>`;
                            }

                            let images = '';
                            if (danhGia.hinh_anh_danh_gia && danhGia.hinh_anh_danh_gia.length > 0) {
                                images = `<div class="review-images mt-2 d-flex flex-wrap gap-2">`;
                                danhGia.hinh_anh_danh_gia.forEach(image => {
                                    images += `
                            <img src="/storage/${image}" class="img-fluid rounded review-image"
                                 style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                                 data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                 data-image="/storage/${image}" alt="Hình ảnh đánh giá">`;
                                });
                                images += `</div>`;
                            }

                            let video = '';
                            if (danhGia.video) {
                                video = `
                        <div class="review-video">
                            <video controls playsinline>
                                <source src="/storage/${danhGia.video}" type="video/mp4">
                                Trình duyệt của bạn không hỗ trợ video.
                            </video>
                        </div>`;
                            }

                            reviewList.innerHTML += `
                    <li>
                        <div class="people-box">
                            <div>
                                <div class="people-image people-text">
                                    <img alt="user" class="img-fluid"
                                         src="${danhGia.nguoi_dung?.anh_dai_dien ? `/storage/${danhGia.nguoi_dung.anh_dai_dien}` : '/default-avatar.jpg'}">
                                </div>
                            </div>
                            <div class="people-comment">
                                <div class="people-name">
                                    <a href="javascript:void(0)" class="name">${danhGia.nguoi_dung?.ten_nguoi_dung || 'Ẩn danh'}</a>
                                    <ul class="rating">${stars}</ul>
                                    <div class="date-time">
                                        <h6 class="text-content">${formatDateTime(danhGia.created_at)}</h6>
                                        <div class="product-rating">
                                            <ul>
                                                ${danhGia.bien_the ? `<p class="text-muted mb-1"> ${danhGia.bien_the.ten_bien_the}</p>` : ''}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="reply">
                                    <p>${danhGia.nhan_xet}</p>
                                    ${images}
                                    ${video}
                                </div>
                            </div>
                        </div>
                    </li>`;
                        });
                    }

                    feather.replace();

                    const reviewImages = document.querySelectorAll('.review-image');
                    const previewImage = document.getElementById('previewImage');
                    reviewImages.forEach(image => {
                        image.addEventListener('click', function() {
                            const imageUrl = this.getAttribute('data-image');
                            previewImage.src = imageUrl;
                        });
                    });

                    updatePagination(data.current_page, data.last_page);
                })
                .catch(error => {
                    console.error('Error loading reviews:', error);
                    document.getElementById('review-list').innerHTML =
                        '<p style="color: red">Lỗi khi tải đánh giá.</p>';
                });
        }

        function updatePagination(currentPage, lastPage) {
            const pagination = document.getElementById('pagination').querySelector('.pagination');
            pagination.innerHTML = '';

            // Previous Page Link
            pagination.innerHTML += `
    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${currentPage - 1})">«</a>
    </li>`;

            // Nếu tổng số trang <= 12, hiển thị tất cả các trang
            if (lastPage <= 12) {
                for (let i = 1; i <= lastPage; i++) {
                    pagination.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
            </li>`;
                }
            } else {
                // Nếu currentPage < 8, hiển thị 10 trang đầu + dấu ba chấm + 2 trang cuối
                if (currentPage < 8) {
                    for (let i = 1; i <= 10; i++) {
                        pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
                </li>`;
                    }
                    // Dấu ba chấm
                    pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link dots">...</span>
            </li>`;
                    // 2 trang cuối
                    for (let i = lastPage - 1; i <= lastPage; i++) {
                        pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
                </li>`;
                    }
                } else {
                    // Hiển thị trang 1, 2
                    for (let i = 1; i <= 2; i++) {
                        pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
                </li>`;
                    }
                    // Dấu ba chấm
                    pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link dots">...</span>
            </li>`;

                    // Tính toán khối 8 trang lân cận
                    let startPage = Math.max(3, currentPage - 4); // Bắt đầu từ currentPage - 4, nhưng không nhỏ hơn 3
                    let endPage = Math.min(lastPage - 2, startPage +
                        7); // Kết thúc sau 7 trang, nhưng không vượt quá lastPage - 2

                    // Nếu endPage gần lastPage - 2, điều chỉnh startPage để giữ khối 8 trang
                    if (endPage >= lastPage - 2) {
                        endPage = lastPage - 2;
                        startPage = Math.max(3, endPage - 7);
                    }

                    // Hiển thị khối 8 trang
                    for (let i = startPage; i <= endPage; i++) {
                        pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
                </li>`;
                    }

                    // Dấu ba chấm nếu endPage < lastPage - 2
                    if (endPage < lastPage - 2) {
                        pagination.innerHTML += `
                <li class="page-item disabled">
                    <span class="page-link dots">...</span>
                </li>`;
                    }

                    // Hiển thị 2 trang cuối
                    for (let i = lastPage - 1; i <= lastPage; i++) {
                        pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}" aria-current="${i === currentPage ? 'page' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${i})">${i}</a>
                </li>`;
                    }
                }
            }

            // Next Page Link
            pagination.innerHTML += `
    <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0)" onclick="loadReviews(${currentPage + 1})">»</a>
    </li>`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadReviews(1);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const colorOptions = document.querySelectorAll(".color-option");
            const sizeContainer = document.querySelector("#size-options");
            const priceDisplay = document.querySelector("#product-price");
            const quantityDisplay = document.querySelector("#product-quantity");
            const priceLabel = document.querySelector(".price-label");
            const defaultPrice = document.querySelector("#default-price");
            const defaultOldPrice = document.querySelector("#default-old-price");
            const selectedColorSpan = document.getElementById("selected-color");
            const productImage = document.querySelector("#main-image");
            const discountLabel = document.querySelector(".offer-top");

            function formatCurrency(value) {
                return new Intl.NumberFormat("vi-VN").format(value) + "₫";
            }

            function updatePriceAndQuantity() {
                const selectedSize = document.querySelector(".variant-size-selector:checked");
                if (selectedSize) {
                    const sizePrice = parseFloat(selectedSize.getAttribute("data-price"));
                    const oldPrice = parseFloat(defaultOldPrice.innerText.replace("₫", "").replace(/\./g, ""));
                    const variantImage = selectedSize.getAttribute("data-image");

                    priceDisplay.textContent = formatCurrency(sizePrice);
                    quantityDisplay.textContent = selectedSize.getAttribute("data-quantity");

                    defaultPrice.style.display = "none";
                    priceLabel.style.display = "inline";
                    priceDisplay.style.display = "inline";

                    if (oldPrice > 0 && sizePrice < oldPrice) {
                        const discountPercent = Math.round(100 - (sizePrice / oldPrice) * 100);
                        discountLabel.textContent = `Giảm giá ${discountPercent}% `;
                        discountLabel.style.visibility = "visible";
                    } else {
                        discountLabel.style.visibility = "hidden";
                    }

                    if (variantImage && variantImage !== "null" && variantImage !== "undefined") {
                        productImage.src = variantImage;
                        productImage.style.display = "block";
                    }
                }
            }

            function updateSizes(bienThes, previousSizeValue = null) {
                sizeContainer.innerHTML = "";

                if (bienThes.length === 0) {
                    sizeContainer.innerHTML = "<p>Không có size phù hợp.</p>";
                    priceDisplay.innerText = formatCurrency(0);
                    quantityDisplay.innerText = "0";
                    return;
                }

                const sizeOrder = {
                    "S": 1,
                    "M": 2,
                    "L": 3,
                    "XL": 4,
                    "XXL": 5
                };
                bienThes.sort((a, b) => (sizeOrder[a.gia_tri] || 99) - (sizeOrder[b.gia_tri] || 99));

                bienThes.forEach(size => {
                    const label = document.createElement("label");
                    label.classList.add("option", "size-option");
                    label.style.cursor = "pointer";
                    label.innerHTML = `
                    <input type="radio" name="size" class="d-none variant-size-selector"
                        value="${size.id}" data-price="${size.gia_ban}"
                        data-quantity="${size.so_luong}" data-image="${size.anh}"
                        data-size="${size.gia_tri}">
                    <span class="option-box">${size.gia_tri}</span>
                `;
                    sizeContainer.appendChild(label);
                });

                attachSizeEvents();

                // Nếu có previousSizeValue (S, M, L...) thì chọn lại size tương ứng
                if (previousSizeValue) {
                    const reselectInput = sizeContainer.querySelector(
                        `.variant-size-selector[data-size="${previousSizeValue}"]`);
                    if (reselectInput) {
                        reselectInput.checked = true;
                        reselectInput.closest("label").classList.add("selected");
                        updatePriceAndQuantity();

                        const addToCartBtn = document.querySelector(".btn-add-cart");
                        addToCartBtn.setAttribute("data-id", reselectInput.value);
                    }
                }
            }

            function attachSizeEvents() {
                const sizeInputs = document.querySelectorAll(".variant-size-selector");

                sizeInputs.forEach(input => {
                    input.addEventListener("change", function() {
                        document.querySelectorAll(".size-option").forEach(label => {
                            label.classList.remove("selected");
                        });

                        this.closest("label").classList.add("selected");
                        updatePriceAndQuantity();

                        const addToCartBtn = document.querySelector(".btn-add-cart");
                        addToCartBtn.setAttribute("data-id", this.value);
                    });
                });
            }

            // Xử lý chọn màu
            colorOptions.forEach(option => {
                const input = option.querySelector("input");

                // Nếu radio đã checked lúc load
                if (input.checked) {
                    option.classList.add("selected", "active");
                    selectedColorSpan.textContent = input.dataset.mau || "Không xác định";

                    const bienThes = JSON.parse(input.getAttribute("data-bienthes"));
                    updateSizes(bienThes);
                }

                option.addEventListener("click", function() {
                    // Lưu lại size hiện tại trước khi chuyển
                    const selectedSizeInput = document.querySelector(
                        ".variant-size-selector:checked");
                    const previousSizeValue = selectedSizeInput?.getAttribute("data-size");

                    colorOptions.forEach(opt => opt.classList.remove("selected", "active"));
                    this.classList.add("selected", "active");

                    selectedColorSpan.textContent = input.dataset.mau || "Không xác định";
                    input.checked = true;

                    const bienThes = JSON.parse(input.getAttribute("data-bienthes"));
                    updateSizes(bienThes, previousSizeValue);
                });
            });

            // Hiển thị size table
            sizeContainer.style.display = "block";
            priceDisplay.style.display = "none";
        });
    </script>



    <script>
        $(document).on("click", ".btn-add-cart", function() {
            let isLoggedIn = $('meta[name="user-logged-in"]').attr("content") ===
                "true"; // Kiểm tra trạng thái đăng nhập

            if (!isLoggedIn) {
                Swal.fire({
                    title: "Bạn chưa đăng nhập!",
                    text: "Vui lòng đăng nhập để tiếp tục mua hàng.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Đăng nhập",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login"; // Điều hướng đến trang đăng nhập
                    }
                });
                return;
            }

            let productId = $(this).attr("data-id");
            let quantity = parseInt($("#quantity").val()); // Chuyển số lượng thành số nguyên
            let selectedColor = $("input[name='color']:checked").attr("data-mau");
            let selectedSize = $("input[name='size']:checked").val();
            let stockQuantity = parseInt($("input[name='size']:checked").attr(
                "data-quantity")); // Lấy số lượng tồn kho

            if (!selectedColor || !selectedSize) {
                Swal.fire("Lỗi", "Vui lòng chọn màu sắc và kích thước trước khi thêm vào giỏ hàng!", "warning");
                return;
            }

            if (stockQuantity === 0) {
                Swal.fire("Lỗi", "Sản phẩm đã hết hàng!", "error");
                return;
            }

            if (quantity <= 0) {
                Swal.fire("Lỗi", "Số lượng sản phẩm không hợp lệ!", "error");
                return;
            }

            if (quantity > stockQuantity) {
                Swal.fire("Lỗi", "Sản phẩm không đủ số lượng trong kho!", "error");
                return;
            }

            let formData = {
                id_bienthe: productId,
                quantity: quantity,
                color: selectedColor,
                size: selectedSize
            };

            $.ajax({
                url: "{{ route('post.giohang') }}",
                method: "POST",
                data: JSON.stringify(formData),
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Thêm vào giỏ hàng thành công!",
                            text: "Sản phẩm đã được thêm vào giỏ hàng.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    $(".header-wishlist .badge").text(response.cart.totalItem);
                    $(".total-price").text(response.cart.totalPrice.toLocaleString(
                        "vi-VN") + " đ");

                    let cartListHtml = '';
                    let itemsToShow = response.cart.items.slice(0,
                        4); // Giới hạn chỉ lấy 4 sản phẩm đầu tiên

                    itemsToShow.forEach(item => {
                        cartListHtml += `
                <li style="width: 100%" class="product-box-contain">
                    <div class="drop-cart">
                        <a href="/sanpham/${item.id}" class="drop-image">
                            <img src="${item.image}" class="blur-up lazyload" alt="">
                        </a>
                        <div class="drop-contain">
                            <a href="/sanpham/${item.id}">
                                <h5>${item.name}</h5>
                                <h6>${item.name_bienthe}</h6>
                            </a>
                            <h6><span>${item.quantity} x</span> ${item.price.toLocaleString("vi-VN")} đ</h6>
                            <button class="close-button close_button delete-cart-item" data-id="${item.id_cart}">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </li>`;
                    });

                    $(".cart-list").html(cartListHtml); // Cập nhật danh sách sản phẩm

                    // Nếu số lượng sản phẩm lớn hơn 4, hiển thị "Xem thêm..."
                    if (response.cart.items.length > 4) {
                        $(".cart-list").append(
                            '<li class="text-center"><a href="giohang">Xem thêm...</a></li>'
                        );
                    }
                    // else {
                    //     Swal.fire("Lỗi", response.message, "error");
                    // }
                },
                error: function(xhr) {
                    Swal.fire("Lỗi", "Có lỗi xảy ra khi thêm vào giỏ hàng!", "error");
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 6,
                spaceBetween: 10,
                loop: false, // ❌ KHÔNG sử dụng loop
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1200: {
                        slidesPerView: 6
                    },
                    1024: {
                        slidesPerView: 4
                    },
                    768: {
                        slidesPerView: 3
                    },
                    480: {
                        slidesPerView: 2
                    },
                    320: {
                        slidesPerView: 1
                    }
                },
                on: {
                    init: function() {
                        toggleNavButtons(this); // Gọi khi khởi tạo
                    },
                    slideChange: function() {
                        toggleNavButtons(this); // Gọi khi chuyển slide
                    }
                }
            });

            function toggleNavButtons(swiperInstance) {
                const prevBtn = document.querySelector('.swiper-button-prev');
                const nextBtn = document.querySelector('.swiper-button-next');

                // Nếu đang ở slide đầu -> ẩn nút prev
                if (swiperInstance.isBeginning) {
                    prevBtn.style.display = 'none';
                } else {
                    prevBtn.style.display = 'flex';
                }

                // Nếu đang ở slide cuối -> ẩn nút next
                if (swiperInstance.isEnd) {
                    nextBtn.style.display = 'none';
                } else {
                    nextBtn.style.display = 'flex';
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chọn tất cả ảnh đánh giá
            const reviewImages = document.querySelectorAll('.review-image');
            const previewImage = document.getElementById('previewImage');

            // Thêm sự kiện click cho từng ảnh
            reviewImages.forEach(image => {
                image.addEventListener('click', function() {
                    // Lấy URL ảnh từ data-image
                    const imageUrl = this.getAttribute('data-image');
                    // Cập nhật src của ảnh trong modal
                    previewImage.src = imageUrl;
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainImage = document.getElementById('main-image');

            // Đổi ảnh khi click thumbnail
            document.querySelectorAll('.image-thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const newImageSrc = this.getAttribute('data-large');
                    if (mainImage) {
                        mainImage.src = newImageSrc;

                        document.querySelectorAll('.image-thumbnail').forEach(img => img.classList
                            .remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Zoom theo vị trí chuột
            document.querySelector('.zoom-container').addEventListener("mousemove", function(e) {
                const rect = mainImage.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;

                mainImage.style.transformOrigin = `${x}% ${y}%`;
                mainImage.style.transform = "scale(1.5)";
            });

            // Reset khi rời chuột
            document.querySelector('.zoom-container').addEventListener("mouseleave", function() {
                mainImage.style.transform = "scale(1)";
            });

            // Khởi tạo slider thumbnail
            $('.left-slider-image').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
                centerMode: false,
                variableWidth: false,
                adaptiveHeight: false
            });
        });
    </script>







    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        function themDanhGia() {
            let sanPhamId = document.getElementById("san_pham_id").value;
            let soSao = document.getElementById("so_sao").value;
            let nhanXet = document.getElementById("nhan_xet").value;

            fetch(`/san-pham/${sanPhamId}/danh-gia`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        so_sao: soSao,
                        nhan_xet: nhanXet
                    })
                })
                .then(response => response.json())
                .then(() => {
                    // Đóng modal sau khi gửi đánh giá thành công
                    var myModal = new bootstrap.Modal(document.getElementById('writereview'));
                    myModal.hide();

                    // Tải lại danh sách đánh giá
                    loadDanhGias();
                });
        }

        function loadDanhGias() {
            let sanPhamId = document.getElementById("san_pham_id").value;

            fetch(`/san-pham/${sanPhamId}/danh-gia`)
                .then(response => response.json())
                .then(data => {
                    let danhGiaHtml = "";
                    data.forEach(danhGia => {
                        danhGiaHtml +=
                            `<p><strong>${danhGia.nguoi_dung.ten_nguoi_dung}</strong> (${danhGia.so_sao}⭐): ${danhGia.nhan_xet}</p>`;
                    });
                    document.getElementById("danhGias").innerHTML = danhGiaHtml;
                });
        }

        // Gọi load danh sách đánh giá khi trang được load
        document.addEventListener("DOMContentLoaded", loadDanhGias);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll("#ratingStars i");
            const soSaoInput = document.getElementById("so_sao");

            stars.forEach(star => {
                star.addEventListener("click", function() {
                    let rating = this.getAttribute("data-value");
                    soSaoInput.value = rating;

                    stars.forEach(s => {
                        if (s.getAttribute("data-value") <= rating) {
                            s.classList.add("selected");
                        } else {
                            s.classList.remove("selected");
                        }
                    });
                });
            });
        });
    </script>
    @if (session('error_binhluan'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Lỗi!",
                    text: "{{ session('error_binhluan') }}",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Thành công!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif
@endsection
