<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViController extends Controller
{
    public function hienThi(Request $request)
{
    $user = Auth::user();
    $vi = $user->layHoacTaoVi();

    // Khởi tạo query giao dịch
    $query = $vi->giaodichs()->latest();

    // Lọc theo ngày nếu có
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    // Phân trang kết quả
    $giaodichs = $query->paginate(10);

    return view('clients.vis.index', compact('vi', 'giaodichs'));
}


    // public function soDuVi()
    // {
    //     $user = Auth::user();
    //     $soDu = $user->layHoacTaoVi(); // Lấy ví của người dùng
      
    //     return view('clients.thanhtoans.thanhtoan', compact('soDu'));
    // }
    


}
