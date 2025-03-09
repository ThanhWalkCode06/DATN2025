@extends('layouts.admin')

@section('title')
    Chi tiết đánh giá
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzone css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Chi tiết đánh giá</h5>
                        </div>
                        <div class="row">
                            <div class="col-12 overflow-hidden">
                                <div class="order-left-image">
                                    <div class="order-image-contain">
                                        <div class="tracker-number">
                                            <p>Người đánh giá : <span>{{ $danhGia->ten_nguoi_dung }}</span></p>
                                            <p>Sản phẩm : <span>{{ $danhGia->ten_san_pham }}</span></p>
                                            <p class="m-0">
                                            <ul class="rating">
                                                Đánh giá :
                                                @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            </p>
                                            <p>Nhận xét : <br><span>{{ $danhGia->nhan_xet }}</span></p>
                                            <p>
                                                Trạng thái :
                                                @if ($danhGia->trang_thai == 1)
                                                    <span class="text-success">Đang hoạt động</span>
                                                @else
                                                    <span class="text-danger">Đã ẩn</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('danhgias.update', $danhGia->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                            @if ($danhGia->trang_thai == 1)
                                <input class="btn btn-danger me-3" type="submit" name="an_danh_gia" value="Ẩn đánh giá">
                            @else
                                <input class="btn btn-primary me-3" type="submit" name="hien_danh_gia"
                                    value="Hiện đánh giá">
                            @endif
                            <a href="{{ route('danhgias.index') }}" class="btn btn-outline">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar menu js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
@endsection
