@extends('layouts.admin')

@section('title')
    Thêm mới phương thức thanh toán
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
    <div class="col-12">
        <a style="width: 90px; height: 39px" href="{{ route('phuongthucthanhtoans.index') }}" class="btn btn-secondary">Quay lại</a>
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Sửa phương thức thanh toán</h5>
                        </div>
                        <div class="tab-content " id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form method="post" class="theme-form theme-form-2 mega-form" action="{{ route('phuongthucthanhtoans.update',$itemId->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Tên phương thức </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('ten_phuong_thuc') is-invalid @enderror" type="text" name="ten_phuong_thuc"
                                                value="{{ $itemId->ten_phuong_thuc }}" >
                                                @error('ten_phuong_thuc')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Trạng thái</label>
                                            <div class="col-lg-10 col-md-9 d-flex gap-3">
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="trang_thai_1" name="trang_thai" value="1"
                                                    {{ $itemId->trang_thai == 1 ? 'checked' : '' }}>
                                                    <div class="status-close">
                                                        <span>Hoạt động</span>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="trang_thai_0" name="trang_thai" value="0"
                                                    {{ $itemId->trang_thai == 0 ? 'checked' : '' }}>
                                                    <div class="status-danger">
                                                        <span >Không hoạt động</span>
                                                    </div>
                                                </div>
                                                @error('trang_thai')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>


                                    </div>
                                    <div class="mt-5 d-flex justify-content-between">
                                        <button class="btn btn-primary" type="submit">Update</button>
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

    <!-- Sidebar js-->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
@endsection
