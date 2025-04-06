@extends('layouts.client')

@section('content')
<div class="container py-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-4" style="color: #28a745; font-weight: bold;">Ví Của Tôi</h2>

    <!-- Card Hiển thị Số dư Ví -->
    <div class="card shadow-lg mb-4" style="border-radius: 12px;">
        <div class="card-body text-center">
            <h4 class="text-muted">Số dư hiện tại</h4>
            <h2 class="font-weight-bold text-success" style="font-size: 2.5rem;">
                {{ number_format($vi->so_du, 0, ',', '.') }} VNĐ
            </h2>
        </div>
    </div>

    <!-- Card Lịch sử Giao Dịch -->
    <div class="card shadow-lg" style="border-radius: 12px;">
        <div class="card-header text-white" style="background-color: #28a745; border-radius: 12px 12px 0 0;">
            <strong>Lịch sử giao dịch</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr style="background-color: #f8f9fa;">
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
                                    @if($gd->loai == 'Hoàn tiền')
                                        <span class="text-success">+{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-danger">-{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                @else
                                    <span class="text-danger">-{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </td>
                            <td>{{ $gd->mo_ta }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">Không có giao dịch nào.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Hiển thị phân trang nếu có -->
            {{ $giaodichs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
