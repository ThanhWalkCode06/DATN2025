@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục bài viết')

@section('css')
<!-- remixicon css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

<!-- Data Table css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

<!-- Themify icon css-->
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
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Chỉnh sửa danh mục bài viết</h5>
                </div>
                <form action="{{ route('danhmucbaiviets.update', $danhMucBaiViet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" name="ten_danh_muc" value="{{ $danhMucBaiViet->ten_danh_muc }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="mo_ta">{{ $danhMucBaiViet->mo_ta }}</textarea>
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <a href="{{ route('danhmucbaiviets.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </form>
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
@endsection
