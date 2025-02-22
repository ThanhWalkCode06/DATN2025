<?php

namespace App\Http\Controllers;

use App\Models\ThuocTinh;
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
            ->leftJoin('gia_tri_thuoc_tinhs', 'thuoc_tinhs.id', '=', 'gia_tri_thuoc_tinhs.thuoc_tinh_id')
            ->select('thuoc_tinhs.id', 'thuoc_tinhs.ten_thuoc_tinh', 
                DB::raw("GROUP_CONCAT(gia_tri_thuoc_tinhs.gia_tri SEPARATOR ', ') as danh_sach_gia_tri"))
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
            DB::beginTransaction(); // Bắt đầu transaction để đảm bảo dữ liệu đồng bộ
    
            // Lưu thuộc tính
            $thuocTinhId = DB::table('thuoc_tinhs')->insertGetId([
                'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
                'created_at' => now(),
                'updated_at' => null
            ]);
    
            // Lưu giá trị thuộc tính (nếu có)
            if ($request->has('gia_tri')) {
                $giaTriThuocTinhs = [];
                foreach ($request->input('gia_tri') as $giaTri) {
                    if (!empty($giaTri)) {
                        $giaTriThuocTinhs[] = [
                            'thuoc_tinh_id' => $thuocTinhId,
                            'gia_tri' => $giaTri,
                            'created_at' => now(),
                            'updated_at' => null
                        ];
                    }
                }
                if (!empty($giaTriThuocTinhs)) {
                    DB::table('gia_tri_thuoc_tinhs')->insert($giaTriThuocTinhs);
                }
            }
    
            DB::commit(); // Lưu thay đổi nếu không có lỗi
            return redirect()->route('thuoctinhs.index')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack(); // Quay lại trạng thái ban đầu nếu có lỗi
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
    $giaTriThuocTinhs = DB::table('gia_tri_thuoc_tinhs')->where('thuoc_tinh_id', $id)->get();

    return view('admins.thuoctinhs.edit', compact('thuocTinh', 'giaTriThuocTinhs'));
}

/**
 * Cập nhật thuộc tính và giá trị thuộc tính
 */
public function update(UpdateThuocTinhRequest $request, $id)
{
    $thuocTinh = DB::table('thuoc_tinhs')->find($id);
    if (!$thuocTinh) {
        return redirect()->route('thuoctinhs.index')->with('error', 'Thuộc tính không tồn tại');
    }

    // Cập nhật tên thuộc tính
    DB::table('thuoc_tinhs')->where('id', $id)->update([
        'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
        'updated_at' => now()
    ]);

    // Cập nhật giá trị thuộc tính
    DB::table('gia_tri_thuoc_tinhs')->where('thuoc_tinh_id', $id)->delete();

    if ($request->has('gia_tri')) {
        $giaTriArray = array_filter($request->gia_tri);
        foreach ($giaTriArray as $giaTri) {
            DB::table('gia_tri_thuoc_tinhs')->insert([
                'thuoc_tinh_id' => $id,
                'gia_tri' => $giaTri,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

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

    // Kiểm tra xem thuộc tính có giá trị liên quan không
    $exists = DB::table('gia_tri_thuoc_tinhs')->where('thuoc_tinh_id', $id)->exists();

    if ($exists) {
        return redirect()->route('thuoctinhs.index')->with('error', 'Không thể xoá thuộc tính khi còn giá trị');
    }

    // Nếu không có giá trị liên quan, tiến hành xoá
    $thuocTinh->delete();

    return redirect()->route('thuoctinhs.index')->with('success', 'Xoá thành công');
}

    
}
