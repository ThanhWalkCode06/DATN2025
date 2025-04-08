<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BienThe;
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


        // if (!$daMuaHang) {
        //     return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
        //         ->with('error_binhluan', 'Bạn chỉ có thể đánh giá sản phẩm sau khi đã mua.');
        // }

        $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])
            ->where('id', Auth::user()->id)
            ->first();

        // Kiểm tra nếu user không tồn tại
        if (!$user) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Người dùng không tồn tại.');
        }

        // Lấy danh sách ID biến thể của sản phẩm
        $idBienThes = BienThe::where('san_pham_id', $san_pham_id)->pluck('id')->toArray();

        // Kiểm tra nếu sản phẩm không có biến thể nào
        if (empty($idBienThes)) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Sản phẩm này không có biến thể để đánh giá.');
        }

        // Đếm số lần sản phẩm đã được mua (qua biến thể) trong các đơn hàng hoàn tất
        $soLanMua = 0;
        $bienTheId = null;
        foreach ($user->donHangs as $donHang) {
            if ($donHang->trang_thai_don_hang >= 4) { // Từ trạng thái "đã giao" trở lên
                $coSanPhamTrongDonHang = false;
                foreach ($donHang->chiTietDonHangs as $chiTiet) {
                    if (in_array($chiTiet->bien_the_id, $idBienThes)) {
                        $coSanPhamTrongDonHang = true;
                        $bienTheId = $chiTiet->bien_the_id;
                        break;
                    }
                }
                if ($coSanPhamTrongDonHang) {
                    $soLanMua++;
                }
            }
        }

        // Đếm số lượt đã đánh giá sản phẩm
        $soLanDanhGia = $user->danhGias->where('san_pham_id', $san_pham_id)->count();

        if ($soLanMua <= $soLanDanhGia) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn chỉ có thể đánh giá sản phẩm sau khi đã mua, và không vượt quá số lần mua.');
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
            'bien_the_id' => $bienTheId,
            'so_sao' => $request->so_sao,
            'nhan_xet' => $request->nhan_xet ?? '',
            'trang_thai' => 1 // Đánh giá mới mặc định chưa duyệt
        ]);

        // Redirect về chi tiết sản phẩm đúng route
        return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
            ->with('success', 'Gửi đánh giá thành công.');
    }

   
    
}
