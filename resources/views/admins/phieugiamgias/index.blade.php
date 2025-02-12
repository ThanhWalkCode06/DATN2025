@extends('layouts.admin')

@section('title')
    Phiếu giảm giá
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

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
                    <h5>Coupon List</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                                <a class="btn btn-solid" href="add-new-product.html">Add Coupon</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package coupon-list-table table-hover theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated checkall" type="checkbox" value="">
                                        </span>
                                    </th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>10% Off</td>
                                    <td>5488165</td>
                                    <td class="theme-color">10%</td>
                                    <td class="menu-status">
                                        <span class="danger">Restitute</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>25% Off</td>
                                    <td>2143235</td>
                                    <td class="theme-color">17%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>12% Off</td>
                                    <td>3243468</td>
                                    <td class="theme-color">20%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>45% Off</td>
                                    <td>7846289</td>
                                    <td class="theme-color">50%</td>
                                    <td class="menu-status">
                                        <span class="danger">Restitute</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>45% Off</td>
                                    <td>3614376</td>
                                    <td class="theme-color">60%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>80% Off</td>
                                    <td>8328192</td>
                                    <td class="theme-color">45%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>60% Off</td>
                                    <td>7218376</td>
                                    <td class="theme-color">30%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="form-check user-checkbox m-0 p-0">
                                            <input class="checkbox_animated check-it" type="checkbox" value="">
                                        </span>
                                    </td>
                                    <td>40% Off</td>
                                    <td>1872349</td>
                                    <td class="theme-color">42%</td>
                                    <td class="menu-status">
                                        <span class="success">Success</span>
                                    </td>
                                    <td>
                                        <ul>
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
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Pagination End -->
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
