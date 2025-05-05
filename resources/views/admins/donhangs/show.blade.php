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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-4">
                            <h5>Đơn hàng #{{ $donHang->ma_don_hang }}</h5>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('donhangs.update', $donHang->id) }}" method="post" id="trangThaiForm">
                                @csrf
                                @method('PUT')
                                <div class="card-footer text-end border-0 m-0 p-0 d-flex justify-content-end">
                                    @if ($donHang->trang_thai_don_hang != -1 && $donHang->trang_thai_don_hang <= 3)
                                        <select class="form-control" name="trang_thai">
                                            <option @if ($donHang->trang_thai_don_hang == 0) selected @endif
                                                @if ($donHang->trang_thai_don_hang > 0) disabled @endif value="0">Chờ xác
                                                nhận
                                            </option>
                                            <option @if ($donHang->trang_thai_don_hang == 1) selected @endif
                                                @if ($donHang->trang_thai_don_hang > 1) disabled @endif value="1">Đang xử lý
                                            </option>
                                            <option @if ($donHang->trang_thai_don_hang == 2) selected @endif
                                                @if ($donHang->trang_thai_don_hang == 0 || $donHang->trang_thai_don_hang > 2) disabled @endif value="2">
                                                Đang giao
                                            </option>
                                            <option @if ($donHang->trang_thai_don_hang == 3) selected @endif
                                                @if ($donHang->trang_thai_don_hang != 2) disabled @endif value="3">Đã giao
                                            </option>
                                        </select>
                                        <input type="hidden" name="doi_trang_thai" value="1">
                                        <input class="btn btn-primary mx-3" type="submit" value="Đổi trạng thái"
                                            onclick="updateConfirmation(event)">
                                    @endif
                                    <a href="{{ route('donhangs.index') }}" class="btn btn-outline">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <ol class="progtrckr">
                        @if ($donHang->trang_thai_don_hang >= 1)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Đang xử lý</h5>
                        <h6>
                            @php
                                $check = false;
                            @endphp
                            @foreach ($lichSuDonHangs as $lichSuDonHang)
                                @if ($lichSuDonHang->trang_thai == 1)
                                    {{ $lichSuDonHang->created_at }}
                                    @php
                                        $check = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($check == false)
                                Chưa xử lý
                            @endif
                        </h6>
                        </li>

                        @if ($donHang->trang_thai_don_hang >= 2)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Đang giao</h5>
                        <h6>
                            @php
                                $check = false;
                            @endphp
                            @foreach ($lichSuDonHangs as $lichSuDonHang)
                                @if ($lichSuDonHang->trang_thai == 2)
                                    {{ $lichSuDonHang->created_at }}
                                    @php
                                        $check = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($check == false)
                                Chưa xử lý
                            @endif
                        </h6>
                        </li>

                        @if ($donHang->trang_thai_don_hang >= 3)
                            <li class="progtrckr-done">
                            @else
                            <li class="progtrckr-todo">
                        @endif
                        <h5>Đã giao</h5>
                        <h6>
                            @php
                                $check = false;
                            @endphp
                            @foreach ($lichSuDonHangs as $lichSuDonHang)
                                @if ($lichSuDonHang->trang_thai == 3)
                                    {{ $lichSuDonHang->created_at }}
                                    @php
                                        $check = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($check == false)
                                Chưa xử lý
                            @endif
                        </h6>
                        </li>

                        @if ($donHang->trang_thai_don_hang == 5)
                            <li class="progtrckr-done">
                                <h5>Trả hàng</h5>
                                <h6>
                                    @php
                                        $check = false;
                                    @endphp
                                    @foreach ($lichSuDonHangs as $lichSuDonHang)
                                        @if ($lichSuDonHang->trang_thai == 5)
                                            {{ $lichSuDonHang->created_at }}
                                            @php
                                                $check = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($check == false)
                                        Chưa xử lý
                                    @endif
                                </h6>
                            </li>
                        @endif

                        @if ($donHang->trang_thai_don_hang != 5)
                            @if ($donHang->trang_thai_don_hang == 4)
                                <li class="progtrckr-done">
                                @else
                                <li class="progtrckr-todo">
                            @endif
                            <h5>Hoàn thành</h5>
                            <h6>
                                @php
                                    $check = false;
                                @endphp
                                @foreach ($lichSuDonHangs as $lichSuDonHang)
                                    @if ($lichSuDonHang->trang_thai == 4)
                                        {{ $lichSuDonHang->created_at }}
                                        @php
                                            $check = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($check == false)
                                    Chưa xử lý
                                @endif
                            </h6>
                            </li>
                        @endif
                    </ol>
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
                                        <tr class="border-bottom">
                                            <td></td>
                                            <td>
                                                <p>Tên sản phẩm</p>
                                            </td>
                                            <td>
                                                <p>Số lượng</p>
                                            </td>
                                            <td>
                                                <p>Giá</p>
                                            </td>
                                        </tr>
                                        @foreach ($chiTietDonHangs as $chiTietDonHang)
                                            <tr class="table-order">
                                                <td class="d-flex justify-content-center">
                                                    <img style="height: 160px"
                                                        src="{{ Storage::url($chiTietDonHang->hinh_anh) }}"
                                                        class="object-fit-cover blur-up lazyload" alt="">
                                                </td>
                                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                                    <h5>{{ $chiTietDonHang->ten_san_pham }}</h5>
                                                    <h5>{{ $chiTietDonHang->ten_bien_the }}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{ $chiTietDonHang->so_luong }}</h5>
                                                </td>
                                                <td>
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
                                                <h4>{{ number_format($tongGiaTri, 0, '', '.') }}đ</h4>
                                            </td>
                                        </tr>

                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h5>Phí vận chuyển :</h5>
                                            </td>
                                            <td>
                                                <h4>{{ number_format($donHang->tong_tien - $tongGiaTri, 0, '', '.') }}đ
                                                </h4>
                                            </td>
                                        </tr>

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
                                        <p>Người đặt :
                                            <span>
                                                @if ($donHang->ten_nguoi_dung == '')
                                                    {{ $donHang->username }}
                                                @else
                                                    {{ $donHang->ten_nguoi_dung }}
                                                @endif
                                            </span>
                                        </p>
                                        <p>Ngày đặt : <span>{{ $donHang->created_at }}</span></p>
                                        <p>Tổng tiền : <span>{{ number_format($donHang->tong_tien, 0, '', '.') }}đ</span>
                                        </p>
                                        <p>Phương thức thanh toán : <span>{{ $donHang->ten_phuong_thuc }}</span></p>
                                        <p>
                                            Trạng thái thanh toán :
                                            @if ($donHang->trang_thai_thanh_toan == 0)
                                                <span class="text-danger">Chưa thanh toán</span>
                                            @elseif ($donHang->trang_thai_thanh_toan == 1)
                                                <span class="text-success">Đã thanh toán</span>
                                            @else
                                                <span class="text-success">Đã hoàn tiền</span>
                                            @endif
                                        </p>
                                        <p>
                                            Trạng thái đơn hàng :
                                            @if ($donHang->trang_thai_don_hang == -1)
                                                <span class="text-danger">Đã hủy</span>
                                            @elseif ($donHang->trang_thai_don_hang == 0)
                                                <span class="text-danger">Chờ xác nhận</span>
                                            @elseif ($donHang->trang_thai_don_hang == 1)
                                                <span class="text-primary">Đang xử lý</span>
                                            @elseif ($donHang->trang_thai_don_hang == 2)
                                                <span class="text-primary">Đang giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 3)
                                                <span class="text-success">Đã giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 4)
                                                <span class="text-success">Hoàn thành</span>
                                            @elseif ($donHang->trang_thai_don_hang == 5)
                                                <span class="text-danger">Trả hàng</span>
                                            @else
                                                <span>Trạng thái không hợp lệ</span>
                                            @endif
                                        </p>
                                        @if ($donHang->trang_thai_don_hang == -1 || $donHang->trang_thai_don_hang == 5)
                                            <p>
                                                Lý do trả hàng: {{ $donHang->ly_do }}
                                            </p>
                                        @endif
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
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <script>
        function updateConfirmation(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Đổi trạng thái',
                text: "Bạn có chắc chắn muốn đổi trạng thái đơn hàng này?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                confirmButtonColor: '#009688',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('trangThaiForm').submit();
                }
            });
        }
    </script>
@endsection
