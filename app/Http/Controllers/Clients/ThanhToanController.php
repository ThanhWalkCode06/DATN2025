<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function gioHang()
    {
        return view('clients.thanhtoans.giohang');
    }

    public function thanhToan()
    {
        return view('clients.thanhtoans.thanhtoan');
    }

    public function datHangThanhCong()
    {
        return view('clients.thanhtoans.dathangthanhcong');
    }
}
