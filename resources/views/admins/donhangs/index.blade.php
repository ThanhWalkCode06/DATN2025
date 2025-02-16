@extends('layouts.admin')

@section('title')
    Đơn hàng
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
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Danh sách đơn hàng</h5>
                    {{-- <a href="#" class="btn btn-solid">Download all orders</a> --}}
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package order-table theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Người đặt</th>
                                    <th>Ngày đặt</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái giao hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>406-4883635</td>

                                    <td>Nguyễn Văn A</td>

                                    <td>Jul 20, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-success">
                                        <span>Đã giao hàng</span>
                                    </td>

                                    <td>$15</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('donhangs.show', 1) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Theo dõi
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>759-4568734</td>

                                    <td>Nguyễn Văn B</td>

                                    <td>Jul 29, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-pending">
                                        <span>Chưa xử lý</span>
                                    </td>

                                    <td>$15</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="order-detail.html">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Theo dõi
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>456-1245789</td>

                                    <td>Nguyễn Văn C</td>

                                    <td>Aug 10, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-cancle">
                                        <span>Đã hủy</span>
                                    </td>

                                    <td>$15</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="order-detail.html">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Theo dõi
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
