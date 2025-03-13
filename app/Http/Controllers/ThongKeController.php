<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;



class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        // Thống kê cơ bản
        $tongDonHang = DonHang::count();
        $tongSanPhamConHang = SanPham::where('trang_thai', 1)->count();
        $tongKhachHangHoatDong = User::where('trang_thai', 1)->count();

        // Xử lý bộ lọc đơn hàng
        $query = DonHang::query();

        // Lọc theo ngày gần nhất
        if ($request->has('filter')) {
            if ($request->filter == 'hom_nay') {
                $query->whereDate('created_at', now());
            } elseif ($request->filter == 'gan_nhat') {
                $query->orderBy('created_at', 'desc'); // Lấy đơn hàng gần nhất
            } elseif ($request->filter == 'thang_nay') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->has('trang_thai')) {
            if ($request->trang_thai == 'chua_xac_nhan') {
                $query->where('trang_thai_don_hang', 0);
            } elseif ($request->trang_thai == 'tra_hang') {
                $query->where('trang_thai_don_hang', 5);
            }
        }

        // Sắp xếp theo ngày đặt hoặc tổng tiền
        if ($request->has('sort')) {
            if ($request->sort == 'ngay_dat') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'tong_tien') {
                $query->orderBy('tong_tien', 'desc');
            }
        }

        $donHangs = $query->paginate(10)->appends(request()->query());


        // Nhận bộ lọc thời gian từ request
        $filter = $request->input('filter', 'ngay'); // Mặc định là "ngày"

        // Hàm áp dụng bộ lọc ngày/tháng/năm vào query
        function applyDateFilter($query, $filter)
        {
            switch ($filter) {
                case 'thang':
                    return $query->whereMonth('chi_tiet_don_hangs.created_at', now()->month)
                        ->whereYear('chi_tiet_don_hangs.created_at', now()->year);
                case 'nam':
                    return $query->whereYear('chi_tiet_don_hangs.created_at', now()->year);
                default:
                    return $query->whereDate('chi_tiet_don_hangs.created_at', now());
            }
        }

        // Truy vấn top 5 sản phẩm bán chạy
        $topBanChay = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->select(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.hinh_anh',
                DB::raw('SUM(chi_tiet_don_hangs.so_luong) as tong_da_ban')
            );

        $topBanChay = applyDateFilter($topBanChay, $filter)
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_da_ban')
            ->take(5)
            ->get();

        // Top 5 sản phẩm doanh thu cao nhất
        $topDoanhThu = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->select(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.hinh_anh',
                DB::raw('SUM(chi_tiet_don_hangs.so_luong * bien_thes.gia_ban) as tong_doanh_thu')
            );

        $topDoanhThu = applyDateFilter($topDoanhThu, $filter)
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_doanh_thu')
            ->take(5)
            ->get();

        // Top 5 sản phẩm lợi nhuận cao nhất
        $topLoiNhuan = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->select(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.hinh_anh',
                DB::raw('SUM((bien_thes.gia_ban - bien_thes.gia_nhap) * chi_tiet_don_hangs.so_luong) as tong_loi_nhuan')
            );

        $topLoiNhuan = applyDateFilter($topLoiNhuan, $filter)
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_loi_nhuan')
            ->take(5)
            ->get();


        //Tổng doanh thu năm
        $query = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->select(DB::raw('SUM(bien_thes.gia_ban * chi_tiet_don_hangs.so_luong) as tong_doanh_thu'));

        // Thêm bộ lọc theo ngày, tháng, năm nếu có
        if (!empty($ngay)) {
            $query->whereDay('chi_tiet_don_hangs.created_at', $ngay);
        }
        if (!empty($thang)) {
            $query->whereMonth('chi_tiet_don_hangs.created_at', $thang);
        }
        if (!empty($nam)) {
            $query->whereYear('chi_tiet_don_hangs.created_at', $nam);
        }

        $tongDoanhThu = $query->value('tong_doanh_thu');



        // Tính doanh thu tháng
        $doanhThuTheoThang = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->select(DB::raw('MONTH(chi_tiet_don_hangs.created_at) as thang, 
                     SUM(bien_thes.gia_ban * chi_tiet_don_hangs.so_luong) as doanh_thu'))
            ->whereYear('chi_tiet_don_hangs.created_at', date('Y')) // Chỉ lấy dữ liệu năm hiện tại
            ->groupBy(DB::raw('MONTH(chi_tiet_don_hangs.created_at)'))
            ->orderBy('thang')
            ->pluck('doanh_thu', 'thang')
            ->toArray();


        // Tạo mảng 12 tháng mặc định bằng 0
        $dataChart = array_fill(0, 12, 0);
        foreach ($doanhThuTheoThang as $thang => $doanhThu) {
            $dataChart[$thang - 1] = $doanhThu; // Gán dữ liệu vào đúng tháng
        }


        return view('admins.index', compact('tongDonHang', 'tongKhachHangHoatDong', 'tongSanPhamConHang', 'donHangs', 'topBanChay', 'topDoanhThu', 'topLoiNhuan', 'tongDoanhThu', 'dataChart'));
    }
}
