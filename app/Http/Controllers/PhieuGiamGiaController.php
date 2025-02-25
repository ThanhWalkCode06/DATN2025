<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use App\Http\Requests\StorePhieuGiamGiaRequest;
use App\Http\Requests\UpdatePhieuGiamGiaRequest;

class PhieuGiamGiaController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.phieugiamgias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.phieugiamgias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhieuGiamGiaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PhieuGiamGia $phieuGiamGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhieuGiamGia $phieuGiamGia)
    {
        return view('admins.phieugiamgias.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhieuGiamGiaRequest $request, PhieuGiamGia $phieuGiamGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhieuGiamGia $phieuGiamGia)
    {
        //
    }
}
