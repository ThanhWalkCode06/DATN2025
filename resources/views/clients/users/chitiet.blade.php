@extends('layouts.client')

@section('title')
    Tài khoản
@endsection

@section('css')
<style>
    .user-dashboard-section .dashboard-right-sidebar .dashboard-bg-box+.dashboard-bg-box {
    margin-top: 0px;
}
</style>
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="{{ Storage::url($user->anh_dai_dien ?? 'images/logo.jpg') }}"
                                            class="blur-up lazyload update_img" alt="">
                                        {{-- <div class="cover-icon">
                                            <i class="fa-solid fa-pen">
                                                <input type="file" onchange="readURL(this,0)">
                                            </i>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{ Auth::user()->username }}</h3>
                                    <h6 class="text-content">{{ Auth::user()->email }}</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                                    Bảng Điều Khiển</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button"><i data-feather="shopping-bag"></i> Đơn
                                    Hàng</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"><i
                                        data-feather="user"></i>
                                    Hồ Sơ</button>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>Bảng Điều Khiển Của Tôi</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Xin chào, <b
                                                class="text-title">{{ $user->username ?? '' }}</b></h6>
                                        <p class="text-content">Từ bảng điều khiển tài khoản của tôi, bạn có thể xem nhanh
                                            hoạt động gần đây của tài khoản và cập nhật thông tin của mình. Chọn một liên
                                            kết bên dưới để xem hoặc chỉnh sửa thông tin.</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Đơn Hàng</h5>
                                                        <h3>{{ $user->donHangs->count() }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Đơn Hàng </h5>
                                                        <h5>Chờ Xử Lý</h5>
                                                        <h3>{{ $i ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Danh Sách </h5>
                                                        <h5>Yêu Thích</h5>
                                                        <h3>{{ $user->sanPhamYeuThichs->count() ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="tab-pane fade" id="pills-wishlist" role="tabpanel">
                                <div class="dashboard-wishlist">
                                    <div class="title">
                                        <h2>Lịch Sử Danh Sách Yêu Thích Của Tôi</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/2.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Rau củ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Bánh mì tươi và bột bánh ngọt 200g</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai thơm ngon với nụ cười rạng rỡ. Phô mai Mascarpone kết
                                                            hợp với rượu, phô mai cứng,
                                                            món phô mai mà ai cũng yêu thích, macaroni phô mai, croque
                                                            monsieur.
                                                        </p>
                                                        <h6 class="unit mt-1">250 ml</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$08.02</span>
                                                            <del>$15.15</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">
                                                                Thêm vào giỏ
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


                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/3.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Rau củ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Bánh quy bơ hảo hạng vị bơ đậu phộng 600g
                                                            </h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai Feta, Taleggio, Croque Monsieur, Swiss, Manchego,
                                                            Cheesecake, Dolcelatte, Jarlsberg.
                                                            Phô mai cứng Danish Fontina, Boursin, phô mai tan chảy, phô mai
                                                            fondue.
                                                        </p>
                                                        <h6 class="unit mt-1">350 G</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$04.33</span>
                                                            <del>$10.36</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">
                                                                Thêm vào giỏ
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

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/4.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Đồ ăn nhẹ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Gói SnackAmor gồm que Jowar và khoai tây
                                                                Jowar</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai cứng Lancashire, Parmesan. Phô mai Danish Fontina,
                                                            Mozzarella, phô mai kem,
                                                            phô mai nặng mùi, phô mai và rượu, bánh phô mai Dolcelatte,
                                                            Stilton.
                                                            Phô mai kem, Parmesan, Ai đã lấy miếng phô mai của tôi? Khi phô
                                                            mai xuất hiện, mọi người đều vui vẻ.
                                                            Phô mai kem, Red Leicester, Ricotta, Edam.
                                                        </p>
                                                        <h6 class="unit mt-1">570 G</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$12.52</span>
                                                            <del>$13.62</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">
                                                                Thêm vào giỏ
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

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/5.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Đồ ăn nhẹ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Khoai tây chiên Yumitos rắc ớt 100 g</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai Cheddar, Pecorino, phô mai cứng, phô mai và bánh quy,
                                                            Bocconcini, Babybel. Phô mai bò, dê, Paneer, phô mai kem,
                                                            Fromage,
                                                            phô mai Cottage, phô mai súp lơ, Jarlsberg.
                                                        </p>
                                                        <h6 class="unit mt-1">100 G</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$10.25</span>
                                                            <del>$12.36</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">
                                                                Thêm vào giỏ
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

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/6.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Rau củ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Bánh quy Choco Chip giòn Fantasy</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai Bavarian bergkase nặng mùi, phô mai Thụy Sĩ, Lancashire,
                                                            Manchego tan chảy.
                                                            Phô mai Red Leicester, paneer, khi phô mai tan chảy, ai cũng vui
                                                            vẻ, croque monsieur,
                                                            phô mai dê, port-salut.
                                                        </p>
                                                        <h6 class="unit mt-1">550 G</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$14.25</span>
                                                            <del>$16.57</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">Thêm vào giỏ hàng
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

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/7.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Rau củ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Bột bánh mì tươi và bánh ngọt 200 g</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai tan chảy, babybel, phô mai phấn và phô mai.
                                                            Port-salut, kem phô mai, khi phô mai tan chảy, ai cũng vui vẻ,
                                                            kem phô mai, phô mai cứng, kem phô mai, phô mai Red Leicester.
                                                        </p>
                                                        <h6 class="unit mt-1">1 Kg</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$12.68</span>
                                                            <del>$14.69</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">Thêm vào giỏ hàng
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

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="../assets/images/cake/product/2.png"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <button class="btn wishlist-button close_button">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">Rau củ</span>
                                                        <a href="product-left-thumbnail.html">
                                                            <h5 class="name">Bột bánh mì tươi và bánh ngọt 200 g</h5>
                                                        </a>
                                                        <p class="text-content mt-1 mb-2 product-content">
                                                            Phô mai dạng xịt, phô mai cottage, dây phô mai.
                                                            Phô mai Red Leicester, paneer, fontina Đan Mạch, queso,
                                                            lancashire,
                                                            khi phô mai tan chảy, ai cũng vui vẻ, phô mai cottage, paneer.
                                                        </p>
                                                        <h6 class="unit mt-1">250 ml</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">$08.02</span>
                                                            <del>$15.15</del>
                                                        </h5>
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">Thêm vào giỏ hàng
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
                            </div>

                            <div class="tab-pane fade" id="pills-order" role="tabpanel">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Lịch Sử Đơn Hàng Của Tôi</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>


                                    <div class="order-contain">
                                        @php
                                            $orderStatus = [
                                                -1 => 'Đã hủy',
                                                0 => 'Chưa xác nhận',
                                                1 => 'Đã xác nhận',
                                                2 => 'Chờ vận chuyển',
                                                3 => 'Đang giao',
                                                4 => 'Đã giao',
                                                5 => 'Trả hàng',
                                            ];
                                        @endphp
                                        @if($donHangsPaginate->isNotEmpty())
                                        @foreach ($donHangsPaginate as $item)
                                            <div class="order-box dashboard-bg-box">
                                                <a href="{{ route('order-tracking.client',$item->id) }}">
                                                    <div class="order-container">
                                                        <div class="order-icon">
                                                            <i data-feather="box"></i>
                                                        </div>

                                                        <div class="order-detail">
                                                            {{-- {{ dd($item->trang_thai) }} --}}
                                                            <h4>Đơn Hàng <span class="{{ in_array($item->trang_thai_don_hang, [-1, 0, 5]) ? '' : 'success-bg' }}">{{ $orderStatus[$item->trang_thai_don_hang] }}</span></h4>
                                                            <h6 class="text-content mt-3">Mã đơn hàng: {{  $item->ma_don_hang }}
                                                            <h6 class="text-content mt-3">Trạng thái thanh toán:
                                                                <span style="float: right; padding-top: 0px; padding-bottom: 0px; padding-left: 5px; padding-right: 0px " class="{{ $item->trang_thai_thanh_toan == 0 ? 'btn bg-danger-subtle text-danger' : 'btn bg-success-subtle text-success' }}">
                                                                    {{ $item->trang_thai_thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</span>
                                                            </h6>
                                                            <h6 class="text-content mt-3">Địa chỉ nhận: {{  $item->dia_chi_nguoi_nhan }}
                                                            </h6>
                                                            <h6 class="text-content mt-3">Tổng tiền: <strong style="font-weight: bold" class="text-success">
                                                                {{  number_format($item->tong_tien,0,'.','.') }} đ</strong>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                        @else
                                        <center>
                                            <h2 style="color: #ccc">Bạn không có đơn hàng nào</h2>
                                            <img style="width: 300px;color: #ccc" src="{{ asset('assets/images/inner-page/not-found.png') }}" alt="">
                                            </center>
                                        @endif

                                    </div>

                                </div>
                                {{ $donHangsPaginate->links('pagination::bootstrap-5') }}
                            </div>

                            <div class="tab-pane fade" id="pills-address" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Sổ Địa Chỉ Của Tôi</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use
                                                        xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                    </use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address">
                                            <i data-feather="plus" class="me-2"></i> Thêm Địa Chỉ Mới
                                        </button>
                                    </div>


                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault2" checked>
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Jack Jennas</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>8424 James Lane, South San Francisco, CA 94080
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+380</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 812-710-3798</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault3">
                                                    </div>

                                                    <div class="label">
                                                        <label>Văn phòng</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Terry S. Sutton</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2280 Rose Avenue Kenner, LA 70062</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+25</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 504-228-0969</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault4">
                                                    </div>

                                                    <div class="label">
                                                        <label>Hàng xóm</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Juan M. McKeon</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>1703 Carson Street Lexington, KY 40593</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+78</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 859-257-0509</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault5">
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà 2</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Gary M. Bailey</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2135 Burning Memory Lane Philadelphia, PA
                                                                            19135</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+26</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 215-335-9916</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault1">
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà 2</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Gary M. Bailey</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2135 Burning Memory Lane Philadelphia, PA
                                                                            19135</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+26</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 215-335-9916</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-card" role="tabpanel">
                                <div class="dashboard-card">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Chi tiết thẻ của tôi</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use
                                                        xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                    </use>
                                                </svg>
                                            </span>
                                        </div>


                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#editCard">
                                            <i data-feather="plus" class="me-2"></i> Thêm thẻ mới
                                        </button>

                                    </div>

                                    <div class="row g-4">
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                            <div class="payment-card-detail">
                                                <div class="card-details">
                                                    <div class="card-number">
                                                        <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                    </div>

                                                    <div class="valid-detail">
                                                        <div class="title">
                                                            <span>Hiệu lực</span>
                                                            <span>đến</span>
                                                        </div>
                                                        <div class="date">
                                                            <h3>08/05</h3>
                                                        </div>
                                                        <div class="primary">
                                                            <span class="badge bg-pill badge-light">Chính</span>
                                                        </div>
                                                    </div>

                                                    <div class="name-detail">
                                                        <div class="name">
                                                            <h5>Audrey Carol</h5>
                                                        </div>
                                                        <div class="card-img">
                                                            <img src="../assets/images/payment-icon/1.jpg"
                                                                class="img-fluid blur-up lazyloaded" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="edit-card">
                                                    <a data-bs-toggle="modal" data-bs-target="#editCard"
                                                        href="javascript:void(0)"><i class="far fa-edit"></i> Chỉnh
                                                        sửa</a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i
                                                            class="far fa-minus-square"></i> Xóa</a>
                                                </div>
                                            </div>

                                            <div class="edit-card-mobile">
                                                <a data-bs-toggle="modal" data-bs-target="#editCard"
                                                    href="javascript:void(0)"><i class="far fa-edit"></i> Chỉnh sửa</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i> Xóa</a>
                                            </div>

                                        </div>
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                            <div class="payment-card-detail">
                                                <div class="card-details card-visa">
                                                    <div class="card-number">
                                                        <h4>XXXX - XXXX - XXXX - 1536</h4>
                                                    </div>

                                                    <div class="valid-detail">
                                                        <div class="title">
                                                            <span>Hiệu lực</span>
                                                            <span>đến</span>
                                                        </div>
                                                        <div class="date">
                                                            <h3>12/23</h3>
                                                        </div>
                                                        <div class="primary">
                                                            <span class="badge bg-pill badge-light">Chính</span>
                                                        </div>
                                                    </div>

                                                    <div class="name-detail">
                                                        <div class="name">
                                                            <h5>Leah Heather</h5>
                                                        </div>
                                                        <div class="card-img">
                                                            <img src="../assets/images/payment-icon/2.jpg"
                                                                class="img-fluid blur-up lazyloaded" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="edit-card">
                                                    <a data-bs-toggle="modal" data-bs-target="#editCard"
                                                        href="javascript:void(0)"><i class="far fa-edit"></i> Chỉnh
                                                        sửa</a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i
                                                            class="far fa-minus-square"></i> Xóa</a>
                                                </div>
                                            </div>

                                            <div class="edit-card-mobile">
                                                <a data-bs-toggle="modal" data-bs-target="#editCard"
                                                    href="javascript:void(0)"><i class="far fa-edit"></i> Chỉnh sửa</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    Xóa</a>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                            <div class="payment-card-detail">
                                                <div class="card-details debit-card">
                                                    <div class="card-number">
                                                        <h4>XXXX - XXXX - XXXX - 1366</h4>
                                                    </div>

                                                    <div class="valid-detail">
                                                        <div class="title">
                                                            <span>Hiệu lực</span>
                                                            <span>đến</span>
                                                        </div>
                                                        <div class="date">
                                                            <h3>05/21</h3>
                                                        </div>
                                                        <div class="primary">
                                                            <span class="badge bg-pill badge-light">Chính</span>
                                                        </div>
                                                    </div>

                                                    <div class="name-detail">
                                                        <div class="name">
                                                            <h5>Mark Jecno</h5>
                                                        </div>
                                                        <div class="card-img">
                                                            <img src="../assets/images/payment-icon/3.jpg"
                                                                class="img-fluid blur-up lazyloaded" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="edit-card">
                                                    <a data-bs-toggle="modal" data-bs-target="#editCard"
                                                        href="javascript:void(0)"><i class="far fa-edit"></i> Chỉnh
                                                        sửa</a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i
                                                            class="far fa-minus-square"></i> Xóa</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>Hồ Sơ Của Tôi</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>


                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="dashboard-title">
                                            <h3>Tên Hồ Sơ</h3>
                                        </div>
                                        <div class="profile-name-detail">
                                            <div class="d-sm-flex align-items-center d-block">
                                                <h3>Họ và tên: {{ $user->ten_nguoi_dung ?? '' }}</h3>
                                            </div>
                                        </div>

                                        <div class="location-profile">
                                            <ul>
                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="map-pin"></i>
                                                        <h6>{{ Auth::user()->dia_chi ?? 'Trống' }}</h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="mail"></i>
                                                        <h6>{{ Auth::user()->email ?? 'Trống' }}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="profile-description">
                                            <p>Các thông tin cơ bản ở dưới bạn có thể thay đổi hay chỉnh sửa theo nhu cầu.
                                            </p>
                                        </div>
                                    </div>


                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="col-xxl-7">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Giới thiệu Hồ Sơ</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Giới tính:</td>
                                                                <td>{{ Auth::user()->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ngày sinh:</td>
                                                                <td>{{ Auth::user()->ngay_sinh ?? 'Trống' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số điện thoại:</td>
                                                                <td>
                                                                    <a
                                                                        href="javascript:void(0)">+{{ Auth::user()->so_dien_thoai ?? 'Trống' }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Địa chỉ:</td>
                                                                <td>{{ Auth::user()->dia_chi ?? 'Trống' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <span style="margin: 0px" data-bs-toggle="modal"
                                                                            data-bs-target="#editProfile">Chỉnh sửa</span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="dashboard-title mb-3">
                                                    <h3>Thông Tin Đăng Nhập</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Password:</td>
                                                                <td>
                                                                    <a href="{{ route('pass.edit.client') }}">*******
                                                                        <span data-bs-toggle="modal">Chỉnh sửa</span></a>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-xxl-5">
                                                <div class="profile-image">
                                                    <img src="../assets/images/inner-page/dashboard-profile.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-download" role="tabpanel">
                                <div class="dashboard-download">
                                    <div class="title">
                                        <h2>Tải Xuống Của Tôi</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>


                                    <div class="download-detail dashboard-bg-box">
                                        <form>
                                            <div class="input-group download-form">
                                                <input type="text" class="form-control"
                                                    placeholder="Search your download">
                                                <button class="btn theme-bg-color text-light" type="button"
                                                    id="button-addon2">Tìm kiếm</button>
                                            </div>
                                        </form>

                                        <div class="select-filter-box">
                                            <select class="form-select">
                                                <option selected="">Tất cả chợ trực tuyến</option>
                                                <option value="1">Một</option>
                                                <option value="2">Hai</option>
                                                <option value="3">Ba</option>
                                            </select>

                                            <ul class="nav nav-pills filter-box" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-data-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-data"
                                                        type="button">Dữ liệu đã mua</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-title-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-title" type="button">Tiêu đề</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-rating-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-rating" type="button">Xếp hạng của
                                                        tôi</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-recent-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-recent" type="button">Cập nhật gần
                                                        đây</button>
                                                </li>
                                            </ul>
                                        </div>


                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-data" role="tabpanel">
                                                <div class="download-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>STT</th>
                                                                    <th>Hình ảnh</th>
                                                                    <th>Tên</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/1.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Mẫu Angular 17 cho Bất động sản</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/2.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Chủ đề Shopify đa năng. Nhanh, sạch sẽ và
                                                                        linh hoạt. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/3.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - Mẫu React JS cho Bảng điều khiển quản trị
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-title">
                                                <div class="download-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>STT</th>
                                                                    <th>Hình ảnh</th>
                                                                    <th>Tên</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/1.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Mẫu Angular 17 cho Bất động sản</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/2.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Chủ đề Shopify đa năng. Nhanh, sạch sẽ và
                                                                        linh hoạt. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/3.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - Mẫu React JS cho Bảng điều khiển quản trị
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-rating">
                                                <div class="download-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>STT</th>
                                                                    <th>Hình ảnh</th>
                                                                    <th>Tên</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/1.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Mẫu Angular 17 cho Bất động sản</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/2.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Chủ đề Shopify đa năng. Nhanh, sạch sẽ và
                                                                        linh hoạt. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/3.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - Mẫu React JS cho Bảng điều khiển quản trị
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-recent">
                                                <div class="download-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>STT</th>
                                                                    <th>Hình ảnh</th>
                                                                    <th>Tên</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/1.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Mẫu Angular 17 cho Bất động sản</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/2.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Chủ đề Shopify đa năng. Nhanh, sạch sẽ và
                                                                        linh hoạt. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="../assets/images/theme-icon/3.png"
                                                                            class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - Mẫu React JS cho Bảng điều khiển quản trị
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                type="button"
                                                                                data-bs-toggle="dropdown">Tải
                                                                                xuống</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Tất cả tệp & tài
                                                                                        liệu</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="#">Chứng nhận giấy phép
                                                                                        & mã mua hàng (văn bản)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-security" role="tabpanel">
                                <div class="dashboard-privacy">
                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Quyền riêng tư</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Cho phép người khác xem hồ sơ của tôi</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio">
                                                    <label class="form-check-label" for="redio"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Tất cả mọi người sẽ có thể xem hồ sơ của tôi</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Chỉ những người đã lưu hồ sơ này mới có thể xem hồ sơ của tôi</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio2">
                                                    <label class="form-check-label" for="redio2"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Tất cả mọi người sẽ không thể xem hồ sơ của tôi</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Lưu thay
                                            đổi</button>
                                    </div>

                                    <div class="dashboard-bg-box mt-4">
                                        <div class="dashboard-title mb-4">
                                            <h3>Cài đặt tài khoản</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Xóa tài khoản của bạn sẽ vĩnh viễn</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio3">
                                                    <label class="form-check-label" for="redio3"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Sau khi tài khoản của bạn bị xóa, bạn sẽ bị đăng xuất
                                                và không thể đăng nhập lại.</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Xóa tài khoản của bạn sẽ tạm thời</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio4">
                                                    <label class="form-check-label" for="redio4"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Sau khi tài khoản của bạn bị xóa, bạn sẽ bị đăng xuất
                                                và có thể tạo tài khoản mới.</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Xóa tài khoản của
                                            tôi</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let activeTab = localStorage.getItem("activeTab");

        if (activeTab) {
            let tab = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (tab) {
                new bootstrap.Tab(tab).show();
            }
        }

        document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener("click", function() {
                localStorage.setItem("activeTab", this.getAttribute("data-bs-target"));
            });
        });
    });
</script>
