<?php

namespace App\Http\Controllers;

use App\Models\BienThe;
use App\Models\SanPham;
use App\Models\ThuocTinh;
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
        $thuocTinhs = ThuocTinh::with('giaTriThuocTinh')->get(); // Lấy cả giá trị thuộc tính
        return view('admins.sanphams.create', compact('danhMucs', 'thuocTinhs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
       
        // Xử lý upload hình ảnh
        $hinhAnhPath = null;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $hinhAnhPath = $file->storeAs('uploads/sanphams', $fileName, 'public');
        }

        // Tạo sản phẩm
        $sanPham = SanPham::create([
            'ten_san_pham' => $request->ten_san_pham,
            'ma_san_pham' => $request->ma_san_pham,
            'khuyen_mai' => $request->khuyen_mai,
            'hinh_anh' => $hinhAnhPath,
            'mo_ta' => $request->mo_ta,
            'danh_muc_id' => $request->danh_muc_id,
            'trang_thai' => $request->trang_thai,
        ]);

        if ($request->has('ten_bien_the')) {
            foreach ($request->ten_bien_the as $key => $tenBienThe) {
                $hinhAnhBienThe = null;
        
                // Kiểm tra file ảnh
                if ($request->hasFile('anh_bien_the')) {
                    $files = $request->file('anh_bien_the');
                
                    if (isset($files[$key]) && $files[$key]->isValid()) {
                        $file = $files[$key]; 
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        
                        // Chắc chắn lưu đúng thư mục 'uploads/bienthe/'
                        $file->move(public_path('uploads/sanphams/'), $fileName);
                
                        $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                    }
                }
                
             
                // Lưu biến thể vào database
                BienThe::create([
                    
                    'san_pham_id' => $sanPham->id,
                    'ten_bien_the' => $tenBienThe,
                    'gia_nhap' => $request->gia_nhap[$key],
                    'gia_ban' => $request->gia_ban[$key],
                    'so_luong' => $request->so_luong[$key],
                    'thuoc_tinh_id' => $request->thuoc_tinh_id[$key] ?? null,
                    'gia_tri_thuoc_tinh_id' => $request->gia_tri_thuoc_tinh[$key] ?? null,
                    'anh_bien_the' => $hinhAnhBienThe, // Lưu đường dẫn ảnh vào database
                ]);
            }
        }
        
        
        
        
       


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
