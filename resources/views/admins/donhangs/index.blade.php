@extends('layouts.admin')

@section('title')
    Đơn hàng
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

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
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Danh sách đơn hàng</h5>
                    {{-- <a href="#" class="btn btn-solid">Download all orders</a> --}}
                </div>
                <div class="w-100">
                    <div class="table-responsive">
                        <input type="text" class="form-control w-25 float-end mb-2" id="searchInput"
                            placeholder="Tìm đơn hàng">
                        <table style="table-layout: fixed; width: 100%;" class="table order-table theme-table"
                            id="dataTable">
                            @foreach ($donHangs as $donHang)
                                <div>
                                    <thead>
                                        <tr>
                                            <th colspan="3">Mã đơn hàng: {{ $donHang->ma_don_hang }}</th>
                                            <th class="float-end">
                                                <a href="{{ route('donhangs.show', $donHang->id) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Người đặt: </b>{{ $donHang->ten_nguoi_dung }}</td>
                                            <td>
                                                <b>Tổng tiền: </b>{{ number_format($donHang->tong_tien, 0, '', '.') }}đ
                                            </td>
                                            <td colspan="2"><b>Ngày đặt: </b>{{ $donHang->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tên người nhận: </b>{{ $donHang->ten_nguoi_nhan }}</td>
                                            <td><b>Email: </b>{{ $donHang->email_nguoi_nhan }}</td>
                                            <td colspan="2"><b>Số điện thoại: </b>{{ $donHang->sdt_nguoi_nhan }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-truncate"><b>Địa chỉ người nhận:
                                                </b>{{ $donHang->dia_chi_nguoi_nhan }}</td>
                                            <td colspan="2" class="text-truncate"><b>Ghi chú:
                                                </b>{{ $donHang->ghi_chu }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Hình thức thanh toán: </b>{{ $donHang->ten_phuong_thuc }}</td>
                                            <td><b>Trạng thái thanh toán: </b>
                                                @if ($donHang->trang_thai_thanh_toan == 0)
                                                    <span class="text-danger">Chưa thanh toán</span>
                                                @else
                                                    <span class="text-success">Đã thanh toán</span>
                                                @endif
                                            </td>
                                            <td colspan="2"><b>Trạng thái đơn hàng: </b>
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
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $donHangs->links('pagination::bootstrap-5') }}
    </div>
@endsection

@section('js')
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });
    </script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
