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
    public function index()
    {
        $tongDonHang = DonHang::count(); 
        $tongSanPhamConHang = SanPham::where('trang_thai', 1)->count(); 
        $tongKhachHangHoatDong = User::where('trang_thai', 1)->count(); 
        $donHangs = DonHang::orderBy('created_at', 'desc')->limit(10)->get();
        return view('admins.index', compact('tongDonHang', 'tongKhachHangHoatDong', 'tongSanPhamConHang','donHangs',));
    }
}

