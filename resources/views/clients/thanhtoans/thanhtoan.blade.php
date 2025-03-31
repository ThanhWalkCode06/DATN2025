@extends('layouts.client')

@section('title')
    Thanh toán
@endsection

@section('css')
    <style>
        .checkbox_animated:after {
            content: "";
            position: absolute;
            top: -0.125rem;
            left: 0;
            width: 1.3rem;
            height: 1.3rem;
            background: #fff;
            border: 1px solid #ccc;
            cursor: pointer;
        }
    </style>
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Thanh toán</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Thanh toán</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Địa chỉ nhận hàng</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <form action="{{ route('thanhtoans.xuLy') }}" method="POST" id="checkoutForm">
                                                @csrf
                                                <input type="hidden" name="voucher_code" id="hiddenVoucherCode">
                                                <input type="hidden" name="tong_tien" id="hiddenTongTien">
                                                <input type="hidden" name="giam_gia" id="hiddenGiamGia">
                                                <input type="hidden" name="phuong_thuc_thanh_toan_id"
                                                    id="hiddenPaymentMethod" value="1">
                                                <div class="mt-3">
                                                    <label for="">Họ và tên:</label>
                                                    <input class="form-control" type="text" name="ten_nguoi_nhan"
                                                        value="{{ Auth::user()->ten_nguoi_dung ?? '' }}">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="">Email:</label>
                                                    <input class="form-control" type="text" name="email_nguoi_nhan"
                                                        value="{{ Auth::user()->email ?? '' }}">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="">Số điện thoại:</label>
                                                    <input class="form-control" type="number" name="sdt_nguoi_nhan"
                                                        value="{{ Auth::user()->so_dien_thoai ?? '' }}">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="">Địa chỉ:</label>
                                                    <input class="form-control" type="text" name="dia_chi_nguoi_nhan"
                                                        value="{{ Auth::user()->dia_chi ?? '' }}">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="">Ghi chú:</label>
                                                    <input class="form-control" type="text" name="ghi_chu"
                                                        value="{{ old('ghi_chu') ?? '' }}">
                                                    @error('dia_chi_nguoi_nhan')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- <div class="mt-3">
                                                    <input style="border:#0da487" class="checkbox_animated checkall" type="checkbox" name="chinh_sach">
                                                    <label for="">Đồng ý rằng khi hoàn hàng sẽ không được nhận lại tiền</label>
                                                </div> --}}
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Hình thức thanh toán</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="accordion accordion-flush custom-accordion"
                                                id="accordionFlushExample">

                                                @foreach ($pttts as $item)
                                                    @if ($item['trang_thai'] == 1)
                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingOne">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseOne">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="{{ 'cash' . $item['id'] }}">
                                                                            <input class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="{{ 'cash' . $item['id'] }}"
                                                                                data-id="{{ $item['id'] }}"
                                                                                {{ $item['id'] == 1 ? 'checked' : '' }}>
                                                                            {{ $item['ten_phuong_thuc'] }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Chi tiết đơn hàng</h3>
                            </div>
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Phiếu giảm giá</h6>
                                <form id="voucherForm" action="{{ route('voucher.giohang') }}" method="post">
                                    @csrf
                                    <div class="mb-3 coupon-box input-group">
                                        <input style="border: 1px solid #0da487;" id="voucherCode" type="text"
                                            class="form-control" id="exampleFormControlInput1"
                                            placeholder="Nhập mã phiếu">
                                        <button style="border: 1px solid #0da487;margin-top: 0px;" type="submit"
                                            class="btn-apply">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                            <ul class="summery-contain">
                                @foreach ($chiTietGioHangs as $chiTietGioHang)
                                    <li>
                                        <img src="{{ Storage::url($chiTietGioHang->hinh_anh) }}"
                                            class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>{{ $chiTietGioHang->ten_san_pham }} x
                                            <span class="so-luong">{{ $chiTietGioHang->so_luong }}</span>
                                            <span>{{ $chiTietGioHang->bienThe->ten_bien_the }}</span>
                                        </h4>

                                        <h4 hidden><span class="gia-moi">{{ $chiTietGioHang->bienThe->gia_ban }}</span>đ
                                        </h4>
                                        <h4 class="price"><span class="tong"></span>đ</h4>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="summery-total">
                                <li>
                                    <h4>Tổng tiền sản phẩm</h4>
                                    <h4 class="price"><span id="tong-san-pham"></span>đ</h4>
                                </li>

                                <li>
                                    <h4>Phí vận chuyển</h4>
                                    <h4 class="price"><span id="phi-van-chuyen">10.000</span>đ</h4>
                                </li>

                                <li>
                                    <h4>Giảm giá</h4>
                                    <h4 class="price">- <span id="giam-gia">0</span>đ</h4>
                                </li>

                                <li class="list-total">
                                    <h4>Tổng tiền</h4>
                                    <h4 class="price"><span id="tong-tien"></span>đ</h4>
                                </li>
                            </ul>
                        </div>

                        <a href="javascript:void(0);" id="btnDatHang"
                            class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">
                            Đặt hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection

@section('js')
    <script>
        let phiVanChuyen = document.getElementById("phi-van-chuyen");


        let originalDiscount = parseFloat($("#giam-gia").text().replace(/\D/g, "")); // Lấy giảm giá ban đầu
        let voucherCode = $("#voucherCode").val().trim();


        $(document).ready(function() {
            let originalTotal = $("#tong-tien").text().trim(); // Lưu tổng tiền gốc
            let appliedVoucher = ""; // Lưu mã đã áp dụng (ban đầu rỗng)
            let tongTienHienTai = Number($("#tong-tien").text().replace(/\D/g, "")) || 0;

            $("#voucherForm").submit(function(event) {
                event.preventDefault();
                let voucherCode = $("#voucherCode").val().trim();

                if (!voucherCode) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text: "Vui lòng nhập mã giảm giá.",
                        confirmButtonText: "OK"
                    });
                    return;
                }

                if (voucherCode !== appliedVoucher) {
                    $("#tong-tien").text(originalTotal.toLocaleString("vi-VN"));
                    $("#giam-gia").text("0đ");
                }

                // ✅ Ngăn nhập lại cùng 1 mã nhưng cho phép đổi mã khác
                if (voucherCode === appliedVoucher) {
                    Swal.fire({
                        icon: "warning",
                        title: "Thông báo!",
                        text: "Mã giảm giá này đã được áp dụng!",
                        confirmButtonText: "OK"
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('voucher.giohang') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: voucherCode,
                        total: tongTienHienTai
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Áp dụng thành công!",
                                text: `Bạn được giảm ${response.discount.toLocaleString("vi-VN")}đ.`,
                                confirmButtonText: "OK"
                            });

                            // ✅ Cập nhật tổng tiền và giảm giá
                            $("#tong-tien").text(response.newTotal.toLocaleString("vi-VN"));
                            $("#giam-gia").text(response.discount.toLocaleString("vi-VN"));

                            appliedVoucher = voucherCode; // ✅ Lưu mã đã áp dụng
                        }
                    },
                    error: function(xhr) {
                        // let errorMessage = "Lỗi server! Vui lòng thử lại sau.";
                        console.log(xhr)
                        if (xhr.status === 403 && xhr.responseJSON && xhr.responseJSON
                            .message) {
                            errorMessage = xhr.responseJSON.message;

                            // ✅ Reset tổng tiền khi nhập sai mã
                            $("#tong-tien").text(originalTotal);
                            $("#giam-gia").text("0");

                            appliedVoucher = ""; // ✅ Cho phép nhập lại mã khác
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Lỗi!",
                            text: errorMessage,
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });





        function showTong() {
            let giaMois = document.getElementsByClassName("gia-moi");
            let soLuongs = document.getElementsByClassName("so-luong");
            let tongs = document.getElementsByClassName("tong");

            let tongSanPham = document.getElementById("tong-san-pham");
            let giamGia = document.getElementById("giam-gia");
            let phiVanChuyen = document.getElementById("phi-van-chuyen");
            let tongTien = document.getElementById("tong-tien");

            let sum = 0;

            for (let i = 0; i < giaMois.length; i++) {
                let giaMoi = Number(giaMois[i].innerHTML.replace(/\./g, "").replace("đ", "").trim());
                let soLuong = Number(soLuongs[i].innerHTML.replace(/\D/g, "").trim());

                let tong = giaMoi * soLuong;
                tongs[i].innerHTML = tong.toLocaleString("vi-VN"); // Hiển thị có dấu chấm phân cách

                sum += tong;
            }

            tongSanPham.innerHTML = sum.toLocaleString("vi-VN");

            let giamGiaValue = Number(giamGia.innerHTML.replace(/\./g, "").replace("đ", "").trim()) || 0;
            let phiVanChuyenValue = Number(phiVanChuyen.innerHTML.replace(/\./g, "").replace("đ", "").trim()) || 0;

            let total = sum - giamGiaValue + phiVanChuyenValue;
            tongTien.innerHTML = total.toLocaleString("vi-VN");
        }
        showTong()

        $(document).ready(function() {

            function updateHiddenInputs() {
                // Lấy giá trị từ HTML và chuyển thành số
                let tongSanPham = parseInt($('#tong-tien').text().replace(/\D/g, '')) || 0;
                let phiVanChuyen = parseInt($('#phi-van-chuyen').text().replace(/\D/g, '')) || 0;
                let giamGia = parseInt($('#giam-gia').text().replace(/\D/g, '')) || 0;
                let voucherCode = $('#voucherCode').val() || ''; // Lấy mã giảm giá nếu có

                // Tính tổng tiền = Tổng sản phẩm + Phí vận chuyển - Giảm giá
                let tongTien = tongSanPham;

                // Gán giá trị vào input ẩn
                $('#hiddenTongTien').val(tongTien);
                $('#hiddenGiamGia').val(giamGia);
                $('#hiddenVoucherCode').val(voucherCode);

                console.log("Tổng tiền:", tongTien);
                console.log("Giảm giá:", giamGia);
                console.log("Mã giảm giá:", voucherCode);
            }

            $('input[name="flexRadioDefault"]').on('change', function() {
                let paymentMethodId = $(this).data('id'); // Lấy ID từ thuộc tính data-id
                $('#hiddenPaymentMethod').val(paymentMethodId); // Gán vào input ẩn
                console.log("Phương thức thanh toán đã chọn:", paymentMethodId);
            });

            $("#btnDatHang").click(function(e) {
                e.preventDefault(); // Ngăn chặn load lại trang
                updateHiddenInputs();

                // Lấy dữ liệu từ form
                var formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Lấy CSRF token
                    voucher_code: $('#hiddenVoucherCode').val(),
                    tong_tien: $('#hiddenTongTien').val(),
                    giam_gia: $('#hiddenGiamGia').val(),
                    phuong_thuc_thanh_toan_id: $('#hiddenPaymentMethod').val(),
                    ten_nguoi_nhan: $('input[name="ten_nguoi_nhan"]').val(),
                    email_nguoi_nhan: $('input[name="email_nguoi_nhan"]').val(),
                    sdt_nguoi_nhan: $('input[name="sdt_nguoi_nhan"]').val(),
                    dia_chi_nguoi_nhan: $('input[name="dia_chi_nguoi_nhan"]').val(),
                    ghi_chu: $('input[name="ghi_chu"]').val(),
                };
                // Gửi request AJAX
                $.ajax({
                    url: "{{ route('thanhtoans.xuLy') }}", // Đường dẫn đến route xử lý thanh toán
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        console.log(response)
                        if (response.status === "vnpay") {
                            window.location.href = response.vnpay_url;
                        } else if (response.status === "success") {
                            window.location.href = `/dathangthanhcong/${response.id}`;
                        }
                    },
                    error: function(xhr) {
                        let response = xhr.responseJSON;
                        if (response && response.over_quantity) {
                            let message =
                                "<strong>Sản phẩm vượt quá số lượng tồn kho:</strong><br>";
                            response.over_quantity.forEach(item => {
                                message +=
                                    `🔹 ${item.ten_san_pham}: ${item.so_luong_muon_mua} / ${item.so_luong_ton_kho} kho<br>`;
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Lỗi số lượng!",
                                html: message, // Dùng html để hiển thị danh sách sản phẩm
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Lỗi!",
                                text: response.message ||
                                    "Có lỗi xảy ra, vui lòng thử lại!",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("checkoutForm").addEventListener("submit", function(event) {
                let isValid = true;

                // Lấy giá trị của các trường
                let ten = document.querySelector("[name='ten_nguoi_nhan']").value.trim();
                let email = document.querySelector("[name='email_nguoi_nhan']").value.trim();
                let sdt = document.querySelector("[name='sdt_nguoi_nhan']").value.trim();
                let diaChi = document.querySelector("[name='dia_chi_nguoi_nhan']").value.trim();

                // Reset lỗi cũ
                document.querySelectorAll(".error-message").forEach(el => el.remove());

                // Kiểm tra Họ và tên
                if (ten === "") {
                    showError("[name='ten_nguoi_nhan']", "Vui lòng nhập họ và tên");
                    isValid = false;
                }

                // Kiểm tra Email
                if (email === "") {
                    showError("[name='email_nguoi_nhan']", "Vui lòng nhập email");
                    isValid = false;
                } else if (!validateEmail(email)) {
                    showError("[name='email_nguoi_nhan']", "Email không hợp lệ");
                    isValid = false;
                }

                // Kiểm tra Số điện thoại
                if (sdt === "") {
                    showError("[name='sdt_nguoi_nhan']", "Vui lòng nhập số điện thoại");
                    isValid = false;
                } else if (!/^\d{10,11}$/.test(sdt)) {
                    showError("[name='sdt_nguoi_nhan']", "Số điện thoại phải có 10-11 số");
                    isValid = false;
                }

                // Kiểm tra Địa chỉ
                if (diaChi === "") {
                    showError("[name='dia_chi_nguoi_nhan']", "Vui lòng nhập địa chỉ");
                    isValid = false;
                }

                // Nếu có lỗi, ngăn không cho submit
                if (!isValid) {
                    event.preventDefault();
                }
            });

            // Hàm hiển thị lỗi
            function showError(selector, message) {
                let inputField = document.querySelector(selector);
                let errorDiv = document.createElement("div");
                errorDiv.className = "error-message text-danger mt-1";
                errorDiv.textContent = message;
                inputField.parentNode.appendChild(errorDiv);
            }

            // Hàm kiểm tra email hợp lệ
            function validateEmail(email) {
                let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
@endsection
