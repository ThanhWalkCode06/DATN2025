<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMucSanPham;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;

class SanPhamController extends Controller
{
    /**  
     * Display a listing of the resource.  
     */
    public function index()
    {
        $sanPhams = SanPham::with(['danhMuc'])->get();

        // Lấy tất cả danh mục để đưa vào view  
        $danhMucs = DanhMucSanPham::all();
        return view('admins.sanphams.index', compact('sanPhams', 'danhMucs'));
    }

    /**  
     * Show the form for creating a new resource.  
     */
    public function create()
    {
        $danhMucs = DanhMucSanPham::all(); // Lấy tất cả danh mục  
        return view('admins.sanphams.create', compact('danhMucs'));
    }

    /**  
     * Store a newly created resource in storage.  
     */
    public function store(StoreSanPhamRequest $request)
{
    // Kiểm tra xem file có được tải lên không
    if ($request->hasFile('hinh_anh')) {
        $file = $request->file('hinh_anh');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Lưu file vào thư mục storage/app/public/uploads/sanphams
        $filePath = $file->storeAs('uploads/sanphams', $fileName, 'public');

        // Lưu đường dẫn tương đối vào cơ sở dữ liệu
        $hinhAnhPath = $filePath;
    } else {
        $hinhAnhPath = null;
    }

    // Tạo sản phẩm mới
    SanPham::create($request->validated() + [
        'hinh_anh' => $hinhAnhPath,
        'danh_muc_id' => $request->danh_muc_id,
    ]);

    return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được tạo thành công!');
}


    /**  
     * Display the specified resource.  
     */
    public function show(SanPham $sanPham)
    {
        return view('admins.sanphams.show', compact('sanPham'));
    }

    /**  
     * Show the form for editing the specified resource.  
     */
    public function edit(SanPham $sanPham)
    {
        return view('admins.sanphams.edit', compact('sanPham'));
    }

    /**  
     * Update the specified resource in storage.  
     */
    public function update(UpdateSanPhamRequest $request, SanPham $sanPham)
    {
        $sanPham->update($request->validated());
        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**  
     * Remove the specified resource from storage.  
     */
    public function destroy(SanPham $sanPham)
    {
        $sanPham->delete();
        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
