@extends('layouts.admin')

@section('title')
    Đơn hàng
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header title-header-block package-card">
                    <div>
                        <h5>Đơn hàng #{{ $donHang->ma_don_hang }}</h5>
                    </div>
                    <div class="card-order-section">
                        <ul>
                            <li>{{ $donHang->created_at }}</li>
                            <li>{{ count($chiTietDonHangs) }} sản phẩm</li>
                        </ul>
                    </div>
                </div>
                <div class="bg-inner cart-section order-details-table">
                    <div class="row g-4">
                        <div class="col-xl-8">
                            <div class="table-responsive table-details">
                                <table class="table cart-table table-borderless">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Sản phẩm</th>
                                            <th class="text-end" colspan="2">
                                                <a href="javascript:void(0)" class="theme-color"></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($chiTietDonHangs as $chiTietDonHang)
                                            <tr class="table-order">
                                                <td>
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('assets/images/profile/3.jpg') }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <p>Tên sản phẩm</p>
                                                    <h5>{{ $chiTietDonHang->ten_bien_the }}</h5>
                                                </td>
                                                <td>
                                                    <p>Số lượng</p>
                                                    <h5>{{ $chiTietDonHang->so_luong }}</h5>
                                                </td>
                                                <td>
                                                    <p>Giá</p>
                                                    <h5>{{ number_format($chiTietDonHang->gia_ban, 0, '', '.') }}đ</h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Tổng giá trị :</h5>
                                            </td>
                                            <td>
                                                <h4>$55.00</h4>
                                            </td>
                                        </tr>

                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Phí vận chuyển :</h5>
                                            </td>
                                            <td>
                                                <h4>$12.00</h4>
                                            </td>
                                        </tr>

                                        {{-- <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Tax(GST) :</h5>
                                            </td>
                                            <td>
                                                <h4>$10.00</h4>
                                            </td>
                                        </tr> --}}

                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h4 class="theme-color fw-bold">Tổng tiền :</h4>
                                            </td>
                                            <td>
                                                <h4 class="theme-color fw-bold">
                                                    {{ number_format($donHang->tong_tien, 0, '', '.') }}đ</h4>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="order-success">
                                <div class="row g-4">
                                    <h4>Thông tin đơn hàng</h4>
                                    <div class="tracker-number">
                                        <p>Mã đơn hàng : <span>{{ $donHang->ma_don_hang }}</span></p>
                                        <p>Người đặt : <span>{{ $donHang->ten_nguoi_dung }}</span></p>
                                        <p>Ngày đặt : <span>{{ $donHang->created_at }}</span></p>
                                        <p>Tổng tiền : <span>{{ $donHang->tong_tien }}</span></p>
                                        <p>Phương thức thanh toán : <span>{{ $donHang->ten_phuong_thuc }}</span></p>
                                        <p>
                                            Trạng thái đơn hàng :
                                            @if ($donHang->trang_thai_don_hang == -1)
                                                <span class="text-danger">Đã hủy</span>
                                            @elseif ($donHang->trang_thai_don_hang == 0)
                                                <span class="text-danger">Chưa xác nhận</span>
                                            @elseif ($donHang->trang_thai_don_hang == 1)
                                                <span class="text-success">Đã xác nhận</span>
                                            @elseif ($donHang->trang_thai_don_hang == 2)
                                                <span class="text-primary">Chờ vận chuyển</span>
                                            @elseif ($donHang->trang_thai_don_hang == 3)
                                                <span class="text-primary">Đang giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 4)
                                                <span class="text-success">Đã giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 5)
                                                <span class="text-danger">Trả hàng</span>
                                            @else
                                                <span>Trạng thái không hợp lệ</span>
                                            @endif
                                        </p>
                                        <p>
                                            Trạng thái thanh toán :
                                            @if ($donHang->trang_thai_thanh_toan == 0)
                                                <span class="text-danger">Chưa thanh toán</span>
                                            @else
                                                <span class="text-success">Đã thanh toán</span>
                                            @endif
                                        </p>
                                    </div>

                                    <h4>Địa chỉ giao hàng</h4>
                                    <ul class="order-details mt-3">
                                        <li>{{ $donHang->ten_nguoi_nhan }}</li>
                                        <li>{{ $donHang->sdt_nguoi_nhan }}</li>
                                        <li>{{ $donHang->dia_chi_nguoi_nhan }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section end -->
                <div class="row mt-4">
                    <ol class="progtrckr">
                        @if ($donHang->trang_thai_don_hang >= 1)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Xác nhận</h5>
                        </li>

                        @if ($donHang->trang_thai_don_hang >= 2)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Chờ vận chuyển</h5>
                        </li>

                        @if ($donHang->trang_thai_don_hang >= 3)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Đang giao</h5>
                        </li>

                        @if ($donHang->trang_thai_don_hang >= 4)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Đã giao</h5>
                        </li>
                    </ol>
                </div>
                <form action="{{ route('donhangs.update', $donHang->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                        @if ($donHang->trang_thai_don_hang != -1 && $donHang->trang_thai_don_hang != 5)
                            <select class="form-control me-3" name="trang_thai">
                                <option @if ($donHang->trang_thai_don_hang == 0) selected @endif
                                    @if ($donHang->trang_thai_don_hang > 0) disabled @endif value="0">Chưa xác nhận
                                </option>
                                <option @if ($donHang->trang_thai_don_hang == 1) selected @endif
                                    @if ($donHang->trang_thai_don_hang > 1) disabled @endif value="1">Xác nhận</option>
                                <option @if ($donHang->trang_thai_don_hang == 2) selected @endif
                                    @if ($donHang->trang_thai_don_hang > 2) disabled @endif value="2">Chờ vận chuyển
                                </option>
                                <option @if ($donHang->trang_thai_don_hang == 3) selected @endif
                                    @if ($donHang->trang_thai_don_hang > 3) disabled @endif value="3">Đang giao</option>
                                <option @if ($donHang->trang_thai_don_hang == 4) selected @endif
                                    @if ($donHang->trang_thai_don_hang > 4) disabled @endif value="4">Đã giao</option>
                                <option @if ($donHang->trang_thai_don_hang == 5) selected @endif
                                    @if ($donHang->trang_thai_don_hang != 4) disabled @endif value="5">Trả hàng</option>
                            </select>
                            <input class="btn btn-primary me-3" type="submit" name="doi_trang_thai" value="Đổi trạng thái"
                                onclick="return confirm('Xác nhận đổi trạng thái?');">
                            @if ($donHang->trang_thai_thanh_toan == 0)
                                <input class="btn btn-primary me-3" type="submit" name="xac_nhan_thanh_toan"
                                    value="Xác nhận thanh toán" onclick="return confirm('Xác nhận thanh toán?');">
                            @endif
                            @if ($donHang->trang_thai_thanh_toan == 0 && $donHang->trang_thai_don_hang <= 3)
                                <input class="btn btn-danger me-3" type="submit" name="huy_don_hang" value="Hủy đơn hàng"
                                    onclick="return confirm('Xác nhận hủy đơn hàng?');">
                            @endif
                        @endif
                        <a href="{{ route('donhangs.index') }}" class="btn btn-outline">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endsection
