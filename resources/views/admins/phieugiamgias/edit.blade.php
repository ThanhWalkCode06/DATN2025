@extends('layouts.admin')

@section('title')
Chỉnh sửa mã giảm giá
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
@endsection


@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector(".theme-form");
        const submitButton = document.getElementById("update-button");
        let isFormChanged = false;

        // Danh sách các trường cần kiểm tra
        const fields = [{
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

        // Kiểm tra khi nhập liệu để kích hoạt nút submit
        form.addEventListener("input", function() {
            isFormChanged = true;
            submitButton.disabled = false;
        });

        // Kiểm tra trước khi submit
        form.addEventListener("submit", function(event) {
            let isValid = true;

            fields.forEach(field => {
                let input = document.querySelector(`[name="${field.name}"]`);
                let errorDiv = input.nextElementSibling;

                // Xóa thông báo lỗi cũ nếu có
                if (errorDiv && errorDiv.classList.contains("text-danger")) {
                    errorDiv.remove();
                }

                // Kiểm tra nếu trường bị bỏ trống
                if (!input.value.trim()) {
                    isValid = false;
                    let errorMessage = document.createElement("div");
                    errorMessage.classList.add("text-danger");
                    errorMessage.innerText = field.message;
                    input.parentElement.appendChild(errorMessage);
                    input.classList.add("border", "border-danger"); // Thêm viền đỏ để báo lỗi
                } else {
                    input.classList.remove("border", "border-danger"); // Xóa viền đỏ nếu hợp lệ
                }
            });

            if (!isValid) {
                event.preventDefault(); // Ngăn form gửi nếu có lỗi
            } else if (!isFormChanged) {
                event.preventDefault();
                alert("Không có thay đổi nào được thực hiện.");
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