@extends('layouts.admin')

@section('title')
    Thêm mới Banner
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
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet">
    <!-- Plugin hiển thị ảnh -->
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
            border: 1px solid #ccc;
        }

        .btn-close {
            z-index: 999;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            display: block;
        }

        .invalid-feedback {
            display: block !important;
            color: red;
        }

        .image-input-wrapper.is-invalid .filepond--wrapper {
            border: 1px solid red;
        }

        .image-container.has-error {
            border: 1px solid #dc3545;
            /* Bootstrap màu đỏ */
            border-radius: 0.375rem;
            padding: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="col-12">
        <a style="width: 90px; height: 39px" href="{{ route('bannerAdmin.index') }}" class="btn btn-secondary">Quay lại</a>
        <div class="row">
            <div style="min-width: 1200px" class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Thêm mới Banner</h5>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form id="bannerForm" action="{{ route('bannerAdmin.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="oldImagePath" value="{{ old('uploaded_temp.0') }}">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="mb-4">
                                                <label class="form-label-title">Ngày bắt đầu</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    value="{{ old('start_date') }}">
                                                @error('start_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label-title">Ngày kết thúc</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    value="{{ old('end_date') }}">
                                                @error('end_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label-title">Vị trí banner</label>
                                                <select name="position" class="form-control ">
                                                    <option value="homepage">Banner chính</option>
                                                    <option value="secondary">Banner phụ</option>
                                                    <option value="sidebar">Banner sidebar</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label-title">Độ ưu tiên (1->3)</label>
                                                <input type="number" name="do_uu_tien" class="form-control"
                                                    value="{{ old('do_uu_tien') }}" id="numberInput" >
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label-title">Trạng thái</label>
                                                <select name="status" class="form-control js-example-basic-single w-100">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Ẩn</option>
                                                </select>
                                            </div>

                                            {{-- Chuyển trang nếu có 1 link chung --}}
                                            <div class="mb-4">
                                                <label class="form-label-title">Link chuyển trang chung (nếu có)</label>
                                                <textarea id="link_url" name="link_url" class="form-control">{{ old('link_url') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- Khối hình ảnh --}}
                                            <!-- Nút thêm ảnh -->
                                            <button type="button" onclick="addImageInput()"
                                                class="btn btn-primary mb-3">+
                                                Thêm ảnh</button>

                                            <!-- Wrapper chứa các nhóm ảnh -->
                                            <div id="image-wrapper">

                                                <!-- Các nhóm ảnh sẽ được thêm vào đây -->
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

    <!-- JS thư viện FilePond -->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

    <script>
        document.getElementById("numberInput").addEventListener("input", function() {
            let value = parseInt(this.value);
            if (value > 3) {
                this.value = 3;
            } else if (value < 1) {
                this.value = 1;
            }
        })
        // Đăng ký các plugin
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );

        const sanphamOptions = @json($listSanPham);
        const danhmucOptions = @json($listDanhMucSP);

        // Thêm ảnh
        let imageIndex = 0;

        function addImageInput() {
            const uniqueId = 'image-input-' + Date.now();
            const currentIndex = imageIndex;
            const imageWrapper = document.getElementById('image-wrapper');

            const imageInput = document.createElement('div');
            imageInput.classList.add('image-group', 'mb-3');

            imageInput.innerHTML = `
                <div class="image-group position-relative mb-3">
                    <input type="hidden" name="require_image[${currentIndex}]" value="1">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 btn-remove-image"></button>

                    <div class="mb-2 image-container" data-index="${currentIndex}">
                        <input type="file" name="images[${currentIndex}]" data-index="${currentIndex}" class="form-control mb-2 image-file" id="${uniqueId}">
                    </div>
                    <div class="invalid-feedback d-none"></div>

                    <div class="mb-2">
                        <label class="form-label-title">Tiêu đề</label>
                        <input type="text" name="title[${currentIndex}]" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-content">Nội dung</label>
                        <input type="text" name="content[${currentIndex}]" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-descript">Mô tả</label>
                        <input type="text" name="descript[${currentIndex}]" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-2">
                        <select name="loai_lien_ket[${currentIndex}]" class="form-control mb-2 loai-lien-ket">
                            <option value="">-- Loại liên kết --</option>
                            <option value="sanpham">Sản phẩm</option>
                            <option value="danhmuc">Danh mục</option>
                            <option value="tuychinh">Tùy chỉnh</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="select-sanpham d-none mb-2">
                        <select name="sanpham[${currentIndex}]" class="form-control js-example-basic-single w-100">
                            <option value="">-- Chọn sản phẩm --</option>
                            ${sanphamOptions.map(item => `<option value="${item.id}">${item.ten_san_pham}</option>`).join('')}
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="select-danhmuc d-none mb-2">
                        <select name="danhmuc[${currentIndex}]" class="form-control js-example-basic-single w-100">
                            <option value="">-- Chọn danh mục --</option>
                            ${danhmucOptions.map(item => `<option value="${item.id}">${item.ten_danh_muc}</option>`).join('')}
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="custom-url d-none mb-2">
                        <input type="text" name="custom_url[${currentIndex}]" class="form-control" placeholder="Nhập URL tùy chỉnh">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label-content_input">Nội dung button</label>
                            <input type="text" name="content_input[${currentIndex}]" class="form-control" placeholder="Mặc định là 'Mua ngay'">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-trang_thai_button">Trạng thái button</label>
                            <select name="trang_thai_button[${currentIndex}]" class="form-control mb-2 js-example-basic-single w-100">
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                </div>`;

            imageWrapper.appendChild(imageInput);

            // Re-init select2
            $(imageInput).find('.js-example-basic-single').select2();

            // ✅ Lấy input ngay lập tức
            const fileInput = imageInput.querySelector(`#${uniqueId}`);
            console.log('fileInput trước khi gọi FilePond:', fileInput); // <-- luôn thấy được

            // ✅ Khởi tạo FilePond
            FilePond.setOptions({
                storeAsFile: true
            });
            const pond = FilePond.create(fileInput);

            imageIndex++; // Tăng sau khi xong

            pond.on('addfile', (error, file) => {
                if (!error) {
                    fileInput.classList.remove('is-invalid');
                    const index = fileInput.dataset.index;
                    const container = document.querySelector(`.image-container[data-index="${index}"]`);
                    if (container) {
                        container.classList.remove('has-error');
                        const feedback = container.nextElementSibling;
                            if (feedback?.classList.contains('invalid-feedback')) {
                                feedback.classList.remove('d-none');
                                feedback.textContent = '';
                            }
                    } else {
                        console.warn('Không tìm thấy .image-container cho index', index);
                    }
                }
            });
        }

        document.getElementById('image-wrapper').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-image')) {
                const imageGroup = e.target.closest('.image-group');
                if (imageGroup) {
                    imageGroup.remove();
                }
            }
        });
        document.getElementById('image-wrapper').addEventListener('change', function(e) {
            if (e.target && e.target.matches('.loai-lien-ket')) {
                const value = e.target.value;
                const imageGroup = e.target.closest('.image-group');

                const selectSanPham = imageGroup.querySelector('.select-sanpham');
                const selectDanhMuc = imageGroup.querySelector('.select-danhmuc');
                const customURL = imageGroup.querySelector('.custom-url');

                selectSanPham.classList.add('d-none');
                selectDanhMuc.classList.add('d-none');
                customURL.classList.add('d-none');

                if (value === 'sanpham') {
                    selectSanPham.classList.remove('d-none');
                } else if (value === 'danhmuc') {
                    selectDanhMuc.classList.remove('d-none');
                } else if (value === 'tuychinh') {
                    customURL.classList.remove('d-none');
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const oldImage = document.getElementById('oldImagePath').value;
            const inputElement = document.querySelector('input[type="file"]');
            // Nếu có ảnh cũ -> hiển thị lại
            if (oldImage) {
                pond.addFile(oldImage);
            }
            // addImageInput();
            document.querySelectorAll('input[type="file"][name^="images"]').forEach(input => {
                FilePond.create(input);
            });


        });

        $(document).ready(function() {
            $('#bannerForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this)[0];
                let formData = new FormData(form);

                // Clear lỗi trước
                $(form).find('.is-invalid').removeClass('is-invalid');
                $(form).find('.invalid-feedback').text('');

                $.ajax({
                    url: form.action,
                    method: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.redirect) {
                            window.location.href = res.redirect;
                        }
                    },
                    error: function(xhr) {
                        console.error("AJAX Error", xhr.status, xhr.responseText);
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            Object.keys(errors).forEach(function(key) {

                                let msg = errors[key][0];

                                if (key.startsWith('require_image')) {
                                    let index = key.match(/\d+/)[0];

                                    setTimeout(() => {
                                        // ✅ Tìm container cha trước (không phụ thuộc input)
                                        let container = document.querySelector(
                                            `.image-container[data-index="${index}"]`
                                        );

                                        if (container) {
                                            // ✅ Đánh dấu lỗi vào .image-container hoặc custom class
                                            container.classList.add(
                                            "has-error");


                                            // ✅ Nếu bạn muốn highlight input của FilePond thì:
                                            let pondWrapper = container
                                                .querySelector(
                                                    '.filepond--wrapper');
                                            if (pondWrapper) {
                                                pondWrapper.classList.add(
                                                    "border",
                                                    "border-danger",
                                                    "rounded");
                                            }

                                            // ✅ Tìm và hiện feedback
                                            let feedback = container
                                                .parentElement.querySelector(
                                                    '.invalid-feedback');
                                            if (feedback) {
                                                feedback.textContent = msg;
                                                feedback.classList.remove(
                                                    'd-none');
                                            } else {
                                                console.warn(
                                                    "Không tìm thấy .invalid-feedback cho hình ảnh",
                                                    container);
                                            }
                                        }else{
                                             container.classList.remove('d-none');
                                        }
                                    }, 100); // đợi DOM render
                                    return;
                                }

                                // Chuyển "title.0" → "title[0]"
                                let convertedKey = key.replace(/\.(\d+)/g, '[$1]');

                                let input = $('[name="' + convertedKey + '"]');

                                if (input.length) {
                                    input.addClass('is-invalid');

                                    // Tìm div .invalid-feedback gần nhất phía sau
                                    let feedback = input.next('.invalid-feedback');
                                    if (!feedback.length) {
                                        // fallback nếu input nằm trong div khác
                                        feedback = input.closest('.mb-2').find(
                                            '.invalid-feedback');
                                    }

                                    if (feedback.length) {
                                        feedback.text(errors[key][0]); // Gán lỗi
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: 'Vui lòng thêm ảnh.'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
