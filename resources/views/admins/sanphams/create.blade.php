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

                        <form action="{{ route('sanphams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Tên sản phẩm --}}
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ten_san_pham" class="form-control"
                                        value="{{ old('ten_san_pham') }}">
                                    @error('ten_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Mã sản phẩm --}}
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mã sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ma_san_pham" class="form-control"
                                        value="{{ old('ma_san_pham') }}">
                                    @error('ma_san_pham')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Khuyến mãi --}}
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Khuyến mãi (%)</label>
                                <div class="col-sm-9">
                                    <input type="number" name="khuyen_mai" class="form-control"
                                        value="{{ old('khuyen_mai', 0) }}" min="0">
                                    @error('khuyen_mai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Danh mục --}}
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Danh mục</label>
                                <div class="col-sm-9">
                                    <select class="form-control js-example-basic-single w-100" name="danh_muc_id">
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

                            {{-- Hình ảnh sản phẩm --}}
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Hình ảnh</label>
                                <div class="col-sm-9">
                                    <input type="file" name="hinh_anh" class="form-control">
                                    @error('hinh_anh')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Trạng thái --}}
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select name="trang_thai" class="form-control">
                                        <option value="1">Còn hàng</option>
                                        <option value="0">Hết hàng</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Mô tả sản phẩm --}}
                            <div class="mb-4 row">
                                <label class="col-sm-3 col-form-label form-label-title">Mô tả</label>
                                <div class="col-sm-9">
                                    <textarea id="editor" name="mo_ta">{{ old('mo_ta') }}</textarea>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div id="bienTheContainer">
                                    <div class="row align-items-center mb-2">
                                        <div class="d-flex mb-4">
                                            <div class="me-3">
                                                <input type="text" name="ten_bien_the[]" class="form-control"
                                                    placeholder="Tên biến thể">
                                            </div>
                                            <div class="thuocTinhContainer">
                                                <button type="button" class="btn btn-primary addAttribute">Thêm thuộc
                                                    tính</button>
                                            </div>
                                        </div>

                                        <label class="form-label-title">Ảnh biến thể</label>
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="anh_bien_the[]"
                                                accept="image/*">
                                        </div>

                                        <div class="d-flex">
                                            <div class="me-3">
                                                <input type="number" name="gia_nhap[]" class="form-control"
                                                    placeholder="Giá nhập">
                                            </div>
                                            <div class="me-3">
                                                <input type="number" name="gia_ban[]" class="form-control"
                                                    placeholder="Giá bán">
                                            </div>
                                            <div class="me-3">
                                                <input type="number" name="so_luong[]" class="form-control"
                                                    placeholder="Số lượng">
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger removeVariant">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="addVariant">Thêm biến thể</button>
                            </div>


                            <div class="row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let thuocTinhs = @json($thuocTinhs);

        // Thêm biến thể mới
        document.getElementById("addVariant").addEventListener("click", function() {
            let container = document.createElement("div");
            container.classList.add("bienThe");

            container.innerHTML = `
                <div class="row align-items-center mb-2">
                    <div class="col-sm-3">
                        <input type="text" name="ten_bien_the[]" class="form-control" placeholder="Tên biến thể">
                    </div>
                    <div class="thuocTinhContainer">
                    <button type="button" class="btn btn-primary addAttribute">Thêm thuộc tính</button>
                </div>
                  <div class="mb-3">
                                            <label for="anh_bien_the" class="form-label">Ảnh biến thể</label>
                                            <input type="file" class="form-control" name="anh_bien_the[]" accept="image/*">
                                        </div>
                    <div class="col-sm-2">
                        <input type="number" name="gia_nhap[]" class="form-control" placeholder="Giá nhập">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" name="gia_ban[]" class="form-control" placeholder="Giá bán">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" name="so_luong[]" class="form-control" placeholder="Số lượng">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-danger removeVariant">Xóa</button>
                    </div>
                </div>

            `;

            document.getElementById("bienTheContainer").appendChild(container);
        });

        // Xóa biến thể
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("removeVariant")) {
                event.target.closest(".bienThe").remove();
            }
        });

        // Thêm thuộc tính cho biến thể
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("addAttribute")) {
                let thuocTinhHTML = `
                    <div class="row align-items-center mt-3">
                        <div class="col-sm-5">
                            <select name="thuoc_tinh_id[]" class="form-control selectAttribute">
                                <option disabled selected>Chọn thuộc tính</option>
                                ${thuocTinhs.map(thuocTinh =>
                    `<option value="${thuocTinh.id}">${thuocTinh.ten_thuoc_tinh}</option>`
                ).join('')}
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select name="gia_tri_thuoc_tinh[]" class="form-control selectValue">
                                <option disabled selected>Chọn giá trị</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger removeAttribute">Xóa</button>
                        </div>
                    </div>`;

                event.target.closest(".thuocTinhContainer").insertAdjacentHTML("beforeend",
                    thuocTinhHTML);
            }
        });

        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('variant-image')) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = event.target.closest('.col-sm-3').querySelector(
                            '.previewImage');
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Xóa thuộc tính
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("removeAttribute")) {
                event.target.closest(".row").remove();
            }
        });


        // Load giá trị thuộc tính khi chọn thuộc tính
        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("selectAttribute")) {
                let thuocTinhId = event.target.value;
                let valueSelect = event.target.closest(".row").querySelector(".selectValue");

                // Xóa các giá trị cũ
                valueSelect.innerHTML = '<option disabled selected>Chọn giá trị</option>';

                // Tìm thuộc tính được chọn và hiển thị giá trị tương ứng
                let selectedAttribute = thuocTinhs.find(t => t.id == thuocTinhId);
                if (selectedAttribute && Array.isArray(selectedAttribute.gia_tri_thuoc_tinh)) {
                    selectedAttribute.gia_tri_thuoc_tinh.forEach(value => {
                        let option = document.createElement("option");
                        option.value = value.id;
                        option.textContent = value.gia_tri;
                        valueSelect.appendChild(option);
                    });
                } else {
                    console.error("Không tìm thấy giá trị thuộc tính");
                }
            }
        });
    });
</script>
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
