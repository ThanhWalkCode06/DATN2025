<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\SanPham;
use Carbon\CarbonPeriod;
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
        // Tổng số lượng sản phẩm còn hàng (trạng thái còn hàng)
        $tongSanPhamConHang = SanPham::where('trang_thai', 1) // Trạng thái còn hàng
            ->whereBetween('created_at', [$startDate, $endDate]) // Áp dụng bộ lọc ngày
            ->count();

        // Tổng số lượng khách hàng hoạt động (trạng thái hoạt động)
        $tongKhachHangHoatDong = User::where('trang_thai', 1) // Trạng thái hoạt động
            ->whereBetween('created_at', [$startDate, $endDate]) // Áp dụng bộ lọc ngày
            ->count();
        // Lấy số lượng khách hàng hôm qua
        $yesterdayStart = Carbon::yesterday()->startOfDay();
        $yesterdayEnd = Carbon::yesterday()->endOfDay();
        $tongKhachHangHomQua = User::where('trang_thai', 1)
            ->whereBetween('created_at', [$yesterdayStart, $yesterdayEnd]) // Lọc theo ngày hôm qua
            ->count();

        // Tính phần trăm thay đổi số lượng khách hàng
        if ($tongKhachHangHomQua == 0) {
            $phanTramThayDoiKhachHang = $tongKhachHangHoatDong > 0 ? 100 : 0;
        } else {
            $phanTramThayDoiKhachHang = (($tongKhachHangHoatDong - $tongKhachHangHomQua) / $tongKhachHangHomQua) * 100;
        }

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
        $tongDoanhThu = DB::table('don_hangs')
            ->where('trang_thai_thanh_toan', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('tong_tien');

        // Tổng doanh thu hôm qua
        $tongDoanhThuHomQua = DB::table('don_hangs')
            ->where('trang_thai_thanh_toan', 1)
            ->whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->sum('tong_tien');

        // Tính phần trăm tăng giảm doanh thu
        // if ($tongDoanhThuHomQua == 0) {
        //     $phanTramTangGiamDoanhThu = $tongDoanhThu > 0 ? 100 : 0;
        // } else {
        //     $phanTramTangGiamDoanhThu = (($tongDoanhThu - $tongDoanhThuHomQua) / $tongDoanhThuHomQua) * 100;
        // }

        // Top doanh thu
        $topDoanhThu = DB::table('chi_tiet_don_hangs')
        ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
        ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
        ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
        ->select(
            'san_phams.id',
            'san_phams.ten_san_pham',
            'san_phams.hinh_anh',
            DB::raw('SUM(chi_tiet_don_hangs.so_luong * bien_thes.gia_ban) as tong_doanh_thu'),
            DB::raw('MAX(don_hangs.created_at) as moi_nhat')
        )
        ->where('don_hangs.trang_thai_thanh_toan', 1)
        ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
        ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
        ->orderByDesc('tong_doanh_thu')
        ->orderByDesc('moi_nhat')
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
            DB::raw('SUM(chi_tiet_don_hangs.so_luong) as tong_da_ban'),
            DB::raw('MAX(don_hangs.created_at) as moi_nhat')
        )
        ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
        ->orderByDesc('tong_da_ban')
        ->orderByDesc('moi_nhat')
        ->take(5)
        ->get();
    

        // Top khách hàng
        $topKhachHang = DB::table('don_hangs')
        ->join('users', 'users.id', '=', 'don_hangs.user_id')
        ->select(
            'users.id',
            'users.ten_nguoi_dung',
            'users.anh_dai_dien',
            DB::raw('COUNT(don_hangs.id) as so_luong_don_hang'),
            DB::raw('SUM(don_hangs.tong_tien) as tong_tien_don_hang') // Tính tổng tiền của đơn hàng
        )
        ->where('don_hangs.trang_thai_thanh_toan', 1)
        ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
        ->groupBy('users.id', 'users.ten_nguoi_dung', 'users.anh_dai_dien')
        ->orderByDesc('so_luong_don_hang') // Sắp xếp theo số lượng đơn hàng
        ->orderByDesc('tong_tien_don_hang') // Thêm điều kiện sắp xếp theo tổng tiền của đơn hàng
        ->take(5)
        ->get();
    
        // Kiểm tra nếu ngày bắt đầu và ngày kết thúc là cùng một ngày
        if ($startDate->toDateString() === $endDate->toDateString()) {
            // Doanh thu theo giờ
            $doanhThuTheoGio = DB::table('don_hangs')
                ->select(
                    DB::raw('HOUR(created_at) as gio'),
                    DB::raw('SUM(tong_tien) as doanh_thu')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('trang_thai_thanh_toan', 1)
                ->groupBy(DB::raw('HOUR(created_at)'))
                ->orderBy('gio')
                ->pluck('doanh_thu', 'gio')
                ->toArray();
        
            $dataChart = array_fill(0, 24, 0);
            foreach ($doanhThuTheoGio as $gio => $doanhThu) {
                $dataChart[$gio] = $doanhThu;
            }
            $categoriesChart = array_map(fn($i) => "$i" . 'h', range(0, 23));
        } else {
            $soNgay = $startDate->diffInDays($endDate);
            if ($soNgay > 31) {
                // Doanh thu theo tháng
                $doanhThuTheoThang = DB::table('don_hangs')
                    ->select(
                        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as thang'),
                        DB::raw('SUM(tong_tien) as doanh_thu')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('trang_thai_thanh_toan', 1)
                    ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                    ->orderBy('thang')
                    ->pluck('doanh_thu', 'thang')
                    ->toArray();
        
                $period = CarbonPeriod::create($startDate->copy()->startOfMonth(), '1 month', $endDate->copy()->startOfMonth());
                $dataChart = [];
                $categoriesChart = [];
        
                foreach ($period as $month) {
                    $thang = $month->format('Y-m');
                    $dataChart[] = $doanhThuTheoThang[$thang] ?? 0;
                    $categoriesChart[] = $month->format('m/Y');
                }
            } else {
                // Doanh thu theo ngày
                $doanhThuTheoNgay = DB::table('don_hangs')
                    ->select(
                        DB::raw('DATE(created_at) as ngay'),
                        DB::raw('SUM(tong_tien) as doanh_thu')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('trang_thai_thanh_toan', 1)
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy('ngay')
                    ->pluck('doanh_thu', 'ngay')
                    ->toArray();
        
                $period = CarbonPeriod::create($startDate, $endDate);
                $dataChart = [];
                $categoriesChart = [];
        
                foreach ($period as $date) {
                    $ngay = $date->format('Y-m-d');
                    $dataChart[] = $doanhThuTheoNgay[$ngay] ?? 0;
                    $categoriesChart[] = $date->format('d/m');
                }
            }
        }
        
        return view('admins.index', compact(
            'tongDoanhThu',
            'tongDonHang',
            'tongKhachHangHoatDong',
            'tongSanPhamConHang',
            'dataChart',
            'categoriesChart',
            'donHangs',
            'topBanChay',
            'topKhachHang',
            'topDoanhThu',
            // 'phanTramThayDoiDonHang',
            // 'phanTramTangGiamDoanhThu',
            // 'phanTramThayDoiKhachHang',
            'hasDateFilter'
        ));
    }
}
