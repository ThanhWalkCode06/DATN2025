<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Http\Requests\StoreDanhMucSanPhamRequest;
use App\Http\Requests\UpdateDanhMucSanPhamRequest;

class DanhMucSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.danhmucs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.danhmucs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDanhMucSanPhamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhMucSanPham $danhMuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhMucSanPham $danhMuc)
    {
        return view('admins.danhmucs.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDanhMucSanPhamRequest $request, DanhMucSanPham $danhMuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhMucSanPham $danhMuc)
    {
        //
    }
}
