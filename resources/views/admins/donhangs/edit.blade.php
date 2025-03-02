@extends('layouts.admin')

@section('title')
    Trạng thái đơn hàng
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
                            <h5>Trạng thái đơn hàng</h5>
                        </div>
                        <div class="row">
                            <div class="col-12 overflow-hidden">
                                <div class="order-left-image">
                                    <div class="order-image-contain">
                                        <div class="tracker-number">
                                            <p>Mã đơn hàng : <span>{{ $donHang->ma_don_hang }}</span></p>
                                            <p>Người đặt : <span>{{ $donHang->ten_nguoi_dung }}</span></p>
                                            <p>Ngày đặt : <span>{{ $donHang->created_at }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ol class="progtrckr">
                                {{-- @if ($donHang->trang_thai_thanh_toan == 1)
                                    <li class="progtrckr-done">
                                        <h5>Thanh toán</h5>
                                    </li>
                                @else
                                    <li class="progtrckr-todo">
                                        <h5>Thanh toán</h5>
                                    </li>
                                @endif --}}

                                @if ($donHang->trang_thai_don_hang >= 1)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Xác nhận</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 2)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Chờ vận chuyển</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 3)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Đang giao</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 4)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Đã giao</h5>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                        <button class="btn btn-primary me-3">Submit</button>
                        <button class="btn btn-outline">Cancel</button>
                    </div>
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
