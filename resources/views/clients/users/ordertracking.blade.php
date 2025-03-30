@extends('layouts.client')
@section('title')
Theo dõi đơn hàng
@endsection

@section('css')

@endsection

@section('content')
<body>


    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="index.html">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="search.html" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="wishlist.html" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="cart.html">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Theo dõi đơn hàng</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.chitiet') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Xem đơn hàng khác</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Order Detail Section Start -->
    <section class="order-detail">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-6">
                    <div class="order-image">
                        <img src="{{ asset('assets/images/box.png') }}" class="img-fluid blur-up lazyload" alt="">
                    </div>
                    <div style="display: flex">
                        @php $trangThai = $donHang->trang_thai_don_hang; @endphp

                        @if ($trangThai == 0 || $trangThai == 1)
                            <form style="margin-left: 10px" id="order-form-{{ $donHang->id }}" action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST" onsubmit="return false;">
                                @csrf
                                <input type="hidden" name="trang_thai" value="-1">
                                <button style="border: none" type="button" class="btn-danger btn-sm confirm-btn"
                                    data-id="{{ $donHang->id }}"
                                    data-action="{{ 'Hủy đơn'}}">
                                    {{ 'Hủy đơn' }}
                                </button>
                            </form>
                        @endif

                        @if ($trangThai == 3 || $trangThai == 4)
                            <form style="margin-left: 10px" id="order-form-{{ $donHang->id }}" action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST" onsubmit="return false;">
                                @csrf
                                <input type="hidden" name="trang_thai" value="5">
                                <button style="border: none" type="button" class="btn-success btn-sm confirm-btn"
                                    data-id="{{ $donHang->id }}"
                                    data-action="{{ 'Trả hàng'  }}">
                                    {{ 'Trả hàng'  }}
                                </button>
                            </form>
                        @endif

                        @if ($trangThai == 3)
                            <form style="margin-left: 10px" id="order-form-{{ $donHang->id }}" action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST" onsubmit="return false;">
                                @csrf
                                <input type="hidden" name="trang_thai" value="4">
                                <button style="border: none" type="button" class="btn-primary btn-sm confirm-btn"
                                    data-id="{{ $donHang->id }}"
                                    data-action="Hoàn thành">
                                    Hoàn thành
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

                <div class="col-xxl-9 col-xl-8 col-lg-6">
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i data-feather="package" class="text-content"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Mã đơn hàng</h5>
                                    <h2 class="theme-color">{{ $donHang->ma_don_hang }}</h2>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="crosshair"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Tổng tiền</h5>
                                    <h4 style="color: #0da487; font-weight: bold">{{ number_format($donHang->tong_tien,0,'','.') }} đ
                                        {{ $checkVoucher ? '(Đã áp dụng mã giảm giá)' : '' }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="map-pin"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Địa chỉ nhận</h5>
                                    <h4 style="color: #0da487; font-weight: bold">{{ $donHang->dia_chi_nguoi_nhan }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="info"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Trạng thái thanh toán</h5>
                                    <h4 style="color: {{ $donHang->trang_thai_thanh_toan == 1 ? '#0da487' : 'red' }}; font-weight: bold " >{{ $donHang->trang_thai_thanh_toan == 1
                                    ? 'Đã thanh toán' : 'Chưa thanh toán' }}</h4>
                                </div>
                            </div>
                        </div>

                        @php
                        $statusText = match($donHang->trang_thai_don_hang) {
                            -1 => 'Hủy Đơn',        // Trạng thái 0 -> Ẩn đơn hàng
                             5 => 'Trả Hàng',  // Trạng thái 1 -> Hoàn trả hàng
                            default => ''
                        };
                        @endphp
                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i data-feather="truck" class=""></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Trạng thái</h5>
                                    <h4 style="color: red; font-weight: bold">{{ $statusText }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="calendar"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Thời gian đặt</h5>
                                    <h4 style="color: #0da487; font-weight: bold">{{ $donHang->created_at }}</h4>
                                </div>
                            </div>
                        </div>

                        @php
                        $statusChart = $donHang->trang_thai_don_hang;
                        @endphp
                        <div class="col-12 overflow-hidden">
                            <ol class="progtrckr">
                                <li class="progtrckr-{{ $statusChart >= 0 ? 'done' : 'todo' }}">
                                    <h5>Chờ xác nhận</h5>
                                </li>
                                <li class="progtrckr-{{ $statusChart >= 1 ? 'done' : 'todo' }}">
                                    <h5>Đang xử lý</h5>
                                </li>
                                <li class="progtrckr-{{ $statusChart >= 2 ? 'done' : 'todo' }}">
                                    <h5>Đang giao</h5>
                                </li>
                                <li class="progtrckr-{{ $statusChart >= 3 ? 'done' : 'todo' }}">
                                    <h5>Đã giao</h5>
                                </li>
                                <li class="progtrckr-{{ $statusChart >= 4 ? 'done' : 'todo' }}">
                                    <h5>Hoàn thành</h5>
                                </li>
                                {{-- <li class="progtrckr-todo">
                                    <h5>Shipped</h5>
                                    <h6>Pending</h6>
                                </li>
                                <li class="progtrckr-todo">
                                    <h5>Delivered</h5>
                                    <h6>Pending</h6>
                                </li> --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Detail Section End -->

    <!-- Order Table Section Start -->
    <section class="order-table-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table order-tab-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bienThesList as $index => $item)
                                <tr>
                                    <td style="line-height: 126px">{{ $index++ }}</td>
                                    <td>
                                        <img style="width: 100px; height: 100px" src="{{ Storage::url($item['anh_bien_the']) }}" alt="">
                                    </td>
                                    <td style="line-height: 126px">
                                        <a href="{{ route('sanphams.chitiet',$item['id_san_pham']) }}">
                                        {{ $item['ten_bien_the'] }}
                                        </a>
                                    </td>
                                    <td style="color: #0da487;line-height: 126px">{{ number_format($item['gia_ban'],0,'','.') }} đ</td>
                                    <td style="line-height: 126px">{{ $item['so_luong'] }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $bienThesPaginated->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Table Section End -->


    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Deal Box Modal Start -->
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="{{ asset('assets/images/box.png') }}" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-2">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/11.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-3">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/12.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/13.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection


@section('js')

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".confirm-btn").forEach(button => {
            button.addEventListener("click", function () {
                let orderId = this.dataset.id;
                let actionText = this.dataset.action;
                Swal.fire({
                    title: `Bạn có chắc muốn ${actionText.toLowerCase()} không?`,
                    text: "Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, tiếp tục!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('order-form-' + orderId).submit();
                    }
                });
            });
        });
    });
</script>
