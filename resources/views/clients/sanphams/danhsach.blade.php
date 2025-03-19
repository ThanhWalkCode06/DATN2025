@extends('layouts.client')

@section('title')
    Sản phẩm
@endsection

@section('css')
<style>
    .category-list-box {
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        padding: 5px;
    }

    .category-list-box:hover {
        background-color: #17a589;
        transform: scale(1.05);
        cursor: pointer;
    }

    /* Làm chữ trắng khi hover */
    .category-list-box:hover .name {
        font-weight: bold;
        color: white;
    }
</style>
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Sản phẩm</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('sanphams.danhsach') }}">
                                        <i class="fa-solid fa-box"></i>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Category Section Start -->
    {{-- <section class="wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 no-space shop-box no-arrow">
                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/vegetable.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Vegetables & Fruit</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/cup.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Beverages</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/meats.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Meats & Seafood</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/breakfast.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Breakfast</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/frozen.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Frozen Foods</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/milk.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Milk & Dairies</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/pet.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Pet Food</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/biscuit.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Biscuits & Snacks</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="shop-category-box">
                                <a href="shop-left-sidebar.html">
                                    <div class="shop-category-image">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/grocery.svg"
                                            class="blur-up lazyload" alt="">
                                    </div>
                                    <div class="category-box-name">
                                        <h6>Grocery & Staples</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Category Section End -->

    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-3 wow fadeInUp">
                    <div class="left-box">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>


                            <div class="accordion custom-accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>Danh mục</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">




                                            @if (isset($danhMucs) && count($danhMucs) > 0)
                                                <form method="GET" action="{{ route('sanphams.danhsach') }}">
                                                    <ul class="category-list custom-padding custom-height" id="category-list">
                                                        @foreach ($danhMucs as $danhMuc)
                                                            @if ($danhMuc->san_phams_count > 0)
                                                                <li>
                                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                                        <input class="checkbox_animated d-none" type="radio"
                                                                            name="danh_muc_id" value="{{ $danhMuc->id }}"
                                                                            id="danhmuc-{{ $danhMuc->id }}"
                                                                            onchange="this.form.submit()"
                                                                            {{ request('danh_muc_id') == $danhMuc->id ? 'checked' : '' }}>

                                                                        <label class="form-check-label" for="danhmuc-{{ $danhMuc->id }}">
                                                                            <span class="name">{{ $danhMuc->ten_danh_muc }}
                                                                                ({{ $danhMuc->san_phams_count }})</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </form>
                                            @endif






                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree">
                                            <span>Giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="range-slider">
                                                <input type="text" class="js-range-slider" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix">
                                            <span>Đánh giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <form action="{{ route('sanphams.danhsach') }}" method="GET">
                                                    <!-- Bộ lọc đánh giá -->
                                                    <ul>
                                                        @foreach ([5, 4, 3, 2, 1] as $i)
                                                            <li>
                                                                <div class="form-check ps-0 m-0 category-list-box">
                                                                    <input class="checkbox_animated d-none" type="radio"
                                                                        name="so_sao" value="{{ $i }}"
                                                                        id="so_sao-{{ $i }}"
                                                                        onchange="this.form.submit()"
                                                                        {{ request('so_sao') == $i ? 'checked' : '' }}>

                                                                    <label class="form-check-label" for="so_sao-{{ $i }}" style="cursor: pointer;">
                                                                        <ul class="rating">
                                                                            @for ($j = 1; $j <= 5; $j++)
                                                                                <li>
                                                                                    <i class="fa fa-star {{ $j <= $i ? 'text-warning' : 'text-secondary' }}"></i>
                                                                                </li>
                                                                            @endfor
                                                                        </ul>
                                                                        <span class="text-content">
                                                                            ({{ $i == 5 ? '5 sao' : $i . '.0 - ' . $i . '.9 sao' }})
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </form>





                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour">
                                            <span>Giảm giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <span class="name">upto 5%</span>
                                                            <span class="number">(06)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                            <span>Kích cỡ & Màu sắc</span>
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault5">
                                                        <label class="form-check-label" for="flexCheckDefault5">
                                                            <span class="name">400 to 500 g</span>
                                                            <span class="number">(05)</span>
                                                        </label>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-custom- wow fadeInUp">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Sắp xếp theo :</h5>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown">
                                        <span>Sản phẩm bán chạy</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="pop" href="javascript:void(0)">Sản phẩm
                                                bán chạy</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="low" href="javascript:void(0)">Giá thấp -
                                                cao</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="high" href="javascript:void(0)">Giá cao -
                                                thấp</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="rating" href="javascript:void(0)">Đánh giá
                                                cao - thấp</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="aToz" href="javascript:void(0)">Thứ tự từ A
                                                - Z
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="zToa" href="javascript:void(0)">Thứ tự từ Z
                                                - A</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="off" href="javascript:void(0)">Giảm giá %
                                                từ cao - thấp</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-3.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/list.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                        @foreach ($sanPhams as $item =>$sanpham)
                        <div>
                            <div class="product-box-3 h-100 wow fadeInUp">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="{{ route('sanphams.chitiet', $sanpham->id) }}">
                                            <img src="../assets/images/cake/product/2.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Vegetable</span>
                                        <a href="{{ route('sanphams.chitiet',  $sanpham->id) }}">
                                            <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                        </a>
                                        <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin brie.
                                            Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                            cheese macaroni cheese croque monsieur.</p>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="compare.html">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <div class="product-footer">
                                        <div class="product-detail">
                                            <span
                                                class="span-name">{{ $sanPham->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</span>
                                            <a href="{{ route('sanphams.chitiet', $sanPham->id) }}">
                                                <h5 class="name">{{ $sanPham->ten_san_pham }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{ $sanPham->mo_ta }}</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            <i data-feather="star"
                                                                class="{{ $i <= $sanPham->tinhDiemTrungBinh() ? 'fill' : '' }}"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                <span>({{ number_format($sanPham->tinhDiemTrungBinh(), 1) }} / 5)</span>
                                                <span class="text-muted">({{ $sanPham->soLuongDanhGia() }} đánh
                                                    giá)</span>
                                            </div>

                                            <h5 class="price">
                                                <span
                                                    class="theme-color">{{ number_format($sanPham->gia_moi, 0, ',', '.') }}
                                                    VNĐ</span>
                                                <del>{{ number_format($sanPham->gia_cu, 0, ',', '.') }} VNĐ</del>

                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <button class="btn btn-add-cart addcart-button">
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </span> Thêm vào giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach

                    </div>



                    <nav class="custom-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                    <i class="fa-solid fa-angles-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection

@section('js')
@endsection
