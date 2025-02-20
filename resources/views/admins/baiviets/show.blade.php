@extends('layouts.admin')

@section('title', 'Bài viết')

@section('page-title', 'Chi tiết bài viết')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông Tin Chi Tiết Bài Viết</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">ID:</label>
                            <span>01</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu Đề:</label>
                            <span>Tin tức mới nhất</span>
                        </div>
                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold">Hình ảnh:</label>
                            <img src="https://aothudong.com/upload/product/atd-422/bo-ao-khoac-gio-nam-lot-long-den.jpg"
                                alt="Hình ảnh bài viết" class="img-fluid rounded" width="200">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh Mục:</label>
                            <span>Tin tức mới nhất</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung:</label>
                            <textarea class="form-control" rows="8" readonly>
Cách làm sạch áo phao lông vũ không cần giặt...
                            </textarea>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('baiviets.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
