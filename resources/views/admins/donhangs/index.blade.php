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
                    <h5>Order List</h5>
                    <a href="#" class="btn btn-solid">Download all orders</a>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package order-table theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Order Image</th>
                                    <th>Order Code</th>
                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Delivery Status</th>
                                    <th>Amount</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <a class="d-block">
                                            <span class="order-image">
                                                <img src="assets/images/product/1.png" class="img-fluid" alt="users">
                                            </span>
                                        </a>
                                    </td>

                                    <td> 406-4883635</td>

                                    <td>Jul 20, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/2.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 573-685572</td>

                                    <td>Jul 25, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/3.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 759-4568734</td>

                                    <td>Jul 29, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-pending">
                                        <span>Pending</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/4.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 546-7664537</td>

                                    <td>Jul 30, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/5.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 479-7533144</td>

                                    <td>Aug 01, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/6.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 456-1245789</td>

                                    <td>Aug 10, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-cancle">
                                        <span>Cancel</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/7.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 057-3657895</td>

                                    <td>Aug 18, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-cancle">
                                        <span>Cancel</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/8.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 123-1234567</td>

                                    <td>Aug 29, 2022</td>

                                    <td>Paypla</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/9.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 987-9876543</td>

                                    <td>Sep 09, 2022</td>

                                    <td>Paypal</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/10.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 147-3692584</td>

                                    <td>Sep 17, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-success">
                                        <span>Success</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        <span class="order-image">
                                            <img src="assets/images/product/11.png" alt="users">
                                        </span>
                                    </td>

                                    <td> 586-5865224</td>

                                    <td>Sep 20, 2022</td>

                                    <td>Stripe</td>

                                    <td class="order-pending">
                                        <span>Pending</span>
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                    Tracking
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
