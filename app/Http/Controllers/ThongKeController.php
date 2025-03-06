<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang; 
use Illuminate\Support\Facades\DB;



class ThongKeController extends Controller
{
    public function index(Request $request)
{
    $tongDonHang = DonHang::count();
    $tongSanPhamConHang = SanPham::where('trang_thai', 1)->count();
    $tongKhachHangHoatDong = User::where('trang_thai', 1)->count();
    
    $query = DonHang::query();

    if ($request->has('sort') && $request->sort == 'ngay_dat') {
        $query->orderBy('created_at', 'desc'); // Ngày đặt gần nhất
    }

    if ($request->has('sort') && $request->sort == 'tong_tien') {
        $query->orderBy('tong_tien', 'desc'); // Tổng tiền cao nhất
    }

    if ($request->has('trang_thai') && $request->trang_thai == 'chua_xac_nhan') {
        $query->where('trang_thai_don_hang', 'Chưa xác nhận'); // Đơn hàng chưa xác nhận
    }


    $donHangs = $query->paginate(20); // Phân trang

    $sanPhamBanChay = DB::table('chi_tiet_don_hangs')
    ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
    ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
    ->select(
        'san_phams.id',
        'san_phams.ten_san_pham',
        'bien_thes.gia_ban', 
        DB::raw('SUM(chi_tiet_don_hangs.so_luong) as tong_da_ban')
    )
    ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'bien_thes.gia_ban')
    ->orderByDesc('tong_da_ban')
    ->paginate(3);
    // dd($sanPhamBanChay);


    return view('admins.index', compact('tongDonHang','tongKhachHangHoatDong','tongSanPhamConHang','donHangs','sanPhamBanChay'));
}

}

