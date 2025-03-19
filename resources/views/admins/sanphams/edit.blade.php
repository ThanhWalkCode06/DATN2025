@extends('layouts.admin')

@section('title')
    Sửa sản phẩm    
@endsection
@section('css')
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
    min-height: 38px !important; /* Đặt chiều cao tối thiểu */
    height: auto !important;
    display: flex;
    align-items: center; /* Căn giữa nội dung */
}


/* Định dạng icon đóng */
.select2-selection__choice__remove { /* Đẩy icon sang phải */
    right: 0 !important;
    order: 2; /* Đưa icon ra cuối */
    padding: 0 5px;
}
.select2-selection__choice__remove > span{
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
tr{
    padding: 8px;
}
.card{
    padding: 50px !important;
}
.image-preview {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
}

.image-item {
    position: relative;
    display: inline-block;
}

.image-item img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.remove-image {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    border: none;
    font-size: 16px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
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
                            <h5>Sửa sản phẩm</h5>
                        </div>

                        <form id="mainForm" action="{{ route('sanphams.update',$sanpham->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- Tên sản phẩm --}}
                            <div class="row">
                                <!-- Cột trái -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label-title">Tên sản phẩm</label>
                                        <input type="text" name="ten_san_pham" class="form-control" value="{{ $sanpham->ten_san_pham }}">
                                        @error('ten_san_pham') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Mã sản phẩm</label>
                                        <input type="text" name="ma_san_pham" class="form-control" value="{{ $sanpham->ma_san_pham }}">
                                        @error('ma_san_pham') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Giá cũ</label>
                                        <input type="number" name="gia_cu" class="form-control" value="{{ $sanpham->gia_cu }}" min="0">
                                        @error('gia_cu') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Giá mới</label>
                                        <input type="number" name="gia_moi" class="form-control" value="{{ $sanpham->gia_moi }}" min="0">
                                        @error('gia_moi') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label-title">Danh mục</label>
                                        <select class="form-control js-example-basic-single w-100" name="danh_muc_id">
                                            <option disabled selected>Chọn danh mục</option>
                                            @foreach ($danhMucs as $danhMuc)
                                                <option {{ $danhMuc->id == $sanpham->danh_muc_id ? 'selected' : '' }} value="{{ $danhMuc->id }}">
                                                    {{ $danhMuc->ten_danh_muc }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('danh_muc_id') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label-title">Trạng thái</label>
                                        <select name="trang_thai" class="form-control">
                                            <option {{ $sanpham->trang_thai == 1 ? 'selected' : '' }} value="1">Còn hàng</option>
                                            <option {{ $sanpham->trang_thai == 0 ? 'selected' : '' }} value="0">Hết hàng</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Cột phải -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label-title">Hình ảnh</label>
                                        <input type="file" name="hinh_anh" class="form-control">
                                        <img src="{{ Storage::url($sanpham->hinh_anh) }}" width="150">
                                        @error('hinh_anh') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="col-sm-3 col-form-label form-label-title">Album ảnh</label>

                                        <input type="file" name="album_anh[]" id="album_anh" class="form-control" multiple>

                                        <div class="image-preview" id="imagePreview">
                                            @foreach ($sanpham->anhSP as $img)
                                            <div class="image-item" data-id="{{ $img->id }}">
                                                <img style="width: 100px" src="{{ Storage::url($img->link_anh_san_pham) }}" alt="">
                                                <button type="button" class="remove-image" data-id="{{ $img->id }}">&times;</button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label-title">Mô tả</label>
                                        <textarea id="editor" name="mo_ta" class="form-control">{{ $sanpham->mo_ta }}</textarea>
                                    </div>
                                </div>
                            </div>
                        <h4>Thêm Thuộc Tính</h4>
                        <div class="mb-3">
                            @foreach ($thuocTinhs as $tt)
                                <div class="mb-2">
                                    <label>{{ $tt->ten_thuoc_tinh }}</label>
                                    <select name="attribute_values[{{ $tt->id }}][]" class="form-control select2" multiple
                                        data-placeholder="{{ $tt->ten_thuoc_tinh == 'Size' ? 'Chọn Size' : ($tt->ten_thuoc_tinh == 'Color' ? 'Chọn Color' : 'Chọn ' . $tt->ten_thuoc_tinh) }}">
                                        @php
                                            // Nếu có biến thể, lấy từ biến thể, nếu không lấy từ checkedTT
                                            $selectedValues = isset($bienThe)
                                                ? explode(' - ', $bienThe->ten_bien_the)
                                                : array_unique(array_merge(...$checkedTT));
                                        @endphp
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

                            {{-- Danh sách biến thể --}}
                            <label class="mt-3"><strong>Danh sách biến thể:</strong></label>
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
                                    @php
                                        $uniqueBienThes = $sanpham->bienThes->unique('ten_bien_the');
                                    @endphp
                                    @foreach ($uniqueBienThes as $index => $bienThe)
                                        <tr data-variant="{{ $bienThe->ten_bien_the }}">
                                            {{-- <p>{{ $index }}</p> --}}
                                            <td>
                                                <input type="file" name="anh_bien_the[]" class="form-control">
                                                <input type="hidden" name="anh_cu[]" value="{{ $bienThe->anh_bien_the }}">
                                                <img style="height: 100px; width: 100px" src="{{ Storage::url($bienThe->anh_bien_the) }}" class="preview-image">
                                                @error("anh_bien_the.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="hidden" name="selected_values[]" value="{{ $bienThe->ten_bien_the }}">
                                                {{ $bienThe->ten_bien_the }}
                                            </td>
                                            <td><input type="number" name="gia_nhap[]" value="{{ $bienThe->gia_nhap }}" class="form-control">
                                                @error("gia_nhap.$index")
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td><input type="number" name="gia_ban[]" value="{{ $bienThe->gia_ban }}" class="form-control">
                                            @error("gia_ban.$index")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="so_luong[]" value="{{ $bienThe->so_luong }}"
                                                class="form-control @error('so_luong.' . $index) is-invalid @enderror">
                                            @error('so_luong.'.$index)
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                                <!-- Lưu dữ liệu biến thể ban đầu vào hidden input -->
                                <input type="hidden" id="existingVariantsData" value='@json($uniqueBienThes)'>

                            </table>
                            {{-- <input type="hidden" name="deleted_variants" id="deletedVariants" value="{{ old('deleted_variants', '[]') }}"> --}}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    $(document).ready(function () {
    $(".select2").select2({
        placeholder: "Chọn một giá trị",
        allowClear: true
    });

    let existingVariants = {}; // Lưu trữ biến thể đã có trước khi chỉnh sửa

    let errors = @json($errors->toArray()); // Lỗi từ Form Request
    let oldValues = @json(old()); // Dữ liệu cũ nếu submit lỗi
    let initialVariants = @json($existingVariants ?? []); // Dữ liệu biến thể từ server khi edit

    console.log("Errors:", errors);
    console.log("Old Values:", oldValues);
    console.log("Initial Variants:", initialVariants);

    function restoreOldData() {
    // Nếu có dữ liệu cũ (submit lỗi)
    if (oldValues['selected_values'] && oldValues['selected_values'].length > 0) {
        oldValues['selected_values'].forEach((variantKey, index) => {
            existingVariants[variantKey] = {
                gia_nhap: oldValues['gia_nhap'] ? oldValues['gia_nhap'][index] || "" : "",
                gia_ban: oldValues['gia_ban'] ? oldValues['gia_ban'][index] || "" : "",
                so_luong: oldValues['so_luong'] ? oldValues['so_luong'][index] || "" : "",
                anh_cu: oldValues['anh_cu'] ? oldValues['anh_cu'][index] || "" : ""
            };
        });
    }
    // Nếu không có oldValues nhưng có dữ liệu từ server (edit)
    else if (initialVariants.length > 0) {
        initialVariants.forEach(variant => {
            existingVariants[variant.key] = {
                gia_nhap: variant.gia_nhap || "",
                gia_ban: variant.gia_ban || "",
                so_luong: variant.so_luong || "",
                anh_cu: variant.anh_cu || ""
            };
        });
    }
    // Nếu không có dữ liệu từ PHP, lấy từ HTML có sẵn
    else {
        $("#variantTable tr").each(function () {
            let variantKey = $(this).data("variant");
            if (variantKey) {
                existingVariants[variantKey] = {
                    gia_nhap: $(this).find("input[name='gia_nhap[]']").val() || "",
                    gia_ban: $(this).find("input[name='gia_ban[]']").val() || "",
                    so_luong: $(this).find("input[name='so_luong[]']").val() || "",
                    anh_cu: $(this).find("input[name='anh_cu[]']").val() || ""
                };
            }
        });
    }

    console.log("Existing Variants after restore:", existingVariants);
}


    restoreOldData();

    function generateVariants() {
        let selectedValues = {};

        $("select[name^='attribute_values']").each(function () {
            let attributeId = $(this).attr("name").match(/\d+/)[0];
            let values = $(this).val() || [];
            if (values.length > 0) {
                selectedValues[attributeId] = values;
            }
        });

        let variants = cartesianProduct(Object.values(selectedValues));
        let newVariants = {};

        if (Object.keys(selectedValues).length === 0 || variants.length === 0) {
            $("#variantTable").empty();
            return;
        }

        $("#variantTable").closest("table").show();

        variants.forEach(variant => {
            let variantKey = variant.join(" - ");
            if (existingVariants[variantKey]) {
                newVariants[variantKey] = existingVariants[variantKey]; // Giữ lại dữ liệu cũ
            } else {
                newVariants[variantKey] = { gia_nhap: "", gia_ban: "", so_luong: "", anh_cu: "" };
            }
        });

        existingVariants = newVariants;
        console.log("Existing Variants after generating:", existingVariants);
        renderVariantTable();
    }

    function renderVariantTable() {
        $("#variantTable").empty();

        if (Object.keys(existingVariants).length === 0) {
            return;
        }

        Object.keys(existingVariants).forEach((variantKey, index) => {
            let data = existingVariants[variantKey];

            let error_gia_nhap = errors[`gia_nhap.${index}`] ? `<p class="text-danger">${errors[`gia_nhap.${index}`][0]}</p>` : '';
            let error_gia_ban = errors[`gia_ban.${index}`] ? `<p class="text-danger">${errors[`gia_ban.${index}`][0]}</p>` : '';
            let error_so_luong = errors[`so_luong.${index}`] ? `<p class="text-danger">${errors[`so_luong.${index}`][0]}</p>` : '';

            let row = `<tr data-variant="${variantKey}">
                <td>
                    <input type="file" name="anh_bien_the[]" class="form-control">
                    <input type="hidden" name="anh_cu[]" value="${data.anh_cu}">
                    ${data.anh_cu ? `<img src="/storage/${data.anh_cu}" width="50" class="preview-image">` : ""}
                </td>
                <td><input type="hidden" name="selected_values[]" value="${variantKey}">${variantKey}</td>
                <td>
                    <input type="number" name="gia_nhap[]" value="${data.gia_nhap}" class="form-control">
                    ${error_gia_nhap}
                </td>
                <td>
                    <input type="number" name="gia_ban[]" value="${data.gia_ban}" class="form-control">
                    ${error_gia_ban}
                </td>
                <td>
                    <input type="number" name="so_luong[]" value="${data.so_luong}" class="form-control">
                    ${error_so_luong}
                </td>
            </tr>`;

            $("#variantTable").append(row);
        });
    }

    function cartesianProduct(arr) {
        return arr.reduce((a, b) => a.flatMap(d => b.map(e => [d, e].flat())), [[]]);
    }

    $(".select2").on("change", function () {
        generateVariants();
    });

    renderVariantTable();
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const MAX_FILES = 6; // Giới hạn ảnh
        let fileList = []; // Danh sách file mới
        let previewContainer = document.getElementById("imagePreview");
        let fileInput = document.getElementById("album_anh");

        // XÓA ẢNH CŨ KHI BẤM NÚT "XÓA"
        document.querySelectorAll(".remove-image").forEach(button => {
            button.addEventListener("click", function () {
                let parentDiv = this.closest(".image-item");
                let imageId = this.getAttribute("data-id");
                parentDiv.remove(); // Xóa ảnh khỏi giao diện
                updateFileLimit();

            });
        });

        // HIỂN THỊ ẢNH MỚI KHI CHỌN FILE
        fileInput.addEventListener("change", function (event) {
            let newFiles = Array.from(event.target.files);

            // Kiểm tra tổng số file không vượt quá MAX_FILES
            if (document.querySelectorAll(".image-item").length + newFiles.length > MAX_FILES) {
                Swal.fire({
                    icon: "error",
                    title: "Quá số lượng!",
                    text: "Bạn chỉ có thể chọn tối đa 6 ảnh.",
                    confirmButtonColor: "#007bff"
                });
                fileInput.value = ""; // Xóa file đã chọn
                return;
            }

            // Lặp qua các file mới và hiển thị ảnh xem trước
            newFiles.forEach(file => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgWrapper = document.createElement("div");
                    imgWrapper.classList.add("image-item");

                    let img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "100px";

                    let removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "&times;";
                    removeBtn.classList.add("remove-image");
                    removeBtn.addEventListener("click", function () {
                        imgWrapper.remove();
                        updateFileLimit();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeBtn);
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });

            updateFileLimit();
        });

        // CẬP NHẬT GIỚI HẠN FILE
        function updateFileLimit() {
            let currentFiles = document.querySelectorAll(".image-item").length;
            fileInput.disabled = (currentFiles >= MAX_FILES);
        }
    });
</script>


