<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HuongDanController extends Controller
{
    public function danhSach()
    {
        return view('clients.huongdans.danhsach');
    }

    public function chiTiet()
    {
        return view('clients.huongdans.chitiet');
    }
}
