@extends('layouts.client')

@section('title')
    Giỏ hàng
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Giỏ hàng</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Giỏ hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    @foreach ($chiTietGioHangs as $chiTietGioHang)
                                        <tr class="product-box-contain">
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <a href="{{ route('sanphams.chitiet', $chiTietGioHang->bienThe->SanPham->id) }}" class="product-image">
                                                        <img src="{{ Storage::url($chiTietGioHang->bienThe->anh_bien_the) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <a
                                                                    href="{{ route('sanphams.chitiet',$chiTietGioHang->bienThe->SanPham->id) }}">{{ $chiTietGioHang->bienThe->sanPham->ten_san_pham }}</a>
                                                            </li>

                                                            <li class="text-content">{{ $chiTietGioHang->ten_bien_the }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Giá</h4>
                                                <h5>
                                                    <span class="gia-moi">{{ number_format($chiTietGioHang->bienThe->gia_ban,0,'','.') }}</span>đ
                                                    <del style="margin-left: 17px" class="text-content">{{ number_format($chiTietGioHang->bienThe->sanPham->gia_cu,0,'','.') }}đ</del>
                                                </h5>
                                                <h6 style="margin-top: 10px" class="theme-color">Tiết kiệm :
                                                    {{ number_format($chiTietGioHang->bienThe->sanPham->gia_cu - $chiTietGioHang->bienThe->gia_ban,0,'','.') }}đ</h6>
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Số lượng</h4>
                                                <div class="quantity-price">
                                                    <div>
                                                        <div class="input-group">
                                                            <input class="form-control input-number so-luong" type="number"
                                                                name="quantity" value="{{ $chiTietGioHang->so_luong }}"
                                                                onchange="showTong()"
                                                                oninput="checkMaxQuantity(this)"
                                                                onchange="checkMaxQuantity(this)"
                                                                onkeypress="return isNumberKey(event)"
                                                                min="1" max="{{ $chiTietGioHang->bienThe->so_luong }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Tổng</h4>
                                                <h5>
                                                    <span class="tong"></span>đ
                                                </h5>
                                            </td>

                                            <td class="save-remove">
                                                <h4 class="table-title text-content">Hành động</h4>
                                                <button style="border: none;color: #2a2929; " class="remove close-button close-button delete-cartIndex-item" data-id="{{ $chiTietGioHang->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        {{-- <div class="summery-header">
                            <h3>Tổng giá trị giỏ hàng</h3>
                        </div> --}}

                        <div class="summery-contain">
                            {{-- <div class="coupon-cart">
                                <h6 class="text-content mb-2">Phiếu giảm giá</h6>
                                <form id="voucherForm" action="{{ route('voucher.giohang') }}" method="post">
                                    @csrf
                                    <div class="mb-3 coupon-box input-group">
                                        <input id="voucherCode" type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Nhập mã phiếu">
                                        <button type="submit" class="btn-apply">Xác nhận</button>
                                    </div>
                                </form>
                            </div> --}}
                            <ul>
                                {{-- <li>
                                    <h4>Tổng tiền sản phẩm</h4>
                                    <h4 class="price"><span id="tong-san-pham"></span>đ</h4>
                                </li> --}}

                                {{-- <li>
                                    <h4>Vận chuyển</h4>
                                    <h4 class="price"><span id="van_chuyen">10.000</span>đ</h4>
                                </li> --}}

                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Tổng tiền</h4>
                                <h4 class="price theme-color"><span id="tong-tien"></span>đ</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button id="btn-thanh-toan"
                                        class="btn btn-animation proceed-btn fw-bold">Thanh toán</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{ route('home') }}';"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Quay lại mua hàng</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection

@section('js')
<script>

$(document).on("click", ".delete-cartIndex-item", function () {
    let cartItemId = $(this).data("id"); // Lấy ID sản phẩm trong giỏ hàng
    console.log("Xóa sản phẩm ID:", cartItemId);

    $.ajax({
        url: "/xoa-gio-hang", // Route xử lý xóa sản phẩm
        method: "POST",
        data: { id: cartItemId },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log("response:", response);
            if (response.status === "success") {
                $(".header-wishlist .badge").text(response.totalItem); // Cập nhật số sản phẩm

                // Xóa sản phẩm khỏi giao diện
                let item = $(`.delete-cartIndex-item[data-id="${cartItemId}"]`).closest("tr");
                $(`.delete-cart-item[data-id="${cartItemId}"]`).closest("li").remove();
                item.fadeOut(300, function () {
                    item.remove();

                    // Cập nhật lại tổng tiền sau khi xóa
                    let totalPrice = response.totalPrice;
                    $("#tong-tien").text(response.totalPrice.toLocaleString("vi-VN"));
                    $(".total-price").text(totalPrice.toLocaleString("vi-VN") + " đ");

                });
            } else {
                Swal.fire("Lỗi", "Không thể xóa sản phẩm", "error");
            }
        },
        error: function (response) {
            Swal.fire("Lỗi", "Có lỗi xảy ra, vui lòng thử lại!", "error");
        },
    });
});



showTong()
// let voucherCode = $("#voucherCode").val().trim();
// $(document).ready(function () {
//     $("#voucherForm").submit(function (event) {
//         event.preventDefault(); // Ngăn form load lại trang

//         let voucherCode = $("#voucherCode").val().trim();
//         let tongTienHienTai = $("#tong-tien").text().replace(/\D/g, ''); // Lấy tổng tiền, bỏ ký tự không phải số

//         if (voucherCode === "") {
//             Swal.fire({
//                 icon: "error",
//                 title: "Lỗi!",
//                 text: "Vui lòng không để trống.",
//                 confirmButtonText: "OK"
//             });
//             return;
//         }

//         $.ajax({
//             url: "{{ route('voucher.giohang') }}", // Route xử lý mã giảm giá
//             type: "POST",
//             data: {
//                 _token: "{{ csrf_token() }}", // Gửi CSRF token
//                 code: voucherCode,  // ✅ Đã thêm dấu phẩy ở đây
//                 total: tongTienHienTai
//             },
//             success: function (response) {
//                 if (response.success) {
//                     Swal.fire({
//                         icon: "success",
//                         title: "Áp dụng thành công!",
//                         text: "Bạn được giảm " + response.discount.toLocaleString("vi-VN") + "đ.",
//                         confirmButtonText: "OK"
//                     });

//                     // Cập nhật tổng tiền và giảm giá trên giao diện
//                     $("#tong-tien").text(response.newTotal.toLocaleString("vi-VN") );
//                     $("#giam-gia").text(response.discount.toLocaleString("vi-VN") );
//                 }
//             },
//             error: function (xhr) { // ✅ Thêm tham số xhr để bắt lỗi
//                 let errorMessage = "Lỗi server! Vui lòng thử lại sau.";

//                 // Bắt lỗi 403 khi mã giảm giá sai hoặc hết hạn
//                 if (xhr.status === 403 && xhr.responseJSON && xhr.responseJSON.message) {
//                     errorMessage = xhr.responseJSON.message;
//                 }

//                 Swal.fire({
//                     icon: "error",
//                     title: "Lỗi!",
//                     text: errorMessage,
//                     confirmButtonText: "OK"
//                 });
//             }
//         });
//     });
// });



function showTong() {
    let giaMois = document.querySelectorAll(".gia-moi"); // Lấy danh sách mới
    let soLuongs = document.querySelectorAll(".so-luong");
    let tongs = document.querySelectorAll(".tong");
    let tongTien = document.getElementById("tong-tien");

    let sum = 0;
    giaMois.forEach((giaMoiEl, index) => {
        let giaMoi = parseFloat(giaMoiEl.innerText.replace(/\D/g, "")) || 0;
        let soLuong = parseFloat(soLuongs[index]?.value || 0);
        let tong = giaMoi * soLuong;

        if (tongs[index]) {
            tongs[index].innerText = tong.toLocaleString("vi-VN");
        }

        sum += tong;
    });

    let tongFinal = sum
    tongTien.innerText = tongFinal.toLocaleString("vi-VN");
}

        function checkMaxQuantity(input) {
    setTimeout(() => {
        let max = parseInt(input.max); // Lấy số lượng tối đa
        let min = parseInt(input.min) || 1; // Đảm bảo giá trị tối thiểu là 1
        let value = parseInt(input.value); // Chuyển thành số nguyên

        if (isNaN(value) || value <= 0) { // Nếu nhập không phải số hoặc nhỏ hơn 1
            Swal.fire({
                icon: "error",
                title: "Lỗi nhập số lượng!",
                text: "Vui lòng nhập số hợp lệ (>=1).",
                confirmButtonText: "OK"
            });
            input.value = min;
            showTong();
            return;
        }

        if (value > max) { // Nếu nhập vượt quá max
            Swal.fire({
                icon: "warning",
                title: "Số lượng vượt quá tồn kho!",
                text: `Bạn chỉ có thể mua tối đa ${max} sản phẩm.`,
                confirmButtonText: "OK"
            });
            input.value = max;
            showTong();
        }
    }, 500); // Chờ 100ms để trình duyệt cập nhật giá trị
}

// Ngăn nhập ký tự không phải số
function isNumberKey(evt) {
    let charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode < 48 || charCode > 57) { // Chỉ cho nhập số (0-9)
        return false;
    }
    return true;
}

    </script>

    <script>
        $(document).on("click", "#btn-thanh-toan", function () {
    let cartData = [];

    $(".so-luong").each(function () {
        let row = $(this).closest("tr");
        let productId = row.find(".delete-cartIndex-item").data("id"); // Lấy ID sản phẩm
        let quantity = $(this).val(); // Lấy số lượng hiện tại

        cartData.push({
            id: productId,
            quantity: quantity
        });
    });


    // Chuyển sang trang thanh toán và gửi dữ liệu bằng AJAX
    $.ajax({
        url: "/accept-thanh-toan", // Route xử lý thanh toán
        method: "POST",
        data: { cartData },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response)
            if (response.status === "success") {
                // let tien = $(".total-price").text(response.totalPrice.toLocaleString("vi-VN"))
                window.location.href = "/thanhtoan"; // Chuyển hướng
            } else {
                Swal.fire("Lỗi", "Không thể thực hiện thanh toán", "error");
            }
        },
        error: function () {
            Swal.fire("Lỗi", "Giỏ hàng trống !", "error");
        },
    });
});
    </script>
@endsection
