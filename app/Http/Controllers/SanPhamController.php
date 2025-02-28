<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;

class SanPhamController extends Controller
{

    public function index(Request $request)
    {
        $sanPhams = SanPham::with(['danhMuc'])
            ->search($request->input('search'))
            // ->orderBy('created_at', 'desc') 
            ->latest()
            ->paginate(10);

        $danhMucs = DanhMucSanPham::all();

        return view('admins.sanphams.index', compact('sanPhams', 'danhMucs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMucs = DanhMucSanPham::all();
        return view('admins.sanphams.create', compact('danhMucs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $filePath = $file->storeAs('uploads/sanphams', $fileName, 'public');

            $hinhAnhPath = $filePath;
        } else {
            $hinhAnhPath = null;
        }

        SanPham::create([
            'ten_san_pham' => $request->ten_san_pham,
            'ma_san_pham' => $request->ma_san_pham,
            'khuyen_mai' => $request->khuyen_mai,
            'hinh_anh' => $hinhAnhPath,
            'mo_ta' => $request->mo_ta,
            'danh_muc_id' => $request->danh_muc_id,
            'trang_thai' => $request->trang_thai,
        ]);

        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sanPham = SanPham::findOrFail($id);
        return view('admins.sanphams.show', compact('sanPham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sanpham = SanPham::findOrFail($id);
        $danhMucs = DanhMucSanPham::all();
        return view('admins.sanphams.edit', compact('sanpham', 'danhMucs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, $id)
    {
        $sanPham = SanPham::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $filePath = $file->storeAs('uploads/sanphams', $fileName, 'public');

            $data['hinh_anh'] = $filePath;
        }
        $sanPham->update($data);

        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sanpham = SanPham::findOrFail($id);

        if ($sanpham->hinh_anh && file_exists(public_path('uploads/' . $sanpham->hinh_anh))) {
            unlink(public_path('uploads/' . $sanpham->hinh_anh));
        }

        $sanpham->delete();

        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
