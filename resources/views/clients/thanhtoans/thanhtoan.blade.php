@extends('layouts.client')

@section('title')
    Thanh toán
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- Select2 Bootstrap 5 theme -->
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

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
        }

        .btn-dung-ngay:hover {
            background-color: #157347;
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

        .voucher-card {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            background: #fff;
        }

        .voucher-discount {
            font-size: 1.2rem;
            padding: 0.9rem 2rem;
            min-width: 65px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .voucher-title {
            font-size: 1rem;
            margin-bottom: 0.1rem;
            /* Giảm khoảng cách dưới của Tên phiếu */
        }

        .voucher-details {
            font-size: 0.85rem;
            margin-bottom: 0.1rem;
            /* Giảm khoảng cách dưới của Mã, Ngày, Tối thiểu */
            line-height: 1.2;
            /* Giảm khoảng cách giữa các dòng trong voucher-details */
        }

        .voucher-details br {
            margin-bottom: 0.2rem;
            /* Giảm khoảng cách của các thẻ <br> */
        }

        /* Điều chỉnh khoảng cách trên của liên kết Xem mô tả */
        .voucher-details+a {
            margin-top: 0.2rem !important;
            /* Giảm khoảng cách trên của Xem mô tả */
        }

        .btn-copy {
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
            border-radius: 12px;
        }

        .ribbon-new {
            width: 75px;
            height: 75px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
            z-index: 1;
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
            top: 10px;
            right: -22px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .badge {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 12px;
        }

        .btn-copy {
            font-size: 0.8rem;
            padding: 6px 16px;
            border-radius: 20px;
            background-color: #198754;
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .d-flex.flex-column.align-items-center {
            width: 100px;
            position: relative;
        }

        .btn-copy.align-with-minimum {
            width: 100%;
            text-align: center;
            position: absolute;
            top: 58px;
        }

        .minimum-maximum-line {
            display: inline-block;
            line-height: 1.2;
        }

        .modal-title-custom {
            background-color: #0da487;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            text-align: center;
            width: 100%;
            display: block;
        }
        /* Tùy chỉnh giao diện Select2 */
        .select2-container .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 38px;
            right: 10px;
        }
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #0d6efd;
            color: white;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            width: 100%;
            /* background-color: #0da487; */
        }.select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
            border: none;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #0da487 !important;
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
                                            <form action="{{ route('thanhtoans.xuLy') }}" method="POST" id="checkoutForm" novalidate>
                                                @csrf
                                                <input type="hidden" name="voucher_code" id="hiddenVoucherCode">
                                                <input type="hidden" name="tong_tien" id="hiddenTongTien">
                                                <input type="hidden" name="giam_gia" id="hiddenGiamGia">
                                                <input type="hidden" id="oldProvince" value="{{ Auth::user()->province }}">
                                                <input type="hidden" id="oldDistrict" value="{{ Auth::user()->district }}">
                                                <input type="hidden" id="oldWard" value="{{ Auth::user()->ward }}">

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

                                                <div class="row justify-content-center">
                                                    <div class="col-md-4 mt-3 justify-content-center">
                                                        <label for="">Tỉnh thành:</label>
                                                        <select id="province" onchange="loadDistricts(this.value)" class=" select2 form-select" name="province_code" required>
                                                            <option value="">Chọn tỉnh/thành</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label for="">Quận / Huyện:</label>
                                                        <select id="district" onchange="loadWards(this.value)" class=" select2 form-select" name="district_code">
                                                            <option value="">Chọn quận/huyện</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label for="">Phường / Xã:</label>
                                                        <select id="ward" class=" select2 form-select" name="ward">
                                                            <option value="">Chọn phường/xã</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="">Địa chỉ cụ thể:</label>
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
                                    <!-- Sửa tiêu đề modal -->
                                    <h4 class="modal-title-custom">Danh sách phiếu giảm giá</h4>

                                </div>
                                <div class="modal-body px-4 pt-2 pb-4">
                                    <div class="d-flex flex-column gap-3">
                                        @foreach ($phieuGiamGiaThanhToans->sortByDesc('ngay_bat_dau') as $key => $phieu)
                                            @php
                                                $laMoi = \Carbon\Carbon::parse($phieu->ngay_bat_dau)->gt(
                                                    now()->subDays(3),
                                                );
                                            @endphp
                                            <div class="card shadow-sm border-0 w-100 position-relative voucher-card">
                                                @if ($laMoi)
                                                    <div class="ribbon-new">
                                                        <span>Mới</span>
                                                    </div>
                                                @endif

                                                <div
                                                    class="card-body d-flex flex-row justify-content-between align-items-start p-2">
                                                    <div class="d-flex flex-row align-items-start flex-grow-2">
                                                        <div
                                                            class="bg-danger text-white rounded text-center voucher-discount me-3">
                                                            <strong>{{ number_format($phieu->gia_tri,0,'','.') }}{{ $phieu->kieu_giam === 'co_dinh' ? 'Đ' : '%'  }}</strong>
                                                        </div>

                                                        <div>
                                                            <div class="voucher-title fw-bold">{{ $phieu->ten_phieu }}
                                                            </div>
                                                            <div class="voucher-details text-muted">
                                                                Mã: <span
                                                                    class="text-dark">{{ $phieu->ma_phieu }}</span><br>
                                                                {{ date('d/m/Y', strtotime($phieu->ngay_bat_dau)) }} -
                                                                {{ date('d/m/Y', strtotime($phieu->ngay_ket_thuc)) }}<br>
                                                                <span class="minimum-maximum-line">
                                                                    Đơn tối thiểu:
                                                                    <strong>{{ number_format($phieu->muc_gia_toi_thieu, 0, ',', '.') }}đ</strong>
                                                                </span>
                                                                <span class="minimum-maximum-line">
                                                                    Giảm tối đa:
                                                                    <strong>{{ number_format($phieu->muc_giam_toi_da, 0, ',', '.') }}đ</strong>
                                                                </span>
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

                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-start gap-2 ms-3">
                                                        <span
                                                            class="badge bg-{{ $phieu->trang_thai == 1 ? 'success' : 'danger' }}">
                                                            {{ $phieu->trang_thai == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                                                        </span>
                                                        <button type="button"
                                                            class="btn btn-success btn-copy align-with-minimum"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                        // console.log(xhr)
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

             $('#checkoutForm').on('submit', function(e) {
                    const province = $('#province').val();
                    const district = $('#district').val();
                    const ward = $('#ward').val();
                    if (!province || !district || !ward) {
                        e.preventDefault(); // chặn submit
                        alert('Vui lòng chọn đầy đủ tỉnh/thành, quận/huyện và phường/xã.');
                    }
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
            }

            $('input[name="flexRadioDefault"]').on('change', function() {
                let paymentMethodId = $(this).data('id'); // Lấy ID từ thuộc tính data-id
                $('#hiddenPaymentMethod').val(paymentMethodId); // Gán vào input ẩn
                // console.log("Phương thức thanh toán đã chọn:", paymentMethodId);
            });

            $("#btnDatHang").click(async function(e) {
                // xử lý điều khoản
                e.preventDefault(); // Ngăn chặn load lại trang
                updateHiddenInputs();

                //  confirm
                // Lấy giá trị phương thức thanh toán từ input hoặc hidden field
                const paymentMethod = $('#hiddenPaymentMethod').val();
                let password = '';
                if (paymentMethod === "3") {
                    const result = await Swal.fire({
                        title: 'Nhập mật khẩu tài khoản',
                        input: 'password',
                        inputLabel: 'Vui lòng nhập mật khẩu tài khoản để xác nhận thanh toán bằng ví',
                        inputPlaceholder: 'Mật khẩu tài khoản',
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Vui lòng nhập mật khẩu tài khoản!';
                            }
                        }
                    });

                    if (!result.isConfirmed) {
                        return;
                    }

                    password = result.value;
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
                    province: $('#province option:selected').text(),
                    district: $('#district option:selected').text(),
                    ward: $('#ward option:selected').text(),
                    dia_chi_nguoi_nhan: $('input[name="dia_chi_nguoi_nhan"]').val(),
                    ghi_chu: $('input[name="ghi_chu"]').val(),
                    password: password
                };

                const province = $('#province').val();
                const district = $('#district').val();
                const ward = $('#ward').val();
                if (!province || !district || !ward) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        html: 'Vui lòng chọn đầy đủ tỉnh/thành, quận/huyện và phường/xã.', // Dùng html để hiển thị danh sách sản phẩm
                        confirmButtonText: "OK"
                    });
                    return;
                }

                // Gửi request AJAX
                $.ajax({
                    url: "{{ route('thanhtoans.xuLy') }}", // Đường dẫn đến route xử lý thanh toán
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // console.log(response)
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
                        }// Xử lý lỗi chung từ server (bao gồm lỗi số dư ví không đủ)
                            else if (response && response.status === 'error' && response.message) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: response.message,
                                    confirmButtonText: "OK"
                                });
                            }

                        else {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!!',
                                html: '<ul>' + errors.map(err => `<li style="font-size: 1.2rem" >${err}</li><br>`).join('') + '</ul>'
                            });
                        }
                    }
                });
            });
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã sao chép mã: ' + maPhieu,
                        timer: 2000,
                        timerProgressBar: true,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal2-custom-toast',
                            title: 'swal2-custom-title'
                        }
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Không thể sao chép mã. Vui lòng thử lại!',
                        confirmButtonText: 'OK'
                    });
                    console.error('Lỗi sao chép: ', error);
                });
        }
    </script>

    <style>
        .swal2-custom-toast {
            background-color: #0da487 !important;
            color: white !important;
            border-radius: 8px !important;
            padding: 10px !important;
        }

        .swal2-custom-title {
            font-size: 16px !important;
            font-weight: bold !important;
            color: white !important;
            margin-bottom: 5px !important;
        }

    </style>

    <script>
    $(document).ready(function() {

        $('.select2').select2({
            theme: 'bootstrap-5',
         });
        // Load provinces
        $.ajax({
            url: '/provinces',
            method: 'GET',
            success: function(data) {
                console.log('Provinces:', data); // Debug
                $.each(data, function(index, province) {
                    $('#province').append(`<option value="${province.code}">${province.name}</option>`);
                });

                const oldProvince = $('#oldProvince').val();
                if (oldProvince) {
                    const matchedProvince = $('#province option').filter(function () {
                        return $(this).text().trim() === oldProvince.trim();
                    });

                    if (matchedProvince.length > 0) {
                        $('#province').val(matchedProvince.val()).trigger('change');
                    }
                }
            },
            error: function(xhr) {
                console.error('Lỗi khi lấy tỉnh/thành:', xhr.responseText);
            }
        });

    });

    function loadDistricts(provinceId) {
        $('#district').html('<option value="">Chọn quận/huyện</option>');
        $('#ward').html('<option value="">Chọn phường/xã</option>');
        if (provinceId) {
            $.ajax({
                url: `/districts/${provinceId}`,
                method: 'GET',
                success: function(data) {
                    console.log('Districts:', data); // Debug
                    if (data.length === 0) {
                        console.warn('Không có quận/huyện cho provinceId:', provinceId);
                    }
                    $.each(data, function(index, district) {
                        $('#district').append(`<option value="${district.code}">${district.name}</option>`);
                    });

                    const oldDistrict = $('#oldDistrict').val();
                    console.log(oldDistrict);
                    if (oldDistrict) {
                    const matchedDistrict = $('#district option').filter(function () {
                        return $(this).text().trim() === oldDistrict.trim();
                    });

                    if (matchedDistrict.length > 0) {
                        $('#district').val(matchedDistrict.val()).trigger('change');
                    }
                }
                },
                error: function(xhr) {
                    console.error('Lỗi khi lấy quận/huyện:', xhr.responseText);
                }
            });
        }
    }

    function loadWards(districtId) {
        $('#ward').html('<option value="">Chọn phường/xã</option>');
        if (districtId) {
            $.ajax({
                url: `/wards/${districtId}`,
                method: 'GET',
                success: function(data) {
                    console.log('Wards:', data); // Debug
                    if (data.length === 0) {
                        console.warn('Không có phường/xã cho districtId:', districtId);
                    }
                    $.each(data, function(index, ward) {
                        $('#ward').append(`<option value="${ward.code}">${ward.name}</option>`);
                    });

                    const oldWard = $('#oldWard').val();
                    if (oldWard) {
                        const matchedWard = $('#ward option').filter(function () {
                            return $(this).text().trim() === oldWard.trim();
                        });

                        if (matchedWard.length > 0) {
                            $('#ward').val(matchedWard.val()).trigger('change');
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Lỗi khi lấy phường/xã:', xhr.responseText);
                }
            });
        }
    }
</script>
@endsection
