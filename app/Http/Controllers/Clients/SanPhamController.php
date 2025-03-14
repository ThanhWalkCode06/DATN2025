<?php

namespace App\Http\Controllers\Clients;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SanPhamController extends Controller
{
    public function danhSach()
    {
        $sanPhams = SanPham::paginate(10);
    return view('clients.sanphams.danhsach', compact('sanPhams'));
    }

    public function chiTiet($id)
    {
        $sanPhams = SanPham::with('bienThes')->findOrFail($id);
        return view('clients.sanphams.chitiet', compact('sanPhams'));
    }

    public function sanPhamYeuThich()
    {
        return view('clients.sanphams.sanphamyeuthich');
    }
}
