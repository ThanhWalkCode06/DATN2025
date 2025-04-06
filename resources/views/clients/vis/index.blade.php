@extends('layouts.client')

@section('content')
<div class="container py-5">

    <!-- Tiêu đề -->
    <h2 class="text-center mb-4" style="color: #009688; font-weight: 700; font-size: 2.5rem;">
        VÍ CỦA TÔI
    </h2>

    <!-- Hiển thị số dư -->
    <div class="card shadow mb-5" style="border-radius: 16px; border: 2px solid #009688;">
        <div class="card-body text-center py-4">
            <h5 class="text-muted mb-2">Số dư hiện tại</h5>
            <h2 style="color: #009688; font-size: 3rem; font-weight: bold;">
                {{ number_format($vi->so_du, 0, ',', '.') }} VNĐ
            </h2>
        </div>
    </div>

    <!-- Form lọc giao dịch -->
    <div class="card shadow mb-4" style="border-radius: 16px;">
        <div class="card-body">
            <form method="GET" action="{{ route('vi') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="from" class="form-label">Từ ngày</label>
                    <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
                </div>
                <div class="col-md-5">
                    <label for="to" class="form-label">Đến ngày</label>
                    <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-success">
                        Lọc
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lịch sử giao dịch -->
    <div class="card shadow" style="border-radius: 16px;">
        <div class="card-header text-white" style="background-color: #009688; border-radius: 16px 16px 0 0;">
            <strong>Lịch sử giao dịch</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f1f1f1;">
                        <tr>
                            <th class="text-center">Ngày</th>
                            <th class="text-center">Loại</th>
                            <th class="text-center">Số tiền</th>
                            <th class="text-start">Mô tả</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($giaodichs as $gd)
                            <tr>
                                <td class="text-center">{{ $gd->created_at->format('H:i d/m/Y') }}</td>
                                <td class="text-center">{{ ucfirst($gd->loai) }}</td>
                                <td class="text-center">
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
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Không có giao dịch nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <div class="p-3 d-flex justify-content-center">
                {{ $giaodichs->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
