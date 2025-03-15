<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\DanhGia;

class GioiThieuController extends Controller
{
    public function home()
    {
        // Lấy danh sách đánh giá có 5 sao và đã được duyệt
        $danhGias = DanhGia::where('so_sao', 5)
            ->where('trang_thai', 1)
            ->get();

        // Lấy danh sách bài viết mới nhất
        $baiViets = BaiViet::latest()->take(5)->get();

        // Truyền dữ liệu sang view
        return view('clients.gioithieu', compact('danhGias', 'baiViets'));
    }
}
