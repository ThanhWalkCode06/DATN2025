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

    $gd = GiaoDichVi::where('id', $id)
    ->whereHas('vi', function ($query) {
        $query->where('nguoi_dung_id', auth()->id());
    })
    ->firstOrFail();


    if ($gd->trang_thai != 0) {
        return back()->with('error', 'Chỉ có thể huỷ giao dịch đang chờ xử lý.');
    }

    $gd->trang_thai = 2; // Đã huỷ
    $gd->mo_ta .= "\n❌ Yêu cầu huỷ bởi người dùng\n📝 Lý do: " . $request->ly_do;
    $gd->updated_at = now();
    $gd->save();

    return back()->with('success', 'Huỷ giao dịch thành công.');
}

}
