@extends('layouts.admin')

@section('title')
    Thêm mới tài khoản
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">
    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">


@endsection

@section('content')
    <div class="col-12">
        <a style="width: 90px; height: 39px" href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Thêm mới tài khoản</h5>
                        </div>
                        <div class="tab-content " id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form method="post" class=" theme-form theme-form-2 mega-form" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-header-1 pagination justify-content-center">
                                        <h5>Thông tin tài khoản</h5>
                                    </div>


                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Tên tài khoản</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                                value="{{ old('name') }}">
                                                @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Họ và tên</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('ten_nguoi_dung') is-invalid @enderror" type="text" name="ten_nguoi_dung"
                                                value="{{ old('ten_nguoi_dung') }}">
                                                @error('ten_nguoi_dung')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Email
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                                value="{{ old('email') }}">
                                                @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Số điện thoại
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('so_dien_thoai') is-invalid @enderror" type="number" name="so_dien_thoai"
                                                value="{{ old('so_dien_thoai') }}">
                                                @error('so_dien_thoai')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày sinh
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control " type="date" name="ngay_sinh"
                                                value="{{ old('ngay_sinh') }}">
                                                @error('ngay_sinh')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Địa chỉ
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('dia_chi') is-invalid @enderror  @error('dia_chi') is-invalid @enderror" type="text"
                                                name="dia_chi" value="{{ old('dia_chi') }}">
                                                @error('dia_chi')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giới tính</label>
                                            <div class="col-lg-10 col-md-9 d-flex gap-3">
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="gioi_tinh_nam" name="gioi_tinh" value="Nam"
                                                    {{ old('gioi_tinh') == 'Nam' ? 'checked' : '' }}>
                                                    <label for="gioi_tinh_nam" class="form-check-label ms-1">Nam</label>
                                                </div>
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="gioi_tinh_nu" name="gioi_tinh" value="Nữ"
                                                    {{ old('gioi_tinh') == 'Nữ' ? 'checked' : '' }}>
                                                    <label for="gioi_tinh_nu" class="form-check-label ms-1">Nữ</label>
                                                </div>
                                                @error('gioi_tinh')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Hình ảnh
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('anh_dai_dien') is-invalid @enderror" type="file"
                                                name="anh_dai_dien" value="{{ old('anh_dai_dien') }}">
                                                @error('anh_dai_dien')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Chức vụ
                                             </label>
                                            <div class="col-md-9 col-lg-10">
                                                <select name="role" class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-1-vf8b" tabindex="-1" aria-hidden="true" id="Select" aria-label="Floating label select example">
                                                    <option value="[]">Khách hàng</option>
                                                    @foreach ($roles as $item=>$role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="col-lg-2 col-md-3 col-form-label form-label-title">Mật khẩu</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('password') is-invalid @enderror" type="password"
                                                name="password" value="{{ old('password') }}">
                                                @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Xác nhận mật khẩu</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input style="border: 1px solid #ced4da;" class="form-control @error('password_verify') is-invalid @enderror" type="password"
                                                name="password_verify" value="{{ old('password_verify') }}">
                                                @error('password_verify')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Trạng thái</label>
                                            <div class="col-lg-10 col-md-9 d-flex gap-3">
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="trang_thai_1" name="trang_thai" value="1"
                                                    checked>
                                                    <div class="status-close">
                                                        <span>Hoạt động</span>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="trang_thai_0" name="trang_thai" value="0"
                                                    >
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
                                        <button class="btn btn-primary" type="submit">Thêm mới</button>
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
