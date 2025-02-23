@extends('layouts.admin')

@section('title')
    Đơn hàng
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header title-header-block package-card">
                    <div>
                        <h5>Đơn hàng #{{ $donHang->ma_don_hang }}</h5>
                    </div>
                    <div class="card-order-section">
                        <ul>
                            <li>{{ $donHang->created_at }}</li>
                            <li>{{ count($chiTietDonHangs) }} sản phẩm</li>
                        </ul>
                    </div>
                </div>
                <div class="bg-inner cart-section order-details-table">
                    <div class="row g-4">
                        <div class="col-xl-8">
                            <div class="table-responsive table-details">
                                <table class="table cart-table table-borderless">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Sản phẩm</th>
                                            <th class="text-end" colspan="2">
                                                <a href="javascript:void(0)" class="theme-color"></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($chiTietDonHangs as $chiTietDonHang)
                                            <tr class="table-order">
                                                <td>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('assets/images/profile/3.jpg') }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <p>Tên sản phẩm</p>
                                                    <h5>{{ $chiTietDonHang->ten_bien_the }}</h5>
                                                </td>
                                                <td>
                                                    <p>Số lượng</p>
                                                    <h5>{{ $chiTietDonHang->so_luong }}</h5>
                                                </td>
                                                <td>
                                                    <p>Giá</p>
                                                    <h5>{{ $chiTietDonHang->gia_ban }}đ</h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Tổng giá trị :</h5>
                                            </td>
                                            <td>
                                                <h4>$55.00</h4>
                                            </td>
                                        </tr>

                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Phí vận chuyển :</h5>
                                            </td>
                                            <td>
                                                <h4>$12.00</h4>
                                            </td>
                                        </tr>

                                        {{-- <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Tax(GST) :</h5>
                                            </td>
                                            <td>
                                                <h4>$10.00</h4>
                                            </td>
                                        </tr> --}}

                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h4 class="theme-color fw-bold">Tổng tiền :</h4>
                                            </td>
                                            <td>
                                                <h4 class="theme-color fw-bold">{{ $donHang->tong_tien }}đ</h4>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="order-success">
                                <div class="row g-4">
                                    <h4>Thông tin đơn hàng</h4>
                                    <ul class="order-details">
                                        <li>Mã đơn hàng: {{ $donHang->ma_don_hang }}</li>
                                        <li>Người đặt: {{ $donHang->name }}</li>
                                        <li>Ngày đặt hàng: {{ $donHang->created_at }}</li>
                                        <li>Tổng tiền: {{ $donHang->tong_tien }}</li>
                                        <li>Hình thức thanh toán: {{ $donHang->ten_phuong_thuc }}</li>
                                    </ul>

                                    <h4>Địa chỉ giao hàng</h4>
                                    <ul class="order-details">
                                        <li>{{ $donHang->ten_nguoi_nhan }}</li>
                                        <li>{{ $donHang->sdt_nguoi_nhan }}</li>
                                        <li>{{ $donHang->dia_chi_nguoi_nhan }}</li>
                                    </ul>

                                    {{-- <div class="payment-mode">
                                        <h4>Hình thức thanh toán</h4>
                                        <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                            available. Card/Net banking acceptance subject to device
                                            availability.</p>
                                    </div> --}}

                                    {{-- <div class="delivery-sec">
                                        <h3>Ngày nhận hàng dự kiến: <span>10/01/2025</span>
                                        </h3>
                                        <a href="order-tracking.html">track order</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section end -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endsection
