<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra xem có đang lọc không
        $hasDateFilter = $request->has('start_date') && $request->has('end_date');

        if ($hasDateFilter) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
        } else {
            $startDate = now()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
        }

        // Ngăn chặn ngày tương lai
        $today = now()->format('Y-m-d');
        if ($startDate > $today) $startDate = $today;
        if ($endDate > $today) $endDate = $today;

        // Chuyển sang Carbon
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Tổng số lượng đơn hàng và khách hàng theo ngày lọc
        $tongDonHang = DonHang::whereBetween('created_at', [$startDate, $endDate])->count();
        $tongSanPhamConHang = SanPham::where('trang_thai', 1)->count();
        $tongKhachHangHoatDong = User::where('trang_thai', 1)->count();

        // Lấy thống kê ngày hôm qua
        $yesterdayStart = Carbon::yesterday()->startOfDay();
        $yesterdayEnd = Carbon::yesterday()->endOfDay();

        $tongDonHangHomQua = DonHang::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])->count();
        $tongKhachHangHomQua = User::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])->count();

        // Tính phần trăm thay đổi đơn hàng
        if ($tongDonHangHomQua == 0) {
            $phanTramThayDoiDonHang = $tongDonHang > 0 ? 100 : 0;
        } else {
            $phanTramThayDoiDonHang = (($tongDonHang - $tongDonHangHomQua) / $tongDonHangHomQua) * 100;
        }

        // Mapping trạng thái
        $trangThaiMapping = [
            'chua_xac_nhan' => 0,
            'dang_xu_ly' => 1,
            'dang_giao' => 2,
            'da_giao' => 3,
            'hoan_thanh' => 4,
            'da_huy' => -1,
            'tra_hang' => 5
        ];

        // Khởi tạo query theo thời gian lọc
        $query = DonHang::whereBetween('created_at', [$startDate, $endDate]);

        // Nếu có lọc theo trạng thái, áp dụng filter
        if ($request->has('trang_thai') && array_key_exists($request->trang_thai, $trangThaiMapping)) {
            $query->where('trang_thai_don_hang', $trangThaiMapping[$request->trang_thai]);
        }

        // Luôn ưu tiên đơn hàng chưa xác nhận lên đầu
        $donHangs = $query
            ->orderByRaw("CASE WHEN trang_thai_don_hang = 0 THEN 0 ELSE 1 END") // Ưu tiên đơn hàng chưa xác nhận
            ->orderBy('created_at', 'desc') // Sau đó mới đến ngày tạo
            ->paginate(10);


        // Tổng doanh thu
        $tongDoanhThu = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->sum(DB::raw('chi_tiet_don_hangs.so_luong * bien_thes.gia_ban'));

        // Tổng doanh thu hôm qua
        $tongDoanhThuHomQua = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->whereBetween('don_hangs.created_at', [$yesterdayStart, $yesterdayEnd])
            ->sum(DB::raw('chi_tiet_don_hangs.so_luong * bien_thes.gia_ban'));

        // Tính phần trăm tăng giảm doanh thu
        if ($tongDoanhThuHomQua == 0) {
            $phanTramTangGiamDoanhThu = $tongDoanhThu > 0 ? 100 : 0;
        } else {
            $phanTramTangGiamDoanhThu = (($tongDoanhThu - $tongDoanhThuHomQua) / $tongDoanhThuHomQua) * 100;
        }

        // Top doanh thu
        $topDoanhThu = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->select(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.hinh_anh',
                DB::raw('SUM(chi_tiet_don_hangs.so_luong * bien_thes.gia_ban) as tong_doanh_thu')
            )
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_doanh_thu')
            ->take(5)
            ->get();

        // Top sản phẩm bán chạy
        $topBanChay = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->select(
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.hinh_anh',
                DB::raw('SUM(chi_tiet_don_hangs.so_luong) as tong_da_ban')
            )
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_da_ban')
            ->take(5)
            ->get();

        // Top khách hàng
        $topKhachHang = DB::table('don_hangs')
            ->join('users', 'users.id', '=', 'don_hangs.user_id')
            ->select(
                'users.id',
                'users.ten_nguoi_dung',
                'users.anh_dai_dien',
                DB::raw('COUNT(don_hangs.id) as so_luong_don_hang')
            )
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->groupBy('users.id', 'users.ten_nguoi_dung', 'users.anh_dai_dien')
            ->orderByDesc('so_luong_don_hang')
            ->take(5)
            ->get();

        // Biểu đồ doanh thu theo tháng
        $doanhThuTheoThang = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->select(DB::raw('MONTH(chi_tiet_don_hangs.created_at) as thang, 
                               SUM(bien_thes.gia_ban * chi_tiet_don_hangs.so_luong) as doanh_thu'))
            ->whereYear('chi_tiet_don_hangs.created_at', date('Y'))
            ->where('don_hangs.trang_thai_thanh_toan', 1)
            ->groupBy(DB::raw('MONTH(chi_tiet_don_hangs.created_at)'))
            ->orderBy('thang')
            ->pluck('doanh_thu', 'thang')
            ->toArray();

        $dataChart = array_fill(0, 12, 0);
        foreach ($doanhThuTheoThang as $thang => $doanhThu) {
            $dataChart[$thang - 1] = $doanhThu;
        }

        return view('admins.index', compact(
            'tongDoanhThu',
            'tongDonHang',
            'tongKhachHangHoatDong',
            'tongSanPhamConHang',
            'dataChart',
            'donHangs',
            'topBanChay',
            'topKhachHang',
            'topDoanhThu',
            'phanTramThayDoiDonHang',
            'phanTramTangGiamDoanhThu',
            'hasDateFilter'
        ));
    }
}
