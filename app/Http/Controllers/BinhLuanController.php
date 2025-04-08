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
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $parent = BinhLuan::findOrFail($id);

        $reply = new BinhLuan();
        $reply->bai_viet_id = $parent->bai_viet_id; // gắn vào cùng bài viết
        $reply->user_id = Auth::id(); // người trả lời là admin đang đăng nhập
        $reply->parent_id = $parent->id; // gắn bình luận cha
        $reply->noi_dung = $request->input('content');
        $reply->trang_thai = 1; // mặc định hiển thị
        $reply->save();

        return redirect()->back()->with('success', 'Phản hồi bình luận đã được gửi!');
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
