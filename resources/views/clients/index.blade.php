@extends('layouts.client')

@section('title')
    Seven Stars
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
        .swiper-button-next{
            color: #0da487;
        }
        .swiper-button-prev{
            color: #0da487;
        }
        .swiper-pagination-bullet-active {
            background-color: #0da487; /* màu đỏ */
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

                    <div class="swiper home-slider">
                        <div class="swiper-wrapper">

                            @if(!empty($mainBanner))
                            @foreach ($mainBanner->bannerImgs as $banner)
                                    @php
                                        $url = null;
                                        if ($banner->link_type == 'danhmuc') {
                                            $url = '/sanpham/?danh_muc_id=' . $banner->link_url;
                                        } elseif ($banner->link_type == 'sanpham') {
                                            $url = '/sanpham/' . $banner->link_url;
                                        } else {
                                            $url = $banner->link_url;
                                        }
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="home-contain h-100">
                                            <a href="{{ $url }}">
                                            <div class="h-100">
                                                <img src="{{ Storage::url($banner->image_url) }}"
                                                    class="bg-img blur-up lazyload" alt="">
                                            </div>
                                            <div class="home-detail p-center-left w-75">
                                                <div>
                                                    <h6>{{ $banner->title }}</h6>
                                                    <strong><h1 class="text-uppercase">{{ $banner->content }}</h1></strong>
                                                    <p class="w-75 d-none d-sm-block">{{ $banner->descript }}</p>
                                                    @if ($banner->status_button == 1)
                                                        <button onclick="location.href = '{{ $url }}';"
                                                        class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">
                                                        {{ $banner->content_button != '' ? $banner->content_button : 'Mua ngay' }} <i class="fa-solid fa-right-long icon"></i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Nút điều hướng -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                        <!-- Dấu chấm slide -->
                        <div class="swiper-pagination"></div>
                    </div>

                </div>


                <div class="col-xl-4 ratio_65">
                    <div class="row g-4">
                        @if (isset($banner1))
                            @php
                                $url1 = null;
                                if ($banner1[0]->link_type == 'danhmuc') {
                                    $url1 = '/sanpham/?danh_muc_id=' . $banner1[0]->link_url;
                                } elseif ($banner1[0]->link_type == 'sanpham') {
                                    $url1 = '/sanpham/' . $banner1[0]->link_url;
                                } else {
                                    $url1 = $banner1[0]->link_url;
                                }
                            @endphp
                            <div class="col-xl-12 col-md-6">
                                <a href="{{ $url1 }}">
                                    <div class="home-contain">
                                        <img src="{{ Storage::url($banner1[0]->image_url) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                        <div class="home-detail p-center-left home-p-sm w-75">
                                            <div>
                                                <h3 class="theme-color">{{ $banner1[0]->title }}</h3>
                                                <h4 class="text-danger">{{ $banner1[0]->content }}</h4>
                                                <p class="w-75">{{ $banner1[0]->descript }}</p>
                                                @if ($banner1[0]->status_button === 1)
                                                    <a href='{{ $url1 }}'
                                                        class="shop-button">{{ $banner1[0]->content_button != '' ? $banner1[0]->content_button : 'Mua ngay' }}
                                                        <i class="fa-solid fa-right-long"></i></a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if (isset($banner2))
                            @php
                                $url2 = null;
                                if ($banner2[0]->link_type == 'danhmuc') {
                                    $url2 = '/sanpham/?danh_muc_id=' . $banner2[0]->link_url;
                                } elseif ($banner2[0]->link_type == 'sanpham') {
                                    $url2 = '/sanpham/' . $banner2[0]->link_url;
                                } else {
                                    $url2 = $banner2[0]->link_url;
                                }
                            @endphp
                            <div class="col-xl-12 col-md-6">
                                <a href="{{ $url2 }}">
                                    <div class="home-contain">
                                        <img src="{{ Storage::url($banner2[0]->image_url) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                        <div class="home-detail p-center-left home-p-sm w-75">
                                            <div>
                                                <h3 class="theme-color">{{ $banner2[0]->title }}</h3>
                                                <h4 class="text-danger">{{ $banner2[0]->content }}</h4>
                                                <p class="w-75">{{ $banner2[0]->descript }}</p>
                                                @if ($banner2[0]->status_button === 1)
                                                    <a href='{{ $url2 }}'
                                                        class="shop-button">{{ $banner2[0]->content_button != '' ? $banner2[0]->content_button : 'Mua ngay' }}
                                                        <i class="fa-solid fa-right-long"></i></a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif


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
                            @if (!empty($sideBarBanner) && isset($sideBarBanner[0]))
                                @php
                                    $url3 = null;
                                    if ($sideBarBanner[0]->bannerImgs[0]->link_type == 'danhmuc') {
                                        $url3 = '/sanpham/?danh_muc_id=' . $sideBarBanner[0]->bannerImgs[0]->link_url;
                                    } elseif ($sideBarBanner[0]->bannerImgs[0]->link_type == 'sanpham') {
                                        $url3 = '/sanpham/' . $sideBarBanner[0]->bannerImgs[0]->link_url;
                                    } else {
                                        $url3 = $sideBarBanner[0]->bannerImgs[0]->link_url;
                                    }
                                @endphp
                                <div class="home-contain hover-effect">
                                    <a href="{{ $url3 }}">
                                    <img src="{{ Storage::url($sideBarBanner[0]->bannerImgs[0]->image_url) }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h6 class="text-yellow home-banner">{{ $sideBarBanner[0]->bannerImgs[0]->title }}</h6>
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">{{ $sideBarBanner[0]->bannerImgs[0]->content }}</h3>
                                            <h3 class="fw-light">{{ $sideBarBanner[0]->bannerImgs[0]->descript }}</h3>
                                            @if ($sideBarBanner[0]->bannerImgs[0]->status_button == 1)
                                                <button onclick="location.href = '{{ $url3 }}';"
                                                    class="btn btn-animation btn-md mend-auto">{{ $sideBarBanner[0]->bannerImgs[0]->content_button != '' ? $sideBarBanner[0]->content_button : 'Mua ngay' }}
                                                    <i class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            @endif
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
                                <h3>{{ __('client/trang_chu.clientJudge') }}</h3>

                                <div class="review-box">
                                    <div class="review-contain">
                                        <h5 class="w-75">{{ __('client/trang_chu.clientJudge.content') }}</h5>
                                        <p>"{{ $bestComment['nhan_xet'] }}"</p>
                                    </div>

                                    <div class="review-profile">
                                        <div class="review-image">
                                            <img src="{{ Storage::url($bestUser['anh_dai_dien'] ?? 'images/default.png') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div class="review-detail">
                                            <h5>{{ $bestUser['ten_nguoi_dung'] }}</h5>
                                            <h6>{{ __('client/trang_chu.loyalCustomer') }}</h6>
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
                            <h2>{{ __('client/trang_chu.topProduct.byUser') }}</h2>
                            <span class="title-leaf">
                            </span>
                            <p>{{ __('client/trang_chu.topProduct.byUser.content') }}</p>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="product-border border-row overflow-hidden">
                            <div class="product-box-slider no-arrow">
                                <div>
                                    <div class="row">
                                        @foreach ($sanPhamFollowComments as $item)
                                            @php
                                                $giaThapNhat = collect($item['bien_thes'])->min('gia_ban') ?? 0;
                                            @endphp
                                            <div class="col-md-3 p-1">
                                                <div style="border: 1px solid #ccc" class="product-box">
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
                                                                <a class="btn-quick-view @if ($item['trang_thai'] == 0) invisible @endif"
                                                                    style="margin-right: 10px;" href="javascript:void(0)"
                                                                    data-bs-toggle="modal" data-bs-target="#view"
                                                                    data-id="{{ $item['id'] }}">
                                                                    <span class="add-icon bg-light-gray">
                                                                        <i class="fa-solid fa-cart-plus"></i>
                                                                    </span> Thêm vào giỏ hàng
                                                                </a>
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
                        <h2>{{ __('client/trang_chu.topCategories') }}</h2>
                        <span class="title-leaf">
                        </span>
                        <p>{{ __('client/trang_chu.topCategories.descript') }}</p>
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
                            <h2>{{ __('client/trang_chu.topProduct.mostSell') }}</h2>
                            <span class="title-leaf">
                            </span>
                            <p>{{ __('client/trang_chu.topProduct.mostSell.descript') }}</p>
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
                        <h2>{{ __('client/trang_chu.article') }}</h2>
                        <span class="title-leaf">
                        </span>
                        <p>{{ __('client/trang_chu.article.descript') }}</p>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.home-slider', {
            loop: true,
            autoplay: {
                delay: 4000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
@endsection
