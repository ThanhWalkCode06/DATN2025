<?php

namespace App\Http\Controllers;

use App\Models\BienThe;
use App\Models\SanPham;
use App\Models\ThuocTinh;
use App\Models\AnhSanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;

class SanPhamController extends Controller
{

    public function index(Request $request)
    {
        $sanPhams = SanPham::with(['danhMuc'])
            ->search($request->input('search'))
            ->orderBy('created_at', 'desc')
            ->latest()
            ->paginate(10);
        // $bienThe = BienThe::where('san_pham_id', 55)
        // ->groupBy('ten_bien_the')
        // ->get();
        // dd($bienThe);

        $danhMucs = DanhMucSanPham::all();

        return view('admins.sanphams.index', compact('sanPhams', 'danhMucs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMucs = DanhMucSanPham::all();
        $thuocTinhs = ThuocTinh::with('giaTriThuocTinh')->get();
        // foreach($thuocTinhs as $tt){
        //     foreach($tt->giaTriThuocTinh as $item){
        //         dd($item->gia_tri);
        //     }
        // }

        return view('admins.sanphams.create', compact('danhMucs', 'thuocTinhs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
        // Xử lý upload hình ảnh
        // dd($request->all());
        $thuocTinhId = array_keys($request->input('attribute_values', []));

        // dd($thuocTInhId);
        $hinhAnhPath = null;
        $arrayAlbum = explode(",",$request->album_anh);


        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $hinhAnhPath = $file->storeAs('uploads/sanphams', $fileName, 'public');

            // Xóa ảnh cũ trong session nếu có
            if (session('temp_image')) {
                $oldImage = storage_path('app/public/' . session('temp_image'));
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
                session()->forget('temp_image');
            }

            // Lưu đường dẫn ảnh vào session
            // session(['temp_image' => $hinhAnhPath]);
        } elseif (session('temp_image')) {
            $hinhAnhPath = session('temp_image');
            session()->forget('temp_image');
        }

        // Tạo sản phẩm
        if($hinhAnhPath){
            $sanPham = SanPham::create([
                'ten_san_pham' => $request->ten_san_pham,
                'ma_san_pham' => $request->ma_san_pham,
                'gia_cu' => $request->gia_cu,
                'gia_moi' => $request->gia_moi,
                'hinh_anh' => $hinhAnhPath,
                'mo_ta' => $request->mo_ta,
                'danh_muc_id' => $request->danh_muc_id,
                'trang_thai' => $request->trang_thai,
            ]);
        }else{
            $sanPham = SanPham::create([
                'ten_san_pham' => $request->ten_san_pham,
                'ma_san_pham' => $request->ma_san_pham,
                'gia_cu' => $request->gia_cu,
                'gia_moi' => $request->gia_moi,
                'mo_ta' => $request->mo_ta,
                'danh_muc_id' => $request->danh_muc_id,
                'trang_thai' => $request->trang_thai,
            ]);
        }
        foreach($arrayAlbum as $item => $img){
            AnhSanPham::create([
                'san_pham_id' => $sanPham->id,
                'link_anh_san_pham' => $img,
            ]);
        }
        $selected_values = is_array($request->selected_values) ? $request->selected_values : json_decode($request->selected_values, true) ?? [];

        if ($request->has('attribute_values')) {
            if(empty($selected_values)){
                $hinhAnhBienThe = null;
                if ($request->hasFile('anh_bien_the')) {
                    $files = $request->file('anh_bien_the');
                    if (isset($files) && $files->isValid()) {
                        $file = $files;
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/sanphams/'), $fileName);
                        $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                    }
                }

                // Lặp qua từng thuộc tính của biến thể
                // dd($request->all());
                foreach ($request->attribute_values as $thuocTinhId => $giaTriArray) {
                    foreach ($giaTriArray as $giaTri) {
                        $index = 0;
                        // dd($request->all());
                        $giaTriTT = GiaTriThuocTinh::query()
                            ->where('gia_tri', $giaTri)
                            ->where('thuoc_tinh_id', $thuocTinhId) // Chắc chắn đúng thuộc tính
                            ->first();

                        if ($giaTriTT) {

                            $bienTheData = [
                                'san_pham_id' => $sanPham->id,
                                'ten_bien_the' => $giaTriArray[$index],
                                'gia_nhap' => $request->gia_nhap[$index],
                                'gia_ban' => $request->gia_ban[$index],
                                'so_luong' => $request->so_luong[$index],
                                'thuoc_tinh_id' => $thuocTinhId,
                                'gia_tri_thuoc_tinh_id' => $giaTriTT->id,
                            ];

                            if ($hinhAnhBienThe) {
                                $bienTheData['anh_bien_the'] = $hinhAnhBienThe;
                            }

                            BienThe::create($bienTheData);
                            $index++;
                        }
                    }
                }
            }else{
            foreach ($request->selected_values as $key => $tenBienThe) {
                $hinhAnhBienThe = null;

                // Xử lý upload ảnh
                if ($request->hasFile('anh_bien_the')) {
                    $files = $request->file('anh_bien_the');
                    if (isset($files[$key]) && $files[$key]->isValid()) {
                        $file = $files[$key];
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/sanphams/'), $fileName);
                        $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                    }
                }

                // Lặp qua từng thuộc tính của biến thể
                foreach ($request->attribute_values as $thuocTinhId => $giaTriArray) {
                    foreach ($giaTriArray as $giaTri) {
                        // Lấy ID giá trị thuộc tính từ DB
                        $giaTriTT = GiaTriThuocTinh::query()
                            ->where('gia_tri', $giaTri)
                            ->where('thuoc_tinh_id', $thuocTinhId) // Chắc chắn đúng thuộc tính
                            ->first();

                        if ($giaTriTT) {
                            // Tạo bản ghi cho từng thuộc tính
                            $bienTheData = [
                                'san_pham_id' => $sanPham->id,
                                'ten_bien_the' => $tenBienThe,
                                'gia_nhap' => $request->gia_nhap[$key],
                                'gia_ban' => $request->gia_ban[$key],
                                'so_luong' => $request->so_luong[$key],
                                'thuoc_tinh_id' => $thuocTinhId,
                                'gia_tri_thuoc_tinh_id' => $giaTriTT->id,
                            ];

                            if ($hinhAnhBienThe) {
                                $bienTheData['anh_bien_the'] = $hinhAnhBienThe;
                            }

                            BienThe::create($bienTheData);

                        }
                    }
                }
            }
            }
        }

        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sanPham = DB::table('bien_thes')
        ->where('san_pham_id', 76)
        ->select('color', 'size')
        ->distinct()
        ->get();
        // dd($sanPham);
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
