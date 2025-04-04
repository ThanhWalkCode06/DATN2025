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
                            <form class="theme-form theme-form-2 mega-form" action="{{ route('phieugiamgias.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Tên phiếu giảm giá -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-lg-2 col-md-3 mb-0">Tên phiếu giảm giá</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('ten_phieu') is-invalid @enderror" type="text" name="ten_phieu" value="{{ old('ten_phieu') }}">
                                            @error('ten_phieu')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Mã Giảm giá -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mã Giảm giá</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('ma_phieu')  @enderror" type="text" name="ma_phieu" value="{{ old('ma_phieu') }}">
                                            @error('ma_phieu')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Ngày bắt đầu -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày bắt đầu</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('ngay_bat_dau')  @enderror" type="date" name="ngay_bat_dau" value="{{ old('ngay_bat_dau') }}">
                                            @error('ngay_bat_dau')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Ngày kết thúc -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày kết thúc</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('ngay_ket_thuc')  @enderror" type="date" name="ngay_ket_thuc" value="{{ old('ngay_ket_thuc') }}">
                                            @error('ngay_ket_thuc')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Giá trị giảm giá -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giá trị giảm giá</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('gia_tri')  @enderror" type="number" name="gia_tri" step="0.01" value="{{ old('gia_tri') }}">
                                            @error('gia_tri')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Giá trị giảm giá -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mức giảm tối đa:</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('muc_giam_toi_da')  @enderror" type="number" name="muc_giam_toi_da" step="0.01" value="{{ old('muc_giam_toi_da') }}">
                                            @error('muc_giam_toi_da')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Giá trị giảm giá -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mức giá tối thiểu áp dụng:</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('muc_gia_toi_thieu')  @enderror" type="number" name="muc_gia_toi_thieu" step="0.01" value="{{ old('muc_gia_toi_thieu') }}">
                                            @error('muc_gia_toi_thieu')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Mô tả</label>
                                        <div class="col-md-9 col-lg-10">
                                            <input class="form-control @error('mo_ta')  @enderror" type="text" name="mo_ta"  value="{{ old('mo_ta') }}">
                                            @error('mo_ta')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Trạng thái -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Trạng thái</label>
                                        <div class="col-lg-10 col-md-9 d-flex gap-3">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="trang_thai_kich_hoat" name="trang_thai" value="1" {{ old('trang_thai', 1) == 1 ? 'checked' : '' }}>
                                                <label for="trang_thai_kich_hoat" class="form-check-label ms-1">Kích hoạt</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="trang_thai_khong_kich_hoat" name="trang_thai" value="0" {{ old('trang_thai', 1) == 0 ? 'checked' : '' }}>
                                                <label for="trang_thai_khong_kich_hoat" class="form-check-label ms-1">Không kích hoạt</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex gap-3">
                                        <a href="{{ route('phieugiamgias.index') }}" class="btn btn-light">Quay lại</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            let isValid = true;
            let fields = [{
                    name: "ten_phieu",
                    message: "Vui lòng nhập tên phiếu giảm giá."
                },
                {
                    name: "ma_phieu",
                    message: "Vui lòng nhập mã giảm giá."
                },
                {
                    name: "ngay_bat_dau",
                    message: "Vui lòng chọn ngày bắt đầu."
                },
                {
                    name: "ngay_ket_thuc",
                    message: "Vui lòng chọn ngày kết thúc."
                },
                {
                    name: "gia_tri",
                    message: "Vui lòng nhập giá trị giảm giá."
                }
            ];

            fields.forEach(field => {
                let input = document.querySelector(`[name="${field.name}"]`);
                let errorDiv = input.nextElementSibling;

                // Xóa thông báo lỗi cũ nếu có
                if (errorDiv && errorDiv.classList.contains("text-danger")) {
                    errorDiv.remove();
                }

                // Kiểm tra nếu bỏ trống
                if (!input.value.trim()) {
                    isValid = false;
                    let errorMessage = document.createElement("div");
                    errorMessage.classList.add("text-danger");
                    errorMessage.innerText = field.message;
                    input.parentElement.appendChild(errorMessage);
                    input.classList.add("border", "border-danger"); // Thêm viền đỏ để báo lỗi

                }
            });

            if (!isValid) {
                event.preventDefault(); // Ngăn form gửi nếu có lỗi
            }
        });
    });
</script>


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
