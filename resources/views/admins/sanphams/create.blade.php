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
        .select2-container--open .select2-dropdown {
            z-index: 7;

        }
        .select2-dropdown .select2-dropdown--below{
            width: 100px;
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

        .custom-file-upload {
            position: relative;
            display: inline-flex;
            align-items: center;
            width: 100%;
            max-width: 150px;
            /* Thu nhỏ để vừa cột */
            height: 50px;
            background-color: #f1f1f1;
            border: 2px solid #0da487;
            border-radius: 8px;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #e8e8e8;
            border-color: #0b8c72;
        }

        input[type="file"] {
            display: none;
        }

        .upload-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 100%;
            background-color: #0da487;
            color: white;
            font-size: 16px;
        }

        .upload-text {
            flex: 1;
            padding: 0 10px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
            display: none !important;
        }

        .preview-image[style*="display: block"] {
            display: block !important;
        }
        .select2-container {
            max-width: 100% !important;
        }

        .select2-dropdown {
            max-width: 100% !important;
        }
        .selection{
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="col-12">

        <div class="row">

            <div style="min-width: 1200px" class="col-sm-8 m-auto">

                <div style="padding: 100px;" class="card">
                    <div class="mb-3">
                        <a style="float: left" href="{{ route('sanphams.index') }}" class="btn btn-secondary col-1">Trở lại</a>
                    </div>
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
                                        <label class="form-label-title">Giá gốc</label>
                                        <input type="number" name="gia_cu" class="form-control"
                                            value="{{ old('gia_cu') }}">
                                        @error('gia_cu')
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

                                    <div class="mb-4">
                                        <label class="form-label-title">Trạng thái</label>
                                        <select name="trang_thai" class="form-control">
                                            <option value="1">Còn hàng</option>
                                            <option value="0">Hết hàng</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Cột phải -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label-title">Hình ảnh</label>
                                        <input style="display: block" type="file" name="hinh_anh" class="form-control">
                                        @if (session('temp_image'))
                                            <img src="{{ Storage::url(session('temp_image')) }}" width="150">
                                        @endif
                                        @error('hinh_anh')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="col-sm-3 col-form-label form-label-title">Album ảnh</label>

                                        <input style="display: block" type="file" name="album_anh[]" id="album_anh"
                                            class="form-control" multiple>
                                        <div class="image-preview" id="imagePreview"></div>

                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label-title">Mô tả</label>
                                        <textarea id="mo_ta" name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                            <h4 class="mb-3" >Thuộc tính</h4>
                            <div  class="mb-3">
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
                            </div>
                            <div>
                            <center>
                                <div>
                                    <h4>Danh sách biến thể:</h4> <br>
                                    <table style="width: 100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 125px">Ảnh</th>
                                                <th style="width: 125px">Thuộc tính</th>
                                                <th style="width: 125px">Giá bán</th>
                                                <th style="width: 125px">Kho hàng</th>
                                                {{-- <th>Hành động</th> --}}
                                            </tr>
                                        </thead>

                                        <tbody id="variantTable">
                                        </tbody>
                                    </table>
                                </div>
                                </center>
                            <input type="hidden" name="deleted_variants" id="deletedVariants"
                                value="{{ old('deleted_variants', '[]') }}">

                            <br>
                            <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

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
    window.oldGiaBan = @json(old('gia_ban', []));
    window.oldSoLuong = @json(old('so_luong', []));
</script>

<script>
    $(document).ready(function() {
    $(".select2").select2({
        placeholder: "Chọn một giá trị",
        allowClear: true
    });

    var deletedVariants = JSON.parse($("#deletedVariants").val() || "[]");
    var oldGiaBan = window.oldGiaBan || [];
    var oldSoLuong = window.oldSoLuong || [];
    var variants = [];

    $("#productForm").submit(function() {
        $("#deletedVariants").val(JSON.stringify(deletedVariants));
    });

    $("select[name^='attribute_values']").change(function() {
        generateVariants();
    });

    function attachPreviewEvents() {
        document.querySelectorAll('.file-input-bien-the').forEach((fileInput) => {
            fileInput.addEventListener('change', function() {
                console.log('File input changed:', this.files); // Debug
                const file = this.files[0];
                const previewImage = this.closest('.custom-file-upload').querySelector('.preview-image');
                const uploadText = this.closest('.custom-file-upload').querySelector('.upload-text');
                const uploadIcon = this.closest('.custom-file-upload').querySelector('.upload-icon');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        console.log('Image loaded:', e.target.result); // Debug
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        uploadText.style.opacity = '0';
                        uploadIcon.style.opacity = '0';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.style.display = 'none';
                    uploadText.style.opacity = '1';
                    uploadIcon.style.opacity = '1';
                }
            });
        });
    }

    // Gọi hàm attachPreviewEvents khi trang tải lần đầu
    document.addEventListener("DOMContentLoaded", function() {
        attachPreviewEvents();
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

        variants = cartesianProduct(Object.values(selectedValues));

        $("#variantTable").find("tr").remove();

        variants.forEach((variant, index) => {
            let variantKey = variant.join(" - ");

            let oldGiaBanValue = oldGiaBan[index] || "";
            let oldSoLuongValue = oldSoLuong[index] || "";

            let errorImg = window.oldErrors?.[`anh_bien_the.${index}`] ?
                `<p class="text-danger">${window.oldErrors[`anh_bien_the.${index}`][0]}</p>` : '';
            let errorGiaBan = window.oldErrors?.[`gia_ban.${index}`] ?
                `<p class="text-danger">${window.oldErrors[`gia_ban.${index}`][0]}</p>` : '';
            let errorSoLuong = window.oldErrors?.[`so_luong.${index}`] ?
                `<p class="text-danger">${window.oldErrors[`so_luong.${index}`][0]}</p>` : '';

            let row = `<tr data-variant='${variantKey}'>
                <td>
                    <label class="custom-file-upload">
                        <input type="file" class="file-input-bien-the" accept="image/*" name="anh_bien_the[]"/>
                        <div class="upload-icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        <span class="upload-text">Tải ảnh lên</span>
                        <img class="preview-image" src="" alt="Ảnh xem trước" style="display: none;" />
                    </label>
                    ${errorImg}
                </td>
                <td><input type="hidden" name="selected_values[]" value="${variantKey}">${variantKey}</td>
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

        // Gán lại sự kiện sau khi render bảng
        attachPreviewEvents();

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
        return arr.reduce((a, b) => a.flatMap(d => b.map(e => [d, e].flat())), [[]]);
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

    // Khôi phục variants từ dữ liệu old() khi trang reload
    if (window.oldGiaBan.length > 0) {
        // Khôi phục selected_values từ old('attribute_values')
        let selectedValues = {};
        $("select[name^='attribute_values']").each(function() {
            let attributeId = $(this).attr("name").match(/\d+/)[0];
            let values = $(this).val() || [];
            if (values.length > 0) {
                selectedValues[attributeId] = values;
            }
        });

        variants = cartesianProduct(Object.values(selectedValues));
    }

    // Kiểm tra biến thể khi submit
    $("#mainForm").submit(function(e) {
        // Kiểm tra số lượng biến thể dựa trên selected_values[]
        let variantCount = $("#variantTable").find("input[name='selected_values[]']").length;

        if (variantCount === 0) {
            e.preventDefault(); // Ngăn form submit nếu không có biến thể

            Swal.fire({
                icon: "warning",
                title: "Bạn chưa thêm biến thể!",
                text: "Vui lòng thêm ít nhất một biến thể.",
                confirmButtonText: "OK"
            });
        }
    });

    // Gọi generateVariants nếu có dữ liệu old()
    if (window.oldGiaBan.length > 0 || $("select[name^='attribute_values']").val()?.length > 0) {
        generateVariants();
    }
});
</script>
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let fileList = []; // Danh sách file thực tế
        const MAX_FILES = 6;
        const fileInput = document.getElementById("album_anh");
        const previewContainer = document.getElementById("imagePreview");
        const fileInputLabel = document.querySelector(
        "label[for='album_anh']"); // Thêm phần hiển thị trạng thái

        // Hàm cập nhật label hiển thị
        function updateFileInputLabel() {
            if (fileList.length > 0) {
                fileInputLabel.textContent = `${fileList.length} file(s) chosen`;
            } else {
                fileInputLabel.textContent = "No file chosen";
            }
        }

        fileInput.addEventListener("change", function(event) {
            let newFiles = Array.from(event.target.files);
            let availableSlots = MAX_FILES - fileList.length;

            if (availableSlots <= 0) {
                Swal.fire({
                    icon: "error",
                    title: "Đã đủ ảnh!",
                    text: `Bạn đã có đủ ${MAX_FILES} ảnh.`,
                    confirmButtonColor: "#007bff"
                });
                fileInput.value = "";
                return;
            }

            if (newFiles.length > availableSlots) {
                Swal.fire({
                    icon: "error",
                    title: "Quá số lượng!",
                    text: `Bạn chỉ có thể thêm ${availableSlots} ảnh nữa.`,
                    confirmButtonColor: "#007bff"
                });
                fileInput.value = "";
                return;
            }

            // Thêm file vào danh sách
            fileList = [...fileList, ...newFiles]; // Sử dụng spread operator để đảm bảo immutability

            // Cập nhật UI và input file
            renderPreviews();
            updateInputFiles();
            updateFileInputLabel(); // Cập nhật label hiển thị
        });

        function renderPreviews() {
            // Xóa toàn bộ preview cũ
            previewContainer.innerHTML = '';

            // Render lại toàn bộ từ fileList
            fileList.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imgWrapper = document.createElement("div");
                    imgWrapper.classList.add("image-wrapper");
                    imgWrapper.dataset.index = index;

                    let img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "100px";

                    let removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "&times;";
                    removeBtn.classList.add("remove-btn");
                    removeBtn.onclick = () => removeFile(index);

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeBtn);
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        }

        function removeFile(index) {
            fileList.splice(index, 1); // Xóa file khỏi danh sách
            renderPreviews(); // Render lại UI
            updateInputFiles(); // Cập nhật input file
            updateFileInputLabel(); // Cập nhật label
        }

        function updateInputFiles() {
            let dataTransfer = new DataTransfer();
            fileList.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            // Debug
            console.log("Current files:", Array.from(fileInput.files).map(f => f.name));
        }

        // Khởi tạo
        updateFileInputLabel();
    });
</script>
<script>
    document.getElementById('editor').addEventListener('keydown', function(event) {
        console.log(event.key); // Kiểm tra xem dấu cách có bị chặn không
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kiểm tra xem phần tử có tồn tại trước khi khởi tạo CKEditor
        if (document.querySelector('#mo_ta')) {
            ClassicEditor
                .create(document.querySelector('#mo_ta'))
                .then(editor => {
                    window.editorMoTa = editor;
                    editor.model.document.on('change:data', () => {
                        document.querySelector('textarea[name="mo_ta"]').value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error('Lỗi CKEditor (Mô tả):', error);
                });
        }
    });
</script>
