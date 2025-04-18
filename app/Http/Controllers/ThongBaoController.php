<?php

namespace App\Http\Controllers;

use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThongBaoController extends Controller
{
    public function fetch()
    {
        $notifications = ThongBao::where('user_id', 1)
            ->where('trang_thai', 0)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return response()->json($notifications);
    }
    public function daDoc(Request $request, $id)
    {
        $thongBao = ThongBao::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $thongBao->trang_thai = 1; // 1: đã đọc
        $thongBao->save();

        return response()->json(['success' => true]);
    }
}
