<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    public function danhSach()
    {
        return view('clients.baiviets.index');
    }

    public function chiTiet()
    {
        return view('clients.baiviets.show');
    }
}
