<?php

namespace App\Http\Controllers;

use App\Models\DanhMucBaiViet;
use Illuminate\Http\Request;

class DanhMucBaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = DanhMucBaiViet::query(); // Tạo query builder

    // Nếu có từ khóa tìm kiếm
    if ($request->has('search') && $request->search != '') {
        $query->where('ten_danh_muc', 'like', '%' . $request->search . '%');
    }

    $danhMucBaiViets = $query->latest()->paginate(10)->appends(['search' => $request->search]); // Giữ từ khóa khi phân trang

    return view('admins.danhmucbaiviets.index', compact('danhMucBaiViets'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.danhmucbaiviets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'ten_danh_muc' => 'required|string|max:255|unique:danh_muc_bai_viets,ten_danh_muc',
        'mo_ta' => 'required|string',
    ], [
        'ten_danh_muc.required' => 'Tên danh mục là bắt buộc.',
        'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại. Vui lòng nhập tên khác.',
        'mo_ta.required' => 'Mô tả không được để trống.',
    ]);

    DanhMucBaiViet::create([
        'ten_danh_muc' => $request->ten_danh_muc,
        'mo_ta' => $request->mo_ta,
    ]);

    return redirect()->route('danhmucbaiviets.index')->with('success', 'Danh mục đã được tạo.');
}

    /**
     * Display the specified resource.
     */
    public function show(DanhMucBaiViet $danhMucBaiViet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $danhMucBaiViet = DanhMucBaiViet::FindorFail($id);
        return view('admins.danhmucbaiviets.edit', compact('danhMucBaiViet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'ten_danh_muc' => 'required|string|max:255|unique:danh_muc_bai_viets,ten_danh_muc,' . $id,
        'mo_ta' => 'required|string',
    ], [
        'ten_danh_muc.required' => 'Tên danh mục là bắt buộc.',
        'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại, vui lòng chọn tên khác.',
        'mo_ta.required' => 'Mô tả không được để trống.',
    ]);

    $danhMucBaiViet = DanhMucBaiViet::findOrFail($id);
    $danhMucBaiViet->update([
        'ten_danh_muc' => $request->ten_danh_muc,
        'mo_ta' => $request->mo_ta,
    ]);

    return redirect()->route('danhmucbaiviets.index')->with('success', 'Danh mục đã được cập nhật.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $danhMucBaiViet = DanhMucBaiViet::findOrFail($id);

    // Kiểm tra nếu danh mục có bài viết nào không
    if ($danhMucBaiViet->baiViets()->count() > 0) {
        return redirect()->route('danhmucbaiviets.index')->with('error', 'Không thể xóa danh mục này vì vẫn còn bài viết.');
    }

    $danhMucBaiViet->delete();
    return redirect()->route('danhmucbaiviets.index')->with('success', 'Danh mục đã được xóa.');
}

}
