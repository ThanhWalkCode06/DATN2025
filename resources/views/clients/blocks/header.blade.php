<header class="pb-md-4 pb-0">

    <div class="header-top">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 d-xxl-block d-none">
                    <div class="top-left-header">
                        <i class="fas fa-map-marker-alt text-white me-2"></i>
                     <a href="https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+Cao+%C4%91%E1%BA%B3ng+FPT+Polytechnic/@21.0381348,105.7446869,17z/data=!3m1!4b1!4m6!3m5!1s0x313455e940879933:0xcf10b34e9f1a03df!8m2!3d21.0381298!4d105.7472618!16s%2Fg%2F11krd97y__?entry=ttu&g_ep=EgoyMDI1MDMxMi4wIKXMDSoASAFQAw%3D%3D">
                        <span class="text-white">Tòa nhà FPT Polytechnic.</span>
                    </a>  

                    </div>
                </div>

                <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                    <div class="header-offer">
                        <div class="notification-slider">
                            <div>
                                <div class="timer-notification">
                                    <h6><strong class="me-1">Chào mừng tới
                                            {{ $globalSetting->name_website ?? 'Seven Stars' }}</strong>
                                    </h6>
                                </div>
                            </div>

                            <div>
                                <div class="timer-notification">
                                    <h6>Mua hàng ngay thôi nào!
                                        <a href="{{ route('sanphams.danhsach') }}" class="text-white">Mua ngay!</a>
                                    </h6>
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


    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <a href="{{ route('home') }}" class="web-logo nav-logo">
                            <img src="{{ Storage::url($globalSetting->client_logo ?? 'images/logo-green.png') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>

                        <div class="middle-box">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Tìm kiếm">
                                    <button class="btn" type="button" id="button-addon2">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Tìm kiếm">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="{{ route('sanphams.sanphamyeuthich') }}"
                                        class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="shopping-cart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge">2
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </button>

                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                                <li class="product-box-contain">
                                                    <div class="drop-cart">
                                                        <a href="product-left-thumbnail.html" class="drop-image">
                                                            <img src="../assets/client/images/vegetable/product/1.png"
                                                                class="blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="drop-contain">
                                                            <a href="product-left-thumbnail.html">
                                                                <h5>Fantasy Crunchy Choco Chip Cookies</h5>
                                                            </a>
                                                            <h6><span>1 x</span> $80.58</h6>
                                                            <button class="close-button close_button">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="product-box-contain">
                                                    <div class="drop-cart">
                                                        <a href="product-left-thumbnail.html" class="drop-image">
                                                            <img src="../assets/client/images/vegetable/product/2.png"
                                                                class="blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="drop-contain">
                                                            <a href="product-left-thumbnail.html">
                                                                <h5>Peanut Butter Bite Premium Butter Cookies 600 g
                                                                </h5>
                                                            </a>
                                                            <h6><span>1 x</span> $25.68</h6>
                                                            <button class="close-button close_button">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <div class="price-box">
                                                <h5>Total :</h5>
                                                <h4 class="theme-color fw-bold">$106.58</h4>
                                            </div>

                                            <div class="button-group">
                                                <a href="{{ route('thanhtoans.giohang') }}"
                                                    class="btn btn-sm cart-button">Xem giỏ hàng</a>
                                                <a href="{{ route('thanhtoans.thanhtoan') }}"
                                                    class="btn btn-sm cart-button theme-bg-color text-white">
                                                    Thanh toán</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>Hello,</h6>
                                            <h5>My Account</h5>
                                        </div>
                                    </div>
                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                            @if (!Auth::user())
                                            <li class="product-box-contain">
                                                <i></i>
                                                <a href="{{ route('login.client') }}">Đăng nhập</a>
                                            </li>
                                            @else
                                            <p>Xin chào <strong
                                                    style="color: #0da487">{{ Auth::user()->username }}</strong>
                                            </p>
                                            <li class="product-box-contain">
                                                <a href="{{ route('users.chitiet') }}">Chi tiết tài
                                                    khoản</a>
                                            </li>
                                            <li class="product-box-contain">
                                                <i></i>
                                                <a onclick="Logout(event)" href="#">Đăng xuất</a>

                                            </li>
                                            @endif

                                            {{-- <li class="product-box-contain">
                                                <a href="sign-up.html">Đăng kí</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="forgot.html">Quên mật khẩu</a>
                                            </li> --}}


                                        </ul>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="header-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category">
                            <i data-feather="align-left"></i>
                            <span>Tất cả danh mục</span>
                        </button>

                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Categories</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <ul class="category-list">
                                @if(isset($categories))
                                @foreach($categories as $category)
                                    <li class="onhover-category-list">
                                        <a href="{{ route('clientsanpham.danhsach', ['danh_muc_id' => $category->id]) }}" class="category-name">
                                            <img src="{{ asset('storage/' . $category->anh_danh_muc) }}" alt="{{ $category->ten_danh_muc }}">
                                            <h6>{{ $category->ten_danh_muc }}</h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            
                            
                            </ul>
                        </div>
                    </div>

                    <div class="header-nav-middle">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button"
                                        data-bs-dismiss="offcanvas"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('sanphams.danhsach') }}">Sản phẩm</a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="shop-category-slider.html">Shop
                                                        Category Slider</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-category.html">Shop
                                                        Category Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-banner.html">Shop
                                                        Banner</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-left-sidebar.html">Shop
                                                        Left
                                                        Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-right-sidebar.html">Shop
                                                        Right Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-top-filter.html">Shop Top
                                                        Filter</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('baiviets.danhsach') }}">Bài viết</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('huongdans.danhsach') }}">Hướng dẫn</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('gioithieu.home') }}">Giới thiệu</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('lienhe.home') }}">Liên hệ</a>
                                            {{-- <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="seller-become.html">Become a
                                                        Seller</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="seller-dashboard.html">Seller
                                                        Dashboard</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="seller-detail.html">Seller
                                                        Detail</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="seller-detail-2.html">Seller
                                                        Detail 2</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="seller-grid.html">Seller
                                                        Grid</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="seller-grid-2.html">Seller Grid
                                                        2</a>
                                                </li>
                                            </ul> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-nav-right">
                        <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                            <i data-feather="zap"></i>
                            <span>Giao dịch hôm nay</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>