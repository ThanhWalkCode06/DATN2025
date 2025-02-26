@extends('layouts.admin')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

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
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Thêm mã giảm giá</h5>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form class="theme-form theme-form-2 mega-form" action="{{ route('phieugiamgias.store') }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Tên phiếu giảm giá -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Tên phiếu giảm
                                                giá</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text" name="ten_phieu" required>
                                            </div>
                                        </div>

                                        <!-- Mã Giảm giá -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mã Giảm
                                                giá</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text" name="ma_phieu" required>
                                            </div>
                                        </div>

                                        <!-- Ngày bắt đầu -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày bắt
                                                đầu</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="date" name="ngay_bat_dau" required>
                                            </div>
                                        </div>

                                        <!-- Ngày kết thúc -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày kết
                                                thúc</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="date" name="ngay_ket_thuc" required>
                                            </div>
                                        </div>

                                        <!-- Giá trị giảm giá -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giá trị giảm
                                                giá</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="number" name="gia_tri" step="0.01"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Trạng thái -->
                                        <div class="row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Trạng thái</label>
                                            <div class="col-md-9">
                                                <div class="form-check user-checkbox ps-0">
                                                    <input class="checkbox_animated check-it" type="checkbox"
                                                        name="trang_thai" value="1">
                                                    <label class="form-label-title col-md-2 mb-0">Kích hoạt</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-solid">Thêm Mã Giảm Giá</button>
                                        </div>

                                    </div>
                                </form>
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

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection