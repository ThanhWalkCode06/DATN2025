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
            // Nếu không có lọc, mặc định lấy ngày hiện tại
            $startDate = now()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
        }

        // Ngăn chặn ngày tương lai
        $today = now()->format('Y-m-d');
        if ($startDate > $today) $startDate = $today;
        if ($endDate > $today) $endDate = $today;

        // Chuyển sang Carbon để xử lý thời gian chính xác
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Thống kê
        $tongDonHang = DonHang::whereBetween('created_at', [$startDate, $endDate])->count();
        $tongSanPhamConHang = SanPham::where('trang_thai', 1)->count();
        $tongKhachHangHoatDong = User::where('trang_thai', 1)->count();

        $trangThaiMapping = [
            'chua_xac_nhan' => 0,
            'dang_xu_ly' => 1,
            'dang_giao' => 2,
            'da_giao' => 3,
            'hoan_thanh' => 4,
            'da_huy' => -1,
            'tra_hang' => 5
        ];

        $query = DonHang::whereBetween('created_at', [$startDate, $endDate]);

        if ($request->has('trang_thai') && array_key_exists($request->trang_thai, $trangThaiMapping)) {
            $query->where('trang_thai_don_hang', $trangThaiMapping[$request->trang_thai]);
        }

        $donHangs = $query->orderBy('created_at', 'desc')->paginate(10);

        $tongDoanhThu = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->where('don_hangs.trang_thai_don_hang', 4)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->sum(DB::raw('chi_tiet_don_hangs.so_luong * bien_thes.gia_ban'));

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
            ->where('don_hangs.trang_thai_don_hang', 4)
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate])
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_doanh_thu')
            ->take(5)
            ->get();

        $topBanChay = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->where('don_hangs.trang_thai_don_hang', 4)
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

        $topKhachHang = DB::table('don_hangs')
            ->join('users', 'users.id', '=', 'don_hangs.user_id') // Liên kết bảng 'users' với bảng 'don_hangs'
            ->select(
                'users.id',
                'users.ten_nguoi_dung', // Trường tên người dùng trong bảng 'users'
                'users.anh_dai_dien', // Dùng trường 'anh_dai_dien' thay cho 'hinh_anh'
                DB::raw('COUNT(don_hangs.id) as so_luong_don_hang') // Đếm số lượng đơn hàng của mỗi khách hàng
            )
            ->where('don_hangs.trang_thai_don_hang', 4) // Chỉ lấy đơn hàng đã hoàn thành
            ->whereBetween('don_hangs.created_at', [$startDate, $endDate]) // Lọc theo thời gian
            ->groupBy('users.id', 'users.ten_nguoi_dung', 'users.anh_dai_dien') // Nhóm theo người dùng
            ->orderByDesc('so_luong_don_hang') // Sắp xếp theo số lượng đơn hàng giảm dần
            ->take(5) // Lấy top 5 khách hàng
            ->get();





        // Biểu đồ doanh thu theo tháng (năm hiện tại)
        $doanhThuTheoThang = DB::table('chi_tiet_don_hangs')
            ->join('bien_thes', 'bien_thes.id', '=', 'chi_tiet_don_hangs.bien_the_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->select(DB::raw('MONTH(chi_tiet_don_hangs.created_at) as thang, 
                               SUM(bien_thes.gia_ban * chi_tiet_don_hangs.so_luong) as doanh_thu'))
            ->whereYear('chi_tiet_don_hangs.created_at', date('Y'))
            ->where('don_hangs.trang_thai_don_hang', 4)
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
            'topDoanhThu'
        ));
    }
}
