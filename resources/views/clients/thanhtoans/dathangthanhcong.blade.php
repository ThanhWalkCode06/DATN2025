@extends('layouts.client')

@section('title')
    Seven Stars
@endsection

@section('css')
@endsection

@section('breadcrumb')
    {{-- @php
    dd( $chiTietDonHangs);
@endphp --}}

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain breadcrumb-order">
                        <div class="order-box">
                            <div class="order-image">
                                <div class="checkmark">
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <div class="order-contain">
                                <h3 class="theme-color">Đặt hàng thành công</h3>
                                <h5 class="text-content">Đơn hàng của bạn đang được xử lý</h5>
                                <h6>Mã đơn hàng: {{ $donHang->ma_don_hang }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
@endsection

@section('content')
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-lg-8">
                    <div class="cart-table order-table order-table-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @php
                                        // dd($chiTietDonHangs,$donHang);
                                    @endphp

                                    @foreach ($chiTietDonHangs as $chiTietDonHang)
                                        <tr>
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <div>
                                                        <h4 class="table-title text-content">Ảnh Sản Phẩm</h4>
                                                        <a href="{{ route('sanphams.chitiet', $chiTietDonHang->bienThe->sanPham->id) }}"
                                                            class="product-image">
                                                            <img width="100px"
                                                                src="{{ Storage::url($chiTietDonHang->bienThe->anh_bien_the) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h4 class="table-title text-content">Tên sản phẩm</h4>
                                                        <ul>
                                                            <li class="name">
                                                                <a
                                                                    href="{{ route('sanphams.chitiet', $chiTietDonHang->bienThe->sanPham->id) }}">{{ $chiTietDonHang->bienThe->sanPham->ten_san_pham }}</a>
                                                            </li>

                                                            <li class="text-content">{{ $chiTietDonHang->bienThe->ten_bien_the }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Giá</h4>
                                                <h6 class="theme-color">
                                                    {{ number_format($chiTietDonHang->bienThe->gia_ban, 0, '', '.') }}đ</h6>
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Số lượng</h4>
                                                <h4 class="text-title">{{ $chiTietDonHang->so_luong }}</h4>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Tổng</h4>
                                                <h5>{{ number_format($chiTietDonHang->bienThe->gia_ban * $chiTietDonHang->so_luong, 0, '', '.') }}đ
                                                </h5>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $chiTietDonHang->bienThe->gia_ban * $chiTietDonHang->so_luong;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-lg-4">
                    <div class="row g-4">
                        <div class="col-lg-12 col-sm-20">
                            <div class="summery-box">
                                <div class="summery-header">
                                    <h3>Chi tiết đơn hàng</h3>
                                    <h5 class="ms-auto theme-color">({{ sizeof($chiTietDonHangs) }} sản phẩm)</h5>
                                </div>

                                {{-- <ul class="summery-contain">
                                    @foreach ($chiTietDonHangs as $chiTietDonHang)
                                        <li>
                                            <h4>{{ $chiTietDonHang->ten_san_pham }}</h4>
                                            <h4 class="price">{{ $chiTietDonHang->gia_moi }}đ</h4>
                                        </li>
                                    @endforeach
                                </ul> --}}

                                <ul class="summery-total">
                                    @php
                                        $countPrice = 0;
                                        $countPrice= $total - $donHang->tong_tien + 10000;
                                    @endphp
                                    <li class="list-total">
                                        <h6>Mã giảm giá:  </h6>
                                        @if (!empty($voucher))
                                        <h4 class="price"> {{ number_format(- $countPrice, 0, '', '.') }}đ</h4>
                                        @endif
                                    </li>
                                    @if (!empty($voucher))
                                        <span class="ms-auto theme-color" style="color:">{{ $voucher->phieuGiamGia->ma_phieu ?? '' }} </span>
                                    @endif


                                    <li class="list-total">
                                        <h6>Phí ship:</h6>
                                        <h4 class="price">{{ number_format(10000, 0, '', '.') }}đ</h4>
                                    </li>
                                    <li class="list-total">
                                        <h4>Tổng:</h4>
                                        <h4 class="price">{{ number_format($donHang->tong_tien, 0, '', '.') }}đ</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>Địa chỉ giao hàng</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block">
                                        <h4>{{ $donHang->dia_chi_nguoi_nhan }}</h4>
                                    </li>

                                    <li class="pb-0">
                                        <h4>Ngày đặt hàng:</h4>
                                        <h4 class="price theme-color">
                                            <a href="{{ route('order-tracking.client', $donHang->id) }}"
                                                class="text-danger">Kiểm tra đơn hàng</a>
                                        </h4>
                                    </li>
                                </ul>

                                <ul class="summery-total">
                                    <li class="list-total border-top-0 pt-2">
                                        <h4 class="fw-bold">{{ $donHang->created_at }}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>Hình thức thanh toán</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block pt-0">
                                        <h4>{{ $donHang->ten_phuong_thuc }}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection

@section('js')
@endsection
