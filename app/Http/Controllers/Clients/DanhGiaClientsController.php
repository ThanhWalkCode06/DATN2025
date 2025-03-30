<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaClientsController extends Controller
{
    // public function danhSachDanhGia($san_pham_id)
    // {
    //     // Lấy thông tin sản phẩm
    //     $sanPham = SanPham::findOrFail($san_pham_id);

    //     // Lấy danh sách đánh giá đã duyệt
    //     $danhGias = DanhGia::where('san_pham_id', $san_pham_id)
    //         ->where('trang_thai', 1) // Chỉ lấy đánh giá đã được duyệt
    //         ->with('nguoiDung') // Nếu model có quan hệ 'nguoiDung'
    //         ->latest()
    //         ->get();

    //     // Trả về view chitiet.blade.php và truyền dữ liệu
    //     return view('clients.sanphams.chitiet', compact('sanPham', 'danhGias'));
    // }
    public function danhSachDanhGia($san_pham_id)
    {
        $danhGias = DanhGia::where('san_pham_id', $san_pham_id)
            ->where('trang_thai', 1) // Chỉ lấy đánh giá có trạng thái hiển thị
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($danhGias);
    }


    public function themDanhGia(Request $request, $san_pham_id)
    {
        // Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
        }

        $daMuaHang = \App\Models\DonHang::where('user_id', Auth::id())
            ->whereHas('bienThes', function ($query) use ($san_pham_id) {
                $query->where('chi_tiet_don_hangs.san_pham_id', $san_pham_id); 
            })
            ->exists();


        if (!$daMuaHang) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn chỉ có thể đánh giá sản phẩm sau khi đã mua.');
        }

        // Validate dữ liệu
        $request->validate([
            'so_sao' => 'required|integer|min:1|max:5',
            'nhan_xet' => 'nullable|string'
        ]);

        // Tạo đánh giá mới
        DanhGia::create([
            'user_id' => Auth::id(),
            'san_pham_id' => $san_pham_id,
            'so_sao' => $request->so_sao,
            'nhan_xet' => $request->nhan_xet ?? '', 
            'trang_thai' => 1 // Đánh giá mới mặc định chưa duyệt
        ]);

        // Redirect về chi tiết sản phẩm đúng route
        return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
            ->with('success', 'Gửi đánh giá thành công.');
    }
}
