@extends('layouts.admin')

@section('title')
    Tài khoản
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
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Danh sách tài khoản</h5>
                    <form class="d-inline-flex">
                        <a href="{{ route('taikhoans.create',1) }}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus"></i>Thêm mới
                        </a>
                    </form>
                </div>

                <div class="table-responsive table-product">
                    <table class="table all-package theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh đại diện</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Chức vụ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="justify-content-center">
                                <td>
                                    01
                                </td>

                                 <td>
                                  <img src="https://file.hstatic.net/200000828357/article/toc-son-tung-2_53560601c8d549788070077fb8549f09.jpg" alt="Hình ảnh tài khoản" class="img-thumbnail" width="100">
                                </td>

                                <td>
                                    <div class="user-name">
                                        <span>Nguyễn Văn A</span>
                                        {{-- <span>Essex Court</span> --}}
                                    </div>
                                </td>

                                <td>abcxyz@gmail.com</td>

                                <td>Admin</td>

                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('taikhoans.show',1) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('taikhoans.edit',1) }}">
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
                            <tr class="">
                                <td>
                                    02
                                </td>

                                 <td>
                                  <img src="https://ss-images.saostar.vn/w700/2024/4/24/pc/1713947639678/ky17o5m2o91-iw5kx9iw122-pd1nnznwjf3.jpg" alt="Hình ảnh tài khoản" class="img-thumbnail" width="100">
                                </td>

                                <td>
                                    <div class="user-name">
                                        <span>Nguyễn Văn A</span>
                                        {{-- <span>Essex Court</span> --}}
                                    </div>
                                </td>

                                <td>abcxyz@gmail.com</td>

                                <td>Admin</td>

                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('taikhoans.show',1) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('taikhoans.edit',1) }}">
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
                            <tr class="">
                                <td>
                                    03
                                </td>

                                 <td>
                                  <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2024/10/31/1415121/Thieu-Bao-Tram.jpeg" alt="Hình ảnh tài khoản" class="img-thumbnail" width="100">
                                </td>

                                <td>
                                    <div class="user-name">
                                        <span>Nguyễn Văn A</span>
                                        {{-- <span>Essex Court</span> --}}
                                    </div>
                                </td>

                                <td>abcxyz@gmail.com</td>

                                <td>Admin</td>

                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('taikhoans.show',1) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('taikhoans.edit',1) }}">
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
                            <tr class="">
                                <td>
                                    04
                                </td>

                                 <td>
                                  <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2024/11/10/1419696/Chi-Dan.jpg" alt="Hình ảnh tài khoản" class="img-thumbnail" width="100">
                                </td>

                                <td>
                                    <div class="user-name">
                                        <span>Nguyễn Văn A</span>
                                        {{-- <span>Essex Court</span> --}}
                                    </div>
                                </td>

                                <td>abcxyz@gmail.com</td>

                                <td>Admin</td>

                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('taikhoans.show',1) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('taikhoans.edit',1) }}">
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
                            <tr class="">
                                <td>
                                    05
                                </td>

                                 <td>
                                  <img src="https://images2.thanhnien.vn/zoom/686_429/528068263637045248/2023/3/28/tran-thanh-3-1679978161164419649988-0-0-960-1536-crop-1679978783808539742892.jpeg" alt="Hình ảnh tài khoản" class="img-thumbnail" width="100">
                                </td>

                                <td>
                                    <div class="user-name">
                                        <span>Nguyễn Văn A</span>
                                        {{-- <span>Essex Court</span> --}}
                                    </div>
                                </td>

                                <td>abcxyz@gmail.com</td>

                                <td>Admin</td>

                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('taikhoans.show',1) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('taikhoans.edit',1) }}">
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
