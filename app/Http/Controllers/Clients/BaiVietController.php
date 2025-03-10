<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    public function danhSach()
    {
        return view('clients.baiviets.danhsach');
    }

    public function chiTiet()
    {
        return view('clients.baiviets.chitiet');
    }
}
