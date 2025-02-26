@extends('layouts.admin')

@section('title')
    Cập nhật sản phẩm
@endsection

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
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Cập nhật sản phẩm</h5>
                        </div>


                        <form class="theme-form theme-form-2 mega-form"
                            action="{{ route('sanphams.update', $sanpham->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="ten_san_pham"
                                        value="{{ $sanpham->ten_san_pham }}">
                                    @error('ten_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mã sản phẩm</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="ma_san_pham"
                                        value="{{ $sanpham->ma_san_pham }}">
                                    @error('ma_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Khuyến mãi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="khuyen_mai"
                                        value="{{ $sanpham->khuyen_mai }}">
                                    @error('khuyen_mai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Danh mục</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="danh_muc_id">
                                        <option disabled>Chọn danh mục</option>
                                        @foreach ($danhMucs as $danhMuc)
                                            <option value="{{ $danhMuc->id }}"
                                                {{ $sanpham->danh_muc_id == $danhMuc->id ? 'selected' : '' }}>
                                                {{ $danhMuc->ten_danh_muc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Hình ảnh hiện tại</label>
                                <div class="col-sm-9">
                                    @if ($sanpham->hinh_anh)
                                        <img src="{{ asset('storage/' . $sanpham->hinh_anh) }}" alt="Hình ảnh sản phẩm"
                                            style="max-width: 200px; max-height: 200px; margin-bottom: 10px;">
                                    @else
                                        <p>Không có hình ảnh hiện tại.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Hình ảnh mới</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-choose" name="hinh_anh" type="file" id="formFile"
                                        multiple>
                                    @error('hinh_anh')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="trang_thai">
                                        <option disabled>Chọn trạng thái</option>
                                        <option value="1" {{ $sanpham->trang_thai == 1 ? 'selected' : '' }}>Còn hàng
                                        </option>
                                        <option value="0" {{ $sanpham->trang_thai == 0 ? 'selected' : '' }}>Hết hàng
                                        </option>
                                    </select>
                                    @error('trang_thai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Mô tả sản phẩm</label>
                                        <div class="col-sm-9">
                                            <div id="editor" name="mo_ta">{!! $sanpham->mo_ta !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Mô tả</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            
                        </form>
                    </div>
                </div> --}}

                {{-- <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Hình ảnh</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            
                        </form>
                    </div>
                </div> --}}

                {{-- <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Biến thể sản phẩm</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Option
                                    Name</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="state">
                                        <option>Color</option>
                                        <option>Size</option>
                                        <option>Material</option>
                                        <option>Style</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Option
                                    Value</label>
                                <div class="col-sm-9">
                                    <div class="bs-example">
                                        <input type="text" class="form-control" placeholder="Type tag & hit enter"
                                            id="#inputTag" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div> --}}

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
