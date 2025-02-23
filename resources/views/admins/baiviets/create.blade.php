

@extends('layouts.admin')

@section('title')
    Thêm mới bài viết
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
                            <h5>Thêm Mới Bài Viết</h5>
                        </div>

                        <form action="{{ route('admins.baiviets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Chọn người dùng -->
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Người Viết</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_id" required>
                                        <option value="" disabled selected>Chọn người viết</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tiêu đề -->
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tiêu Đề</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="tieu_de"
                                        placeholder="Nhập tiêu đề bài viết" required>
                                    @error('tieu_de')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Danh mục -->
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Danh Mục</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="danh_muc_id" required>
                                        <option value="" disabled selected>Chọn danh mục</option>
                                        @foreach ($danhMucs as $danhMuc)
                                            <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten_danh_muc }}</option>
                                        @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nội dung -->
                            <div class="mb-4 row">
                                <label class="col-sm-3 col-form-label form-label-title">Nội Dung</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="noi_dung" rows="5" required></textarea>
                                    @error('noi_dung')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ảnh bìa -->
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Ảnh Bìa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="anh_bia" accept="image/*">
                                    @error('anh_bia')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nút Submit -->
                            <div class="mt-5 d-flex justify-content-between">
                                <a href="{{ route('baiviets.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button class="btn btn-primary" type="submit">Thêm mới</button>
                            </div>

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

    <!-- ck editor js -->
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor-custom.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
