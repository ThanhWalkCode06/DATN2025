<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use App\Models\ClientDanhMucSanPham;
use App\Http\Requests\StoreClientDanhMucSanPhamRequest;
use App\Http\Requests\UpdateClientDanhMucSanPhamRequest;

class ClientDanhMucSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function danhSachSanPham(Request $request)
    {
        $danh_muc_id = $request->query('danh_muc_id');

        // Lấy danh sách danh mục kèm số lượng sản phẩm
        $danhMucsp = DanhMucSanPham::withCount('sanPhams')->get();

        // Lấy danh sách sản phẩm theo danh mục
        if ($danh_muc_id) {
            $sanPhams = SanPham::where('danh_muc_id', $danh_muc_id)->get();
        } else {
            $sanPhams = SanPham::all();
        }

        return view('clients.sanphams.danhsach', compact('sanPhams', 'danhMucsp'));
    }

    public function sanPhamTrangchu()
{
    // Lấy danh sách danh mục
    $danhMucs = DanhMucSanPham::withCount('sanPhams')->get();

    // Lấy 8 sản phẩm có giá thấp nhất
    $sanPhams = SanPham::orderBy('gia_moi', 'asc')->take(8)->get();

    // Chia sản phẩm thành 2 nhóm (4 trên, 4 dưới)
    $sanPhamsTop = $sanPhams->take(4);
    $sanPhamsBottom = $sanPhams->skip(4)->take(4);

    return view('clients.index', compact('sanPhamsTop', 'sanPhamsBottom', 'danhMucs'));
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
    public function store(StoreClientDanhMucSanPhamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientDanhMucSanPham $clientDanhMucSanPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientDanhMucSanPham $clientDanhMucSanPham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientDanhMucSanPhamRequest $request, ClientDanhMucSanPham $clientDanhMucSanPham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientDanhMucSanPham $clientDanhMucSanPham)
    {
        //
    }
}
