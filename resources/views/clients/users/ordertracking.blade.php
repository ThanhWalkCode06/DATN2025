@extends('layouts.client')
@section('title')
    Theo dõi đơn hàng
@endsection

@section('css')
    <style>
        .rating i {
            font-size: 24px;
            cursor: pointer;
            color: #ccc;
        }

        .rating i.selected {
            color: #f39c12;
        }

        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .product-wrapper {
            /* display: flex; */
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .product-image img {
            width: 500px !important;
            height: 300px !important;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .product-content .name {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .product-review-rating {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 5px;
        }

        .product-rating {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: left;
            gap: 5px;
        }

        .theme-color {
            color: #009970;
            font-weight: bold;
            font-size: 16px;
        }

        .review-box {
            margin: 15px 0;
        }

        .review-box label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
            padding: 15px 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-theme-outline {
            border: 1px solid #1abc9c;
            color: #1abc9c;
            background: transparent;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .theme-bg-color {
            background: #1abc9c;
            color: #fff;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
            border: none;
        }

        .upload-box {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .upload-box:hover {
            background-color: #f8f9fa;
        }

        .upload-label {
            display: block;
            cursor: pointer;
            text-align: center;
        }

        .upload-label i {
            font-size: 2rem;
        }

        .upload-label p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .d-none {
            display: none !important;
        }

        .image-preview img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
            position: relative;
        }

        .image-preview .preview-item {
            position: relative;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4d4f;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            cursor: pointer;
            font-size: 12px;
        }

        .video-preview video {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .video-preview .preview-item {
            position: relative;
        }

        .video-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4d4f;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            cursor: pointer;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            background-color: #1abc9c;
            border-color: #1abc9c;
        }

        .pagination .page-link:hover {
            background-color: #e9f7f4;
            border-color: #1abc9c;
        }
    </style>
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
                                    <li class="breadcrumb-item active">Xem đơn hàng khác</li>
                                    </a>
                                    </li>

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
                            <img src="{{ asset('assets/images/box.png') }}" class="img-fluid blur-up lazyload"
                                alt="">
                        </div>
                        <div style="display: flex">
                            @php $trangThai = $donHang->trang_thai_don_hang; @endphp

                            @if ($trangThai == 0 || $trangThai == 1)
                                <form id="cancel-form-{{ $donHang->id }}"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST"
                                    onsubmit="return false;">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="-1">
                                    <button style="border: none" type="button" class="btn-danger btn-sm confirm-btn"
                                        data-form-id="cancel-form-{{ $donHang->id }}" data-title="Nhập lý do hủy đơn"
                                        data-trang-thai="-1" data-action="Hủy đơn">
                                        Hủy đơn
                                    </button>
                                </form>
                            @endif

                            {{-- TRẢ HÀNG --}}
                            @if ($trangThai == 3)
                                <form style="margin-left: 10px" id="return-form-{{ $donHang->id }}"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST"
                                    onsubmit="return false;">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="5">
                                    <button style="border: none" type="button" class="btn-success btn-sm confirm-btn"
                                        data-form-id="return-form-{{ $donHang->id }}" data-title="Nhập lý do trả hàng"
                                        data-trang-thai="5" data-action="Trả hàng">
                                        Trả hàng
                                    </button>
                                </form>
                            @endif

                            @if ($trangThai == 3)
                                <form id="formXacNhan" style="margin-left: 10px"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="4">
                                    <button style="border: none" type="button" class="btn-primary btn-sm" id="xacNhanDon">
                                        Đã nhận hàng
                                    </button>
                                </form>
                            @endif
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="lyDoModal" tabindex="-1" aria-labelledby="lyDoModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form style="margin-top: 25% !important" id="ly-do-form" method="POST"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}">
                                    @csrf
                                    <input type="hidden" name="trang_thai" id="modal-trang-thai">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lyDoModalLabel">Nhập lý do</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="form-control" name="ly_do" id="modal-ly-do" rows="4" placeholder="Nhập lý do tại đây..." maxlength="255"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button style="border:none" type="button" class="btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button style="border:none" type="submit" class="btn-primary btn-sm">Xác
                                                nhận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                        <h4 class="theme-color fw-bold">
                                            {{ $donHang->ma_don_hang }}
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="credit-card"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Tổng tiền</h5>
                                        <h4 class="theme-color fw-bold">
                                            {{ number_format($donHang->tong_tien, 0, '', '.') }} đ
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="gift"></i>
                                    </div>

                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($bienThesList as $chiTietDonHang)
                                        @php
                                            $total += $chiTietDonHang['gia_ban'] * $chiTietDonHang['so_luong'];
                                        @endphp
                                    @endforeach
                                    @php
                                        $countPrice = 0;
                                        $countPrice = $total - $donHang->tong_tien + 10000;
                                    @endphp

                                    <div class="order-details-name">
                                        <h5 class="text-content">Phiếu giảm giá áp dụng</h5>
                                        <h5 style="color: #0da487; font-weight: bold">
                                            @if (!empty($checkVoucher))
                                                <span>Mã phiếu: {{ $checkVoucher->phieuGiamGia->ma_phieu ?? '' }}</span>
                                                <span>Giá trị:
                                                    {{ '-' . $checkVoucher->phieuGiamGia->gia_tri . '%' ?? '' }}</span>
                                                <br>
                                                <span>{{ $checkVoucher ? 'Đã giảm ' . number_format($countPrice, 0, '', '.') . ' đ' : '' }}</span>
                                            @else
                                                <h4 class="theme-color fw-bold">Không</h4>
                                            @endif
                                        </h5>
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
                                        <h4 style="color: #0da487; font-weight: bold">{{ $donHang->dia_chi_nguoi_nhan }}
                                        </h4>
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
                                        @if ($donHang->trang_thai_thanh_toan == 0)
                                            <h4 class="text-danger fw-bold">
                                                Chưa thanh toán
                                            </h4>
                                        @elseif ($donHang->trang_thai_thanh_toan == 1)
                                            <h4 class="theme-color fw-bold">
                                                Đã thanh toán
                                            </h4>
                                        @else
                                            <h4 class="theme-color fw-bold">
                                                Đã hoàn tiền
                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @php
                                $statusText = match ($donHang->trang_thai_don_hang) {
                                    -1 => 'Hủy Đơn', // Trạng thái 0 -> Ẩn đơn hàng
                                    5 => 'Trả Hàng', // Trạng thái 1 -> Hoàn trả hàng
                                    default => '',
                                };
                            @endphp
                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="truck" class=""></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Trạng thái</h5>
                                        <h4 class="fw-bold">
                                            @if ($donHang->trang_thai_don_hang == -1)
                                                <span class="text-danger">Đã hủy</span>
                                            @elseif ($donHang->trang_thai_don_hang == 0)
                                                <span class="text-danger">Chờ xác nhận</span>
                                            @elseif ($donHang->trang_thai_don_hang == 1)
                                                <span class="text-primary">Đang xử lý</span>
                                            @elseif ($donHang->trang_thai_don_hang == 2)
                                                <span class="text-primary">Đang giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 3)
                                                <span class="theme-color">Đã giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 4)
                                                <span class="theme-color">Hoàn thành</span>
                                            @elseif ($donHang->trang_thai_don_hang == 5)
                                                <span class="text-danger">Trả hàng</span>
                                            @else
                                                <span>Trạng thái không hợp lệ</span>
                                            @endif
                                        </h4>
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
                                    @if ($donHang->trang_thai_don_hang >= 1)
                                        <li class="progtrckr-done">
                                        @else
                                        <li class="progtrckr-todo">
                                    @endif
                                    <h5>Đang xử lý</h5>
                                    <h6>
                                        @php
                                            $check = false;
                                        @endphp
                                        @foreach ($lichSuDonHangs as $lichSuDonHang)
                                            @if ($lichSuDonHang->trang_thai == 1)
                                                {{ $lichSuDonHang->created_at }}
                                                @php
                                                    $check = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($check == false)
                                            Chưa xử lý
                                        @endif
                                    </h6>
                                    </li>

                                    @if ($donHang->trang_thai_don_hang >= 2)
                                        <li class="progtrckr-done">
                                        @else
                                        <li class="progtrckr-todo">
                                    @endif
                                    <h5>Đang giao</h5>
                                    <h6>
                                        @php
                                            $check = false;
                                        @endphp
                                        @foreach ($lichSuDonHangs as $lichSuDonHang)
                                            @if ($lichSuDonHang->trang_thai == 2)
                                                {{ $lichSuDonHang->created_at }}
                                                @php
                                                    $check = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($check == false)
                                            Chưa xử lý
                                        @endif
                                    </h6>
                                    </li>

                                    @if ($donHang->trang_thai_don_hang >= 3)
                                        <li class="progtrckr-done">
                                        @else
                                        <li class="progtrckr-todo">
                                    @endif
                                    <h5>Đã giao</h5>
                                    <h6>
                                        @php
                                            $check = false;
                                        @endphp
                                        @foreach ($lichSuDonHangs as $lichSuDonHang)
                                            @if ($lichSuDonHang->trang_thai == 3)
                                                {{ $lichSuDonHang->created_at }}
                                                @php
                                                    $check = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($check == false)
                                            Chưa xử lý
                                        @endif
                                    </h6>
                                    </li>

                                    @if ($donHang->trang_thai_don_hang == 5)
                                        <li class="progtrckr-done">
                                            <h5>Trả hàng</h5>
                                            <h6>
                                                @php
                                                    $check = false;
                                                @endphp
                                                @foreach ($lichSuDonHangs as $lichSuDonHang)
                                                    @if ($lichSuDonHang->trang_thai == 5)
                                                        {{ $lichSuDonHang->created_at }}
                                                        @php
                                                            $check = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($check == false)
                                                    Chưa xử lý
                                                @endif
                                            </h6>
                                        </li>
                                    @endif

                                    @if ($donHang->trang_thai_don_hang != 5)
                                        @if ($donHang->trang_thai_don_hang == 4)
                                            <li class="progtrckr-done">
                                            @else
                                            <li class="progtrckr-todo">
                                        @endif
                                        <h5>Hoàn thành</h5>
                                        <h6>
                                            @php
                                                $check = false;
                                            @endphp
                                            @foreach ($lichSuDonHangs as $lichSuDonHang)
                                                @if ($lichSuDonHang->trang_thai == 4)
                                                    {{ $lichSuDonHang->created_at }}
                                                    @php
                                                        $check = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($check == false)
                                                Chưa xử lý
                                            @endif
                                        </h6>
                                        </li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Order Detail Section End -->

        <!-- Order Table Section Start -->
        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Thành công!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        @if (session('error_binhluan'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "{{ session('error_binhluan') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif
        <section class="order-table-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table order-tab-table align-middle">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Số lượng</th>
                                        @if ($statusChart == 4)
                                            <th>Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bienThesList as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 + ($bienThesPaginated->currentPage() - 1) * $bienThesPaginated->perPage() }}
                                            </td>
                                            <td>
                                                <img style="width: 100px;"
                                                    src="{{ Storage::url($item['anh_bien_the']) }}" alt="">
                                            </td>
                                            <td>
                                                <a href="{{ route('sanphams.chitiet', $item['id_san_pham']) }}">
                                                    {{ $item['ten_bien_the'] }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ number_format($item['gia_ban'], 0, '', '.') }} đ</td>
                                            <td>{{ $item['so_luong'] }}</td>
                                            @if ($statusChart == 4)
                                                <td>
                                                    <button type="button" class="btn-primary btn-sm btn-review-product"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#reviewModal{{ $item['bien_the_id'] }}"
                                                        data-product-id="{{ $item['id_san_pham'] }}"
                                                        data-variant-id="{{ $item['bien_the_id'] }}"
                                                        data-product-name="{{ $item['ten_bien_the'] }}"
                                                        data-product-image="{{ Storage::url($item['anh_bien_the']) }}">
                                                        Đánh giá sản phẩm
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-area mt-3">
                                {{ $bienThesPaginated->links('vendor.pagination.bootstrap-5') }}
                            </div>
                            {{-- <div class="pagination-wrapper">
                                {{ $bienThesPaginated->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Order Table Section End -->

        <!-- Review Modal -->
        <!-- Modified Review Modal Upload Section -->
        @foreach ($bienThesList as $item)
            <div class="modal fade theme-modal" id="reviewModal{{ $item['bien_the_id'] }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Viết đánh giá sản phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <form class="review-form" method="POST" action="{{ route('sanphams.themdanhgiadonhang') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="san_pham_id" value="{{ $item['id_san_pham'] }}">
                                <input type="hidden" name="bien_the_id" value="{{ $item['bien_the_id'] }}">
                                <input type="hidden" name="don_hang_id" value="{{ $donHang->id }}">
                                <!-- Thêm don_hang_id -->
                                <input type="hidden" name="so_sao" class="so_sao" value="5">

                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img src="{{ Storage::url($item['anh_bien_the']) }}"
                                            class="img-fluid rounded shadow-sm" style="width:100%; height:100%;"
                                            alt="{{ $item['ten_bien_the'] }}">
                                    </div>
                                    <br>
                                    <div class="product-content">
                                        <h5 class="name">Sản phẩm: {{ $item['ten_bien_the'] }}</h5>
                                    </div>
                                </div>

                                <div class="review-box mt-3">
                                    <label>Đánh giá của bạn *</label>
                                    <div class="rating" data-variant-id="{{ $item['bien_the_id'] }}">
                                        <i class="fa fa-star selected" data-value="1"></i>
                                        <i class="fa fa-star selected" data-value="2"></i>
                                        <i class="fa fa-star selected" data-value="3"></i>
                                        <i class="fa fa-star selected" data-value="4"></i>
                                        <i class="fa fa-star selected" data-value="5"></i>
                                    </div>
                                </div>

                                <div class="review-box">
                                    <label for="nhan_xet_{{ $item['bien_the_id'] }}" class="form-label">Nhận xét của bạn
                                        *</label>
                                    <textarea id="nhan_xet_{{ $item['bien_the_id'] }}" name="nhan_xet" rows="3" class="form-control"
                                        placeholder="Viết nhận xét của bạn..." maxlength="50"></textarea>
                                </div>

                                <div class="review-box d-flex gap-3 align-items-start">
                                    <!-- Image Upload -->
                                    <div class="upload-box text-center">
                                        <label for="hinh_anh_{{ $item['bien_the_id'] }}" class="upload-label">
                                            <i class="fa-solid fa-image fa-2x" style="color: #1abc9c;"></i>
                                            <p class="mt-2">Tải ảnh (tối đa 5)</p>
                                        </label>
                                        <input type="file" id="hinh_anh_{{ $item['bien_the_id'] }}"
                                            name="hinh_anh_danh_gia[]" class="d-none"
                                            accept="image/jpeg,image/png,image/jpg,image/gif" multiple>

                                        <div class="image-preview mt-2 d-flex flex-wrap gap-2"
                                            id="image-preview-{{ $item['bien_the_id'] }}"></div>
                                    </div>

                                    <!-- Video Upload -->
                                    <div class="upload-box text-center">
                                        <label for="video_{{ $item['bien_the_id'] }}" class="upload-label">
                                            <i class="fa-solid fa-video fa-2x" style="color: #1abc9c;"></i>
                                            <p class="mt-2">Tải video (tối đa 1)</p>
                                        </label>
                                        <input type="file" id="video_{{ $item['bien_the_id'] }}" name="video"
                                            class="d-none" accept="video/mp4,video/mpeg,video/quicktime">

                                        <div class="video-preview mt-2" id="video-preview-{{ $item['bien_the_id'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit"
                                        class="btn btn-md fw-bold text-light theme-bg-color">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- End Review Modal -->
    </body>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($bienThesList as $item)
                const input{{ $item['bien_the_id'] }} = document.getElementById(
                    'hinh_anh_{{ $item['bien_the_id'] }}');
                const preview{{ $item['bien_the_id'] }} = document.getElementById(
                    'image-preview-{{ $item['bien_the_id'] }}');

                let selectedFiles{{ $item['bien_the_id'] }} = [];

                input{{ $item['bien_the_id'] }}.addEventListener('change', function(event) {
                    const files = Array.from(event.target.files);

                    if ((selectedFiles{{ $item['bien_the_id'] }}.length + files.length) > 5) {
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Bạn chỉ được tải lên tối đa 5 hình ảnh!",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                        input{{ $item['bien_the_id'] }}.value = '';
                        return;
                    }

                    files.forEach((file, index) => {
                        if (!file.type.startsWith('image/')) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: `File ${file.name} không phải là hình ảnh hợp lệ!`,
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                            return;
                        }
                        if (file.size > 2 * 1024 * 1024) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: `File ${file.name} vượt quá 2MB!`,
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                            return;
                        }

                        selectedFiles{{ $item['bien_the_id'] }}.push(file);

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.classList.add('preview-item');
                            previewItem.style.position = 'relative';
                            previewItem.innerHTML = `
                            <img src="${e.target.result}" style="width:80px;height:80px;object-fit:cover;border-radius:5px;box-shadow:0 2px 5px rgba(0,0,0,0.1);">
                            <span class="remove-btn" style="position:absolute;top:-8px;right:-8px;background:red;color:white;border-radius:50%;padding:2px 6px;cursor:pointer;font-size:12px;">×</span>
                        `;
                            preview{{ $item['bien_the_id'] }}.appendChild(previewItem);

                            // Xử lý khi nhấn nút xóa
                            previewItem.querySelector('.remove-btn').addEventListener('click',
                                function() {
                                    const indexToRemove = Array.from(
                                            preview{{ $item['bien_the_id'] }}.children)
                                        .indexOf(previewItem);
                                    selectedFiles{{ $item['bien_the_id'] }}.splice(
                                        indexToRemove, 1);
                                    previewItem.remove();
                                    updateInputFiles{{ $item['bien_the_id'] }}();
                                });
                        };
                        reader.readAsDataURL(file);
                    });

                    updateInputFiles{{ $item['bien_the_id'] }}();
                });

                function updateInputFiles{{ $item['bien_the_id'] }}() {
                    const dataTransfer = new DataTransfer();
                    selectedFiles{{ $item['bien_the_id'] }}.forEach(file => {
                        dataTransfer.items.add(file);
                    });
                    input{{ $item['bien_the_id'] }}.files = dataTransfer.files;
                }
            @endforeach
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('textarea[name="nhan_xet"]').forEach(textarea => {
                const maxLength = 50;
                const charCount = document.createElement('div');
                charCount.className = 'char-count';
                charCount.style.fontSize = '12px';
                charCount.style.color = '#666';
                textarea.parentNode.appendChild(charCount);
                charCount.textContent = `Còn lại ${maxLength - textarea.value.length} ký tự`;

                textarea.addEventListener('input', function() {
                    const remaining = maxLength - this.value.length;
                    charCount.textContent = `Còn lại ${remaining} ký tự`;
                    if (remaining < 0) {
                        this.value = this.value.substring(0, maxLength);
                        charCount.textContent = `Còn lại 0 ký tự`;
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Script rating hiện tại (giữ nguyên)
            document.querySelectorAll('.rating').forEach(ratingContainer => {
                const stars = ratingContainer.querySelectorAll('i');
                const soSaoInput = ratingContainer.closest('form').querySelector('.so_sao');

                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-value');
                        soSaoInput.value = rating;

                        stars.forEach(s => {
                            if (s.getAttribute('data-value') <= rating) {
                                s.classList.add('selected');
                            } else {
                                s.classList.remove('selected');
                            }
                        });
                    });
                });
            });

            // Xử lý preview video (giữ nguyên)
            document.querySelectorAll('input[type="file"][name="video"]').forEach(input => {
                input.addEventListener('change', function() {
                    const previewContainer = document.getElementById(
                        `video-preview-${this.id.split('_')[1]}`);
                    previewContainer.innerHTML = ''; // Xóa preview trước đó

                    const file = this.files[0];
                    if (file) {
                        if (!file.type.match('video/mp4|video/mpeg|video/quicktime') || file.size >
                            20 * 1024 * 1024) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: "Video phải là mp4, mpeg, quicktime và dưới 20MB!",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                            this.value = '';
                            return;
                        }

                        const video = document.createElement('video');
                        video.src = URL.createObjectURL(file);
                        video.onloadedmetadata = function() {
                            if (video.duration < 3 || video.duration > 60) {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Video phải từ 3 đến 60 giây!",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                                input.value = '';
                                URL.revokeObjectURL(video.src);
                                return;
                            }

                            const previewItem = document.createElement('div');
                            previewItem.classList.add('preview-item');
                            previewItem.innerHTML = `
                                    <video src="${video.src}" controls></video>
                                    <span class="remove-btn">×</span>
                                `;
                            previewContainer.appendChild(previewItem);

                            // Xóa video khi nhấn nút remove
                            previewItem.querySelector('.remove-btn').addEventListener('click',
                                function() {
                                    previewItem.remove();
                                    input.value = '';
                                });

                            URL.revokeObjectURL(video.src);
                        };
                    }
                });
            });
        });
    </script>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let btnxacNhan = document.querySelector("#xacNhanDon");
        btnxacNhan.addEventListener("click", function() {
            Swal.fire({
                title: `Bạn đã nhận được hàng chưa ?`,
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tôi đã nhận được",
                cancelButtonText: "Chưa"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formXacNhan').submit();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentForm = null;

        document.querySelectorAll('.confirm-btn').forEach(button => {
            button.addEventListener('click', function() {
                const formId = this.dataset.formId;
                const title = this.dataset.title;
                const trangThai = this.dataset.trangThai;

                currentForm = document.getElementById(formId);
                document.getElementById('lyDoModalLabel').textContent = title;
                document.getElementById('modal-trang-thai').value = trangThai;
                document.getElementById('modal-ly-do').value = '';

                const modal = new bootstrap.Modal(document.getElementById('lyDoModal'));
                modal.show();
            });
        });

        document.getElementById('ly-do-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const lyDo = document.getElementById('modal-ly-do').value.trim();
            const trangThai = document.getElementById('modal-trang-thai').value;

            if (!lyDo) {
                Swal.fire("Lỗi", "Vui lòng nhập lý do!", "error");
                return;
            }

            // Cập nhật trạng thái nếu form có sẵn input hidden
            const trangThaiInput = currentForm.querySelector('input[name="trang_thai"]');
            if (trangThaiInput) {
                trangThaiInput.value = trangThai;
            }

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'ly_do';
            hiddenInput.value = lyDo;
            currentForm.appendChild(hiddenInput);

            currentForm.submit();
        });
    });
</script>
{{-- <script>
    const textarea = document.getElementById('modal-ly-do');
    const charCount = document.getElementById('char-count');

    textarea.addEventListener('input', () => {
        const remaining = 255 - textarea.value.length;
        charCount.textContent = `Còn lại: ${remaining} ký tự`;
    });
</script> --}}
