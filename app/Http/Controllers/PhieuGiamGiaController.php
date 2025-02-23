<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;

class PhieuGiamGiaController extends Controller
{
    /**
     * Hiển thị danh sách phiếu giảm giá.
     */
    public function index()
    {
        $phieuGiamGias = PhieuGiamGia::all();
        return view('admins.phieugiamgias.index', compact('phieuGiamGias'));
    }

    /**
     * Hiển thị form tạo mới phiếu giảm giá.
     */
    public function create()
    {
        return view('admins.phieugiamgias.create');
    }

    /**
     * Lưu phiếu giảm giá vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_phieu' => 'required|unique:phieu_giam_gias|max:255',
            'ten_phieu' => 'required',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'gia_tri' => 'required|numeric|min:0',
        ]);

        PhieuGiamGia::create($request->all());

        return redirect()->route('phieugiamgias.index')->with('success', 'Thêm phiếu giảm giá thành công!');
    }

    /**
     * Hiển thị chi tiết phiếu giảm giá.
     */
    public function show(PhieuGiamGia $phieuGiamGia)
    {
        return view('admins.phieugiamgias.show', compact('phieuGiamGia'));
    }

    /**
     * Hiển thị form chỉnh sửa phiếu giảm giá.
     */
    public function edit($id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);
        return view('admins.phieugiamgias.edit', compact('phieuGiamGia'));
    }


    /**
     * Cập nhật phiếu giảm giá.
     */
    public function update(Request $request, $id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'ten_phieu' => 'required|string|max:255',
            'ma_phieu' => 'required|string|max:50',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'gia_tri' => 'required|numeric|min:0',
        ]);

        // Cập nhật dữ liệu
        $phieuGiamGia->update([
            'ten_phieu' => $request->ten_phieu,
            'ma_phieu' => $request->ma_phieu,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'gia_tri' => $request->gia_tri,
        ]);

        return redirect()->route('phieugiamgias.index')->with('success', 'Cập nhật thành công');
    }


    /**
     * Xóa phiếu giảm giá.
     */
    public function destroy($id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);
        $phieuGiamGia->delete();

        return redirect()->route('phieugiamgias.index')->with('success', 'Xóa thành công!');
    }

}
