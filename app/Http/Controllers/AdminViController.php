<?php

namespace App\Http\Controllers;

use App\Models\Vi;
use App\Models\User;
use App\Models\GiaoDichVi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminViController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $locCanDuyet = $request->get('loc_can_duyet');

        // Lấy toàn bộ danh sách users có liên kết ví và giao dịch
        $users = User::with(['vi.giaodichs'])
            ->leftJoin('vis', 'users.id', '=', 'vis.nguoi_dung_id') // Khóa đúng
            ->when(!empty($keyword), function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('ten_nguoi_dung', 'like', '%' . $keyword . '%')
                        ->orWhere('username', 'like', '%' . $keyword . '%');
                });
            })
            ->select('users.*')
            ->get()
            ->filter(function ($user) use ($locCanDuyet) {
                if ($locCanDuyet === '1') {
                    return $user->vi && $user->vi->giaodichs()
                        ->where('loai', 'Rút tiền')
                        ->where('trang_thai', 0)
                        ->exists();
                }
                return true;
            })
            ->sortByDesc(function ($user) {
                return $user->vi->so_du ?? 0; // Sắp xếp giảm dần theo số dư ví
            });

        // Phân trang thủ công
        $page = Paginator::resolveCurrentPage('page');
        $perPage = 10;
        $items = $users->slice(($page - 1) * $perPage, $perPage)->values();
        $users = new LengthAwarePaginator($items, $users->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        return view('admins.vis.index', compact('users', 'keyword', 'locCanDuyet'));
    }







    public function show($id, Request $request)
    {
        $trangThai = $request->get('trang_thai');
        $user = User::with('vi')->findOrFail($id);

        if ($user->vi) {
            $giaodichsQuery = $user->vi->giaodichs()->latest();

            if ($trangThai !== null) {
                $giaodichsQuery->where('trang_thai', $trangThai);
            }

            $giaodichs = $giaodichsQuery->paginate(10);
        } else {
            // Trả về paginator rỗng để tránh lỗi khi gọi ->links() và ->appends()
            $giaodichs = new LengthAwarePaginator([], 0, 10, 1, [
                'path' => request()->url(),
                'query' => request()->query()
            ]);
        }

        return view('admins.vis.show', compact('user', 'trangThai', 'giaodichs'));
    }



    
    public function updateTrangThai(Request $request)
    {
        $ids = $request->input('ids', []);
        $trangThai = $request->input('trang_thai');
        $lyDoChung = $request->input('ly_do'); // lấy lý do nếu có
    
        foreach ($ids as $id) {
            $giaoDich = GiaoDichVi::find($id);
    
            if (!$giaoDich || $giaoDich->trang_thai == 1 || $giaoDich->trang_thai == 2) {
                continue; // bỏ qua nếu đã duyệt hoặc huỷ
            }
    
            if ($giaoDich->loai === 'Rút tiền') {
                $vi = $giaoDich->vi;
                $soDuTruoc = $vi->so_du;
    
                if ($trangThai == 1) {
                    // Duyệt rút
                    if ($vi->so_du >= $giaoDich->so_tien) {
                        $vi->so_du -= $giaoDich->so_tien;
                        $vi->save();
    
                        $giaoDich->mo_ta = "💸 Rút tiền từ ví\n"
                            . "Số dư: " . number_format($soDuTruoc, 0, ',', '.') . " ➝ " . number_format($vi->so_du, 0, ',', '.') . " VNĐ\n"
                            . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
                            . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
                            . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}";
                        $giaoDich->trang_thai = 1;
                        $giaoDich->save();
                    } else {
                        return back()->with('error', 'Ví không đủ số dư để duyệt rút tiền.');
                    }
    
                } elseif ($trangThai == 2) {
                    // Huỷ rút
                    $vi = $giaoDich->vi;
                    $giaoDich->trang_thai = 2;
                    $giaoDich->mo_ta = "❌ Yêu cầu rút tiền đã bị huỷ\n"
                        . "⏱ Thời gian: " . now()->format('d/m/Y H:i') . "\n"
                        . "📝 Lý do: {$lyDoChung}\n"
                        . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
                        . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
                        . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}\n"
                        . "💰 Số dư hiện tại: " . number_format($vi->so_du, 0, ',', '.') . " VNĐ";
                    $giaoDich->save();
                    
                }
            } else {
                $giaoDich->trang_thai = $trangThai;
                $giaoDich->save();
            }
        }
    
        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }
    

}
