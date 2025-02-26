@extends('layouts.admin')

@section('title')
    Thêm mới sản phẩm
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
                            <h5>Thêm mới sản phẩm</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form" action="{{route('sanphams.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="ten_san_pham" value="{{ old('ten_san_pham') }}">
                                    @error('ten_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mã sản phẩm</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="ma_san_pham" value="{{ old('ma_san_pham') }}">
                                    @error('ma_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Khuyến mãi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="khuyen_mai" value="{{ old('khuyen_mai') }}">
                                    @error('khuyen_mai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ngày nhập</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date" name="ngay_nhap" value="{{ old('ngay_nhap') }}">
                                    @error('ngay_nhap')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Danh mục</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="danh_muc_id">
                                        <option disabled selected>Chọn danh mục</option>
                                        @foreach ($danhMucs as $danhMuc)
                                        <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten_danh_muc }}</option>
                                    @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Hình ảnh</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-choose" name="hinh_anh" type="file" id="formFile" multiple>
                                    @error('hinh_anh')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="trang_thai">
                                        <option disabled selected>Chọn trạng thái</option>
                                        <option value="1">Còn hàng</option>
                                        <option value="0">Hết hàng</option>
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
                                            <textarea id="editor" name="mo_ta">{{ old('mo_ta') }}</textarea>6
                                        </div>  
                                    </div>  
                                </div>  
                            </div>
                            <br>
                        
                            <div class="mb-4 row align-items-center">  
                                <div class="col-sm-9 offset-sm-3">  
                                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>  
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
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            document.querySelector('form').addEventListener('submit', () => {
                document.querySelector('#editor').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

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


