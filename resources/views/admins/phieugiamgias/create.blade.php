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
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button">Tổng quan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button">Đối tượng</button>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form class="theme-form theme-form-2 mega-form">
                             

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Tên phiếu giảm giá</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mã Giảm giá</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="number">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày bắt đầu</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="date">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày kết thúc</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="date">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Free
                                                Shipping</label>
                                            <div class="col-md-9">
                                                <div class="form-check user-checkbox ps-0">
                                                    <input class="checkbox_animated check-it" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-label-title col-md-2 mb-0">
                                                        Free Shipping</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="col-lg-2 col-md-3 col-form-label form-label-title">Số lượng</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="number">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 col-form-label form-label-title">Discount
                                                Type</label>
                                            <div class="col-sm-10">
                                                <select class="js-example-basic-single" name="state">
                                                    <option disabled>--Select--</option>
                                                    <option>Percent</option>
                                                    <option>Fixed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Trạng thái</label>
                                            <div class="col-md-9">
                                                <div class="form-check user-checkbox ps-0">
                                                    <input class="checkbox_animated check-it" type="checkbox"
                                                        value="" id="flexCheckDefault1">
                                                    <label class="form-label-title col-md-2 mb-0">
                                                        Kích hoạt</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="card-header-1">
                                        <h5>Đối tượng</h5>
                                    </div>

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Sản phẩm</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 col-form-label form-label-title">Danh mục</label>
                                            <div class="col-sm-10">
                                                <select class="js-example-basic-single" name="state">
                                                    <option disabled>--Chọn--</option>
                                                    <option>Áo dài tay	
                                                    </option>
                                                    <option>Áo ngắn tay	
                                                    </option>
                                                    <option>Quần dài	
                                                    </option>
                                                    <option>Quần ngắn	
                                                    </option>
                                                    <option>Đồ bộ		
                                                    </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giá từ</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="number">
                                            </div>
                                        </div>

                                 
                                        </div>
                                    </div>
                                </form>
                            </div>

                            
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a class="btn btn-solid" href="add-new-product.html">Add Coupon</a>
                            </li>
                        </ul>
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
