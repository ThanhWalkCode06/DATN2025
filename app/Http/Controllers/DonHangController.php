<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Http\Requests\StoreDonHangRequest;
use App\Http\Requests\UpdateDonHangRequest;
use App\Models\ChiTietDonHang;

class DonHangController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = DonHang::select('don_hangs.*', 'users.name', 'phuong_thuc_thanh_toans.ten_phuong_thuc')
            ->join('users', 'users.id', '=', 'user_id')
            ->join('phuong_thuc_thanh_toans', 'phuong_thuc_thanh_toans.id', '=', 'phuong_thuc_thanh_toan_id')
            ->get();
        // dd($donHangs);
        return view('admins.donhangs.index', compact('donHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonHangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DonHang $donhang)
    {
        $donHang = DonHang::select('don_hangs.*', 'users.name', 'phuong_thuc_thanh_toans.ten_phuong_thuc')
            ->join('users', 'users.id', '=', 'user_id')
            ->join('phuong_thuc_thanh_toans', 'phuong_thuc_thanh_toans.id', '=', 'phuong_thuc_thanh_toan_id')
            ->find($donhang->id);

        $chiTietDonHangs = ChiTietDonHang::select('chi_tiet_don_hangs.*', 'bien_thes.ten_bien_the', 'bien_thes.anh_bien_the', 'bien_thes.gia_ban')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->where('don_hang_id', '=', $donhang->id)
            ->get();
        // dd($chiTietDonHangs);
        return view('admins.donhangs.show', compact('donHang', 'chiTietDonHangs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang $donhang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonHangRequest $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        //
    }
}
