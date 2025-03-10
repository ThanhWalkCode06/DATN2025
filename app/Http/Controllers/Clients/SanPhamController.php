<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function danhSach()
    {
        return view('clients.sanphams.index');
    }

    public function chiTiet()
    {
        return view('clients.sanphams.show');
    }

    public function sanPhamYeuThich()
    {
        return view('clients.sanphams.sanphamyeuthich');
    }
}
