<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViController extends Controller
{
    
    public function hienThi()
    {
        $user = Auth::user();
        $vi = $user->layHoacTaoVi();
        $giaodichs = $vi->giaodichs()->latest()->paginate(10);

        return view('clients.vis.index', compact('vi', 'giaodichs'));
    }

    // public function soDuVi()
    // {
    //     $user = Auth::user();
    //     $soDu = $user->layHoacTaoVi(); // Lấy ví của người dùng
      
    //     return view('clients.thanhtoans.thanhtoan', compact('soDu'));
    // }
    


}
