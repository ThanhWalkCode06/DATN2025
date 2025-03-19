<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use App\Models\DanhMucBaiViet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateBaiVietRequest;
use App\Models\SanPham;

class BaiVietController extends Controller
{

    public function index(Request $request)
{
    $query = BaiViet::with('user', 'danhMuc'); // Load quan hệ user & danh mục

    // Nếu có từ khóa tìm kiếm
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('tieu_de', 'like', '%' . $search . '%') // Tìm theo tiêu đề
              ->orWhereHas('user', function ($q) use ($search) {
                  $q->where('ten_nguoi_dung', 'like', '%' . $search . '%'); // Tìm theo tên tài khoản
              })
              ->orWhereHas('danhMuc', function ($q) use ($search) {
                  $q->where('ten_danh_muc', 'like', '%' . $search . '%'); // Tìm theo danh mục
              });
        });
    }

    $baiViets = $query->orderBy('created_at', 'desc')->paginate(10)->appends(['search' => $request->search]);

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
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'tieu_de' => 'required|string|max:255|unique:bai_viets,tieu_de',
        'danh_muc_id' => 'required|exists:danh_muc_bai_viets,id',
        'noi_dung' => 'required',
        'anh_bia' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ], [
        'user_id.required' => 'Vui lòng chọn tài khoản người viết.',
        'user_id.exists' => 'Tài khoản không tồn tại.',
        'tieu_de.required' => 'Tiêu đề bài viết là bắt buộc.',
        'tieu_de.unique' => 'Tiêu đề bài viết đã tồn tại. Vui lòng nhập tiêu đề khác.',
        'danh_muc_id.required' => 'Danh mục bài viết là bắt buộc.',
        'danh_muc_id.exists' => 'Danh mục không tồn tại.',
        'noi_dung.required' => 'Nội dung bài viết không được để trống.',
        'anh_bia.required' => 'Hình ảnh không được để trống.',
        'anh_bia.image' => 'Tệp tải lên phải là hình ảnh.',
        'anh_bia.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
        'anh_bia.max' => 'Hình ảnh không được vượt quá 2MB.'
    ]);

    // Tạo bài viết mới
    $baiViet = new BaiViet();
    $baiViet->user_id = $request->user_id;
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
    return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được tạo.');
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
    public function update(UpdateBaiVietRequest $request, $id)
    {
        $baiViet = BaiViet::findOrFail($id);

        $baiViet->user_id = $request->user_id;
        $baiViet->tieu_de = $request->tieu_de;
        $baiViet->danh_muc_id = $request->danh_muc_id;
        $baiViet->noi_dung = $request->noi_dung;

        // Xử lý upload ảnh nếu có thay đổi
        if ($request->hasFile('anh_bia')) {
            $file = $request->file('anh_bia');
            $path = $file->store('images', 'public');

            // Xóa ảnh cũ nếu có
            if ($baiViet->anh_bia) {
                Storage::disk('public')->delete($baiViet->anh_bia);
            }

            $baiViet->anh_bia = $path;
        }

        $baiViet->save();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được cập nhật.');
    }




    // Xóa bài viết
    public function destroy($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $baiViet->delete();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được xóa!');
    }
}
