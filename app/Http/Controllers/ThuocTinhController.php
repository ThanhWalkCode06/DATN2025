<?php

namespace App\Http\Controllers;

use App\Models\BienThe;
use App\Models\ThuocTinh;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreThuocTinhRequest;
use App\Http\Requests\UpdateThuocTinhRequest;

class ThuocTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listThuocTinh = DB::table('thuoc_tinhs')
    ->leftJoin('gia_tri_thuoc_tinhs', function ($join) {
        $join->on('thuoc_tinhs.id', '=', 'gia_tri_thuoc_tinhs.thuoc_tinh_id')
             ->whereNull('gia_tri_thuoc_tinhs.deleted_at'); // Lọc giá trị chưa bị xóa mềm
    })
    ->whereNull('thuoc_tinhs.deleted_at') // Chỉ lấy thuộc tính chưa bị xóa mềm
    ->select(
        'thuoc_tinhs.id',
        'thuoc_tinhs.ten_thuoc_tinh',
        DB::raw("IFNULL(GROUP_CONCAT(DISTINCT gia_tri_thuoc_tinhs.gia_tri SEPARATOR ', '), 'Không có giá trị') as danh_sach_gia_tri")
    )
    ->groupBy('thuoc_tinhs.id', 'thuoc_tinhs.ten_thuoc_tinh')
    ->orderByDesc('thuoc_tinhs.id')
    ->paginate(5);




        return view('admins.thuoctinhs.index', compact('listThuocTinh'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.thuoctinhs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThuocTinhRequest $request)
    {


        try {
            DB::beginTransaction();

            // Kiểm tra nếu thuộc tính bị xóa mềm -> khôi phục
            $thuocTinh = DB::table('thuoc_tinhs')
                ->where('ten_thuoc_tinh', $request->input('ten_thuoc_tinh'))
                ->whereNotNull('deleted_at')
                ->first();

            if ($thuocTinh) {
                DB::table('thuoc_tinhs')
                    ->where('id', $thuocTinh->id)
                    ->update(['deleted_at' => null, 'updated_at' => now()]);
                $thuocTinhId = $thuocTinh->id;
            } else {
                // Kiểm tra trùng lặp trước khi thêm mới
                $exists = DB::table('thuoc_tinhs')
                    ->where('ten_thuoc_tinh', $request->input('ten_thuoc_tinh'))
                    ->exists();

                if ($exists) {
                    return redirect()->back()->withErrors(['ten_thuoc_tinh' => 'Tên thuộc tính đã tồn tại.'])->withInput();
                }

                // Tạo mới thuộc tính
                $thuocTinhId = DB::table('thuoc_tinhs')->insertGetId([
                    'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Xử lý giá trị thuộc tính
            if ($request->has('gia_tri')) {
                $giaTriThuocTinhs = [];
                foreach ($request->input('gia_tri') as $giaTri) {
                    if (!empty($giaTri)) {
                        $existingGiaTri = DB::table('gia_tri_thuoc_tinhs')
                            ->where('thuoc_tinh_id', $thuocTinhId)
                            ->where('gia_tri', $giaTri)
                            ->first();

                        if ($existingGiaTri) {
                            if ($existingGiaTri->deleted_at !== null) {
                                DB::table('gia_tri_thuoc_tinhs')
                                    ->where('id', $existingGiaTri->id)
                                    ->update(['deleted_at' => null, 'updated_at' => now()]);
                            }
                        } else {
                            $giaTriThuocTinhs[] = [
                                'thuoc_tinh_id' => $thuocTinhId,
                                'gia_tri' => $giaTri,
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                        }
                    }
                }

                if (!empty($giaTriThuocTinhs)) {
                    DB::table('gia_tri_thuoc_tinhs')->insert($giaTriThuocTinhs);
                }
            }

            DB::commit();
            return redirect()->route('thuoctinhs.index')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ThuocTinh $thuocTinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $thuocTinh = DB::table('thuoc_tinhs')->find($id);

        // Chỉ lấy giá trị thuộc tính chưa bị xóa mềm (deleted_at IS NULL)
        $giaTriThuocTinhs = DB::table('gia_tri_thuoc_tinhs')
            ->where('thuoc_tinh_id', $id)
            ->whereNull('deleted_at') // Lọc bỏ giá trị đã bị xóa mềm
            ->get();

        return view('admins.thuoctinhs.edit', compact('thuocTinh', 'giaTriThuocTinhs'));
    }


    /**
     * Cập nhật thuộc tính và giá trị thuộc tính
     */


    public function update(UpdateThuocTinhRequest $request, $id)
    {
        $thuocTinh = ThuocTinh::find($id);
        if (!$thuocTinh) {
            return redirect()->route('thuoctinhs.index')->with('error', 'Thuộc tính không tồn tại');
        }

        // Cập nhật tên thuộc tính
        $thuocTinh->update([
            'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
            'updated_at' => now()
        ]);

        // Lấy danh sách giá trị cũ (bao gồm cả giá trị đã xóa mềm)
        $giaTriCu = GiaTriThuocTinh::withTrashed()
            ->where('thuoc_tinh_id', $id)
            ->get()
            ->keyBy(fn($item) => trim($item->gia_tri));

        // Danh sách giá trị mới từ request
        $giaTriMoi = array_map(fn($value) => trim($value), $request->gia_tri ?? []);

        // Kiểm tra trùng lặp
        if (count($giaTriMoi) !== count(array_unique($giaTriMoi))) {
            return redirect()->back()->with('error', 'Không được nhập giá trị trùng lặp.');
        }

        foreach ($giaTriMoi as $giaTri) {
            if (!empty($giaTri)) {
                if (isset($giaTriCu[$giaTri])) {
                    // Nếu giá trị cũ đã bị xóa mềm, khôi phục nó
                    if ($giaTriCu[$giaTri]->deleted_at !== null) {
                        $giaTriCu[$giaTri]->restore();
                    }
                } else {
                    // Kiểm tra giá trị đã tồn tại trong DB
                    $checkTonTai = GiaTriThuocTinh::where('thuoc_tinh_id', $id)
                        ->whereRaw('TRIM(gia_tri) = ?', [$giaTri])
                        ->whereNull('deleted_at')
                        ->exists();

                    if ($checkTonTai) {
                        return redirect()->back()->with('error', "Giá trị thuộc tính '$giaTri' đã tồn tại.");
                    }

                    // Thêm giá trị mới
                    GiaTriThuocTinh::create([
                        'thuoc_tinh_id' => $id,
                        'gia_tri' => $giaTri,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        // Xác định các giá trị cần xóa mềm
        $giaTriDeXoa = GiaTriThuocTinh::where('thuoc_tinh_id', $id)
            ->whereNotIn(DB::raw('TRIM(gia_tri)'), $giaTriMoi)
            ->pluck('id');

        // Kiểm tra nếu có giá trị đang sử dụng
        $giaTriDangSuDung = DB::table('bien_the_thuoc_tinhs')
            ->whereIn('gia_tri_thuoc_tinh_id', $giaTriDeXoa)
            ->pluck('gia_tri_thuoc_tinh_id')
            ->toArray();

        if (!empty($giaTriDangSuDung)) {
            return redirect()->route('thuoctinhs.edit', ['thuoctinh' => $id])
                ->with('error', 'Không thể xóa các giá trị đang được sử dụng.');
        }

        // Xóa mềm các giá trị không còn sử dụng
        GiaTriThuocTinh::whereIn('id', $giaTriDeXoa)->delete();

        return redirect()->route('thuoctinhs.index')->with('success', 'Cập nhật thành công');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $thuocTinh = ThuocTinh::find($id);

        if (!$thuocTinh) {
            return redirect()->route('thuoctinhs.index')->with('error', 'Thuộc tính không tồn tại');
        }

        // Kiểm tra xem thuộc tính có giá trị nào không
        $giaTriThuocTinhIds = GiaTriThuocTinh::where('thuoc_tinh_id', $id)->pluck('id');

        // Kiểm tra xem giá trị thuộc tính có liên kết với bảng trung gian không
        $giaTriDangSuDung = DB::table('bien_the_thuoc_tinhs')
            ->whereIn('gia_tri_thuoc_tinh_id', $giaTriThuocTinhIds)
            ->exists();

        if ($giaTriDangSuDung) {
            return redirect()->route('thuoctinhs.index')->with('error', 'Thuộc tính này đang được sử dụng và không thể xóa.');
        }

        // Xóa mềm các giá trị thuộc tính
        GiaTriThuocTinh::whereIn('id', $giaTriThuocTinhIds)->delete();

        // Xóa mềm thuộc tính
        $thuocTinh->delete();

        return redirect()->route('thuoctinhs.index')->with('success', 'Xoá thành công');
    }
}
