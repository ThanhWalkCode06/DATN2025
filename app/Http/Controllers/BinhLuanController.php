<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhLuanController extends Controller
{
    // Hiển thị danh sách bình luận
    public function index(Request $request)
    {
        $query = BinhLuan::with(['baiViet', 'user']);

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $query->where('noi_dung', 'like', "%$keyword%");
        }

        $binhLuans = $query->latest()->paginate(10);

        return view('admins.binhluans.index', compact('binhLuans'));
    }

    public function show($id)
    {
        $binhLuan = BinhLuan::with(['baiViet', 'user', 'replies.user'])->findOrFail($id);
        return view('admins.binhluans.show', compact('binhLuan'));
    }
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'bai_viet_id' => 'required|exists:bai_viets,id',
        ]);

        // Nếu chưa đăng nhập thì redirect về trang đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login.client')->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        $binhLuan = new BinhLuan();
        $binhLuan->bai_viet_id = $request->bai_viet_id;
        $binhLuan->user_id = Auth::id();
        $binhLuan->noi_dung = $request->input('content');
        $binhLuan->trang_thai = 1;

        // Nếu là trả lời bình luận
        if ($id) {
            $parent = BinhLuan::findOrFail($id);
            $binhLuan->parent_id = $parent->id;
        }

        $binhLuan->save();

        return redirect()->back()->with('success', $id ? 'Phản hồi đã được gửi!' : 'Bình luận đã được gửi!');
    }

    // Xóa bình luận
    public function destroy($id)
    {
        $binhLuan = BinhLuan::findOrFail($id);
        $binhLuan->delete();

        return redirect()->route('admins.binhluans.index')->with('success', 'Xóa bình luận thành công.');
    }

    // Toggle trạng thái hiển thị / ẩn
    public function toggle($id)
    {
        $binhLuan = BinhLuan::findOrFail($id);
        $binhLuan->trang_thai = !$binhLuan->trang_thai;
        $binhLuan->save();

        return redirect()->back()->with('success', 'Trạng thái đã được cập nhật!');
    }
}
