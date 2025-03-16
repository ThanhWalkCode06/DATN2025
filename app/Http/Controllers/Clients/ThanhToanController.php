<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use App\Http\Controllers\Controller;

class ThanhToanController extends Controller
{
    public function gioHang()
    {
        $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.gia_moi', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->where('user_id', '=', 1)
            ->get();

        // dd($chiTietGioHangs);

        return view('clients.thanhtoans.giohang', compact('chiTietGioHangs'));
    }

    public function thanhToan()
    {
        $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.gia_moi', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->where('user_id', '=', 1)
            ->get();

        return view('clients.thanhtoans.thanhtoan', compact('chiTietGioHangs'));
    }

    public function datHangThanhCong()
    {
        return view('clients.thanhtoans.dathangthanhcong');
    }
}
