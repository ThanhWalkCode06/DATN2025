<?php

namespace App\Http\Controllers;

use App\Models\ThuocTinh;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreGiaTriThuocTinhRequest;
use App\Http\Requests\UpdateGiaTriThuocTinhRequest;

class GiaTriThuocTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listGiaTriThuocTinh = DB::table('gia_tri_thuoc_tinhs')
        ->join('thuoc_tinhs', 'gia_tri_thuoc_tinhs.thuoc_tinh_id', '=', 'thuoc_tinhs.id')
        ->select('gia_tri_thuoc_tinhs.*', 'thuoc_tinhs.ten_thuoc_tinh')
        ->orderByDesc('id')->paginate(5);

        return view('admins.giatrithuoctinhs.index', compact('listGiaTriThuocTinh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $thuocTinhs = ThuocTinh::all();
        return view('admins.giatrithuoctinhs.create',compact('thuocTinhs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGiaTriThuocTinhRequest $request)
    {
        $dataGiaTri = [
            
            'thuoc_tinh_id' => $request->input('thuoc_tinh_id'),
            'gia_tri'       => $request->input('gia_tri'),
            'created_at' => now(),
            'updated_at' => null
        ];
        DB::table('gia_tri_thuoc_tinhs')->insert($dataGiaTri);
        return redirect()->route('giatrithuoctinhs.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(GiaTriThuocTinh $giaTriThuocTinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $thuocTinhs = ThuocTinh::all();
        $giaTri = DB::table('gia_tri_thuoc_tinhs')->find($id);
        return view('admins.giatrithuoctinhs.edit', compact('giaTri','thuocTinhs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGiaTriThuocTinhRequest $request,  $id)
    {
        $giaTri = DB::table('gia_tri_thuoc_tinhs')->find($id);
        if (!$giaTri) {
            return redirect()->route('giatrithuoctinhs.index')->with('error','Thuộc tính không tồn tại');
        }
        $datagiaTri = [
            
            'thuoc_tinh_id' => $request->input('thuoc_tinh_id'),
            'gia_tri'       => $request->input('gia_tri'),
            
            'updated_at' => now()
        ];
        DB::table('gia_tri_thuoc_tinhs')->where('id',$id)->update($datagiaTri);
        return redirect()->route('giatrithuoctinhs.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $giaTri = GiaTriThuocTinh::find($id);
        if (!$giaTri) {
            return redirect()->route('giatrithuoctinhs.index')->with('error','Giá trị thuộc tính không tồn tại');
        }
       $giaTri->delete();

        return redirect()->route('giatrithuoctinhs.index')->with('success', 'Xoá thành công');
    }
}
