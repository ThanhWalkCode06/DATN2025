<?php

namespace App\Http\Controllers;

use App\Models\Vi;
use App\Models\User;
use App\Models\GiaoDichVi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminViController extends Controller
{
    public function index()
{
    $users = \App\Models\User::orderBy('created_at', 'desc')->paginate(10); // Mới nhất trước

    return view('admins.vis.index', compact('users'));
}


public function show($id, Request $request)
{
    $trangThai = $request->get('trang_thai');

    $user = User::with(['vi.giaodichs' => function ($q) use ($trangThai) {
        if ($trangThai !== null) {
            $q->where('trang_thai', $trangThai);
        }
        $q->latest();
    }])->findOrFail($id);

    return view('admins.vis.show', compact('user', 'trangThai'));
}

public function updateTrangThai(Request $request)
{
    $ids = $request->input('ids', []);
    $trangThai = $request->input('trang_thai');

    GiaoDichVi::whereIn('id', $ids)->update(['trang_thai' => $trangThai]);

    return back()->with('success', 'Cập nhật trạng thái thành công');
}
}
