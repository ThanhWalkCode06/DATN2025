<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhGias = DanhGia::select('danh_gias.*', 'users.ten_nguoi_dung', 'san_phams.ten_san_pham')
            ->join('users', 'users.id', '=', 'user_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->get();
        return view('admins.danhgias.index', compact('danhGias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhGia $danhgia)
    {
        $danhGia = DanhGia::select('danh_gias.*', 'users.ten_nguoi_dung', 'san_phams.ten_san_pham')
            ->join('users', 'users.id', '=', 'user_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->find($danhgia->id);

        return view('admins.danhgias.show', compact('danhGia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DanhGia $danhgia)
    {
        if ($request->an_danh_gia) {
            $data = [
                'trang_thai' => 0
            ];
            DanhGia::where("id", $danhgia->id)->update($data);
        }

        if ($request->hien_danh_gia) {
            $data = [
                'trang_thai' => 1
            ];
            DanhGia::where("id", $danhgia->id)->update($data);
        }

        return redirect()->route('danhgias.show', $danhgia->id)->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showDanhGias()
    {
        // Lấy danh sách đánh giá có trạng thái = 1 (được duyệt)
        $danhGias = DanhGia::with(['user', 'sanPham'])->where('trang_thai', 1)->get();

        // Truyền dữ liệu sang view 'clients.gioithieu'
        return view('clients.gioithieu', compact('danhGias'));
    }
}
