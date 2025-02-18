@extends('layouts.admin')
@section('title')
    Quản lý tài khoản
@endsection
@section('page-title')
    Sửa Bài Viết
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
                <form action="" method="POST" enctype="multipart/form-data">
                    {{-- khi sử dụng form trong Laravel bắt buộc phải có @csrf --}}
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="mt-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" name="id"
                                    placeholder="Nhập ID">
                            </div>
                            <div class="mt-3">
                                <label for="ten_bai_viet" class="form-label">Tiêu Đề Bài Viết</label>
                                <input type="text" class="form-control" id="ten_bai_viet" name="ten_bai_viet"
                                    placeholder="Nhập tên bài viết">
                            </div>
                            <div class="mt-3">
                                <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="mt-3">
                                <label for="noi_dung" class="form-label">Nội Dung</label>
                                <textarea class="form-control" id="noi_dung" name="noi_dung" rows="10" placeholder="Nhập nội dung"></textarea>
                            </div>
                            <div class="mt-5 d-flex justify-content-between">
                                <a href="{{ route('baiviets.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button class="btn btn-primary" type="submit">Sửa</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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
