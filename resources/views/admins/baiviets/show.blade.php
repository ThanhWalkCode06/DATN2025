@extends('layouts.admin')

@section('title', 'Chi Tiết Bài Viết')

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">📖 Chi Tiết Bài Viết</h3>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Cột trái -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h5><i class="ri-user-line"></i> Người Viết:</h5>
                            <p class="text-muted">{{ $baiViet->user->name }} ({{ $baiViet->user->email }})</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-book-2-line"></i> Tiêu Đề:</h5>
                            <p class="fw-bold">{{ $baiViet->tieu_de }}</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-folder-line"></i> Danh Mục:</h5>
                            <p class="text-dark fw-bold">{{ $baiViet->danhMuc->ten_danh_muc }}</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-file-text-line"></i> Nội Dung:</h5>
                            <p class="text-muted">{!! nl2br(e($baiViet->noi_dung)) !!}</p>
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-4 text-center">
                        <h5><i class="ri-image-line"></i> Ảnh Bìa:</h5>
                        <img src="{{ asset('storage/' . $baiViet->anh_bia) }}" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('baiviets.index') }}" class="btn btn-outline-primary">
                    <i class="ri-arrow-go-back-line"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- ck editor js -->
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor-custom.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
