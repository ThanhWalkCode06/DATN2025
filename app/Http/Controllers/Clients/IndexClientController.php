<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;

class IndexClientController extends Controller
{
    public function index(){
        $danhMucAll = DanhMucSanPham::all();
        $sanPhamFollowComments = SanPham::with('bienThes','danhGias','anhSP')
        ->withAvg('danhGias', 'so_sao') // Lấy trung bình số sao từ bảng danh_gias
        ->orderByDesc('danh_gias_avg_so_sao') // Sắp xếp theo số sao trung bình giảm dần
        ->take(8)
        ->get()->toArray();

        return view('clients.index',compact('danhMucAll','sanPhamFollowComments'));
    }
}
