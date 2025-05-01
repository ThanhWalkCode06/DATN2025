<?php

namespace App\Http\Controllers;

use App\Models\GiaoDichVi;
use Illuminate\Http\Request;

class GiaoDichViController extends Controller
{
    public function huy(Request $request, $id)
    {
        $request->validate([
            'ly_do' => 'required|string|max:255',
        ]);

        // Tìm giao dịch với điều kiện thuộc về ví của người dùng hiện tại
        $giaoDich = GiaoDichVi::where('id', $id)
            ->whereHas('vi', function ($query) {
                $query->where('nguoi_dung_id', auth()->id());
            })
            ->firstOrFail();

        // Kiểm tra trạng thái giao dịch
        if ($giaoDich->trang_thai != 0) {
            return back()->with('error', 'Chỉ có thể huỷ giao dịch đang chờ xử lý.');
        }

        // Làm mới ví để đảm bảo số dư chính xác
        $giaoDich->vi->refresh();

        // Cập nhật trạng thái và mô tả giao dịch
        $giaoDich->trang_thai = 2; // Đã huỷ
        $giaoDich->mo_ta = "❌ Yêu cầu rút tiền đã bị huỷ bởi người dùng\n"
            . "🕒 Thời gian huỷ: " . now()->format('H:i d/m/Y') . "\n"
            . "📝 Lý do: " . $request->ly_do . "\n"
            . "🏦 Ngân hàng: " . ($giaoDich->ten_ngan_hang ?? 'N/A') . "\n"
            . "🔢 Số tài khoản: " . ($giaoDich->so_tai_khoan ?? 'N/A') . "\n"
            . "👤 Người nhận: " . ($giaoDich->ten_nguoi_nhan ?? 'N/A') . "\n"
            . "💰 Số dư hiện tại: " . number_format($giaoDich->vi->so_du, 0, ',', '.') . " VNĐ";
        $giaoDich->updated_at = now();
        $giaoDich->save();

        return back()->with('success', 'Huỷ giao dịch thành công.');
    }
}