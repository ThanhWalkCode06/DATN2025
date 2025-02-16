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
                        <h5>Đơn hàng #36648</h5>
                    </div>
                    <div class="card-order-section">
                        <ul>
                            <li>01/01/2025 | 9:08</li>
                            <li>3 sản phẩm</li>
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
                                        <tr class="table-order">
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('assets/images/profile/1.jpg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p>Tên sản phẩm</p>
                                                <h5>Outwear & Coats</h5>
                                            </td>
                                            <td>
                                                <p>Số lượng</p>
                                                <h5>1</h5>
                                            </td>
                                            <td>
                                                <p>Giá</p>
                                                <h5>$63.54</h5>
                                            </td>
                                        </tr>

                                        <tr class="table-order">
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('assets/images/profile/2.jpg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p>Tên sản phẩm</p>
                                                <h5>Slim Fit Plastic Coat</h5>
                                            </td>
                                            <td>
                                                <p>Số lượng</p>
                                                <h5>5</h5>
                                            </td>
                                            <td>
                                                <p>Giá</p>
                                                <h5>$63.54</h5>
                                            </td>
                                        </tr>

                                        <tr class="table-order">
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('assets/images/profile/3.jpg') }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p>Tên sản phẩm</p>
                                                <h5>Men's Sweatshirt</h5>
                                            </td>
                                            <td>
                                                <p>Số lượng</p>
                                                <h5>1</h5>
                                            </td>
                                            <td>
                                                <p>Giá</p>
                                                <h5>$63.54</h5>
                                            </td>
                                        </tr>
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
                                                <h4 class="theme-color fw-bold">$6935.00</h4>
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
                                        <li>Mã đơn hàng: 5563853658932</li>
                                        <li>Ngày đặt hàng: October 22, 2018</li>
                                        <li>Tổng tiền: $907.28</li>
                                        <li>Hình thức thanh toán: COD</li>
                                    </ul>

                                    <h4>Địa chỉ giao hàng</h4>
                                    <ul class="order-details">
                                        <li>Nguyễn Văn A</li>
                                        <li>0987654321</li>
                                        <li>Austrlia, 235153 Contact No. 48465465465</li>
                                    </ul>

                                    {{-- <div class="payment-mode">
                                        <h4>Hình thức thanh toán</h4>
                                        <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                            available. Card/Net banking acceptance subject to device
                                            availability.</p>
                                    </div> --}}

                                    <div class="delivery-sec">
                                        <h3>Ngày nhận hàng dự kiến: <span>10/01/2025</span>
                                        </h3>
                                        {{-- <a href="order-tracking.html">track order</a> --}}
                                    </div>
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
