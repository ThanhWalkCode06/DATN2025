<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Support\Facades\Auth;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class SanPhamController extends Controller
{
    public function danhSach(Request $request)
    {
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

    public function sanPhamYeuThich()
    {
        $user = Auth::user();
        return view('clients.sanphams.sanphamyeuthich',compact('user'));
    }

    public function addsanPhamYeuThich(string $id)
    {
        $user = Auth::user();
        $tam =
        `<li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
            <a href="#" class="notifi-wishlist">
                <i data-feather="heart"></i>
            </a>
            <form action="{{ route('add.wishlist',1) }}" method="POST" class="wishlist-form">
                @csrf
            </form>
        </li>`;
        if($user){
            if(!$user->sanPhamYeuThichs()->where('san_pham_id', $id)->exists()){
                $user->sanPhamYeuThichs()->attach($id);
                return response()->json(['message' => 'Thêm thành công vào danh sách yêu thích!'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'Sản phẩm đã tồn tại trong danh sách!'], 500);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Bạn chưa đăng nhập!'], 401);
        }

    }

    public function xoaYeuThich($id)
    {
        try {
            $user = Auth::user();

            // Kiểm tra xem sản phẩm có trong danh sách yêu thích không
            if (!$user->sanPhamYeuThichs()->where('san_pham_id', $id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
            }

            // Xóa sản phẩm yêu thích
            $user->sanPhamYeuThichs()->detach($id);

            return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
        } catch (\Exception $e) {
            \Log::error('Lỗi xóa sản phẩm yêu thích: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi server!'], 500);
        }
    }
}
