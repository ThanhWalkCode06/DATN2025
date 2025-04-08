@extends('layouts.admin')

@section('title', 'Lịch sửví người dùng')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 style="color: #009688; font-weight: 700;">Lịch sử ví - 
            <span class="text-dark">{{ $user->ten_nguoi_dung ?? $user->username }}</span>
        </h4>
        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #009688; color: white;">
            💰 Số dư: {{ number_format($user->vi->so_du ?? 0, 0, ',', '.') }} VNĐ
        </span>
        
    </div>

    {{-- Bộ lọc trạng thái --}}
    <form method="GET" class="row g-2 align-items-center mb-4">
        <div class="col-auto">
            <label for="trang_thai" class="form-label fw-semibold">Lọc theo trạng thái:</label>
        </div>
        <div class="col-auto">
            <select name="trang_thai" id="trang_thai" class="form-select" style="min-width: 160px;" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>✅ Thành công</option>
                <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
            </select>
        </div>
    </form>

    {{-- Cập nhật trạng thái --}}
    <form method="POST" action="{{ route('admin.vis.updateTrangThai') }}">
        @csrf
        <div class="row g-2 align-items-center mb-3">
            <div class="col-auto">
                <select name="trang_thai" class="form-select form-select-sm border border-1" style="min-width: 150px;" required>
                    <option value="">-- Chọn trạng thái mới --</option>
                    <option value="1"> ✅ Thành công</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm" style="background-color: #009688; color: white;">
                    <i class="bi bi-check-circle"></i> Cập nhật
                </button>
            </div>
        </div>

        {{-- Bảng giao dịch --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead style="background-color: #009688 !important;">
                    <tr>
                        <th style="color: white;"><input type="checkbox" id="checkAll"></th>

                        <th style="color: white;">Số tiền</th>
                        <th style="color: white;">Loại</th>
                        <th style="color: white;">Mô tả</th>
                        <th style="color: white;">Trạng thái</th>
                        <th style="color: white;">Thời gian</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (!$user->vi)
                        <tr>
                            <td colspan="6" class="text-center text-danger">Người dùng chưa có ví</td>
                        </tr>
                    @else
                        @forelse ($giaodichs as $gd)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $gd->id }}"></td>
                                <td>
                                    @if(in_array($gd->loai, ['Rút tiền', 'Mua hàng', 'Thanh toán']))
                                        @if($gd->trang_thai == 1)
                                            <span class="text-danger">-{{ number_format(abs($gd->so_tien), 0, ',', '.') }} VNĐ</span>
                                        @else
                                            <span class="text-warning">{{ number_format(abs($gd->so_tien), 0, ',', '.') }} VNĐ</span>
                                        @endif
                                    @elseif(in_array($gd->loai, ['Nạp tiền', 'Hoàn tiền']))
                                        <span class="text-success">+{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-dark">{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <span class="badge bg-light border border-1 text-dark px-2">{{ $gd->loai }}</span>
                                </td>
                                <td>{{ $gd->mo_ta }}</td>
                                <td>
                                    @if ($gd->trang_thai == 1)
                                    <span class="badge" style="background-color: #28a745; color: white;">Thành công</span>
                                @else
                                    <span class="badge" style="background-color: #dc3545; color: white;">Chờ xử lý</span>
                                @endif
                                
                                </td>
                                <td>{{ $gd->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Không có giao dịch nào</td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $giaodichs->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </form>
</div>

{{-- Check All --}}
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        document.querySelectorAll('input[name="ids[]"]').forEach(el => el.checked = this.checked);
    });
</script>
@endsection
