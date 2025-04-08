@extends('layouts.admin')

@section('title', 'Chi tiết ví người dùng')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Chi tiết ví - <span class="text-primary">{{ $user->ten_nguoi_dung ?? $user->username }}</span></h4>
        <span class="badge bg-success fs-6">Số dư: {{ number_format($user->vi->so_du ?? 0, 0, ',', '.') }} VNĐ</span>
    </div>

    {{-- Bộ lọc trạng thái --}}
    <form method="GET" class="row g-2 align-items-center mb-3">
        <div class="col-auto">
            <label for="trang_thai" class="col-form-label">Lọc theo trạng thái:</label>
        </div>
        <div class="col-auto">
            <select name="trang_thai" id="trang_thai" class="form-select" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Thành công</option>
                <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Chờ xử lý</option>
            </select>
        </div>
    </form>

    {{-- Cập nhật trạng thái --}}
    <form method="POST" action="{{ route('admin.vis.updateTrangThai') }}">
        @csrf
        <div class="row g-2 align-items-center mb-3">
            <div class="col-auto">
                <select name="trang_thai" class="form-select form-select-sm" required>
                    <option value="">Chọn trạng thái mới</option>
                    <option value="1">Thành công</option>
                    <option value="0">Chờ xử lý</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
            </div>
        </div>

        {{-- Bảng giao dịch --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 30px;"><input type="checkbox" id="checkAll"></th>
                        <th style="min-width: 100px;">Số tiền</th>
                        <th style="min-width: 100px;">Loại</th>
                        <th style="min-width: 200px;">Mô tả</th>
                        <th style="min-width: 100px;">Trạng thái</th>
                        <th style="min-width: 150px;">Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$user->vi)
                    <tr>
                        <td colspan="6" class="text-center text-danger">Người dùng chưa có ví</td>
                    </tr>
                @else
                    @forelse ($user->vi->giaodichs->when(request('trang_thai') !== null, fn($q) => $q->where('trang_thai', request('trang_thai'))) as $gd)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $gd->id }}"></td>
                            <td>{{ number_format($gd->so_tien, 0, ',', '.') }} VNĐ</td>
                            <td><span class="badge bg-info text-dark">{{ $gd->loai }}</span></td>
                            <td>{{ $gd->mo_ta }}</td>
                            <td>
                                @if ($gd->trang_thai == 1)
                                    <span class="badge bg-success">Thành công</span>
                                @else
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
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
    </form>
</div>

{{-- Check All --}}
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        document.querySelectorAll('input[name="ids[]"]').forEach(el => el.checked = this.checked);
    });
</script>
@endsection
