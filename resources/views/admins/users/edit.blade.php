@extends('layouts.admin')

@section('title')
    Sửa tài khoản
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Sửa tài khoản</h5>
                        </div>
                        <div class="tab-content " id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="card-header-1 pagination justify-content-center">
                                        <h5>Thông tin tài khoản</h5>
                                    </div>

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">ID</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Họ và tên</label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Email
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="email">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Số điện
                                                    thoại
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="number">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày sinh
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="date">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Địa chỉ
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giới
                                                    tính</label>
                                                <div class="col-lg-10 col-md-9 d-flex gap-3">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="gioi_tinh_nam"
                                                            name="gioi_tinh" value="Nam">
                                                        <label for="gioi_tinh_nam" class="form-check-label ms-1">Nam</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="gioi_tinh_nu"
                                                            name="gioi_tinh" value="Nữ">
                                                        <label for="gioi_tinh_nu" class="form-check-label ms-1">Nữ</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Hình ảnh
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="file">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Chức vụ
                                                </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <select name="role" class="" id="Select"
                                                        aria-label="Floating label select example">
                                                        <option selected value="0">Admin</option>
                                                        <option value="1">User</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="mb-4 row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mật
                                                    khẩu</label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="password">
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Xác nhận
                                                    mật khẩu</label>
                                                <div class="col-md-9 col-lg-10">
                                                    <input class="form-control" type="password">
                                                </div>
                                            </div>


                                        </div>
                                </form>
                                <div class="mt-5 d-flex justify-content-between">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js-->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
@endsection
