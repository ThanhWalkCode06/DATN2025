@extends('layouts.client')

@section('content')
<div class="container">
    <h2>Ví của tôi</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Số dư hiện tại: <strong>{{ number_format($vi->so_du, 0, ',', '.') }} VNĐ</strong></h4>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <strong>Lịch sử giao dịch</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Loại</th>
                        <th>Số tiền</th>
                        <th>Mô tả</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($giaodichs as $gd)
                        <tr>
                            <td>{{ $gd->created_at->format('H:i d/m/Y') }}</td>

                            <td>{{ ucfirst($gd->loai) }}</td>
                            <td>
                                @if($gd->so_tien > 0)
                                @if($gd->loai == 'Hoàn tiền') <!-- Nếu loại giao dịch là 'Hoàn tiền' -->
                                    <span class="text-success">+{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-danger">-{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span> <!-- Nếu không phải 'Hoàn tiền', thì là thanh toán -->
                                @endif
                            @else
                                <span class="text-danger">-{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span> <!-- Dành cho các giao dịch chi tiền (số tiền âm) -->
                            @endif
                            </td>
                            <td>{{ $gd->mo_ta }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Không có giao dịch nào.</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{ $giaodichs->links() }}
        </div>
    </div>
</div>
@endsection
