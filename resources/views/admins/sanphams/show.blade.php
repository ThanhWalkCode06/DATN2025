@extends('layouts.admin')

@section('title')
    Sản phẩm
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

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

            <div class="bg-inner cart-section order-details-table">
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="table-responsive table-details">
                            <table class="table cart-table table-borderless">
                                <thead>
                                    <tr>
                                        <th colspan="2">Tên sản phẩm: {{$bienThe->ten_san_pham}}</th>
                                        <th class="text-end" colspan="2">

                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr class="table-order">
                                        <td>

                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('storage/' . $bienThe->hinh_anh) }}" class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                        </td>

                                        <td>
                                            <p>Mã sản phẩm</p>
                                            <h5>{{ $bienThe->ma_san_pham }}</h5>
                                        </td>
                                        <td>
                                            <p>Khuyến mãi</p>
                                            <h5>{{ $bienThe->khuyen_mai }}</h5>
                                        </td>
                                        <td>
                                            @if ($bienThe->trang_thai == 1)
                                                <span class="badge bg-success-subtle text-success fs-6">Còn hàng</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger fs-6">Hết hàng</span>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>


                                <tfoot>
                                    <tr>

                                        <td>
                                            <p>Mô tả sản phẩm </p>
                                            <p>{!! $bienThe->mo_ta !!}</p>

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="col-xl-4">
                        <div class="order-success">
                            <div class="row g-4">
                                <h4>summery</h4>
                                <ul class="order-details">
                                    <li>Order ID: 5563853658932</li>
                                    <li>Order Date: October 22, 2018</li>
                                    <li>Order Total: $907.28</li>
                                </ul>

                                <h4>shipping address</h4>
                                <ul class="order-details">
                                    <li>Gerg Harvell</li>
                                    <li>568, Suite Ave.</li>
                                    <li>Austrlia, 235153 Contact No. 48465465465</li>
                                </ul>

                                <div class="payment-mode">
                                    <h4>payment method</h4>
                                    <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                        available. Card/Net banking acceptance subject to device
                                        availability.</p>
                                </div>

                                <div class="delivery-sec">
                                    <h3>expected date of delivery: <span>october 22, 2018</span>
                                    </h3>
                                    <a href="order-tracking.html">track order</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- section end -->
        </div>
    </div>
</div>
@endsection

@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
