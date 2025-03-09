<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiaTriThuocTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyGiaTri($id)
    {
        try {
            // Xóa mềm giá trị thuộc tính bằng cách cập nhật `deleted_at`
            DB::table('gia_tri_thuoc_tinhs')
                ->where('id', $id)
                ->update(['deleted_at' => now()]);
    
            return response()->json(['success' => true, 'message' => 'Giá trị thuộc tính đã được xóa mềm!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi xóa: ' . $e->getMessage()]);
        }
    }
}
