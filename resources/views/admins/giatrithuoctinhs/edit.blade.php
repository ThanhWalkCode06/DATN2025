@extends('layouts.admin')

@section('title')
    Sửa giá trị thuộc tính
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
            <div class="col-xxl-8 col-lg-10 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Sửa giá trị thuộc tính</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form"
                        action="{{ route('giatrithuoctinhs.update',$giaTri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0" for="gia_tri">Giá trị thuộc tính</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="gia_tri" name="gia_tri" type="text"
                                    placeholder="Giá trị thuộc tính" value="{{ old('gia_tri', $giaTri->gia_tri) }}">
                                @error('gia_tri')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0" for="thuoc_tinh_id">Thuộc tính</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="thuoc_tinh_id" name="thuoc_tinh_id">
                                    <option value="">-- Chọn thuộc tính --</option>
                                    @foreach($thuocTinhs as $thuocTinh)
                                        <option value="{{ $thuocTinh->id }}" 
                                            {{ old('thuoc_tinh_id', $giaTri->thuoc_tinh_id) == $thuocTinh->id ? 'selected' : '' }}>
                                            {{ $thuocTinh->ten_thuoc_tinh }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('thuoc_tinh_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        


                          

                            <button type="submit" class="btn ms-auto theme-bg-color text-white">Cập nhật</button>
                        </form>

                        

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
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
