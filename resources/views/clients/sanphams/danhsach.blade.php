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

        .category-list-box:hover .name {
            font-weight: bold;
            color: white;
        }

        .product-option {
            list-style: none;
            display: flex;
            justify-content: center;
            /* Căn giữa các biểu tượng */
            align-items: center;
            gap: 10px;
            /* Giảm khoảng cách giữa hai biểu tượng */
            padding: 5px 10px;
            /* Tạo padding hợp lý */
        }

        .product-option li {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            /* Chia đều khoảng cách giữa các mục */
        }

        .product-option a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-option i {
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .product-option a:hover i {
            color: #1abc9c;
        }

        #clearAllFilters {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        #clearAllFilters:hover {
            background: linear-gradient(135deg, #ff4b2b);
            transform: translateY(-3px);
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
                                <div class="selected-filters mt-4 text-center">
                                    <strong class="text-dark fs-4 d-block">Bộ lọc đã chọn</strong>
                                    <div id="selectedFilters" class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                                    </div>
                                    <a href="{{ route('sanphams.danhsach') }}" id="clearAllFilters" style="display: none;">
                                        <i class="fas fa-trash-alt"></i> Bỏ hết
                                    </a>
                                </div>



                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>Danh mục</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">




                                            @if ($danhMucs->isNotEmpty())
                                            <form method="GET" action="{{ route('sanphams.danhsach') }}">
                                                {{-- Giữ lại các tham số khác ngoài "danh_muc_id" --}}
                                                @foreach(request()->except('danh_muc_id') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                                @endforeach
                                            
                                                <ul class="category-list custom-padding custom-height" id="category-list">
                                                    @foreach ($danhMucs as $danhMuc)
                                                        <li>
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input class="checkbox_animated d-none" type="radio"
                                                                    name="danh_muc_id" value="{{ $danhMuc->id }}"
                                                                    id="danhmuc-{{ $danhMuc->id }}"
                                                                    onchange="this.form.submit()"
                                                                    {{ request('danh_muc_id') == $danhMuc->id ? 'checked' : '' }}>
                                            
                                                                <label class="form-check-label" for="danhmuc-{{ $danhMuc->id }}" style="cursor: pointer;">
                                                                    {{ $danhMuc->ten_danh_muc }}
                                                                    <span class="badge bg-success text-white ms-2">
                                                                        {{ $danhMuc->san_phams_count }} sản phẩm
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </form>
                                            
                                            @else
                                                <p>Không có danh mục nào có sản phẩm.</p>
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
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="0-100000" id="price1" data-value="0-100000">
                                                <label class="form-check-label" for="price1">Giá dưới 100.000đ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="100000-200000" id="price2" data-value="100000-200000">
                                                <label class="form-check-label" for="price2">100.000đ - 200.000đ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="200000-300000" id="price3" data-value="200000-300000">
                                                <label class="form-check-label" for="price3">200.000đ - 300.000đ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="300000-500000" id="price4" data-value="300000-500000">
                                                <label class="form-check-label" for="price4">300.000đ - 500.000đ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="500000-1000000" id="price5" data-value="500000-1000000">
                                                <label class="form-check-label" for="price5">500.000đ -
                                                    1.000.000đ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox"
                                                    value="1000000-999999999" id="price6"
                                                    data-value="1000000-999999999">
                                                <label class="form-check-label" for="price6">Giá trên 1.000.000đ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                            <span>Đánh giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <form action="{{ route('sanphams.danhsach') }}" method="GET">
                                                    <!-- Giữ lại các bộ lọc khác -->
                                                    @foreach (request()->except('so_sao') as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach

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

                                                                    <label class="form-check-label"
                                                                        for="so_sao-{{ $i }}"
                                                                        style="cursor: pointer;">
                                                                        <ul class="rating">
                                                                            @for ($j = 1; $j <= 5; $j++)
                                                                                <li>
                                                                                    <i
                                                                                        class="fa fa-star {{ $j <= $i ? 'text-warning' : 'text-secondary' }}"></i>
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

                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive">
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
                                </div> --}}
                                {{-- <div class="d-flex justify-content-center mt-3">
                                    <button id="clearFilters"
                                        class="btn btn-outline-danger px-4 py-2 fw-bold rounded-pill shadow">
                                        <i class="fa fa-times-circle me-2"></i> Xóa bộ lọc
                                    </button>
                                </div> --}}


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
                                        <span>
                                            @php
                                                $sortText = match (request('sort')) {
                                                    'Giá thấp - cao' => 'Giá thấp - cao',
                                                    'Giá cao - thấp' => 'Giá cao - thấp',
                                                    'Giảm giá % cao - thấp' => 'Giảm giá % cao - thấp',
                                                    default => 'Sắp xếp',
                                                };
                                            @endphp
                                            {{ $sortText }}
                                        </span>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ request()->fullUrlWithQuery(['sort' => 'Giá thấp - cao']) }}">Giá
                                                thấp -
                                                cao</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ request()->fullUrlWithQuery(['sort' => 'Giá cao - thấp']) }}">Giá
                                                cao -
                                                thấp</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ request()->fullUrlWithQuery(['sort' => 'Giảm giá % cao - thấp']) }}">Giảm
                                                giá % cao
                                                - thấp</a></li>
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

                    @if ($sanPhams->isEmpty())
                        <div class="text-center mt-4">
                            <h4 style="color: red">Không có sản phẩm nào phù hợp với bộ lọc</h4>
                            <p>Hãy thử thay đổi tiêu chí lọc để tìm kiếm sản phẩm phù hợp.</p>
                        </div>
                    @else
                        <div
                            class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                            @foreach ($sanPhams as $sanPham)
                                <div>
                                    <div class="product-box-3 h-100 wow fadeInUp">
                                        <div class="product-header">
                                            @if ($sanPham->gia_cu > $sanPham->giaThapNhatCuaSP())
                                                <span class="badge bg-danger">
                                                    -{{ $sanPham->phanTramGiamGia() }}%
                                                </span>
                                            @endif
                                            <div class="product-image text-center" style="max-width: 250px;">
                                                <a href="{{ route('sanphams.chitiet', $sanPham->id) }}">
                                                    <img src="{{ Storage::url($sanPham->hinh_anh) }}"
                                                        class="img-fluid rounded shadow-sm"
                                                        alt="{{ $sanPham->ten_san_pham }}">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Xem chi tiết">
                                                        <a
                                                            href="{{ route('sanphams.chitiet', ['id' => $sanPham['id']]) }}">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="#" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                        <form action="{{ route('add.wishlist', $sanPham['id']) }}"
                                                            method="POST" class="wishlist-form">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-detail">
                                                <span
                                                    class="span-name">{{ $sanPham->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</span>
                                                <a href="{{ route('sanphams.chitiet', $sanPham->id) }}">
                                                    <h5 class="name">{{ $sanPham->ten_san_pham }}</h5>
                                                </a>
                                                <p class="text-content mt-1 mb-2 product-content">{{ $sanPham->mo_ta }}
                                                </p>
                                                <div class="product-rating mt-2">
                                                    <ul class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $sanPham->tinhDiemTrungBinh() ? 'fill' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <span>({{ number_format($sanPham->tinhDiemTrungBinh(), 1) }} /
                                                        5)</span>
                                                    <span class="text-muted">({{ $sanPham->soLuongDanhGia() }} đánh
                                                        giá)</span>
                                                </div>
                                                <h5 class="price">

                                                    <span class="theme-color">
                                                        {{ number_format($sanPham->giaThapNhatCuaSP(), 0, ',', '.') }} ₫
                                                    </span>
                                                    <del>{{ number_format($sanPham->gia_cu, 0, ',', '.') }} ₫</del>
                                                    
                                                </h5>
                                                <div class="add-to-cart-box bg-white">
                                                    <button class="btn btn-add-cart addcart-button">
                                                        @if ($sanPham['trang_thai'] == 1)
                                                            <a class="btn-quick-view" style="margin-right: 10px;"
                                                                href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#view" data-id="{{ $sanPham['id'] }}">
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
                                </div>
                            @endforeach
                        </div>
                    @endif


                    @if ($sanPhams->hasPages())
                        <nav class="custom-pagination">
                            <ul class="pagination justify-content-center">
                                {{-- Nút "Trang đầu" --}}
                                <li class="page-item {{ $sanPhams->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $sanPhams->url(1) }}">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </a>
                                </li>

                                {{-- Các trang --}}
                                @foreach ($sanPhams->links()->elements[0] as $page => $url)
                                    <li class="page-item {{ $sanPhams->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Nút "Trang cuối" --}}
                                <li class="page-item {{ $sanPhams->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $sanPhams->url($sanPhams->lastPage()) }}">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const priceFilters = document.querySelectorAll(".price-filter");

            // Lấy khoảng giá từ URL
            const urlParams = new URLSearchParams(window.location.search);
            const selectedPrice = urlParams.get("price_range");

            // Đánh dấu checkbox nếu có giá trị trong URL
            if (selectedPrice) {
                priceFilters.forEach(filter => {
                    if (filter.dataset.value === selectedPrice) {
                        filter.checked = true;
                    }
                });
            }

            // Khi chọn một checkbox, bỏ chọn các checkbox khác và cập nhật URL
            priceFilters.forEach(filter => {
                filter.addEventListener("change", function() {
                    if (this.checked) {
                        // Bỏ chọn tất cả checkbox khác
                        priceFilters.forEach(f => {
                            if (f !== this) f.checked = false;
                        });

                        // Cập nhật URL với giá trị mới
                        urlParams.set("price_range", this.value);
                    } else {
                        // Nếu bỏ chọn thì xóa param
                        urlParams.delete("price_range");
                    }

                    window.location.href = window.location.pathname + "?" + urlParams.toString();
                });
            });
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectedFiltersContainer = document.getElementById("selectedFilters");
            const clearAllFilters = document.getElementById("clearAllFilters");

            function formatCurrencyVND(value) {
                return new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND"
                }).format(value);
            }

            function formatPriceRange(value) {
                let [min, max] = value.split("-").map(Number);
                if (max >= 999999999) {
                    return `Giá trên ${formatCurrencyVND(min)}`;
                }
                if (min === 0) {
                    return `Giá dưới ${formatCurrencyVND(max)}`;
                }
                return `${formatCurrencyVND(min)} - ${formatCurrencyVND(max)}`;
            }

            const filterNames = {
                "danh_muc_id": {
                    "1": "Áo Hoodio",
                    "2": "Thời Trang",
                    "3": "Thể thao",
                    "4": "Áo"
                },
                "so_sao": {
                    "5": "(5 sao)",
                    "4": "(4 sao)",
                    "3": "(3 sao)",
                    "2": "(2 sao)",
                    "1": "(1 sao)"
                }
            };

            function updateSelectedFilters() {
                selectedFiltersContainer.innerHTML = "";
                const urlParams = new URLSearchParams(window.location.search);
                let hasFilter = false;

                urlParams.forEach((value, key) => {
                    let displayName;

                    if (key === "price_range") {
                        displayName = formatPriceRange(value);
                    } else {
                        displayName = filterNames[key] && filterNames[key][value] ? filterNames[key][
                            value] : value;
                    }

                    const filterTag = document.createElement("span");
                    filterTag.className = "badge text-white px-3 py-2 d-flex align-items-center";
                    filterTag.style.backgroundColor = "#17a589";
                    filterTag.innerHTML = `
                <span class="me-2">${displayName}</span>
                <span style="cursor:pointer;" class="ms-2 remove-filter" data-key="${key}">✖</span>
            `;
                    selectedFiltersContainer.appendChild(filterTag);
                    hasFilter = true;
                });

                clearAllFilters.style.display = hasFilter ? "inline-block" : "none";

                document.querySelectorAll(".remove-filter").forEach((btn) => {
                    btn.addEventListener("click", function() {
                        let filterKey = this.getAttribute("data-key");
                        let params = new URLSearchParams(window.location.search);
                        params.delete(filterKey);

                        window.location.href = window.location.pathname + "?" + params.toString();
                    });
                });
            }

            updateSelectedFilters();
        });
    </script>
@endsection
