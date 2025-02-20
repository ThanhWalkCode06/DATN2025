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
        $listThuocTinh = DB::table('thuoc_tinhs')->orderByDesc('id')->paginate(5);
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
        $dataThuocTinh = [
            
            'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
            'created_at' => now(),
            'updated_at' => null
        ];
        DB::table('thuoc_tinhs')->insert($dataThuocTinh);
        return redirect()->route('thuoctinhs.index')->with('success', 'Thêm thành công');
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
    public function edit( $id)
    {
        $thuocTinh = DB::table('thuoc_tinhs')->find($id);
        return view('admins.thuoctinhs.edit', compact('thuocTinh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThuocTinhRequest $request,  $id)
    {
        $thuocTinh = DB::table('thuoc_tinhs')->find($id);
        if (!$thuocTinh) {
            return redirect()->route('thuoctinhs.index')->with('error','Thuộc tính không tồn tại');
        }
        $dataThuocTinh = [
            
            'ten_thuoc_tinh' => $request->input('ten_thuoc_tinh'),
            
            'updated_at' => now()
        ];
        DB::table('thuoc_tinhs')->where('id',$id)->update($dataThuocTinh);
        return redirect()->route('thuoctinhs.index')->with('success', 'Sửa thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $thuocTinh = ThuocTinh::find($id);
        if (!$thuocTinh) {
            return redirect()->route('thuoctinhs.index')->with('error','Thuộc tính không tồn tại');
        }
       $thuocTinh->delete();

        return redirect()->route('thuoctinhs.index')->with('success', 'Xoá thành công');
    }
}
