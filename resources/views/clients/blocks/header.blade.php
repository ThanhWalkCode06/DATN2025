<header class="pb-md-4 pb-0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <div class="header-top">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 d-xxl-block d-none">
                    <div class="top-left-header">
                        <i class="iconly-Location icli text-white"></i>
                        <span class="text-white">1418 Riverwood Drive, CA 96052, US</span>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                    <div class="header-offer">
                        <div class="notification-slider">
                            <div>
                                <div class="timer-notification">
                                    <h6><strong class="me-1">Welcome to Fastkart!</strong>Wrap new offers/gift
                                        every single day on Weekends.<strong class="ms-1">New Coupon Code: Fast024
                                        </strong>

                                    </h6>
                                </div>
                            </div>

                            <div>
                                <div class="timer-notification">
                                    <h6>Something you love is now on sale!
                                        <a href="shop-left-sidebar.html" class="text-white">Buy Now
                                            !</a>
                                    </h6>
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
                            <img src="../assets/client/images/logo/1.png" class="img-fluid blur-up lazyload"
                                alt="">
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
                                            <li class="product-box-contain">
                                                <i></i>
                                                <a href="login.html">Đăng nhập</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="sign-up.html">Đăng kí</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="forgot.html">Quên mật khẩu</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="{{ route('users.chitiet', 'nguyenvana') }}">Chi tiết tài
                                                    khoản</a>
                                            </li>
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
                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/vegetable.svg"
                                            alt="">
                                        <h6>Vegetables & Fruit</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Organic Vegetables</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Potato & Tomato</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cucumber & Capsicum</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Leafy Vegetables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Root Vegetables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Beans & Okra</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cabbage & Cauliflower</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Gourd & Drumstick</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Specialty</a>
                                                </li>
                                            </ul>
                                            <div class="category-title-box">
                                                <h5>Organic Vegetables</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Potato & Tomato</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cucumber & Capsicum</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Leafy Vegetables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Root Vegetables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Beans & Okra</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cabbage & Cauliflower</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Gourd & Drumstick</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Specialty</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/cup.svg"
                                            alt="">
                                        <h6>Beverages</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box w-100">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Energy & Soft Drinks</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Soda & Cocktail Mix</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Soda & Cocktail Mix</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Sports & Energy Drinks</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Non Alcoholic Drinks</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Packaged Water</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Spring Water</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Flavoured Water</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/meats.svg"
                                            alt="">
                                        <h6>Meats & Seafood</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Meat</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Fresh Meat</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Frozen Meat</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Marinated Meat</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Fresh & Frozen Meat</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="list-2">
                                            <div class="category-title-box">
                                                <h5>Seafood</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Fresh Water Fish</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Dry Fish</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Frozen Fish & Seafood</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Marine Water Fish</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Canned Seafood</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Prawans & Shrimps</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Other Seafood</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/breakfast.svg"
                                            alt="">
                                        <h6>Breakfast & Dairy</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Breakfast Cereals</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Oats & Porridge</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Kids Cereal</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Muesli</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Flakes</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Granola & Cereal Bars</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Instant Noodles</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Pasta & Macaroni</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Frozen Non-Veg Snacks</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="list-2">
                                            <div class="category-title-box">
                                                <h5>Dairy</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Milk</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Curd</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Paneer, Tofu & Cream</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Butter & Margarine</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Condensed, Powdered Milk</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Buttermilk & Lassi</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Yogurt & Shrikhand</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Flavoured, Soya Milk</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/frozen.svg"
                                            alt="">
                                        <h6>Frozen Foods</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box w-100">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Noodle, Pasta</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Instant Noodles</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Hakka Noodles</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cup Noodles</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Vermicelli</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Instant Pasta</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/biscuit.svg"
                                            alt="">
                                        <h6>Biscuits & Snacks</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Biscuits & Cookies</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Salted Biscuits</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Marie, Health, Digestive</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cream Biscuits & Wafers</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Glucose & Milk Biscuits</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cookies</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="list-2">
                                            <div class="category-title-box">
                                                <h5>Bakery Snacks</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Bread Sticks & Lavash</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Cheese & Garlic Bread</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Puffs, Patties, Sandwiches</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Breadcrumbs & Croutons</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="onhover-category-list">
                                    <a href="javascript:void(0)" class="category-name">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/grocery.svg"
                                            alt="">
                                        <h6>Grocery & Staples</h6>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>

                                    <div class="onhover-category-box">
                                        <div class="list-1">
                                            <div class="category-title-box">
                                                <h5>Grocery</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Lemon, Ginger & Garlic</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Indian & Exotic Herbs</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Vegetables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Fruits</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="list-2">
                                            <div class="category-title-box">
                                                <h5>Organic Staples</h5>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Dry Fruits</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Dals & Pulses</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Millet & Flours</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Sugar, Jaggery</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Masalas & Spices</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Rice, Other Rice</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Flours</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Organic Edible Oil, Ghee</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
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
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('sanphams.danhsach') }}">Sản phẩm</a>

                                            {{-- <ul class="dropdown-menu">
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
                                            </ul> --}}
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('baiviets.danhsach') }}">Bài viết</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="blog-detail.html">Blog
                                                        Detail</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-grid.html">Blog Grid</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-list.html">Blog List</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('huongdans.danhsach') }}">Hướng dẫn</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="blog-detail.html">Blog
                                                        Detail</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-grid.html">Blog Grid</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-list.html">Blog List</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('gioithieu.home') }}">Giới thiệu</a>
                                            <ul class="dropdown-menu">
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
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('lienhe.home') }}">Liên hệ</a>
                                            <ul class="dropdown-menu">
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
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-nav-right">
                        <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                            <i data-feather="zap"></i>
                            <span>Deal Today</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
