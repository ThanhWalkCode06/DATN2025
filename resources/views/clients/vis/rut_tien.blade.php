@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4" style="color: #009688;">RÚT TIỀN VỀ NGÂN HÀNG</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @elseif(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('rut-tien.xuly') }}" class="card p-4 shadow" style="max-width: 600px; margin: 0 auto; border-radius: 16px;">
        @csrf

        <!-- Ngân hàng -->
        <div class="mb-3">
            <label for="ngan_hang" class="form-label">Ngân hàng nhận tiền</label>
            <select name="ngan_hang" id="ngan_hang" class="form-select" required>
                <option value="">-- Chọn ngân hàng --</option>
                <option value="VCB">Vietcombank</option>
                <option value="TCB">Techcombank</option>
                <option value="ACB">ACB</option>
                <option value="MB">MB Bank</option>
                <option value="BIDV">BIDV</option>
                <option value="VPB">VPBank</option>
                <!-- Thêm các ngân hàng khác -->
            </select>
        </div>

        <!-- Số tài khoản -->
        <div class="mb-3">
            <label for="so_tai_khoan" class="form-label">Số tài khoản ngân hàng</label>
            <input type="text" name="so_tai_khoan" id="so_tai_khoan" class="form-control" required>
        </div>

        <!-- Tên người nhận -->
        <div class="mb-3">
            <label for="ten_nguoi_nhan" class="form-label">Tên người nhận</label>
            <input type="text" name="ten_nguoi_nhan" id="ten_nguoi_nhan" class="form-control" required>
        </div>

        <!-- Số tiền -->
        <div class="mb-3">
            <label for="so_tien" class="form-label">Số tiền muốn rút (VNĐ)</label>
            <input type="number" name="so_tien" id="so_tien" class="form-control" required min="10000">
        </div>

        <!-- Ghi chú -->
        <div class="mb-3">
            <label for="ghi_chu" class="form-label">Ghi chú (nếu có)</label>
            <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="2"></textarea>
        </div>

        <!-- Nút xác nhận -->
        <button type="submit" class="btn btn-success w-100" style="background-color: #009688; border: none;">
            <i class="fas fa-paper-plane me-2"></i> Gửi yêu cầu rút tiền
        </button>

        <p class="text-muted text-center mt-3" style="font-size: 0.9rem;">
            Thời gian xử lý có thể mất đến 24h. Phí rút: 0đ.
        </p>
    </form>
</div>
@endsection
