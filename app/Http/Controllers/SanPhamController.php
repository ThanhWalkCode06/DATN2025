<?php

namespace App\Http\Controllers;


use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ThuocTinh;
use App\Models\AnhSanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Carbon;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Http\Controllers\HelperCommon\Helper;
use App\Models\ChiTietGioHang;
use App\Models\GioHang;

class SanPhamController extends Controller
{

    public function index(Request $request)
    {
        $sanPhams = SanPham::with('danhMuc')
            ->with(['bienThes' => function ($query) {
                $query->select('id', 'san_pham_id', 'ten_bien_the', 'anh_bien_the', 'gia_nhap', 'gia_ban', 'so_luong')
                    ->whereRaw('id IN (SELECT MAX(id) FROM bien_thes GROUP BY san_pham_id, ten_bien_the)'); // Lấy biến thể mới nhất theo `ten_bien_the`
            }])
            ->search($request->input('search'))
            ->orderBy('created_at', 'desc')
            ->latest()
            ->paginate(10);


        // $bienThes = BienThe::select('san_pham_id','ten_bien_the')->where('san_pham_id',52)->distinct()->get();

        // $danhMucs = DanhMucSanPham::all();

        return view('admins.sanphams.index', compact('sanPhams'));
    }

    public function sanPhamTopDanhGia()
    {
        $sanPhams = SanPham::select('san_phams.*')
            ->join('danh_gias', 'san_phams.id', '=', 'danh_gias.san_pham_id')
            ->selectRaw('AVG(danh_gias.so_sao) as avg_rating')
            ->groupBy('san_phams.id')
            ->orderByDesc('avg_rating')
            ->limit(4)
            ->get();

        return view('clients.index', compact('sanPhams'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMucs = DanhMucSanPham::all();
        $thuocTinhs = ThuocTinh::with('giaTriThuocTinhs')->get();
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
        // dd($request->selected_values,$request->all());
        $thuocTinhId = array_keys($request->input('attribute_values', []));

        $hinhAnhPath = null;

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
        } else if (session('temp_image')) {
            $hinhAnhPath = session('temp_image');
            session()->forget('temp_image');
        }

        $data = [
            'ten_san_pham' => $request->ten_san_pham,
            'ma_san_pham' => $request->ma_san_pham,
            'gia_cu' => $request->gia_cu,
            'gia_moi' => $request->gia_moi,
            'mo_ta' => $request->mo_ta,
            'danh_muc_id' => $request->danh_muc_id,
            'trang_thai' => $request->trang_thai,
        ];
        // Tạo sản phẩm
        if ($hinhAnhPath) {
            $data['hinh_anh'] = $hinhAnhPath;
        }

        $sanPham = SanPham::create($data);
        Helper::uploadAlbum($sanPham->id, $token = false,'hihi');

        // Xóa session sau khi lưu
        session()->forget('uploaded_files');

        $selected_values = is_array($request->selected_values) ? $request->selected_values : json_decode($request->selected_values, true) ?? [];

        if ($request->has('attribute_values')) {
            if (empty($selected_values)) {
                $hinhAnhBienThe = null;
                if ($request->hasFile('anh_bien_the')) {
                    $files = $request->file('anh_bien_the');
                    if (isset($files) && $files->isValid()) {
                        $file = $files;
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs("public/uploads/sanphams/", $fileName);
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
            } else {

                foreach ($request->selected_values as $key => $tenBienThe) {
                    $hinhAnhBienThe = null;

                    // Xử lý upload ảnh
                    if ($request->hasFile('anh_bien_the')) {
                        $files = $request->file('anh_bien_the');
                        if (isset($files[$key]) && $files[$key]->isValid()) {
                            $file = $files[$key];
                            $fileName = time() . '_' . $file->getClientOriginalName();
                            $file->storeAs("public/uploads/sanphams/", $fileName);
                            $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                        }
                    }

                    // Tạo biến thể
                    $bienThe = BienThe::create([
                        'san_pham_id' => $sanPham->id,
                        'ten_bien_the' => $tenBienThe,
                        'gia_nhap' => $request->gia_nhap[$key],
                        'gia_ban' => $request->gia_ban[$key],
                        'so_luong' => $request->so_luong[$key],
                    ]);

                    if ($hinhAnhBienThe) {
                        $bienThe->anh_bien_the = $hinhAnhBienThe;
                    }
                    $bienThe->save();

                    // Lưu từng thuộc tính của biến thể vào bảng trung gian
                    // dd($request->attribute_values);
                    foreach ($request->attribute_values as $thuocTinhId => $giaTriArray) {
                        foreach ($giaTriArray as $giaTri) {
                            if (strpos($tenBienThe, $giaTri) !== false) {
                                $giaTriTT = GiaTriThuocTinh::where('gia_tri', $giaTri)
                                    ->where('thuoc_tinh_id', $thuocTinhId)
                                    ->first();

                                if ($giaTriTT) {
                                    DB::table('bien_the_thuoc_tinhs')->insert([
                                        'bien_the_id' => $bienThe->id,
                                        'thuoc_tinh_id' => $thuocTinhId,
                                        'gia_tri_thuoc_tinh_id' => $giaTriTT->id,
                                    ]);
                                }
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
        $sanPham = SanPham::with(['danhMuc', 'bienThes'])->findOrFail($id);

        return view('admins.sanphams.show', compact('sanPham'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $sanpham = SanPham::with('bienThes', 'anhSP')->findOrFail($id);
        $checkedTT = [];
        foreach ($sanpham->bienThes->unique('ten_bien_the') as $ten) {
            $checkedTT[] = array_unique(explode(' - ', $ten->ten_bien_the));
        }
        // foreach($sanpham->bienThe){

        // }
        // dd($sanpham->bienThes);
        $album = AnhSanPham::where('san_pham_id', $id)->get();
        $thuocTinhs = ThuocTinh::with('giaTriThuocTinhs')->get();
        $danhMucs = DanhMucSanPham::all();
        return view('admins.sanphams.edit', compact('sanpham', 'danhMucs', 'thuocTinhs', 'album', 'checkedTT'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, $id)
    {
        $sanPham = SanPham::findOrFail($id);
        $bienThes = BienThe::where('san_pham_id', $sanPham->id)->get();
        // dd(request()->all(),$bienThes);

        // foreach($bienThes as $item){
        //     dd($item->anh_bien_the);
        // }
        // dd(1);
        $thuocTinhId = array_keys($request->input('attribute_values', []));
        $hinhAnhPath = null;

        if ($request->hasFile('hinh_anh')) {
            if ($sanPham->hinh_anh && Storage::exists('public', $sanPham->hinh_anh) && !Storage::exists('public/images')) {
                Storage::delete('public/' . $sanPham->hinh_anh);
            }
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $hinhAnhPath = $file->storeAs('uploads/sanphams', $fileName, 'public');
        }
        $data = [
            'ten_san_pham' => $request->ten_san_pham,
            'ma_san_pham' => $request->ma_san_pham,
            'gia_cu' => $request->gia_cu,
            'gia_moi' => $request->gia_moi,
            'mo_ta' => $request->mo_ta,
            'danh_muc_id' => $request->danh_muc_id,
            'trang_thai' => $request->trang_thai,
        ];
        $data['hinh_anh'] = $hinhAnhPath ?? $sanPham->hinh_anh;


        $sanPham->update($data);
        Helper::uploadAlbum($sanPham->id, $token = true,json_decode($request->input('deleted_images'), true));

        $selected_values = is_array($request->selected_values) ? $request->selected_values : json_decode($request->selected_values, true) ?? [];
        // dd($selected_values);
        if ($request->has('attribute_values')) {

            if (empty($selected_values)) {
                if ($request->hasFile('anh_bien_the')) {
                    $files = $request->file('anh_bien_the');
                    if (isset($files) && $files->isValid()) {
                        $fileName = time() . '_' . $files->getClientOriginalName();
                        $files->storeAs("public/uploads/sanphams/", $fileName);
                        $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                    }
                }

                foreach ($request->attribute_values as $thuocTinhId => $giaTriArray) {
                    $index = 0;
                    foreach ($giaTriArray as $giaTri) {
                        $giaTriTT = GiaTriThuocTinh::where('gia_tri', $giaTri)
                            ->where('thuoc_tinh_id', $thuocTinhId)
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
                                'anh_bien_the' => $hinhAnhBienThe ?? null,
                            ];

                            BienThe::updateOrCreate($bienTheData);
                            $index++;
                        }
                    }
                }
            } else {
                $bienTheIdsMoi = []; // Danh sách ID biến thể mới

                foreach ($request->selected_values as $key => $tenBienThe) {
                    $hinhAnhBienThe = null;
                    if ($request->hasFile('anh_bien_the')) {
                        $files = $request->file('anh_bien_the');
                        if (isset($files[$key]) && $files[$key]->isValid()) {
                            $fileName = time() . '_' . $files[$key]->getClientOriginalName();
                            $files[$key]->storeAs("public/uploads/sanphams/", $fileName);
                            $hinhAnhBienThe = 'uploads/sanphams/' . $fileName;
                        }
                    }

                    // Tạo hoặc cập nhật biến thể
                    $bienThe = BienThe::updateOrCreate(
                        [
                            'san_pham_id' => $sanPham->id,
                            'ten_bien_the' => $tenBienThe,
                        ],
                        [
                            'gia_nhap' => $request->gia_nhap[$key] ?? 0,
                            'gia_ban' => $request->gia_ban[$key] ?? 0,
                            'so_luong' => $request->so_luong[$key] ?? 0,
                        ]
                    );

                    if ($hinhAnhBienThe) {
                        $bienThe->anh_bien_the = $hinhAnhBienThe;
                        $bienThe->save();
                    }

                    // Lưu lại ID biến thể mới
                    $bienTheIdsMoi[] = $bienThe->id;

                    // Cập nhật bảng trung gian
                    DB::table('bien_the_thuoc_tinhs')->where('bien_the_id', $bienThe->id)->delete();
                    // dd($request->attribute_values);
                    foreach ($request->attribute_values as $thuocTinhId => $giaTriArray) {
                        foreach ($giaTriArray as $giaTri) {
                            if (strpos($tenBienThe, $giaTri) !== false) {
                                $giaTriTT = GiaTriThuocTinh::where('gia_tri', $giaTri)
                                    ->where('thuoc_tinh_id', $thuocTinhId)
                                    ->first();

                                if ($giaTriTT) {
                                    DB::table('bien_the_thuoc_tinhs')->insert([
                                        'bien_the_id' => $bienThe->id,
                                        'thuoc_tinh_id' => $thuocTinhId,
                                        'gia_tri_thuoc_tinh_id' => $giaTriTT->id,
                                    ]);
                                }
                            }
                        }
                    }
                }

                $hasCart = ChiTietGioHang::whereIn('bien_the_id', $bienTheIdsMoi)->exists();
                $hasOrder = ChiTietDonHang::whereIn('bien_the_id', $bienTheIdsMoi)->exists();

                if ($hasOrder) {
                    return redirect()->back()->with('error', 'Sản phẩm không thể xóa do đã có đơn hàng!');
                }

                if ($hasCart) {
                    return redirect()->back()->with('error', 'Sản phẩm không thể xóa do đã có trong giỏ hàng!');
                }

                // Xóa các biến thể không có trong danh sách mới
                BienThe::where('san_pham_id', $sanPham->id)
                    ->whereNotIn('id', $bienTheIdsMoi)
                    ->delete();
            }
        } else {
            $bienTheIds = $bienThes->pluck('id')->toArray(); // Lấy danh sách ID hợp lệ

            $donhangChiTiet = ChiTietDonHang::whereIn('bien_the_id', $bienTheIds)->exists();

            if (!$donhangChiTiet) { // Nếu không có đơn hàng nào chứa biến thể
                $bienThes->each->delete(); // Xóa tất cả biến thể
            }
        }


        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sanpham = SanPham::with('bienThes')->find($id);
        $hasCart = ChiTietGioHang::whereIn('bien_the_id', $sanpham->bienThes->pluck('id'))->exists();
        $hasOrder = ChiTietDonHang::whereIn('bien_the_id', $sanpham->bienThes->pluck('id'))->exists();

        if ($hasOrder) {
            return redirect()->back()->with('error', 'Sản phẩm không thể xóa do đã có đơn hàng!');
        }

        if ($hasCart) {
            return redirect()->back()->with('error', 'Sản phẩm không thể xóa do đã có trong giỏ hàng!');
        }

        if ($sanpham->hinh_anh && file_exists(public_path('uploads/' . $sanpham->hinh_anh))) {
            unlink(public_path('uploads/' . $sanpham->hinh_anh));
        }
        $sanpham->delete();
        $sanpham
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
