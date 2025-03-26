<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\DanhGia;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use App\Models\User;
use Illuminate\Http\Request;

class IndexClientController extends Controller
{
    public function index()
    {
        $danhMucAll = DanhMucSanPham::all();
        $sanPhamFollowComments = SanPham::with('bienThes', 'danhGias', 'anhSP')
            ->withAvg('danhGias', 'so_sao') // Lấy trung bình số sao từ bảng danh_gias
            ->orderByDesc('danh_gias_avg_so_sao') // Sắp xếp theo số sao trung bình giảm dần
            ->take(8)
            ->get()->toArray();

        // $sanPhamFollowTopOrders = SanPham::select('san_phams.*')
        // ->selectRaw('COUNT(chi_tiet_don_hangs.id) as so_luong_don_hang') // Đếm số đơn hàng
        // ->leftJoin('bien_thes', 'san_phams.id', '=', 'bien_thes.san_pham_id') // Nối bảng biến thể
        // ->leftJoin('chi_tiet_don_hangs', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id') // Nối với đơn hàng
        // ->groupBy('san_phams.id') // Nhóm theo sản phẩm
        // ->orderByDesc('so_luong_don_hang') // Sắp xếp theo số lượng đơn hàng giảm dần
        // ->take(12) // Lấy 8 sản phẩm có nhiều đơn hàng nhất
        // ->get()
        // ->toArray();

        // $half = ceil(count($sanPhamFollowTopOrders) / 3);
        // $part1 = array_slice($sanPhamFollowTopOrders, 0, $half); // Lấy nửa đầu
        // $part2 = array_slice($sanPhamFollowTopOrders, 4,$half); // Lấy nửa sau
        // $part3 = array_slice($sanPhamFollowTopOrders, 8,$half); // Lấy nửa sau

        // dd($sanPhamFollowTopOrders,$part1,$part2,$part3);

        $baiViets = BaiViet::limit(2)->get()->toArray();
        $danhGia = DanhGia::where('so_sao', 5)->first()->toArray();
        $bestUser = User::withCount('donHangs') // Đếm số lượng đơn hàng
            ->orderByDesc('don_hangs_count') // Sắp xếp theo số lượng đơn hàng giảm dần
            ->first()
            ->toArray();

        $bestComment = DanhGia::where('so_sao', 5) // Sắp xếp theo số lượng đơn hàng giảm dần
            ->first()
            ->toArray();

        // dd($bestComment);
        return view('clients.index', compact(
            'danhMucAll',
            'sanPhamFollowComments',
            // 'part1',
            // 'part2',
            // 'part3',
            'baiViets',
            'bestUser',
            'bestComment'
        ));
    }
}
