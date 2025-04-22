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

        .ribbon-new {
            width: 80px;
            height: 80px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
        }

        .ribbon-new span {
            position: absolute;
            display: block;
            width: 80px;
            padding: 5px 0;
            background: #f11b3f;
            color: #fff;
            font-size: 8px;
            font-weight: bold;
            text-align: center;
            transform: rotate(45deg);
            top: 9px;
            right: -25px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-dung-ngay {
            transition: all 0.2s ease;
            background-color: #198754;
            /* màu bg-success */
        }

        .btn-dung-ngay:hover {
            background-color: #157347;
            /* xanh đậm hơn khi hover */
            text-decoration: none;
        }

        .btn-dung-ngay:active {
            transform: scale(0.95);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3) inset;
        }

        .btn-apply {
            background-color: #0da487;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
        }

    </style>

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
                                                            <div class="accordion-header"
                                                                id="flush-heading{{ $item['id'] }}">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapse{{ $item['id'] }}">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="{{ 'payment_method_' . $item['id'] }}">
                                                                            <input class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="{{ 'payment_method_' . $item['id'] }}"
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
                                                {{-- Hiện số dư --}}
                                                @if ($item['id'] == 3)
                                                    <div id="soDuViBox" class="mt-2 ms-4 text-success"
                                                        style="display: none;">
                                                        Số dư ví: <strong>{{ number_format($soDuVi ?? 0, 0, ',', '.') }}
                                                            VNĐ</strong>
                                                    </div>
                                                @endif
                                                {{-- Hiện số dư --}}

                                                <!-- Modal Điều Khoản -->
                                                {{-- <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content shadow">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="termsModalLabel">Điều khoản thanh toán</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <p>Khi thanh toán online bằng VNPAY hoặc bằng Ví, nếu quý khách huỷ hàng hoặc trả hàng thì tiền sẽ được trả về Ví của quý khách.</p>
                                                        <p>Số tiền đó <strong>chỉ dùng để mua hàng</strong> trong cửa hàng của chúng tôi, Ví đó <strong>không thể nạp cũng như không thể rút tiền</strong> </p>
                                                        <p>Nếu không đồng ý điều khoản bạn chỉ có thể mua hàng và thanh toán bằng tiền mặt. Trân trọng!</p>
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input" type="checkbox" id="agreeTerms">
                                                            <label class="form-check-label" for="agreeTerms">
                                                            Tôi đồng ý với điều khoản mua hàng
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                        <button type="button" class="btn btn-primary" id="acceptTerms" disabled>Chấp nhận</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div> --}}


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
                            <a href="javascript:void(0);" id="btnMaGiamGia"
                                class="btn theme-bg-color text-white btn-md w-100 mt-3 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#modalVoucher">
                                Phiếu giảm giá dành cho bạn
                            </a>

                            <br>
                            <div class="coupon-cart">
                                {{-- <h6 class="text-content mb-2">Phiếu giảm giá</h6> --}}
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
                                        <img src="{{ Storage::url($chiTietGioHang->anh_bien_the) }}"
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

                    <!-- Modal Phiếu Giảm Giá -->
                    <div id="modalVoucher" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Danh sách phiếu giảm giá</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-4 pt-2 pb-4">
                                    <div class="d-flex flex-column gap-3">
                                        @foreach ($phieuGiamGiaThanhToans->sortByDesc('ngay_bat_dau') as $key => $phieu)
                                            @php
                                                $laMoi = \Carbon\Carbon::parse($phieu->ngay_bat_dau)->gt(
                                                    now()->subDays(3),
                                                );
                                            @endphp

                                            <div class="card shadow-sm border-0 w-100 position-relative">
                                                @if ($laMoi)
                                                    <div class="ribbon-new">
                                                        <span>Mới</span>
                                                    </div>
                                                @endif
                                                <div
                                                    class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start position-relative">
                                                    <div
                                                        class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start">
                                                        <!-- Cột trái: thông tin chính -->
                                                        <div class="d-flex align-items-start flex-grow-1">
                                                            <div class="bg-danger text-white rounded p-2 me-3 text-center"
                                                                style="min-width: 55px;">
                                                                <strong
                                                                    style="font-size: 1.2rem;">{{ $phieu->gia_tri }}%</strong>
                                                            </div>

                                                            <div>
                                                                <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">
                                                                    {{ $phieu->ten_phieu }}</h5>
                                                                <div class="text-muted mb-1 fw-semibold">Mã: <span
                                                                        class="text-dark">{{ $phieu->ma_phieu }}</span>
                                                                </div>
                                                                <div class="text-muted small mb-1">
                                                                    {{ date('d/m/Y', strtotime($phieu->ngay_bat_dau)) }} -
                                                                    {{ date('d/m/Y', strtotime($phieu->ngay_ket_thuc)) }}
                                                                </div>

                                                                <div class="text-muted small mb-1">
                                                                    Đơn tối thiểu:
                                                                    <strong>{{ number_format($phieu->muc_gia_toi_thieu, 0, ',', '.') }}đ</strong><br>
                                                                    Giảm tối đa:
                                                                    <strong>{{ number_format($phieu->muc_giam_toi_da, 0, ',', '.') }}đ</strong>
                                                                </div>

                                                                <a class="text-primary small d-inline-block mt-1"
                                                                    data-bs-toggle="collapse"
                                                                    href="#description{{ $key }}" role="button"
                                                                    aria-expanded="false"
                                                                    aria-controls="description{{ $key }}">
                                                                    Xem mô tả
                                                                </a>

                                                                <div class="collapse mt-1"
                                                                    id="description{{ $key }}">
                                                                    <p class="small mb-0">{{ $phieu->mo_ta }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-column justify-content-between align-items-end ms-md-3 mt-2 mt-md-0"
                                                            style="min-width: 90px;">
                                                            <div class="flex-grow-1">
                                                                @if ($phieu->trang_thai == 1)
                                                                    <span class="badge bg-success"
                                                                        >Hoạt động</span>
                                                                @else
                                                                    <span class="badge bg-danger"
                                                                        >Không hoạt động</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <button type="button"
                                                            class="badge bg-success d-inline-block py-2 px-4 fw-bold text-white position-absolute btn-dung-ngay"
                                                            style="bottom: 1rem; right: 1rem; font-size: 0.95rem; border-radius: 20px;"
                                                            onclick="copyMaPhieu('{{ $phieu->ma_phieu }}')">
                                                            Sao chép mã
                                                        </button>


                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- điều khoản --}}
    {{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    let accepted = false;
    const acceptTermsButton = document.getElementById('acceptTerms');
    const agreeCheckbox = document.getElementById('agreeTerms');
    const termsModalEl = document.getElementById('termsModal');
    const termsModal = new bootstrap.Modal(termsModalEl);
    const form = document.querySelector('form');
    const btnDatHang = document.getElementById('btnDatHang');

    // Khi chọn VNPAY hoặc Ví
    document.querySelectorAll('input[name="flexRadioDefault"]').forEach(input => {
        input.addEventListener('change', function () {
            if (this.dataset.id === '2' || this.dataset.id === '3') {
                accepted = false;
                agreeCheckbox.checked = false;
                acceptTermsButton.disabled = true;
                termsModal.show();
            } else {
                accepted = true;
            }
        });
    });

    // Tick checkbox thì bật nút chấp nhận
    agreeCheckbox.addEventListener('change', function () {
        acceptTermsButton.disabled = !this.checked;
    });

    // Bấm nút "Chấp nhận"
    acceptTermsButton.addEventListener('click', function () {
        accepted = true;
        termsModal.hide();
    });

    // Nếu đóng modal mà chưa chấp nhận → bỏ chọn radio
    termsModalEl.addEventListener('hidden.bs.modal', function () {
        if (!accepted) {
            document.querySelectorAll('input[name="flexRadioDefault"]').forEach(input => {
                if (input.dataset.id === '2' || input.dataset.id === '3') {
                    input.checked = false;
                }
            });
        }
    });

    // Khi bấm nút Đặt hàng
    btnDatHang.addEventListener('click', function (e) {
        const selected = document.querySelector('input[name="flexRadioDefault"]:checked');
        if ((selected && (selected.dataset.id === '2' || selected.dataset.id === '3')) && !accepted) {
            e.preventDefault(); // Chặn gửi nếu chưa chấp nhận điều khoản
            termsModal.show();
            return;
        }
    });

    // Nếu submit form mà chưa chấp nhận điều khoản → chặn luôn
    form.addEventListener('submit', function (e) {
        const selected = document.querySelector('input[name="flexRadioDefault"]:checked');
        if ((selected && (selected.dataset.id === '2' || selected.dataset.id === '3')) && !accepted) {
            e.preventDefault();
            termsModal.show();
        }
    });
});

</script> --}}

    {{-- điều khoản  --}}



    {{-- Hiện số dư --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="flexRadioDefault"]');
            const soDuViBox = document.getElementById('soDuViBox');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.dataset.id == 3) {
                        soDuViBox.style.display = 'block';
                    } else {
                        soDuViBox.style.display = 'none';
                    }
                });

                // Kiểm tra mặc định khi load
                if (radio.checked && radio.dataset.id == 3) {
                    soDuViBox.style.display = 'block';
                }
            });
        });
    </script>

    {{-- Hiện số dư --}}




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

            $("#btnDatHang").click(async function(e) {
                // xử lý điều khoản
                // const selected = document.querySelector('input[name="flexRadioDefault"]:checked');
                //     if (!selected) {
                //         e.preventDefault();
                //         Swal.fire({
                //             icon: "warning",
                //             title: "Chưa chọn phương thức thanh toán",
                //             text: "Vui lòng chọn phương thức thanh toán để tiếp tục.",
                //             confirmButtonText: "OK"
                //         });
                //         return;
                //     }
                // xử lý điều khoản
                e.preventDefault(); // Ngăn chặn load lại trang
                updateHiddenInputs();

                //  confirm
                // Lấy giá trị phương thức thanh toán từ input hoặc hidden field
                const paymentMethod = $('#hiddenPaymentMethod').val();
                // Nếu là thanh toán bằng ví (ID = 3)
                if (paymentMethod === "3") {
                    const result = await Swal.fire({
                        title: 'Xác nhận?',
                        text: 'Bạn có chắc chắn muốn trừ tiền trong ví không?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy',
                        reverseButtons: true
                    });

                    if (!result.isConfirmed) {
                        return;
                    }
                 }

   
                //  confirm
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
    <script>
        function chonMaPhieu(maPhieu) {
            document.getElementById('voucherCode').value = maPhieu;

            // Tự động submit form
            document.getElementById('voucherForm').submit();

            // Đóng modal (nếu bạn dùng Bootstrap 5)
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalVoucher'));
            modal.hide();
        }
    </script>
    <script>
        function copyMaPhieu(maPhieu) {
            navigator.clipboard.writeText(maPhieu)
                .then(function() {
                    alert('Đã sao chép mã: ' + maPhieu);
                })
                .catch(function(error) {
                    console.error('Lỗi sao chép: ', error);
                });
        }
    </script>
@endsection
