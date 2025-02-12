@extends('layouts.admin')

@section('title')
    Liên hệ
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

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
            <!-- Table Start -->
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Support Ticket</h5>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table ticket-table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox checkall">
                                                <input class="checkbox_animated" type="checkbox" value="">
                                            </span>
                                            <span>Ticket Number</span>
                                        </div>
                                    </th>
                                    <th>
                                        <span>Date</span>
                                    </th>
                                    <th>
                                        <span>Subject</span>
                                    </th>
                                    <th>
                                        <span>Status</span>
                                    </th>
                                    <th>
                                        <span>Options</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#453</span>
                                        </div>
                                    </td>
                                    <td>25-09-2021</td>

                                    <td>Query about return & exchange</td>

                                    <td class="status-danger">
                                        <span>Pending</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#453</span>
                                        </div>
                                    </td>

                                    <td>20-10-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-close">
                                        <span>Closed</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#456</span>
                                        </div>
                                    </td>

                                    <td>30-01-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-danger">
                                        <span>Pending</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#456</span>
                                        </div>
                                    </td>

                                    <td>30-01-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-danger">
                                        <span>Pending</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#782</span>
                                        </div>
                                    </td>

                                    <td>02-04-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-close">
                                        <span>Closed</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#214</span>
                                        </div>
                                    </td>

                                    <td>10-01-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-close">
                                        <span>Closed</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#258</span>
                                        </div>
                                    </td>

                                    <td>26-07-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-danger">
                                        <span>Pending</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#634</span>
                                        </div>
                                    </td>

                                    <td>30-10-2020</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-close">
                                        <span>Closed</span>
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
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it" type="checkbox" value="">
                                            </span>
                                            <span>#124</span>
                                        </div>
                                    </td>

                                    <td>09-08-2021</td>
                                    <td>Query about return & exchange</td>
                                    <td class="status-danger">
                                        <span>Pending</span>
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
            <!-- Table End -->
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
