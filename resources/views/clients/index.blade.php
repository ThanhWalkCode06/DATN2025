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
    min-width: 250px; /* Đặt theo kích thước mong muốn */
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
                                <button onclick="location.href = 'shop-left-sidebar.html';"
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
                                        <a href="shop-left-sidebar.html" class="shop-button">Mua ngay <i
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
                                        <a href="shop-left-sidebar.html" class="shop-button">Mua ngay <i
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
    <!-- Home Section End -->

    <!-- Banner Section Start -->
    {{-- <section class="banner-section ratio_60 wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="banner-slider">
                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/client/images/vegetable/banner/4.jpg" class="bg-img blur-up lazyload"
                            alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                    <h6 class="text-danger">5% GIẢM</h6>
                                    <h5>Ưu Đãi Hot Cho Sản Phẩm Mới</h5>
                                    <h6 class="text-content">Trang Phục Thể Thao Mới Nhất</h6>
                                </div>
                                <a href="shop-left-sidebar.html" class="banner-button text-white">Mua Ngay <i class="fa-solid fa-right-long ms-2"></i></a>
                            </div>

                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/client/images/vegetable/banner/5.jpg" class="bg-img blur-up lazyload"
                            alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                    <h6 class="text-danger">5% GIẢM</h6>
                                    <h5>Mua Nhiều Giảm Nhiều</h5>
                                    <h6 class="text-content">Trang Phục Thể Thao Cao Cấp</h6>
                                </div>
                                <a href="shop-left-sidebar.html" class="banner-button text-white">Mua Ngay <i class="fa-solid fa-right-long ms-2"></i></a>
                            </div>

                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/client/images/vegetable/banner/6.jpg" class="bg-img blur-up lazyload"
                            alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                    <h6 class="text-danger">5% GIẢM</h6>
                                    <h5>Trang Phục Thể Thao Chất Lượng</h5>
                                    <h6 class="text-content">Giao Hàng Tận Nơi</h6>
                                </div>
                                <a href="shop-left-sidebar.html" class="banner-button text-white">Mua Ngay <i class="fa-solid fa-right-long ms-2"></i></a>
                            </div>

                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/client/images/vegetable/banner/7.jpg" class="bg-img blur-up lazyload"
                            alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                    <h6 class="text-danger">5% GIẢM</h6>
                                    <h5>Mua Nhiều - Tiết Kiệm Hơn</h5>
                                    <h6 class="text-content">Quần Áo Thể Thao Chất Lượng Cao</h6>
                                </div>
                                <a href="shop-left-sidebar.html" class="banner-button text-white">Mua Ngay <i class="fa-solid fa-right-long ms-2"></i></a>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3 mt-4">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        {{-- <div class="category-menu">
                            <h3>Danh Mục</h3>
                            <ul>
                                <li>
                                    <div class="category-list">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/tshirt.svg"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="shop-left-sidebar.html">Áo Thể Thao</a>
                                        </h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-list">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/pants.svg"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="shop-left-sidebar.html">Quần Thể Thao</a>
                                        </h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-list">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/shoes.svg"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="shop-left-sidebar.html">Giày Thể Thao</a>
                                        </h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-list">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/jacket.svg"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="shop-left-sidebar.html">Áo Khoác Thể Thao</a>
                                        </h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-list">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/accessories.svg"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="shop-left-sidebar.html">Phụ Kiện Thể Thao</a>
                                        </h5>
                                    </div>
                                </li>
                            </ul>

                        </div> --}}


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
                                        <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn btn-animation btn-md mend-auto">Mua Ngay <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ratio_medium section-t-space">
                            <div class="home-contain hover-effect">
                                <img src="../assets/client/images/sports/banner/11.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
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

                        {{-- <div class="section-t-space">
                            <div class="category-menu">
                                <h3>Sản Phẩm Bán Chạy</h3>

                                <ul class="product-list border-0 p-0 d-block">
                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/client/images/sports/product/1.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html" class="text-title">
                                                        <h6 class="name">Áo Thể Thao Nam Cao Cấp</h6>
                                                    </a>
                                                    <span>Kích thước: M, L, XL</span>
                                                    <h6 class="price theme-color">₫ 350.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/client/images/sports/product/2.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html" class="text-title">
                                                        <h6 class="name">Quần Short Tập Gym</h6>
                                                    </a>
                                                    <span>Kích thước: M, L, XL</span>
                                                    <h6 class="price theme-color">₫ 250.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/client/images/sports/product/3.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html" class="text-title">
                                                        <h6 class="name">Giày Chạy Bộ Chuyên Nghiệp</h6>
                                                    </a>
                                                    <span>Kích thước: 39 - 44</span>
                                                    <h6 class="price theme-color">₫ 990.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="mb-0">
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/client/images/sports/product/4.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html" class="text-title">
                                                        <h6 class="name">Balo Thể Thao Chống Nước</h6>
                                                    </a>
                                                    <span>Dung tích: 25L</span>
                                                    <h6 class="price theme-color">₫ 450.000</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}

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
                                <svg class="icon-width">
                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                    </use>
                                </svg>
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
                                        <div style=" border: 1px solid #ccc;width: 222px" class="col-md-3 px-0">
                                            <div style="height: 327px" class="product-box">
                                                <div style="position: relative; width: 100%">
                                                    @if ($item['gia_cu'] > $item['gia_moi'])
                                                    <span style="position: absolute; top: 0; right: 0;"
                                                    class="badge bg-danger">-{{ round((($item['gia_cu'] - $item['gia_moi']) / $item['gia_cu']) * 100) }}%</span>
                                                @endif
                                                </div>
                                                <div class="product-image">
                                                    <a href="{{ route('sanphams.chitiet',$item['id']) }}">

                                                        <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                        <ul style="width: 50%;flex-direction: column;" class="product-option">

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <center>
                                                                <a href="#" class="notifi-wishlist">
                                                                    <i data-feather="heart"></i>
                                                                </a>
                                                                <form action="{{ route('add.wishlist',$item['id']) }}" method="POST" class="wishlist-form">
                                                                    @csrf
                                                                </form>
                                                            </center>
                                                            </li>
                                                        </ul>
                                                </div>
                                                <div class="product-detail">
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                    </a>

                                                    <h5 class="sold text-content">
                                                        <span class="theme-color price">{{ number_format($item['gia_moi'],0,'','.') }} đ</span>
                                                        <del>{{ number_format($item['gia_cu'],0,'','.') }} đ</del>
                                                    </h5>

                                                    <div class="product-rating mt-sm-2 mt-1">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="{{ $item['danh_gias_avg_so_sao'] >= 1 ? 'fill' : '' }}"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="{{ $item['danh_gias_avg_so_sao'] >= 2 ? 'fill' : '' }}"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="{{ $item['danh_gias_avg_so_sao'] >= 3 ? 'fill' : '' }}"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="{{ $item['danh_gias_avg_so_sao'] >= 4 ? 'fill' : '' }}"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="{{ $item['danh_gias_avg_so_sao'] >= 5 ? 'fill' : '' }}"></i>
                                                            </li>
                                                        </ul>

                                                        <h6 class="theme-color">{{ $item['trang_thai'] == 1 ? 'Còn hàng' : 'Hết hàng'}}</h6>
                                                    </div>


                                                    <div class="add-to-cart-box bg-white">
                                                        <button class="btn btn-add-cart addcart-button">
                                                            @if ($item['trang_thai'] == 1)
                                                            <a class="btn-quick-view" style="margin-right: 10px;" href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#view" data-id="{{ $item['id'] }}">
                                                                <span  class="add-icon bg-light-gray">
                                                                    <i  class="fa-solid fa-cart-plus"></i>
                                                                </span> Thêm vào giỏ hàng
                                                            </a>
                                                            @endif
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        {{-- <div class="col-12 px-0">
                                            <div  class="product-box">
                                                <div class="product-image">
                                                    <a href="product-left-thumbnail.html">
                                                        <img src="../assets/client/images/vegetable/product/2.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#view">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i data-feather="refresh-cw"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html" class="notifi-wishlist">
                                                                <i data-feather="heart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail">
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">Cold Brew Coffee Instant Coffee 50 g</h6>
                                                    </a>

                                                    <h5 class="sold text-content">
                                                        <span class="theme-color price">$26.69</span>
                                                        <del>28.56</del>
                                                    </h5>

                                                    <div class="product-rating mt-sm-2 mt-1">
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

                                                        <h6 class="theme-color">In Stock</h6>
                                                    </div>

                                                    <div class="add-to-cart-box">
                                                        <button class="btn btn-add-cart addcart-button">Add
                                                            <span class="add-icon">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </span>
                                                        </button>
                                                        <div class="cart_qty qty-box">
                                                            <div class="input-group">
                                                                <button type="button" class="qty-left-minus"
                                                                    data-type="minus" data-field="">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                                <input class="form-control input-number qty-input"
                                                                    type="text" name="quantity" value="0">
                                                                <button type="button" class="qty-right-plus"
                                                                    data-type="plus" data-field="">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{--


                  <!-- Thêm CSS của Swiper (nếu cần dùng slider) -->
                  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

                  <div class="section-b-space">
                      <div class="product-border border-row overflow-hidden">
                          <div class="swiper product-slider">
                              <div class="swiper-wrapper">
                                  @foreach ($sanPhams->take(4) as $sanPham)
                                  <div class="swiper-slide">
                                      <div class="product-box">
                                          <div class="product-image">
                                            <a href="">
                                                <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="img-fluid" alt="{{ $sanPham->ten_san_pham }}">
                                            </a>

                                              <ul class="product-option">
                                                  <li title="Xem nhanh">
                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#view">
                                                          <i data-feather="eye"></i>
                                                      </a>
                                                  </li>
                                                  <li title="So sánh">
                                                      <a href="compare.html">
                                                          <i data-feather="refresh-cw"></i>
                                                      </a>
                                                  </li>
                                                  <li title="Yêu thích">
                                                      <a href="wishlist.html">
                                                          <i data-feather="heart"></i>
                                                      </a>
                                                  </li>
                                              </ul>
                                          </div>
                                          <div class="product-detail">
                                              <a href="">
                                                  <h6 class="name">{{ $sanPham->ten_san_pham }}</h6>
                                              </a>
                                              <h5 class="sold">
                                                  <span class="theme-color price">{{ number_format($sanPham->gia_moi, 0, ',', '.') }}đ</span>
                                                  <del>{{ number_format($sanPham->gia_cu, 0, ',', '.') }}đ</del>
                                              </h5>
                                              <div class="product-rating">
                                                  <ul class="rating">
                                                      @for ($i = 1; $i <= 5; $i++)
                                                      <li>
                                                          <i data-feather="star" class="{{ $i <= $sanPham->diem_danh_gia ? 'fill' : '' }}"></i>
                                                      </li>
                                                      @endfor
                                                  </ul>
                                                  <h6 class="theme-color">{{ $sanPham->trang_thai == 1 ? 'Còn Hàng' : 'Hết Hàng' }}</h6>
                                              </div>
                                              <div class="add-to-cart-box">
                                                  <button class="btn btn-add-cart">Thêm vào giỏ</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>

                      <div class="product-border border-row overflow-hidden mt-4">
                          <div class="swiper product-slider">
                              <div class="swiper-wrapper">
                                  @foreach ($sanPhams->skip(4)->take(4) as $sanPham)
                                  <div class="swiper-slide">
                                      <div class="product-box">
                                          <div class="product-image">
                                            <a href="">
                                                <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="img-fluid" alt="{{ $sanPham->ten_san_pham }}">
                                            </a>

                                              <ul class="product-option">
                                                  <li title="Xem nhanh">
                                                      <a href="#" data-bs-toggle="modal" data-bs-target="#view">
                                                          <i data-feather="eye"></i>
                                                      </a>
                                                  </li>
                                                  <li title="So sánh">
                                                      <a href="compare.html">
                                                          <i data-feather="refresh-cw"></i>
                                                      </a>
                                                  </li>
                                                  <li title="Yêu thích">
                                                      <a href="wishlist.html">
                                                          <i data-feather="heart"></i>
                                                      </a>
                                                  </li>
                                              </ul>
                                          </div>
                                          <div class="product-detail">
                                              <a href="">
                                                  <h6 class="name">{{ $sanPham->ten_san_pham }}</h6>
                                              </a>
                                              <h5 class="sold">
                                                  <span class="theme-color price">{{ number_format($sanPham->gia_moi, 0, ',', '.') }}đ</span>
                                                  <del>{{ number_format($sanPham->gia_cu, 0, ',', '.') }}đ</del>
                                              </h5>
                                              <div class="product-rating">
                                                  <ul class="rating">
                                                      @for ($i = 1; $i <= 5; $i++)
                                                      <li>
                                                          <i data-feather="star" class="{{ $i <= $sanPham->diem_danh_gia ? 'fill' : '' }}"></i>
                                                      </li>
                                                      @endfor
                                                  </ul>
                                                  <h6 class="theme-color">{{ $sanPham->trang_thai == 1 ? 'Còn Hàng' : 'Hết Hàng' }}</h6>

                                              </div>
                                              <div class="add-to-cart-box">
                                                  <button class="btn btn-add-cart">Thêm vào giỏ</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>


<!-- Thêm Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".product-slider", {
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        breakpoints: {
            0: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1200: { slidesPerView: 4 }
        }
    });
</script>


 --}}
                    <div class="title">
                        <h2>Danh Mục Nổi Bật</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                </use>
                            </svg>
                        </span>
                        <p>Danh mục hàng đầu</p>
                    </div>

                    <div class="category-slider-2 product-wrapper no-arrow">
                        @foreach ($danhMucAll as $item)
                        <div>
                            <a href="shop-left-sidebar.html" class="category-box category-dark">
                                <div>
                                    <img src="{{ Storage::url('images/'.$item->anh_danh_muc) }}"
                                        class="blur-up lazyload" alt="">
                                    <h5>{{ $item->ten_danh_muc }}</h5>
                                </div>
                            </a>
                        </div>
                        @endforeach

                    </div>
                    {{-- <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/client/images/fashion/banner/1.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-exo">Giảm giá 50%</h3>
                                            <h4 class="text-russo fw-normal theme-color mb-2">Áo thể thao cao cấp</h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                class="btn btn-animation btn-sm mend-auto">Mua ngay <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/client/images/sports/banner/2.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-exo">Giảm giá 50%</h3>
                                            <h4 class="text-russo fw-normal theme-color mb-2">Giày chạy bộ chuyên nghiệp</h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                class="btn btn-animation btn-sm mend-auto">Mua ngay <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="title d-block">
                        <h2>Tủ đồ thể thao</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                </use>
                            </svg>
                        </span>
                        <p>Một trợ lý ảo sẽ giúp bạn chọn những sản phẩm phù hợp</p>
                    </div> --}}
                    {{-- <div class="product-border overflow-hidden wow fadeInUp">
                        <div class="product-box-slider no-arrow">
                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/1.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Chocolate Powder</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/2.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Sandwich Cookies</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/3.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Butter Croissant</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/4.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Dark Chocolate</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/5.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Mix-sweet-food</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="product-left-thumbnail.html">
                                                    <img src="../assets/client/images/vegetable/product/4.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="compare.html">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="wishlist.html" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="product-left-thumbnail.html">
                                                    <h6 class="name h-100">Dark Chocolate</h6>
                                                </a>

                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">$26.69</span>
                                                    <del>28.56</del>
                                                </h5>

                                                <div class="product-rating mt-sm-2 mt-1">
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

                                                    <h6 class="theme-color">In Stock</h6>
                                                </div>

                                                <div class="add-to-cart-box">
                                                    <button class="btn btn-add-cart addcart-button">Add
                                                        <span class="add-icon">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="section-t-space">
                        <div class="banner-contain">
                            <img src="../assets/client/images/vegetable/banner/15.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center p-4 text-white text-center">
                                <div>
                                    <h3 class="lh-base fw-bold offer-text">Nhận ngay $3 hoàn tiền! Đơn hàng tối thiểu $30</h3>
                                    <h6 class="coupon-code">Sử dụng mã: SPORTS1920</h6>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-xxl-8 col-xl-12 col-md-7">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/client/images/vegetable/banner/12.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h2 class="text-kaushan fw-normal theme-color">Get Ready To</h2>
                                            <h3 class="mt-2 mb-3">TAKE ON THE DAY!</h3>
                                            <p class="text-content banner-text">In publishing and graphic design,
                                                Lorem
                                                ipsum is a placeholder text commonly used to demonstrate.</p>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-12 col-md-5">
                                <a href="shop-left-sidebar.html" class="banner-contain hover-effect h-100">
                                    <img src="../assets/client/images/vegetable/banner/13.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4 h-100">
                                        <div>
                                            <h2 class="text-kaushan fw-normal text-danger">20% Off</h2>
                                            <h3 class="mt-2 mb-2 theme-color">SUMMRY</h3>
                                            <h3 class="fw-normal product-name text-title">Product</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="title d-block">
                        <div>
                            <h2>Sản phẩm bán chạy</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                    </use>
                                </svg>
                            </span>
                            <p>Những sản phẩm được mua nhiều nhất của chúng tôi</p>
                        </div>
                    </div>

                    <div class="best-selling-slider product-wrapper wow fadeInUp">
                        <div>
                            <ul class="product-list">
                                @foreach ($part1 as $item)
                                <li>
                                    <div class="offer-product">
                                        <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="offer-image">
                                            <div style="position: relative; width: 100%">
                                                @if ($item['gia_cu'] > $item['gia_moi'])
                                                <span style="position: absolute; top: 0; right: 0;"
                                                class="badge bg-danger">-{{ round((($item['gia_cu'] - $item['gia_moi']) / $item['gia_cu']) * 100) }}%</span>
                                            @endif
                                            </div>
                                            <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                class="blur-up lazyload" alt="">
                                        </a>

                                        <div class="offer-detail">
                                            <div>
                                                <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="text-title">
                                                    <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                </a>
                                                <del>{{ number_format($item['gia_cu'],0,'','.') }} đ</del>
                                                <h6 class="price theme-color">{{ number_format($item['gia_moi'],0,'','.') }} đ</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">
                                @foreach ($part2 as $item)
                                <li>
                                    <div class="offer-product">
                                        <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="offer-image">
                                            <div style="position: relative; width: 100%">
                                                @if ($item['gia_cu'] > $item['gia_moi'])
                                                <span style="position: absolute; top: 0; right: 0;"
                                                class="badge bg-danger">-{{ round((($item['gia_cu'] - $item['gia_moi']) / $item['gia_cu']) * 100) }}%</span>
                                            @endif
                                            </div>
                                            <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                class="blur-up lazyload" alt="">
                                        </a>

                                        <div class="offer-detail">
                                            <div>
                                                <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="text-title">
                                                    <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                </a>
                                                <del>{{ number_format($item['gia_cu'],0,'','.') }} đ</del>
                                                <h6 class="price theme-color">{{ number_format($item['gia_moi'],0,'','.') }} đ</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">
                                @foreach ($part3 as $item)
                                <li>
                                    <div class="offer-product">

                                        <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="offer-image">
                                            <div style="position: relative; width: 100%">
                                                @if ($item['gia_cu'] > $item['gia_moi'])
                                                <span style="position: absolute; top: 0; right: 0;"
                                                class="badge bg-danger">-{{ round((($item['gia_cu'] - $item['gia_moi']) / $item['gia_cu']) * 100) }}%</span>
                                            @endif
                                            </div>
                                            <img src="{{ Storage::url($item['hinh_anh']) }}"
                                                class="blur-up lazyload" alt="">
                                        </a>

                                        <div class="offer-detail">
                                            <div>
                                                <a href="{{ route('sanphams.chitiet',$item['id']) }}" class="text-title">
                                                    <h6 class="name">{{ $item['ten_san_pham'] }}</h6>
                                                </a>
                                                <del>{{ number_format($item['gia_cu'],0,'','.') }} đ</del>
                                                <h6 class="price theme-color">{{ number_format($item['gia_moi'],0,'','.') }} đ</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="section-t-space">
                        <div class="banner-contain hover-effect">
                            <img src="../assets/client/images/vegetable/banner/14.jpg" class="bg-img blur-up lazyload"
                                alt="">
                            <div class="banner-details p-center banner-b-space w-100 text-center">
                                <div>
                                    <h6 class="ls-expanded theme-color mb-sm-3 mb-1">SUMMER</h6>
                                    <h2 class="banner-title">VEGETABLE</h2>
                                    <h5 class="lh-sm mx-auto mt-1 text-content">Save up to 5% OFF</h5>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                        class="btn btn-animation btn-sm mx-auto mt-sm-3 mt-2">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="title section-t-space">
                        <h2>Bài viết</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                </use>
                            </svg>
                        </span>
                        <p>Những bài viết đáng chú ý</p>
                    </div>

                    <div class="slider-3-blog ratio_65 no-arrow product-wrapper">
                        @foreach ($baiViets as $item)
                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="{{  route('baiviets.chitiet',$item['id']) }}" class="blog-image">
                                        <img style="
                                            object-fit: contain;" src="{{ Storage::url($item['anh_bia']) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>

                                <a href="{{  route('baiviets.chitiet',$item['id']) }}" class="blog-detail">
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
    <!-- Product Section End -->

    <!-- Newsletter Section Start -->
    {{-- <section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2>Join our newsletter and get...</h2>
                                    <h5>$20 discount for your first order</h5>
                                    <div class="input-box">
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter Your Email">
                                        <i class="fa-solid fa-envelope arrow"></i>
                                        <button class="sub-btn  btn-animation">
                                            <span class="d-sm-block d-none">Subscribe</span>
                                            <i class="fa-solid fa-arrow-right icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Newsletter Section End -->
@endsection

@section('js')
@endsection

