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
    // public function daDoc(Request $request, $id)
    // {
    //     $thongBao = ThongBao::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    //     $thongBao->trang_thai = 1; // 1: đã đọc
    //     $thongBao->save();

    //     return response()->json(['success' => true]);
    // }
    public function daDoc(Request $request, $id)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        ThongBao::where('user_id', $userId)
            ->where('trang_thai', 0)
            ->update(['trang_thai' => 1]);

        return response()->json(['success' => true]);
    }

    public function deleteAll(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        ThongBao::where('user_id', $userId)->delete();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request, $id)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $thongBao = ThongBao::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $thongBao->delete();

        return response()->json(['success' => true]);
    }
    
//     public function fetchAll()
// {
//     $userId = Auth::id();
//     if (!$userId) {
//         return response()->json([]);
//     }

//     $thongBaos = ThongBao::with('danhGia.sanPham')
//         ->where('user_id', $userId)
//         ->where('trang_thai', 0)
//         ->orderBy('created_at', 'desc')
//         ->get()
//         ->map(function ($thongBao) {
//             return [
//                 'id' => $thongBao->id,
//                 'noi_dung' => $thongBao->noi_dung,
//                 'nhan_xet' => $thongBao->danhGia->nhan_xet ?? null,
//                 'created_at' => $thongBao->created_at->diffForHumans(), // "1 giờ trước"
//                 'created_at_full' => $thongBao->created_at->format('d/m/Y H:i'), // "19/04/2025 14:30"
//                 'danh_gia' => $thongBao->danhGia ? [
//                     'san_pham' => $thongBao->danhGia->sanPham ? [
//                         'ten_san_pham' => $thongBao->danhGia->sanPham->ten_san_pham,
//                     ] : null,
//                     'ly_do_an' => $thongBao->danhGia->ly_do_an,
//                 ] : null,
//             ];
//         });

//     return response()->json($thongBaos);
// }
public function fetchAll()
{
    $user = Auth::user();
    if (!$user) {
        return response()->json([]);
    }

    $notifications = ThongBao::with('danhGia.sanPham')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($thongBao) {
            return [
                'id' => $thongBao->id,
                'noi_dung' => $thongBao->noi_dung,
                'trang_thai' => $thongBao->trang_thai,
                // 'created_at' => $thongBao->created_at->diffForHumans(),
                'created_at_full' => $thongBao->created_at->toDateTimeString(),
                'danh_gia' => $thongBao->danhGia ? [
                    'san_pham' => $thongBao->danhGia->sanPham ? [
                        'ten_san_pham' => $thongBao->danhGia->sanPham->ten_san_pham,
                    ] : null,
                    'ly_do_an' => $thongBao->danhGia->ly_do_an,
                ] : null,
                'nhan_xet' => $thongBao->danhGia ? $thongBao->danhGia->nhan_xet : null,
            ];
        });

    return response()->json($notifications);
}
public function countUnread()
{
    $userId = Auth::id();
    if (!$userId) {
        return response()->json(['count' => 0]);
    }

    $count = ThongBao::where('user_id', $userId)
        ->where('trang_thai', 0)
        ->count();

    return response()->json(['count' => $count]);
}
}
