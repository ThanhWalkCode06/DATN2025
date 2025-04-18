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
            // ->with(['nguoiDung', 'bienThe'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($danhGias);
    }
    
    public function kiemTraQuyenDanhGia($san_pham_id)
    {
        if (!Auth::check()) {
            return false; // Chưa đăng nhập, không được đánh giá
        }
    
        $user = User::with(['donHangs.chiTietDonHangs'])->find(Auth::id());
        if (!$user) {
            return false; // Người dùng không tồn tại
        }
    
        // Lấy danh sách biến thể của sản phẩm
        $idBienThes = BienThe::where('san_pham_id', $san_pham_id)->pluck('id')->toArray();
        if (empty($idBienThes)) {
            return false; // Không có biến thể
        }
    
        // Kiểm tra các biến thể đã mua
        $bienTheDaMua = [];
        foreach ($user->donHangs as $donHang) {
            if ($donHang->trang_thai_don_hang == 4) { // Đơn hàng đã hoàn thành hoặc giao hàng thành công
                $bienTheTrongDon = $donHang->chiTietDonHangs
                    ->whereIn('bien_the_id', $idBienThes)
                    ->pluck('bien_the_id')
                    ->unique();
    
                foreach ($bienTheTrongDon as $bienTheId) {
                    $bienTheDaMua[$bienTheId] = ($bienTheDaMua[$bienTheId] ?? 0) + 1;
                }
            }
        }
    
        return !empty($bienTheDaMua); // Trả về true nếu có ít nhất một biến thể đã mua
    }

    public function themDanhGia(Request $request, $san_pham_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
        }
    
        $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])->find(Auth::id());
    
        if (!$user) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Người dùng không tồn tại.');
        }
    
        // Lấy danh sách biến thể của sản phẩm hiện tại
        $idBienThes = BienThe::where('san_pham_id', $san_pham_id)->pluck('id')->toArray();
    
        if (empty($idBienThes)) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Sản phẩm này không có biến thể để đánh giá.');
        }
    
        // Tìm các biến thể đã mua
        $bienTheDaMua = [];
        foreach ($user->donHangs as $donHang) {
            if ($donHang->trang_thai_don_hang == 4) {
                $bienTheTrongDon = $donHang->chiTietDonHangs
                    ->whereIn('bien_the_id', $idBienThes)
                    ->pluck('bien_the_id')
                    ->unique();
    
                foreach ($bienTheTrongDon as $bienTheId) {
                    $bienTheDaMua[$bienTheId] = ($bienTheDaMua[$bienTheId] ?? 0) + 1;
                }
            }
        }
    
        // Nếu nhiều biến thể và chưa chọn → bắt chọn
        if (count($bienTheDaMua) > 1 && !$request->filled('bien_the_id')) {
            session()->put('bienTheDaMua_' . $san_pham_id, $bienTheDaMua);
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('chophep_danhgia', true)
                ->with('error_binhluan', 'Vui lòng chọn biến thể bạn muốn đánh giá.');
        }
    
        // Nếu chỉ có 1 biến thể → tự động gán
        $bienTheId = $request->input('bien_the_id') ?? array_key_first($bienTheDaMua);
    
        if (!$bienTheId || !isset($bienTheDaMua[$bienTheId])) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn chưa mua biến thể này.');
        }
    
        // Kiểm tra số lượt đã đánh giá
        $soLuotDaDanhGia = DanhGia::where('user_id', $user->id)
            ->where('san_pham_id', $san_pham_id)
            ->where('bien_the_id', $bienTheId)
            ->count();
    
        if ($soLuotDaDanhGia >= $bienTheDaMua[$bienTheId]) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn đã đánh giá đủ số lượt cho biến thể này. Hãy mua thêm để tiếp tục đánh giá.');
        }
    
        $request->validate([
            'so_sao' => 'required|integer|min:1|max:5',
            'nhan_xet' => 'nullable|string'
        ]);
    
        DanhGia::create([
            'user_id' => $user->id,
            'san_pham_id' => $san_pham_id,
            'bien_the_id' => $bienTheId,
            'so_sao' => $request->so_sao,
            'nhan_xet' => $request->nhan_xet ?? '',
            'trang_thai' => 1
        ]);
    
        // Xoá session sau khi đánh giá xong để tránh lỗi khi chuyển sản phẩm
        session()->forget('bienTheDaMua_' . $san_pham_id);
    
        return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
            ->with('success', 'Gửi đánh giá thành công.')
            ->with('daMuaHang', true);
    }
    
}
