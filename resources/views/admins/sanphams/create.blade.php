@extends('layouts.admin')

@section('title')
    Thêm mới sản phẩm
@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
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
    <style>
        /* 1. Di chuyển icon đóng (x) sang phải */
        /* Cố định chiều cao Select2 */
        .select2-container--default .select2-selection--multiple {
            min-height: 38px !important;
            /* Đặt chiều cao tối thiểu */
            height: auto !important;
            display: flex;
            align-items: center;
            /* Căn giữa nội dung */
        }


        /* Định dạng icon đóng */
        .select2-selection__choice__remove {
            /* Đẩy icon sang phải */
            right: 0 !important;
            order: 2;
            /* Đưa icon ra cuối */
            padding: 0 5px;
        }

        .select2-selection__choice__remove>span {
            float: right;
        }

        /* Tắt hover icon đóng */
        .select2-selection__choice__remove:hover {
            background: transparent !important;
            color: inherit !important;
            cursor: pointer;
        }

        /* .select2-container {
                            border: 1px solid #ccc !important;
                            width: 300px !important;
                        } */
        .selection .select2-selection {
            border-radius: 5px !important;
            width: 100%;
        }

        tr {
            padding: 8px;
        }

        .card {
            padding: 50px !important;
        }

        .image-wrapper {
            display: inline-block;
            position: relative;
            margin: 5px;
        }

        .image-wrapper img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .remove-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background: red;
            color: white;
            border: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: none;
        }
    </style>
@endsection
@section('content')
    <div class="col-12">
        <a style="float: left" href="{{ route('sanphams.index') }}" class="btn btn-secondary col-1">Trở lại</a>
        <div class="row">
            <div style="min-width: 1000px" class="col-sm-8 m-auto">
                <div style="padding: 100px;" class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Thêm mới sản phẩm</h5>
                        </div>

                        <form id="mainForm" action="{{ route('sanphams.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Tên sản phẩm --}}
                            <div class="row">
                                <!-- Cột trái -->
                                <div class="col-md-6">
                                    <input type="hidden" name="san_pham_id" id="san_pham_id" value="">
                                    <div class="mb-4">
                                        <label class="form-label-title">Tên sản phẩm</label>
                                        <input type="text" name="ten_san_pham" class="form-control"
                                            value="{{ old('ten_san_pham') }}">
                                        @error('ten_san_pham')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Mã sản phẩm</label>
                                        <input type="text" name="ma_san_pham" class="form-control"
                                            value="{{ old('ma_san_pham') }}">
                                        @error('ma_san_pham')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Giá cũ</label>
                                        <input type="number" name="gia_cu" class="form-control"
                                            value="{{ old('gia_cu', 0) }}" min="0">
                                        @error('gia_cu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Giá mới</label>
                                        <input type="number" name="gia_moi" class="form-control"
                                            value="{{ old('gia_moi', 0) }}" min="0">
                                        @error('gia_moi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Danh mục</label>
                                        <select class="form-control js-example-basic-single w-100" name="danh_muc_id">
                                            <option disabled selected>Chọn danh mục</option>
                                            @foreach ($danhMucs as $danhMuc)
                                                <option {{ $danhMuc->id == old('danh_muc_id') ? 'selected' : '' }}
                                                    value="{{ $danhMuc->id }}">
                                                    {{ $danhMuc->ten_danh_muc }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('danh_muc_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Cột phải -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label-title">Hình ảnh</label>
                                        <input type="file" name="hinh_anh" class="form-control">
                                        @if (session('temp_image'))
                                            <img src="{{ Storage::url(session('temp_image')) }}" width="150">
                                        @endif
                                        @error('hinh_anh')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="col-sm-3 col-form-label form-label-title">Album ảnh</label>

                                        <input type="file" name="album_anh[]" id="album_anh" class="form-control"
                                            multiple>
                                        <div class="image-preview" id="imagePreview"></div>

                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label-title">Trạng thái</label>
                                        <select name="trang_thai" class="form-control">
                                            <option value="1">Còn hàng</option>
                                            <option value="0">Hết hàng</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Mô tả</label>
                                        <textarea id="editor" name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                @foreach ($thuocTinhs as $tt)
                                    <div class="mb-2">
                                        <label>{{ $tt->ten_thuoc_tinh }}</label>
                                        <select name="attribute_values[{{ $tt->id }}][]"
                                            class="form-control select2" multiple
                                            data-placeholder="{{ $tt->ten_thuoc_tinh == 'Size' ? 'Chọn Size' : ($tt->ten_thuoc_tinh == 'Color' ? 'Chọn Color' : 'Chọn ' . $tt->ten_thuoc_tinh) }}">
                                            @php
                                                $selectedValues = old("attribute_values.$tt->id", []);
                                            @endphp
                                            <!-- Tạo option rỗng để Select2 nhận diện placeholder -->
                                            @foreach ($tt->giaTriThuocTinhs as $value)
                                                <option value="{{ $value->gia_tri }}"
                                                    {{ in_array($value->gia_tri, $selectedValues) ? 'selected' : '' }}>
                                                    {{ $value->gia_tri }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            {{-- @dump(old('anh_bien_the.0')) --}}

                            {{-- Danh sách biến thể --}}
                            <h4>Danh sách biến thể:</h4>
                            <table style="width: 107%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Thuộc tính</th>
                                        <th>Giá nhập</th>
                                        <th>Giá bán</th>
                                        <th>Kho hàng</th>
                                        {{-- <th>Hành động</th> --}}
                                    </tr>
                                </thead>

                                <tbody id="variantTable">
                                    @if (old('gia_nhap'))
                                        @php
                                            $deletedVariants = json_decode(old('deleted_variants', '[]'), true);
                                        @endphp

                                        @foreach (old('gia_nhap', []) as $index => $gia_nhap)
                                            @php
                                                $selectedValues = implode(
                                                    ', ',
                                                    array_merge(...array_values(old('attribute_values'))),
                                                );
                                                $selectedValues2 = explode(',', $selectedValues);
                                            @endphp

                                            <tr>
                                                <td><input type="file" name="anh_bien_the[]" class="form-control">
                                                    @error("anh_bien_the.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>{{ $selectedValues2[$index] ?? 'Không có dữ liệu' }}</td>
                                                <td><input type="number" name="gia_nhap[]"
                                                        value="{{ old("gia_nhap.$index") }}"
                                                        class="form-control @error("gia_nhap.$index") is-invalid @enderror">
                                                    @error("gia_nhap.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td><input type="number" name="gia_ban[]"
                                                        value="{{ old("gia_ban.$index") }}"
                                                        class="form-control @error("gia_ban.$index") is-invalid @enderror">
                                                    @error("gia_ban.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td><input type="number" name="so_luong[]"
                                                        value="{{ old("so_luong.$index") }}"
                                                        class="form-control @error("so_luong.$index") is-invalid @enderror">
                                                    @error("so_luong.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <input type="hidden" name="deleted_variants" id="deletedVariants"
                                value="{{ old('deleted_variants', '[]') }}">

                            <br>
                            <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                        </form>
                        {{-- <form id="uploadForm" action="{{ route('upload.album') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="multiFileUpload" class="dropzone"></div>
                        </form> --}}
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
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>/
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
< script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" >
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: function() {
                return $(this).attr('data-placeholder');
            },
            language: {
                noResults: function() {
                    return "Không tìm thấy kết quả";
                }
            },
            allowClear: true
        });
    });
</script>
<script>
    window.oldErrors = @json($errors->toArray());
    console.log(window.oldErrors);
    Object.keys(window.oldErrors).forEach(key => {
        if (key.startsWith("anh_bien_the.")) {
            let index = key.split(".")[1] || 0; // Lấy index nếu có
            $(`input[name="anh_bien_the[]"]`).eq(index).after(
                `<p class="text-danger">${window.oldErrors[key][0]}</p>`);
        }
    });
    window.oldGiaNhap = @json(old('gia_nhap', []));
    window.oldGiaBan = @json(old('gia_ban', []));
    window.oldSoLuong = @json(old('so_luong', []));
</script>

<script>
    $(document).ready(function () {
        $(".select2").select2({
            placeholder: "Chọn một giá trị",
            allowClear: true
        });

        var deletedVariants = JSON.parse($("#deletedVariants").val() || "[]");

        var oldGiaNhap = window.oldGiaNhap || [];
        var oldGiaBan = window.oldGiaBan || [];
        var oldSoLuong = window.oldSoLuong || [];

        $("#productForm").submit(function() {
            $("#deletedVariants").val(JSON.stringify(deletedVariants));
        });

        $("select[name^='attribute_values']").change(function() {
            generateVariants();
        });

        function generateVariants() {
            let selectedValues = {};
            $("select[name^='attribute_values']").each(function() {
                let attributeId = $(this).attr("name").match(/\d+/)[0];
                let values = $(this).val() || [];
                if (values.length > 0) {
                    selectedValues[attributeId] = values;
                }
            });

            let variants = cartesianProduct(Object.values(selectedValues));

            $("#variantTable").find("tr").remove();

            variants.forEach((variant, index) => {
                let variantKey = variant.join(" - ");

                let oldGiaNhapValue = oldGiaNhap[index] || "";
                let oldGiaBanValue = oldGiaBan[index] || "";
                let oldSoLuongValue = oldSoLuong[index] || "";

                let errorImg = window.oldErrors?.[`anh_bien_the.${index}`] ?
                    `<p class="text-danger">${window.oldErrors[`anh_bien_the.${index}`][0]}</p>` : '';

                let errorGiaNhap = window.oldErrors?.[`gia_nhap.${index}`] ?
                    `<p class="text-danger">${window.oldErrors[`gia_nhap.${index}`][0]}</p>` : '';
                let errorGiaBan = window.oldErrors?.[`gia_ban.${index}`] ?
                    `<p class="text-danger">${window.oldErrors[`gia_ban.${index}`][0]}</p>` : '';
                let errorSoLuong = window.oldErrors?.[`so_luong.${index}`] ?
                    `<p class="text-danger">${window.oldErrors[`so_luong.${index}`][0]}</p>` : '';

                let row = `<tr data-variant='${variantKey}'>
                    <td><input type="file" name="anh_bien_the[]" class="form-control">
                        ${errorImg}
                    </td>
                    <td><input type="hidden" name="selected_values[]" value="${variantKey}">${variantKey}</td>
                    <td>
                        <input type="number" class="form-control" name="gia_nhap[]" value="${oldGiaNhapValue}" placeholder="Giá nhập">
                        ${errorGiaNhap}
                    </td>
                    <td>
                        <input type="number" class="form-control" name="gia_ban[]" value="${oldGiaBanValue}" placeholder="Giá bán">
                        ${errorGiaBan}
                    </td>
                    <td>
                        <input type="number" class="form-control" name="so_luong[]" value="${oldSoLuongValue}" placeholder="Kho hàng">
                        ${errorSoLuong}
                    </td>
                </tr>`;

                $("#variantTable").append(row);
            });

            $(".remove-variant").on("click", function() {
                $(this).closest("tr").remove();
                updateHiddenInputs();
            });
            removeEmptyVariants();
        }

        function removeEmptyVariants() {
            let hasSelectedValues = false;
            $("select[name^='attribute_values']").each(function() {
                if ($(this).val() && $(this).val().length > 0) {
                    hasSelectedValues = true;
                }
            });

            if (!hasSelectedValues) {
                $("#variantTable").find("tr").remove();
            }
        }

        function cartesianProduct(arr) {
            return arr.reduce((a, b) => a.flatMap(d => b.map(e => [d, e].flat())), [
                []
            ]);
        }

        function updateHiddenInputs() {
            let remainingVariants = [];
            $("#variantTable tr").each(function() {
                let variantKey = $(this).find("input[name='selected_values[]']").val();
                remainingVariants.push(variantKey);
            });

            $("#hiddenVariantInput").val(JSON.stringify(remainingVariants));
        }

        $("#productForm").submit(function(e) {
            updateHiddenInputs();
        });

        if ($("select[name^='attribute_values']").val().length > 0) {
            generateVariants();
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let fileList = []; // Danh sách file
        const MAX_FILES = 6;
        const fileInput = document.getElementById("album_anh");
        const previewContainer = document.getElementById("imagePreview");

        fileInput.addEventListener("change", function(event) {
            let newFiles = Array.from(event.target.files);

            // Kiểm tra nếu tổng số file vượt quá giới hạn
            if (fileList.length + newFiles.length > MAX_FILES) {
                Swal.fire({
                    icon: "error",
                    title: "Quá số lượng!",
                    text: "Bạn chỉ có thể chọn tối đa 6 ảnh.",
                    confirmButtonColor: "#007bff"
                });
                fileInput.value = "";
                return;
            }

            // Lọc và thêm file vào danh sách
            newFiles.forEach((file) => {
                if (fileList.length < MAX_FILES) {
                    fileList.push(file);
                    previewImage(file);
                }
            });

            updateInputFiles(); // Cập nhật input file
        });

        function previewImage(file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let imgWrapper = document.createElement("div");
                imgWrapper.classList.add("image-wrapper");
                imgWrapper.setAttribute("data-name", file.name);

                let img = document.createElement("img");
                img.src = e.target.result;

                let removeBtn = document.createElement("button");
                removeBtn.innerHTML = "&times;";
                removeBtn.classList.add("remove-btn");
                removeBtn.addEventListener("click", function() {
                    removeFile(file.name);
                    imgWrapper.remove();
                });

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        }

        function removeFile(fileName) {
            fileList = fileList.filter(file => file.name !== fileName);
            updateInputFiles(); // Cập nhật input file
        }

        function updateInputFiles() {
            let dataTransfer = new DataTransfer();
            fileList.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files; // Cập nhật lại input file

        }
    });
</script>
