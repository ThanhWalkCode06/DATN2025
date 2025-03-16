<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function danhSach()
    {
        return view('clients.sanphams.danhsach');
    }

    public function chiTiet()
    {
        return view('clients.sanphams.chitiet');
    }

    public function sanPhamYeuThich()
    {
        $user = Auth::user();
        return view('clients.sanphams.sanphamyeuthich',compact('user'));
    }

    public function addsanPhamYeuThich(string $id)
    {
        $user = Auth::user();
        if($user){
            $user->sanPhamYeuThichs()->attach($id);
        }else{
            return redirect()->back()->with(['error' => 'Vui lòng đăng nhập để sử dụng tính năng']);
        }
        return view('clients.sanphams.sanphamyeuthich',compact('user'));
    }

    public function xoaYeuThich($id)
    {
        try {
            $user = Auth::user();

            // Kiểm tra xem sản phẩm có trong danh sách yêu thích không
            if (!$user->sanPhamYeuThichs()->where('san_pham_id', $id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
            }

            // Xóa sản phẩm yêu thích
            $user->sanPhamYeuThichs()->detach($id);

            return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
        } catch (\Exception $e) {
            \Log::error('Lỗi xóa sản phẩm yêu thích: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi server!'], 500);
        }
    }
}
