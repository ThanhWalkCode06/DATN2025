<?php

namespace App\Http\Controllers\Clients;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SanPhamController extends Controller
{
    public function danhSach()
    {
        $sanPhams = SanPham::all();
    return view('clients.sanphams.danhsach', compact('sanPhams'));
    }
    public function chiTiet($id)  
    {  
        $sanPhams = SanPham::with(['bienThes', 'anhSP'])->findOrFail($id);  
        
        return view('clients.sanphams.chitiet', [  
            'sanPhams' => $sanPhams,  
            'bienThes' => $sanPhams->bienThes,  
        ]);  
    }  
    public function sanPhamYeuThich()
    {
        return view('clients.sanphams.sanphamyeuthich');
    }
}
