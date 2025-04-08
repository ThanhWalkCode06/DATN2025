<?php

namespace App\Http\Controllers;

use App\Models\Vi;
use App\Models\User;
use App\Models\GiaoDichVi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminViController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->get('keyword');

    $users = User::with('vi')
        ->when(!empty($keyword), function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('ten_nguoi_dung', 'like', '%' . $keyword . '%')
                  ->orWhere('username', 'like', '%' . $keyword . '%');
            });
        })
        ->paginate(10);

    return view('admins.vis.index', compact('users', 'keyword'));
}

    
    


public function show($id, Request $request)
{
    $trangThai = $request->get('trang_thai');

    // Lấy user
    $user = User::with('vi')->findOrFail($id);

    // Lấy giao dịch phân trang
    $giaodichsQuery = $user->vi?->giaodichs()->latest();
    
    if ($trangThai !== null) {
        $giaodichsQuery->where('trang_thai', $trangThai);
    }

    $giaodichs = $giaodichsQuery?->paginate(10);

    return view('admins.vis.show', compact('user', 'trangThai', 'giaodichs'));
}


public function updateTrangThai(Request $request)
{
    $ids = $request->input('ids', []);
    $trangThai = $request->input('trang_thai');

    foreach ($ids as $id) {
        $giaoDich = GiaoDichVi::find($id);

        // Chỉ xử lý khi là rút tiền và cập nhật sang trạng thái "thành công"
        if ($giaoDich && $giaoDich->loai === 'Rút tiền' && $trangThai == 1 && $giaoDich->trang_thai != 1) {
            $vi = $giaoDich->vi;

            // Trừ tiền
            $soDuTruoc = $vi->so_du;
            $vi->so_du -= $giaoDich->so_tien;
            $vi->save();

            // Cập nhật mô tả và trạng thái
            $giaoDich->mo_ta = "💸 Rút tiền từ ví\nSố dư: " . number_format($soDuTruoc, 0, ',', '.') . " ➝ " . number_format($vi->so_du, 0, ',', '.') . " VNĐ";

            $giaoDich->trang_thai = 1;
            $giaoDich->save();
        } else {
            // Cập nhật các loại giao dịch khác (không phải rút tiền)
            $giaoDich?->update(['trang_thai' => $trangThai]);
        }
    }

    return back()->with('success', 'Cập nhật trạng thái thành công');
}

}
