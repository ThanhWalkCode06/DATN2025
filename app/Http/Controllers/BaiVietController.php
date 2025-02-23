<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\User;
use App\Models\DanhMucBaiViet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BaiVietController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $baiViets = BaiViet::with('user', 'danhMuc')->orderBy('created_at', 'desc')->get();
        return view('admins.baiviets.index', compact('baiViets'));
    }

    // Hiển thị form tạo bài viết
    public function create()
    {
        $users = User::all(); // Lấy danh sách user
        $danhMucs = DanhMucBaiViet::all(); // Lấy danh mục bài viết
        return view('admins.baiviets.create', compact('users', 'danhMucs'));
    }

    // Xử lý lưu bài viết mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'tieu_de' => 'required|string|max:255',
            'danh_muc_id' => 'required|exists:danh_muc_bai_viets,id',
            'noi_dung' => 'required',
            'anh_bia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo bài viết mới
        $baiViet = new BaiViet();
        $baiViet->user_id = $request->user_id; // Lấy từ dropdown form
        $baiViet->tieu_de = $request->tieu_de;
        $baiViet->danh_muc_id = $request->danh_muc_id;
        $baiViet->noi_dung = $request->noi_dung;

        // Xử lý upload ảnh
        if ($request->hasFile('anh_bia')) {
            $file = $request->file('anh_bia');
            $path = $file->store('images', 'public');
            $baiViet->anh_bia = $path;
        }

        $baiViet->save();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được tạo!');
    }
    public function show($id)
    {
        $baiViet = BaiViet::with('user', 'danhMuc')->findOrFail($id);
        return view('admins.baiviets.show', compact('baiViet'));
    }

    // Hiển thị form chỉnh sửa bài viết
    public function edit($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $users = User::all();
        $danhMucs = DanhMucBaiViet::all();
        return view('admins.baiviets.edit', compact('baiViet', 'users', 'danhMucs'));
    }

    // Xử lý cập nhật bài viết
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'tieu_de' => 'required|string|max:255',
            'danh_muc_id' => 'required|exists:danh_muc_bai_viets,id',
            'noi_dung' => 'required',
            'anh_bia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $baiViet = BaiViet::findOrFail($id);
        $baiViet->user_id = $request->user_id;
        $baiViet->tieu_de = $request->tieu_de;
        $baiViet->danh_muc_id = $request->danh_muc_id;
        $baiViet->noi_dung = $request->noi_dung;

        // Xử lý upload ảnh nếu có thay đổi
        if ($request->hasFile('anh_bia')) {
            $file = $request->file('anh_bia');
            $path = $file->store('images', 'public');
            $baiViet->anh_bia = $path;
        }

        $baiViet->save();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được cập nhật!');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $baiViet->delete();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được xóa!');
    }
}
