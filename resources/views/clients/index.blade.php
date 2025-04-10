@extends('layouts.client')

@section('title')
    Seven Stars
@endsection

@section('css')
    <style>
        .product-box-slider .slick-track {
            display: flex;
            width: 100% !important;
        }

        .product-box-slider .slick-slide {
            flex: 1;
            min-width: 250px;
            /* Đặt theo kích thước mong muốn */
        }

        .product-border {
            border: none !important;
            border-radius: 10px;
            padding: 0 14px;
        }
    </style>
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <!-- Home Section Start -->
    <section class="home-section pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-8 ratio_65">
                    <div class="home-contain h-100">
                        <div class="h-100">
                            <img src="{{ asset('assets/client/images/banner/1.png') }}" class="bg-img blur-up lazyload"
                                alt="">
                        </div>
                        <div class="home-detail p-center-left w-75">
                            <div>
                                <h6>Ưu đãi đặc biệt</h6>
                                <h1 class="text-uppercase">Ở nhà & nhận ngay <span class="daily">Trang phục <br> thể
                                        thao</span>
                                </h1>
                                <p class="w-75 d-none d-sm-block">Những bộ quần áo thể thao thoải mái, phong cách giúp bạn
                                    tự tin vận động mỗi ngày.</p>
                                <button onclick="location.href = '/sanpham/?danh_muc_id=3';"
                                    class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">Mua ngay <i
                                        class="fa-solid fa-right-long icon"></i></button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 ratio_65">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="{{ asset('assets/client/images/banner/2.png') }}" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        <h3 class="theme-color">Bộ Sưu Tập Áo Hoodio</h3>
                                        <p class="w-75">Chúng tôi mang đến những bộ trang phục thể thao chất lượng, thoải
                                            mái và phong cách.</p>
                                        <a href='/sanpham/?danh_muc_id=1' class="shop-button">Mua ngay <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="{{ asset('assets/client/images/banner/3.png') }}" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        <h3 class="mt-0 theme-color fw-bold">Bộ Đồ Thời Trang</h3>
                                        <h4 class="text-danger">Bộ Sưu Tập Mới</h4>
                                        <p class="organic">Bắt đầu ngày mới với những bộ trang phục
                                            thoải mái.</p>
                                        <a href='/sanpham/?danh_muc_id=2' class="shop-button">Mua ngay <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3 mt-4">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">


                        <div class="ratio_156 section-t-space">
                            <div class="home-contain hover-effect">
                                <img src="{{ asset('assets/client/images/banner/4.png') }}" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">Áo khoác gió</h6>
                                        <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">Sản
                                                Phẩm</span> Mới Nhất</h3>
                                        <h3 class="fw-light">Cập Nhật Liên Tục</h3>
                                        {{-- <button onclick="location.href = '/clientsanpham';"
                                            class="btn btn-animation btn-md mend-auto">Mua Ngay <i
                                                class="fa-solid fa-arrow-right icon"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ratio_medium section-t-space">
                            <div class="home-contain hover-effect">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h4 class="text-yellow text-exo home-banner">Thể Thao</h4>
                                        <h2 class="text-uppercase fw-normal mb-0 text-russo theme-color">Thời Trang</h2>
                                        <h2 class="text-uppercase fw-normal text-title">Năng Động</h2>
                                        <p class="mb-3">Ưu Đãi Lên Đến 50%</p>
                                        <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn btn-animation btn-md mend-auto">Mua Ngay <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="section-t-space">
                            <div class="category-menu">
                                <h3>Khách Hàng Đánh Giá</h3>

                                <div class="review-box">
                                    <div class="review-contain">
                                        <h5 class="w-75">Chúng Tôi Luôn Quan Tâm Đến Trải Nghiệm Của Bạn</h5>
                                        <p>"{{ $bestComment['nhan_xet'] }}"</p>
                                    </div>

                                    <div class="review-profile">
                                        <div class="review-image">
                                            <img src="{{ Storage::url($bestUser['anh_dai_dien'] ?? 'images/default.png') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div class="review-detail">
                                            <h5>{{ $bestUser['ten_nguoi_dung'] }}</h5>
                                            <h6>Khách Hàng Thân Thiết</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8">
                    <div class="title title-flex">
                        <div>
                            <h2>Sản phẩm được nhiều người đánh giá cao</h2>
                            <span class="title-leaf">
                            </span>
                            <p>Đừng bỏ lỡ cơ hội này với mức giá đặc biệt.</p>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="product-border border-row overflow-hidden">
                            <div class="product-box-slider no-arrow">
                                <div>

                                    <div style="border-bottom: 1px solid #ccc; width: 889px" class="row">
                                        @foreach ($sanPhamFollowComments as $item)
                                            @php
                                                $giaThapNhat = collect($item['bien_thes'])->min('gia_ban') ?? 0;
                                            @endphp
                                            <div style=" border: 1px solid #ccc;width: 222px" class="col-md-3 px-0">
                                                <div style="height: 327px" class="product-box">
                                                    <div style="position: relative; width: 100%">
                                                        @if ($item['gia_cu'] > $giaThapNhat)
                                                            <span style="position: absolute; top: 0; right: 0;"
                                                                class="badge bg-danger">-{{ round((($item['gia_cu'] - $giaThapNhat) / $item['gia_cu']) * 100) }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-image">
                                                        <a href="{{ route('sanphams.chitiet', $item['id']) }}">

                                                            <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <ul style="width: 50%;flex-direction: column;"
                                                            class="product-option">

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <center>
                                                                    <a href="#" class="notifi-wishlist">
                                                                        <i data-feather="heart"></i>
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('add.wishlist', $item['id']) }}"
                                                                        method="POST" class="wishlist-form">
                                                                        @csrf
                                                                    </form>
                                                                </center>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-detail">
                                                        <a href="{{ route('sanphams.chitiet', $item['id']) }}">
                                                            <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                        </a>

                                                        <h5 class="sold text-content">
                                                            <span
                                                                class="theme-color price">{{ number_format($giaThapNhat, 0, '', '.') }}
                                                                đ</span>
                                                            <del>{{ number_format($item['gia_cu'], 0, '', '.') }} đ</del>
                                                        </h5>

                                                        <div class="product-rating mt-sm-2 mt-1">
                                                            <ul class="rating">
                                                                <li>
                                                                    <i data-feather="star"
                                                                        class="{{ $item['danh_gias_avg_so_sao'] >= 1 ? 'fill' : '' }}"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"
                                                                        class="{{ $item['danh_gias_avg_so_sao'] >= 2 ? 'fill' : '' }}"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"
                                                                        class="{{ $item['danh_gias_avg_so_sao'] >= 3 ? 'fill' : '' }}"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"
                                                                        class="{{ $item['danh_gias_avg_so_sao'] >= 4 ? 'fill' : '' }}"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"
                                                                        class="{{ $item['danh_gias_avg_so_sao'] >= 5 ? 'fill' : '' }}"></i>
                                                                </li>
                                                            </ul>

                                                            <h6 class="theme-color">
                                                                {{ $item['trang_thai'] == 1 ? 'Còn hàng' : 'Hết hàng' }}
                                                            </h6>
                                                        </div>


                                                        <div class="add-to-cart-box bg-white">
                                                            <button class="btn btn-add-cart addcart-button">
                                                                @if ($item['trang_thai'] == 1)
                                                                    <a class="btn-quick-view" style="margin-right: 10px;"
                                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#view"
                                                                        data-id="{{ $item['id'] }}">
                                                                        <span class="add-icon bg-light-gray">
                                                                            <i class="fa-solid fa-cart-plus"></i>
                                                                        </span> Thêm vào giỏ hàng
                                                                    </a>
                                                                @endif
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="title">
                        <h2>Danh Mục Nổi Bật</h2>
                        <span class="title-leaf">
                        </span>
                        <p>Danh mục hàng đầu</p>
                    </div>

                    <div class="category-slider-2 product-wrapper no-arrow">
                        @foreach ($danhMucAll as $item)
                            <div>
                                <a href="{{ '/sanpham/?danh_muc_id=' . $item->id }}" class="category-box category-dark">
                                    <div>
                                        <img src="{{ Storage::url($item->anh_danh_muc) }}" class="blur-up lazyload"
                                            alt="">
                                        <h5>{{ $item->ten_danh_muc }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <div class="title d-block">
                        <div>
                            <h2>Sản phẩm bán chạy</h2>
                            <span class="title-leaf">
                            </span>
                            <p>Những sản phẩm được mua nhiều nhất của chúng tôi</p>
                        </div>
                    </div>

                    <div class="best-selling-slider product-wrapper wow fadeInUp">
                        <div>
                            <ul class="product-list">
                                @foreach ($part1 as $item)
                                    @php
                                        $giaThapNhat = collect($item['bien_thes'])->min('gia_ban') ?? 0;
                                    @endphp
                                    <li>
                                        <div class="offer-product">
                                            <div>
                                                <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                    class="offer-image">

                                                    <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                        class="blur-up lazyload" alt="">
                                                </a>
                                                <div style="position: relative; width: 100%">
                                                    @if ($item['gia_cu'] > $giaThapNhat)
                                                        <span style="position: absolute; top: 0; right: 0;"
                                                            class="badge bg-danger">-{{ round((($item['gia_cu'] - $giaThapNhat) / $item['gia_cu']) * 100) }}%</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                        class="text-title">
                                                        <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                    </a>
                                                    <del>{{ number_format($item['gia_cu'], 0, '', '.') }} đ</del>
                                                    <h6 class="price theme-color">
                                                        {{ number_format($giaThapNhat, 0, '', '.') }} đ</h6>
                                                </div>
                                            </div>
                                        </div>


                                        @if ($item['trang_thai'] == 1)
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">
                                                    @if ($item['trang_thai'] == 1)
                                                        <a class="btn-quick-view" style="margin-right: 40px;"
                                                            href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view" data-id="{{ $item['id'] }}">
                                                            <span class="add-icon bg-light-gray">
                                                                <i class="fa-solid fa-cart-plus"></i>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </button>
                                            </div>
                                        @else
                                            <span style="color: #0da487" class="bg-light-gray">Hết hàng</span>
                                        @endif
                                        <div>
                                            <center>
                                                <a href="#" class="notifi-wishlist">
                                                    <i style="width: 14px; height: 14px;margin-top: 8px"
                                                        data-feather="heart"></i>
                                                </a>
                                                <form action="{{ route('add.wishlist', $item['id']) }}" method="POST"
                                                    class="wishlist-form">
                                                    @csrf
                                                </form>
                                            </center>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">
                                @foreach ($part2 as $item)
                                    @php
                                        $giaThapNhat = collect($item['bien_thes'])->min('gia_ban') ?? 0;
                                    @endphp
                                    <li>
                                        <div class="offer-product">
                                            <div>
                                                <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                    class="offer-image">

                                                    <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                        class="blur-up lazyload" alt="">
                                                </a>
                                                <div style="position: relative; width: 100%">
                                                    @if ($item['gia_cu'] > $giaThapNhat)
                                                        <span style="position: absolute; top: 0; right: 0;"
                                                            class="badge bg-danger">-{{ round((($item['gia_cu'] - $giaThapNhat) / $item['gia_cu']) * 100) }}%</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                        class="text-title">
                                                        <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                    </a>
                                                    <del>{{ number_format($item['gia_cu'], 0, '', '.') }} đ</del>
                                                    <h6 class="price theme-color">
                                                        {{ number_format($giaThapNhat, 0, '', '.') }} đ</h6>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($item['trang_thai'] == 1)
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">
                                                    @if ($item['trang_thai'] == 1)
                                                        <a class="btn-quick-view" style="margin-right: 40px;"
                                                            href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view" data-id="{{ $item['id'] }}">
                                                            <span class="add-icon bg-light-gray">
                                                                <i class="fa-solid fa-cart-plus"></i>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </button>
                                            </div>
                                        @else
                                            <span style="color: #0da487" class="bg-light-gray">Hết hàng</span>
                                        @endif
                                        <div>
                                            <center>

                                                <a href="#" class="notifi-wishlist">
                                                    <i style="width: 14px; height: 14px;margin-top: 8px"
                                                        data-feather="heart"></i>
                                                </a>
                                                <form action="{{ route('add.wishlist', $item['id']) }}" method="POST"
                                                    class="wishlist-form">
                                                    @csrf
                                                </form>
                                            </center>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">
                                @foreach ($part3 as $item)
                                    @php
                                        $giaThapNhat = collect($item['bien_thes'])->min('gia_ban') ?? 0;
                                    @endphp
                                    <li>
                                        <div class="offer-product">

                                            <div>
                                                <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                    class="offer-image">

                                                    <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                        class="blur-up lazyload" alt="">
                                                </a>
                                                <div style="position: relative; width: 100%">
                                                    @if ($item['gia_cu'] > $giaThapNhat)
                                                        <span style="position: absolute; top: 0; right: 0;"
                                                            class="badge bg-danger">-{{ round((($item['gia_cu'] - $giaThapNhat) / $item['gia_cu']) * 100) }}%</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ route('sanphams.chitiet', $item['id']) }}"
                                                        class="text-title">
                                                        <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                    </a>
                                                    <del>{{ number_format($item['gia_cu'], 0, '', '.') }} đ</del>
                                                    <h6 class="price theme-color">
                                                        {{ number_format($giaThapNhat, 0, '', '.') }} đ</h6>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($item['trang_thai'] == 1)
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">
                                                    @if ($item['trang_thai'] == 1)
                                                        <a class="btn-quick-view" style="margin-right: 40px;"
                                                            href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view" data-id="{{ $item['id'] }}">
                                                            <span class="add-icon bg-light-gray">
                                                                <i class="fa-solid fa-cart-plus"></i>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </button>
                                            </div>
                                        @else
                                            <span style="color: #0da487" class="bg-light-gray">Hết hàng</span>
                                        @endif
                                        <div>
                                            <center>
                                                <a href="#" class="notifi-wishlist">
                                                    <i style="width: 14px; height: 14px;margin-top: 8px"
                                                        data-feather="heart"></i>
                                                </a>
                                                <form action="{{ route('add.wishlist', $item['id']) }}" method="POST"
                                                    class="wishlist-form">
                                                    @csrf
                                                </form>
                                            </center>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="title section-t-space">
                        <h2>Bài viết</h2>
                        <span class="title-leaf">
                        </span>
                        <p>Bài viết mới nhất</p>
                    </div>

                    <div class="slider-3-blog ratio_65 no-arrow product-wrapper">
                        @foreach ($baiViets as $item)
                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="{{ route('baiviets.chitiet', $item['id']) }}" class="blog-image">
                                            <img style="
                                            object-fit: contain;"
                                                src="{{ Storage::url($item['anh_bia']) }}"
                                                class="bg-img blur-up lazyload" alt="">
                                        </a>
                                    </div>

                                    <a href="{{ route('baiviets.chitiet', $item['id']) }}" class="blog-detail">
                                        {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
                                        <h5>{{ $item['tieu_de'] }}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
