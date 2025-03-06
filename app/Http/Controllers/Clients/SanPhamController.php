<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index()
    {
        return view('clients.sanphams.index');
    }

    public function show()
    {
        return view('clients.sanphams.show');
    }

    public function sanPhamYeuThich()
    {
        return view('clients.sanphams.sanphamyeuthich');
    }
}
