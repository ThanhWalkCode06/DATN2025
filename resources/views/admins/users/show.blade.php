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
                                <img src="{{ asset(Storage::url($user->anh_dai_dien)) }}" alt="Hình ảnh tài khoản"
                                    class="rounded-circle border shadow-lg" width="180">
                                <h5 class="mt-3 text-primary h5">{{ $user->name }}</h5>
                                <span class="badge bg-danger ">{{ $user->roles->pluck('name')->first() }}</span>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>ID:</strong> {{ $user->name }}</li>
                                    <li class="list-group-item"><strong>Email:</strong>{{ $user->email }}</li>
                                    <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $user->so_dien_thoai }}
                                    </li>
                                    <li class="list-group-item"><strong>Ngày sinh:</strong> {{ $user->ngay_sinh }}</li>
                                    <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $user->dia_chi }}</li>
                                    <li class="list-group-item"><strong>Trạng thái:</strong>
                                        @if ($user->trang_thai == 1)
                                            <div style="float: right; margin-right: 30%" class="status-close">
                                                <span>Hoạt động</span>
                                            </div>
                                        @else
                                            <div style="float: right; margin-right: 30%" class="status-danger">
                                                <span>Không hoạt động</span>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-primary px-4">Quay lại</a>
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
