<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Http\Requests\StoreBaiVietRequest;
use App\Http\Requests\UpdateBaiVietRequest;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baiViets = BaiViet::latest()->paginate(10);
        return view('admins.baiviets.index', compact('baiViets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.baiviets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBaiVietRequest $request)
    {
        BaiViet::create($request->validated());
        return redirect()->route('baiviets.index')->with('success', 'Bài viết được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BaiViet $baiViet)
    {
        return view('baiviets.show', compact('baiViet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaiViet $baiViet)
    {
        return view('baiviets.edit', compact('baiViet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBaiVietRequest $request, BaiViet $baiViet)
    {
        $baiViet->update($request->validated());
        return redirect()->route('baiviets.index')->with('success', 'Bài viết được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaiViet $baiViet)
    {
        $baiViet->delete();
        return redirect()->route('baiviets.index')->with('success', 'Bài viết đã bị xóa.');
    }
}
