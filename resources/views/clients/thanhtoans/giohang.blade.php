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
                                                    <a href="{{ route('sanphams.chitiet', 1) }}" class="product-image">
                                                        <img src="{{ Storage::url($chiTietGioHang->hinh_anh) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <a
                                                                    href="{{ route('sanphams.chitiet', 1) }}">{{ $chiTietGioHang->ten_san_pham }}</a>
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
                                                    <span class="gia-moi">{{ $chiTietGioHang->gia_moi }}</span>đ
                                                    <del class="text-content">{{ $chiTietGioHang->gia_cu }}đ</del>
                                                </h5>
                                                <h6 class="theme-color">Tiết kiệm :
                                                    {{ $chiTietGioHang->gia_cu - $chiTietGioHang->gia_moi }}đ</h6>
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Số lượng</h4>
                                                <div class="quantity-price">
                                                    <div>
                                                        <div class="input-group">
                                                            <input class="form-control input-number so-luong" type="number"
                                                                name="quantity" value="{{ $chiTietGioHang->so_luong }}"
                                                                onchange="showTong()">
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
                                                <a class="remove close_button" href="javascript:void(0)"
                                                    onclick="showTong()">Xóa</a>
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
                        <div class="summery-header">
                            <h3>Tổng giá trị giỏ hàng</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Phiếu giảm giá</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Nhập mã phiếu">
                                    <button class="btn-apply">Xác nhận</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>Tổng sản phẩm</h4>
                                    <h4 class="price"><span id="tong-san-pham"></span>đ</h4>
                                </li>

                                <li>
                                    <h4>Giảm giá</h4>
                                    <h4 class="price"><span id="giam-gia">0</span>đ</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Phí vận chuyến</h4>
                                    <h4 class="price text-end"><span id="phi-van-chuyen">1000</span>đ</h4>
                                </li>
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
                                    <button onclick="location.href = '{{ route('thanhtoans.thanhtoan') }}';"
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
        function showTong() {
            giaMois = document.getElementsByClassName("gia-moi")
            soLuongs = document.getElementsByClassName("so-luong")
            tongs = document.getElementsByClassName("tong")
            tongSanPham = document.getElementById("tong-san-pham")
            giamGia = document.getElementById("giam-gia")
            phiVanChuyen = document.getElementById("phi-van-chuyen")
            tongTien = document.getElementById("tong-tien")

            sum = 0
            for (let i = 0; i < giaMois.length; i++) {
                tongs[i].innerHTML = Number(giaMois[i].innerHTML) * Number(soLuongs[i].value)
                sum += Number(tongs[i].innerHTML)
            }

            tongSanPham.innerHTML = sum
            tongTien.innerHTML = Number(tongSanPham.innerHTML) - Number(giamGia.innerHTML) + Number(phiVanChuyen.innerHTML)
        }

        showTong()
    </script>
@endsection
