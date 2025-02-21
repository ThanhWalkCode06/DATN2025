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
        return view('admins.danhmucbaiviets.index');
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
        //
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
    public function edit(DanhMucBaiViet $danhMucBaiViet)
    {
        return view('admins.danhmucbaiviets.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DanhMucBaiViet $danhMucBaiViet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhMucBaiViet $danhMucBaiViet)
    {
        //
    }
}
