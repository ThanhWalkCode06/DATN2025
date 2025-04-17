<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\SanPham;
use App\Events\AnBinhLuan;
use App\Events\HienBinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sanPhams = SanPham::all();

        $query = DanhGia::select('danh_gias.*', 'users.ten_nguoi_dung', 'san_phams.ten_san_pham')
            ->join('users', 'users.id', '=', 'user_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id');

        // Lọc theo từ khoá chung: tên người dùng hoặc tên sản phẩm
        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('users.ten_nguoi_dung', 'like', "%$keyword%")
                    ->orWhere('san_phams.ten_san_pham', 'like', "%$keyword%");
            });
        }

        $query->orderBy('danh_gias.created_at', 'desc');

        $danhGias = $query->paginate(10)->appends($request->all());

        return view('admins.danhgias.index', compact('danhGias', 'sanPhams'));
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
            $data = ['trang_thai' => 0];
            DanhGia::where("id", $danhgia->id)->update($data);
        }

        if ($request->hien_danh_gia) {
            $data = ['trang_thai' => 1];
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
        $danhGias = DanhGia::with(['user', 'sanPham'])
            ->where('trang_thai', 1)
            ->get();

        return view('clients.gioithieu', compact('danhGias'));
    }

    

    // public function trangThaiDanhGia(Request $request)
    // {
    //     $danhGia = DanhGia::find($request->id);
    //     if ($danhGia) {
    //         $newStatus = $danhGia->trang_thai == 1 ? 0 : 1;
    //         $danhGia->trang_thai = $newStatus;

    //         if ($newStatus == 0 && $request->has('reasons')) {
    //             $danhGia->ly_do_an = implode(', ', $request->input('reasons'));
    //         } else {
    //             $danhGia->ly_do_an = null;
    //         }

    //         $danhGia->save();

    //         if ($newStatus == 0) {
    //             Log::info('Kích hoạt sự kiện AnBinhLuan cho bình luận ID: ' . $danhGia->id);
    //             event(new AnBinhLuan($danhGia));
    //         } else {
    //             Log::info('Kích hoạt sự kiện HienBinhLuan cho bình luận ID: ' . $danhGia->id);
    //             event(new HienBinhLuan($danhGia));
    //         }
            
    //         return response()->json(['success' => true, 'status' => $danhGia->trang_thai]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Đánh giá không tồn tại.']);
    // }
    public function trangThaiDanhGia(Request $request)
    {
        $danhGia = DanhGia::find($request->id);
        if ($danhGia) {
            $newStatus = $danhGia->trang_thai == 1 ? 0 : 1;
            $danhGia->trang_thai = $newStatus;

            if ($newStatus == 0 && $request->has('reasons')) {
                $danhGia->ly_do_an = implode(', ', $request->input('reasons'));
            } else {
                $danhGia->ly_do_an = null;
            }

            $danhGia->save();

            if ($newStatus == 0) {
                event(new AnBinhLuan($danhGia));
            } else {
                event(new HienBinhLuan($danhGia)); // Trigger HienBinhLuan event
            }
            
            return response()->json(['success' => true, 'status' => $danhGia->trang_thai]);
        }

        return response()->json(['success' => false, 'message' => 'Đánh giá không tồn tại.']);
    }
    


    public function updateStatus(Request $request, $id)
    {
        $danhGia = DanhGia::findOrFail($id);
        $danhGia->trang_thai = $request->input('trang_thai');
        $danhGia->save();

        return response()->json(['success' => true]);
    }
}
