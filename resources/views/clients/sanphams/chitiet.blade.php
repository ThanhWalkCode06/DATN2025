@extends('layouts.client')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
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

        /* .option-box:hover,
                .option input:checked+.option-box {
                } */

        input[type="radio"].variant-color-selector {
            opacity: 0;
            position: absolute;
            width: 1px;
            height: 1px;
        }

        .color-option {
            display: inline-block;
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ddd;
        }

        .color-option img {
            width: 50px;
            height: 50px;
            border: 2px solid transparent;
        }

        .color-option input:checked+img {
            border-color: #1abc9c;
        }

        .color-option.selected img {
            border: 2px solid #1abc9c !important;
            box-shadow: 0px 0px 5px #1abc9c;
        }

        .product-box-3 {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Căn chỉnh phần đánh giá */
        .product-rating {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        /* Tạo khoảng cách giữa sao và số đánh giá */
        .product-rating ul.rating {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .product-rating ul.rating li {
            margin-right: 3px;
        }

        /* Chỉnh icon sao */
        .product-rating ul.rating i {
            color: #ffcc00;
            /* Màu vàng cho sao */
            font-size: 14px;
        }

        /* Chỉnh số điểm trung bình */
        .product-rating span {
            font-size: 14px;
            color: #666;
        }

        /* Đảm bảo chữ không bị tràn */
        .product-detail h5.name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }


        .swiper-container {
            width: 100%;
            overflow: hidden;
            padding: 10px;
            position: relative;
            /* Quan trọng để các nút điều hướng đúng vị trí */
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

        #product-price {
            color: #e74c3c;
        }

        #default-old-price {
            color: #7f8c8d;
            text-decoration: line-through;
        }

        .offer-top {
            font-size: 16px;
            font-weight: bold;
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
                                <div class="row g-sm-4 g-2">
                                    <div class="col-12">
                                        <div class="product-main no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <!-- Hiển thị hình ảnh chính của sản phẩm -->
                                                    <img src="{{ asset('storage/' . $sanPhams->hinh_anh) }}" id="img-1"
                                                        data-zoom-image="{{ asset('storage/' . $sanPhams->hinh_anh) }}"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                </div>
                                            </div>

                                            <!-- Hiển thị các hình ảnh phụ -->
                                            @foreach ($anhSPs as $anhSP)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('storage/' . $anhSP->link_anh_san_pham) }}"
                                                            data-zoom-image="{{ asset('storage/' . $anhSP->link_anh_san_pham) }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="left-slider-image left-slider no-arrow slick-top">
                                            <!-- Hiển thị hình ảnh chính của sản phẩm trong sidebar -->
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ asset('storage/' . $sanPhams->hinh_anh) }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>

                                            <!-- Hiển thị các hình ảnh phụ trong sidebar -->
                                            @foreach ($anhSPs as $anhSP)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ asset('storage/' . $anhSP->link_anh_san_pham) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
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
                                <h6 class="offer-top">({{ $phanTramGiamGia }}% off)</h6> <!-- Giữ mặc định -->
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <strong class="price-label"></strong>
                                    <span id="product-price" class="theme-color price"
                                        style="font-size: 20px; font-weight: bold;">0₫</span>

                                    <span id="default-price" class="theme-color price"
                                        style="font-size: 20px; font-weight: bold;">
                                        {{ number_format($sanPhams->gia_moi, 0, ',', '.') }}₫
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
                                                    style="cursor: pointer; width: 60px; height: 60px; position: relative; border: 3px solid transparent;"
                                                    data-color-name="{{ $mau['gia_tri'] }}">
                                                    <input type="radio" name="color"
                                                        class="d-none variant-color-selector" value="{{ $index }}"
                                                        data-mau="{{ $mau['gia_tri'] }}"
                                                        data-bienthes='@json($mau['bien_thes'])'
                                                        {{ $index === 0 ? 'checked' : '' }}>
                                                    <img src="{{ $mau['anh'] }}" alt="{{ $mau['gia_tri'] }}"
                                                        class="color-img rounded-circle"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
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
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
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
                                                                    <h4 class="fw-bold">Đánh giá sản phẩm này</h4>
                                                                    <p>Hãy cho chúng tôi biết đánh giá của bạn</p>
                                                                    <button class="btn" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#writereview">Viết đánh
                                                                        giá</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-7">
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                            @if ($sanPhams->danhGias->count() > 0)
                                                                @foreach ($sanPhams->danhGias->sortByDesc('created_at') as $danhGia)
                                                                    <li>
                                                                        <div class="people-box">
                                                                            <div>
                                                                                <div class="people-image people-text">
                                                                                    <img alt="user" class="img-fluid"
                                                                                        src="{{ $danhGia->nguoiDung->anh_dai_dien ?? asset('default-avatar.jpg') }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="people-comment">
                                                                                <div class="people-name">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="name">{{ $danhGia->nguoiDung->ten_nguoi_dung }}</a>
                                                                                    <div class="date-time">
                                                                                        <h6 class="text-content">
                                                                                            {{ \Carbon\Carbon::parse($danhGia->created_at)->format('d/m/Y H:i') }}
                                                                                        </h6>
                                                                                        <div class="product-rating">
                                                                                            <ul class="rating">
                                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                                    <li>
                                                                                                        <i data-feather="star"
                                                                                                            class="{{ $i <= $danhGia->so_sao ? 'fill' : '' }}"></i>
                                                                                                    </li>
                                                                                                @endfor
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="reply">
                                                                                    <p>{{ $danhGia->nhan_xet }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <p style="color: red">Chưa có đánh giá nào.</p>
                                                            @endif




                                                        </ul>
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
                    <svg class="icon-width">
                        <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                    </svg>
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
                                        @if ($item->gia_cu > $item->gia_moi)
                                            <span class="badge bg-danger">
                                                -{{ round((($item->gia_cu - $item->gia_moi) / $item->gia_cu) * 100) }}%
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
                                            <span class="span-name">
                                                {{ $item->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}
                                            </span>

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
                                                <span class="text-muted">
                                                    ({{ $item->soLuongDanhGia() }} đánh giá)
                                                </span>
                                            </div>

                                            <h5 class="price">
                                                <span class="theme-color">
                                                    {{ number_format($item->gia_moi, 0, ',', '.') }} ₫
                                                </span>
                                                <del>{{ number_format($item->gia_cu, 0, ',', '.') }} ₫</del>
                                            </h5>

                                            <!-- Nút thêm vào giỏ hàng -->
                                            <div class="add-to-cart-box bg-white">

                                                {{-- <button class="btn btn-add-cart addcart-button">
                                                    @if ($sanPhams['trang_thai'] == 1)
                                                        <a class="btn-quick-view" style="margin-right: 10px;"
                                                            href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view" data-id="{{ $sanPhams['id'] }}">
                                                            <span class="add-icon bg-light-gray">
                                                                <i class="fa-solid fa-cart-plus"></i>
                                                            </span> Thêm vào giỏ hàng
                                                        </a>
                                                    @endif
                                                </button> --}}
                                            </div>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Viết đánh giá</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form class="product-review-form">
                        <div class="product-wrapper">
                            <div class="product-image">
                                <img src="{{ Storage::url($sanPhams->hinh_anh) }}" class="img-fluid rounded shadow-sm"
                                    alt="{{ $sanPhams->ten_san_pham }}">
                            </div>
                            <div class="product-content">
                                <h5 class="name">{{ $sanPhams->ten_san_pham }}</h5>
                                <div class="product-review-rating">
                                    <div class="product-rating">
                                        {{-- <h6 class="price-number">{{ number_format($sanPhams->gia_moi, 0, ',', '.') }} đ --}}
                                        <span class="theme-color">{{ number_format($sanPhams->gia_moi, 0, ',', '.') }}
                                            ₫</span>
                                        <del>{{ number_format($sanPhams->gia_cu, 0, ',', '.') }} ₫</del>

                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="review-box">
                            <div class="product-review-rating">
                                <label></label>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review-box">
                            <label for="content" class="form-label">Câu trả lời của bạn *</label>
                            <textarea id="content" rows="3" class="form-control" placeholder="Câu trả lời của bạn"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                        data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-md fw-bold text-light theme-bg-color">Gửi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal End -->
@endsection

@section('js')
    {{-- <script>
        $(document).ready(function() {
            // Khởi tạo tính năng zoom cho ảnh chính  
            const mainImage = $('#img-1');
            if (mainImage.length) êm
            mainImage.elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                scrollZoom: true,
                responsive: true,
                zoomWindowWidth: 400,
                zoomWindowHeight: 400,
            });
        }

        // Khởi tạo tính năng zoom cho các ảnh phụ khi di chuyển chuột  
        $('.slider-image img').not('#img-1').each(function() {
            $(this).hover(function() {
                $(this).elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    scrollZoom: true,
                    responsive: true,
                    zoomWindowWidth: 400,
                    zoomWindowHeight: 400,
                });
            }, function() {
                // Khi chuột rời đi, hủy zoom để giải phóng bộ nhớ  
                $.fn.elevateZoom.destroy();
            });
        }); $(document).on('mousewheel DOMMouseScroll', function(e) {
            var zoomWindow = $('.zoomWindow');
            if (zoomWindow.is(':visible')) {
                e.preventDefault(); // Ngăn chặn sự kiện mặc định  
                var delta = (e.originalEvent.wheelDelta || -e.originalEvent.detail);
                window.scrollBy(0, delta > 0 ? -30 : 30); // Cuộn lên hoặc cuộn xuống  
            }
        });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let colorOptions = document.querySelectorAll(".color-option");
            let sizeContainer = document.querySelector("#size-options");
            let priceDisplay = document.querySelector("#product-price");
            let quantityDisplay = document.querySelector("#product-quantity");
            let priceLabel = document.querySelector(".price-label");
            let defaultPrice = document.querySelector("#default-price");
            let defaultOldPrice = document.querySelector("#default-old-price");
            let selectedColorText = document.querySelector("#selected-color");
            let productImage = document.querySelector("#product-image");
            let discountLabel = document.querySelector(".offer-top");

            function formatCurrency(value) {
                return new Intl.NumberFormat("vi-VN").format(value) + "₫";
            }

            function updatePriceAndQuantity() {
                let selectedSize = document.querySelector(".variant-size-selector:checked");
                if (selectedSize) {
                    let sizePrice = parseFloat(selectedSize.getAttribute("data-price"));
                    let oldPrice = parseFloat(defaultOldPrice.innerText.replace("₫", "").replace(/\./g, ""));

                    priceDisplay.textContent = formatCurrency(sizePrice);
                    quantityDisplay.textContent = selectedSize.getAttribute("data-quantity");

                    defaultPrice.style.display = "none";
                    priceLabel.style.display = "inline";
                    priceDisplay.style.display = "inline";

                    if (oldPrice > 0 && sizePrice < oldPrice) {
                        let discountPercent = Math.round(100 - (sizePrice / oldPrice) * 100);
                        discountLabel.textContent = `(${discountPercent}% off)`;
                        discountLabel.style.visibility = "visible";
                    } else {
                        discountLabel.style.visibility = "hidden";
                    }
                }
            }

            function updateSizes(bienThes) {
                sizeContainer.innerHTML = "";

                if (bienThes.length === 0) {
                    sizeContainer.innerHTML = "<p>Không có size phù hợp.</p>";
                    priceDisplay.innerText = formatCurrency(0);
                    quantityDisplay.innerText = "0";
                    return;
                }

                let sizeOrder = ["S", "M", "L", "XL", "XXL"];
                bienThes.sort((a, b) => sizeOrder.indexOf(a.gia_tri) - sizeOrder.indexOf(b.gia_tri));

                let firstSizeInput = null;

                bienThes.forEach((size, index) => {
                    let label = document.createElement("label");
                    label.classList.add("option", "size-option");
                    label.style.cursor = "pointer";
                    label.innerHTML = `
                        <input type="radio" name="size" class="d-none variant-size-selector"
                            value="${size.id}" data-price="${size.gia_ban}" data-quantity="${size.so_luong}">
                        <span class="option-box">${size.gia_tri}</span>
                    `;
                    sizeContainer.appendChild(label);

                    if (index === 0) {
                        firstSizeInput = label.querySelector("input");
                    }
                });

                attachSizeEvents();

                if (firstSizeInput) {
                    firstSizeInput.checked = true;
                    firstSizeInput.dispatchEvent(new Event("change"));
                }
            }

            function attachSizeEvents() {
                let sizeInputs = document.querySelectorAll(".variant-size-selector");
                sizeInputs.forEach(input => {
                    input.addEventListener("change", function() {
                        document.querySelectorAll(".size-option").forEach(label => {
                            label.classList.remove("selected");
                        });

                        this.closest("label").classList.add("selected");
                        updatePriceAndQuantity();

                        let addToCartBtn = document.querySelector(".btn-add-cart");
                        addToCartBtn.setAttribute("data-id", this.value);
                    });
                });
            }

            colorOptions.forEach(option => {
                option.addEventListener("click", function() {
                    colorOptions.forEach(opt => opt.classList.remove("selected"));
                    this.classList.add("selected");

                    let colorName = this.getAttribute("data-color-name") || "Không xác định";
                    selectedColorText.innerText = colorName;

                    let bienThes = JSON.parse(this.querySelector("input[type='radio']")
                        .getAttribute("data-bienthes"));
                    let imageUrl = this.getAttribute("data-image");
                    if (imageUrl) {
                        productImage.src = imageUrl;
                    }
                    updateSizes(bienThes);
                });
            });

            priceLabel.style.display = "none";
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
                    } else {
                        Swal.fire("Lỗi", response.message, "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Lỗi", "Có lỗi xảy ra khi thêm vào giỏ hàng!", "error");
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 6, // Hiển thị 6 sản phẩm cùng lúc
                spaceBetween: 10, // Khoảng cách giữa các sản phẩm
                loop: true, // Cho phép lặp vô hạn
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1200: {
                        slidesPerView: 6
                    }, // Màn hình lớn
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
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection
