{{ $donHangs->appends(request()->query())->links('pagination::bootstrap-5') }}
<table style="table-layout: fixed; width: 100%;" class="table order-table theme-table my-2">
    @foreach ($donHangs as $donHang)
        <thead>
            <tr>
                <th colspan="3">Mã đơn hàng: {{ $donHang->ma_don_hang }}</th>
                <th>
                    @if ($donHang->trang_thai_thanh_toan == 0)
                        <span class="order-danger">Chưa thanh toán</span>
                    @else
                        <span class="order-success">Đã thanh toán</span>
                    @endif
                </th>
                <th>
                    @if ($donHang->trang_thai_don_hang == -1)
                        <span class="order-danger">Đã hủy</span>
                    @elseif ($donHang->trang_thai_don_hang == 0)
                        <span class="order-danger">Chờ xác nhận</span>
                    @elseif ($donHang->trang_thai_don_hang == 1)
                        <span class="order-primary">Đang xử lý</span>
                    @elseif ($donHang->trang_thai_don_hang == 2)
                        <span class="order-primary">Đang giao</span>
                    @elseif ($donHang->trang_thai_don_hang == 3)
                        <span class="order-success">Đã giao</span>
                    @elseif ($donHang->trang_thai_don_hang == 4)
                        <span class="order-success">Hoàn thành</span>
                    @elseif ($donHang->trang_thai_don_hang == 5)
                        <span class="order-danger">Trả hàng</span>
                    @else
                        <span>Trạng thái không hợp lệ</span>
                    @endif
                </th>
                <th class="float-end">
                    <a href="{{ route('donhangs.show', $donHang->id) }}">
                        <i class="ri-eye-line"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <b>Người đặt: </b>
                    @if ($donHang->ten_nguoi_dung == '')
                        {{ $donHang->username }}
                    @else
                        {{ $donHang->ten_nguoi_dung }}
                    @endif
                </td>
                <td colspan="2">
                    <b>Tổng tiền: </b>{{ number_format($donHang->tong_tien, 0, '', '.') }}đ
                </td>
                <td colspan="2"><b>Hình thức thanh toán:
                    </b>{{ $donHang->ten_phuong_thuc }}
                </td>
            </tr>
            <tr>
                <td colspan="2"><b>Tên người nhận: </b>{{ $donHang->ten_nguoi_nhan }}
                </td>
                <td colspan="2" class="text-truncate"><b>Email:
                    </b>{{ $donHang->email_nguoi_nhan }}</td>
                <td colspan="2"><b>Số điện thoại: </b>{{ $donHang->sdt_nguoi_nhan }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-truncate"><b>Địa chỉ người nhận:
                    </b>{{ $donHang->dia_chi_nguoi_nhan }}</td>
                <td colspan="2" class="text-truncate">
                    <b>Ghi chú: </b>
                    @if ($donHang->ghi_chu == '')
                        Không
                    @else
                        {{ $donHang->ghi_chu }}
                    @endif
                </td>
                <td><b>Ngày đặt: </b>{{ $donHang->created_at }}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </tbody>
    @endforeach
</table>
{{ $donHangs->appends(request()->query())->links('pagination::bootstrap-5') }}
