@extends('layouts.admin')

@section('title')
    Bài viết
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
                    <h5>Danh Sách Bài Viết</h5>
                    <form class="d-inline-flex">
                        <a href="{{ route('baiviets.create') }}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus"></i>Thêm Bài Viết
                        </a>
                    </form>
                </div>
                <div>
                    <div class="table-responsive">
                        <table id="table_id" class="table role-table all-package theme-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tiêu Đề</th>
                                    <th>Hình Ảnh</th>
                                    <th>Danh Mục Bài Viết</th>
                                    <th class="col-3">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tin Tức Mới Nhất</td>
                                    <td><img src="https://aothudong.com/upload/product/atd-422/bo-ao-khoac-gio-nam-lot-long-den.jpg"
                                        alt="avt" class="img-thumbnail" width="150"></td>
                                    <td>Áo Khoác</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('baiviets.show', 1) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('baiviets.edit', 1) }}">
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
                                    <td>2</td>
                                    <td>Tin Tức Vừa Qua </td>
                                    <td><img src="data:image/jpeg;base64,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"
                                        alt="avt" class="img-thumbnail" width="150"></td>
                                    <td>Áo Khoác</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('baiviets.show', 2) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('baiviets.edit', 2) }}">
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
                                    <td>3</td>
                                    <td>Dummy</td>
                                    <td><img src="data:image/jpeg;base64,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"
                                        alt="avt" class="img-thumbnail" width="150">
                                    </td>
                                    <td>Áo Thu Đông</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('baiviets.show', 3) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('baiviets.edit', 3) }}">
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

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
