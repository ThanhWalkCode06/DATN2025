<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\Storage;

class DanhMucSanPhamController extends Controller
{
    public function index()
    {
        $danhMucs = DanhMucSanPham::orderBy('created_at', 'desc')->get();
        return view('admins.danhmucsanphams.index', compact('danhMucs'));
    }

    public function create()
    {
        return view('admins.danhmucsanphams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255|unique:danh_muc_san_phams,ten_danh_muc',
            'anh_danh_muc' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'mo_ta' => 'nullable|string',
        ], [
            'ten_danh_muc.required' => 'Tên danh mục không được để trống.',
            'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại.',
            'ten_danh_muc.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'anh_danh_muc.image' => 'File tải lên phải là hình ảnh.',
            'anh_danh_muc.mimes' => 'Ảnh danh mục chỉ chấp nhận định dạng: jpeg, png, jpg, gif.',
            'anh_danh_muc.max' => 'Ảnh danh mục không được vượt quá 2MB.',
        ]);

        $anhDanhMuc = null;
        if ($request->hasFile('anh_danh_muc')) {
            $anhDanhMuc = $request->file('anh_danh_muc')->store('uploads/danhmucsanphams', 'public');
        }

        DanhMucSanPham::create([
            'ten_danh_muc' => $request->ten_danh_muc,
            'anh_danh_muc' => $anhDanhMuc,
            // 'mo_ta' => $request->mo_ta,
        ]);

        return redirect()->route('danhmucsanphams.index')->with('success', 'Danh mục đã được thêm.');
    }


    public function show($id)
    {

        $danhMuc = DanhMucSanPham::findOrFail($id);
        return view('danhmucsanphams.show', compact('danhMuc'));
    }


    public function edit($id)
    {
        $danhMuc = DanhMucSanPham::findOrFail($id);
        return view('admins.danhmucsanphams.edit', compact('danhMuc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255|unique:danh_muc_san_phams,ten_danh_muc,' . $id,
            'anh_danh_muc' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'ten_danh_muc.required' => 'Tên danh mục không được để trống.',
            'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại.',
            'ten_danh_muc.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'anh_danh_muc.image' => 'File tải lên phải là hình ảnh.',
            'anh_danh_muc.mimes' => 'Ảnh danh mục chỉ chấp nhận định dạng: jpeg, png, jpg, gif.',
            'anh_danh_muc.max' => 'Ảnh danh mục không được vượt quá 2MB.',
        ]);

        $danhMuc = DanhMucSanPham::findOrFail($id);
        $danhMuc->ten_danh_muc = $request->ten_danh_muc;

        if ($request->hasFile('anh_danh_muc')) {
            // Xóa ảnh cũ nếu có
            if ($danhMuc->anh_danh_muc) {
                Storage::delete('public/' . $danhMuc->anh_danh_muc);
            }
            // Lưu ảnh mới
            $path = $request->file('anh_danh_muc')->store('uploads/danhmucsanphams', 'public');
            $danhMuc->anh_danh_muc = $path;
        }

        $danhMuc->save();

        return redirect()->route('danhmucsanphams.index')->with('success', 'Danh mục đã được cập nhật.');
    }


    public function destroy($id)
    {
        // Kiểm tra danh mục có tồn tại không
        $danhMuc = DanhMucSanPham::findOrFail($id);

        // Kiểm tra xem danh mục có sản phẩm nào không
        $soSanPham = SanPham::where('danh_muc_id', $id)->count();

        if ($soSanPham > 0) {
            return redirect()->route('danhmucsanphams.index')->with('error', 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này.');
        }

        // Xóa ảnh nếu có
        if ($danhMuc->anh_danh_muc) {
            Storage::disk('public')->delete($danhMuc->anh_danh_muc);
        }

        // Thực hiện xóa danh mục
        $danhMuc->delete();

        return redirect()->route('danhmucsanphams.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
