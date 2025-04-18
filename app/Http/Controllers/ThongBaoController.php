<?php

namespace App\Http\Controllers;

use App\Models\ThongBao;
use Illuminate\Http\Request;

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
}
