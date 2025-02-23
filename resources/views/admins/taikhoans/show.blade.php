@extends('layouts.admin')

@section('title')
    Chi tiết tài khoản
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4 overflow-hidden border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Thông Tin Tài Khoản</h3>
                </div>
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="https://file.hstatic.net/200000828357/article/toc-son-tung-2_53560601c8d549788070077fb8549f09.jpg" alt="Hình ảnh tài khoản" class="rounded-circle border shadow-lg" width="180">
                            <h5 class="mt-3 text-primary h5">Nguyễn Văn A</h5>
                            <span class="badge bg-danger ">Admin</span>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>ID:</strong> 01</li>
                                <li class="list-group-item"><strong>Email:</strong>abcxyz@gmail.com</li>
                                <li class="list-group-item"><strong>Số điện thoại:</strong> 0971415610</li>
                                <li class="list-group-item"><strong>Ngày sinh:</strong> 24-08-2003</li>
                                <li class="list-group-item"><strong>Địa chỉ:</strong> Cầu Giấy, Hà Nội, Việt Nam</li>
                                <li class="list-group-item"><strong>Giới tính:</strong> Nam</li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('taikhoans.index') }}" class="btn btn-outline-primary px-4">Quay lại</a>
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