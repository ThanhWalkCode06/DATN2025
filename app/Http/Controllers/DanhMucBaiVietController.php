<?php

namespace App\Http\Controllers;

use App\Models\DanhMucBaiViet;
use Illuminate\Http\Request;

class DanhMucBaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhMucBaiViets = DanhMucBaiViet::latest()->paginate(10);
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
            'ten_danh_muc' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ]);

        DanhMucBaiViet::create($request->all());
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
            'ten_danh_muc' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ]);
        $danhMucBaiViet = DanhMucBaiViet::FindorFail($id);
        $danhMucBaiViet->update($request->all());
        return redirect()->route('danhmucbaiviets.index')->with('success', 'Danh mục đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhMucBaiViet = DanhMucBaiViet::FindorFail($id);
        $danhMucBaiViet->delete();
        return redirect()->route('danhmucbaiviets.index')->with('success', 'Danh mục đã được xóa.');
    }
}
