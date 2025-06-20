<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\Banner;
use App\Models\BaiViet;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use App\Http\Controllers\Controller;
use SebastianBergmann\Diff\Chunk;

class IndexClientController extends Controller
{
    public function index()
    {
        $danhMucAll = DanhMucSanPham::all();
        $sanPhamFollowComments = SanPham::with('bienThes', 'danhGias', 'anhSP')
            ->withAvg('danhGias', 'so_sao') // Lấy trung bình số sao từ bảng danh_gias
            ->whereNull('san_phams.deleted_at')
            ->where('san_phams.trang_thai',1)
            ->orderByDesc('danh_gias_avg_so_sao') // Sắp xếp theo số sao trung bình giảm dần
            ->take(8)
            ->get()->toArray();

        $sanPhamFollowTopOrders = SanPham::with('bienThes')->select('san_phams.*')
            ->selectRaw('COUNT(chi_tiet_don_hangs.id) as so_luong_don_hang') // Đếm số đơn hàng
            ->leftJoin('bien_thes', 'san_phams.id', '=', 'bien_thes.san_pham_id') // Nối bảng biến thể
            ->leftJoin('chi_tiet_don_hangs', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id') // Nối với đơn hàng
            ->whereNull('san_phams.deleted_at')
            ->where('san_phams.trang_thai',1)
            ->groupBy(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.ma_san_pham',
                'san_phams.san_pham_slug',
                'san_phams.gia_cu',
                'san_phams.khuyen_mai',
                'san_phams.hinh_anh',
                'san_phams.mo_ta',
                'san_phams.danh_muc_id',
                'san_phams.trang_thai',
                'san_phams.created_at',
                'san_phams.updated_at',
                'san_phams.deleted_at'
            ) // Nhóm theo sản phẩm
            ->orderByDesc('so_luong_don_hang') // Sắp xếp theo số lượng đơn hàng giảm dần
            ->take(12) // Lấy 8 sản phẩm có nhiều đơn hàng nhất
            ->get()
            ->toArray();
        // dd($sanPhamFollowTopOrders);
        $half = ceil(count($sanPhamFollowTopOrders) / 3);
        $part1 = array_slice($sanPhamFollowTopOrders, 0, $half); // Lấy nửa đầu
        $part2 = array_slice($sanPhamFollowTopOrders, 4, $half); // Lấy nửa sau
        $part3 = array_slice($sanPhamFollowTopOrders, 8, $half); // Lấy nửa sau

        // dd($sanPhamFollowTopOrders,$part1,$part2,$part3);

        $baiViets = BaiViet::orderBy('created_at', 'desc')->limit(2)->get()->toArray();

        $danhGia = DanhGia::where('so_sao', 5)->first()->toArray();
        $bestUser = User::withCount('donHangs') // Đếm số lượng đơn hàng
            ->orderByDesc('don_hangs_count') // Sắp xếp theo số lượng đơn hàng giảm dần
            ->first()
            ->toArray();

        $bestComment = DanhGia::where('so_sao', 5) // Sắp xếp theo số lượng đơn hàng giảm dần
            ->first()
            ->toArray();

        $now = now();

        $mainBanner = Banner::with('bannerImgs')
            ->where('position', 'homepage')
            ->where('status', 1)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $now);
            })
            ->orderByDesc('priority')
            ->orderByDesc('created_at')
            ->first();

        $subBanner = Banner::with('bannerImgs')
            ->where('position', 'secondary')
            ->where('status', 1)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $now);
            })
            ->orderByDesc('priority')
            ->orderByDesc('created_at')
            ->take(2)
            ->get();

        $sideBarBanner = Banner::with('bannerImgs')
            ->where('position', 'sidebar')
            ->where('status', 1)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $now);
            })
            ->orderByDesc('priority')
            ->orderByDesc('created_at')
            ->take(1)
            ->get();

        // Gán từng banner một cách an toàn
        $banner1 = $subBanner[0]->bannerImgs ?? null;
        $banner2 = $subBanner[1]->bannerImgs ?? null;

        // dd($sideBarBanner[0]->bannerImgs[0]);
        return view('clients.index', compact(
            'danhMucAll',
            'sanPhamFollowComments',
            'part1',
            'part2',
            'part3',
            'baiViets',
            'bestUser',
            'bestComment','mainBanner',
            'banner1','banner2','sideBarBanner'
        ));
    }
}
