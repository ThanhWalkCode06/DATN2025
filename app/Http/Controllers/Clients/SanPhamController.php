<?php

namespace App\Http\Controllers\Clients;

use App\Models\SanPham;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\DB;
>>>>>>> 1158e7fdfc038b1e1a02aa83b5b2744491307223
use App\Http\Controllers\Controller;

class SanPhamController extends Controller
{
    public function danhSach(Request $request)
    {
<<<<<<< HEAD
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
=======
        $query = SanPham::with(['danhMuc', 'danhGias', 'bienThes'])
            ->where('san_phams.trang_thai', 1); 
    
        if ($request->has('danh_muc_id')) {
            $query->where('san_phams.danh_muc_id', $request->danh_muc_id); 
        }
    
        if ($request->has('so_sao')) {
            $soSao = (int) $request->so_sao; 
    
            $query->selectRaw('san_phams.id, san_phams.ten_san_pham, san_phams.trang_thai, COALESCE(AVG(danh_gias.so_sao), 0) as avg_rating')
                ->leftJoin('danh_gias', 'san_phams.id', '=', 'danh_gias.san_pham_id')
                ->where('san_phams.trang_thai', 1) 
                ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.trang_thai'); 
    
            if ($soSao == 5) {
                $query->havingRaw('AVG(danh_gias.so_sao) = 5.0');
            } else {
                $min = $soSao;
                $max = $soSao + 0.9;
                $query->havingRaw('AVG(danh_gias.so_sao) BETWEEN ? AND ?', [$min, $max]);
            }
        }
    
        $sanPhams = $query->paginate(12); 

    
        $danhMucs = DanhMucSanPham::withCount([
            'sanPhams' => function ($query) {
                $query->where('san_phams.trang_thai', 1); 
            }
        ])->get();
    
        return view('clients.sanphams.danhsach', compact('sanPhams', 'danhMucs'));
    }
    


    public function chiTiet()
    {
        return view('clients.sanphams.chitiet');
    }

>>>>>>> 1158e7fdfc038b1e1a02aa83b5b2744491307223
    public function sanPhamYeuThich()
    {
        return view('clients.sanphams.sanphamyeuthich');
    }
}
