<?php

namespace App\Providers;

use App\Models\BaiViet;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Models\PhieuGiamGia;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ClientDanhMucSanPham;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('globalSetting', Setting::first());
        });

        View::composer('*', function ($view) {
            $view->with('danhMucsp', ClientDanhMucSanPham::all());
        });
        View::composer('clients.blocks.header', function ($view) {
            $user = Auth::user();
            $gioHang = $user ? ChiTietGioHang::where('user_id', $user->id)->get() : collect();
            $total = $gioHang->sum(function ($item) {
                return $item->bienThe->gia_ban * $item->so_luong ?? 0; // Nếu `bienThe` không tồn tại, lấy 0 để tránh lỗi
            });

            $view->with(compact('gioHang', 'total'));
        });
        View::composer('clients.blocks.footer', function ($view) {
            $user = Auth::user();
            $baivietSupport = BaiViet::orderBy('id','asc')->limit(2)->get();

            // dd($total); // Debug để kiểm tra tổng
            $view->with(compact('baivietSupport'));
        });
        View::composer('clients.blocks.extra', function ($view) {
            $topOrderProducts = ChiTietDonHang::select(
                'bien_thes.san_pham_id',
                DB::raw('SUM(chi_tiet_don_hangs.so_luong) as total_quantity')
            )
            ->join('bien_thes', 'chi_tiet_don_hangs.bien_the_id', '=', 'bien_thes.id')
            ->whereDate('chi_tiet_don_hangs.created_at', Carbon::today()) // Chỉ lấy đơn hàng hôm nay
            ->groupBy('bien_thes.san_pham_id')
            ->orderByDesc('total_quantity')
            ->take(4)
            ->with('bienThe.sanPham')
            ->get();

            $view->with(compact('topOrderProducts'));
        });



        View::composer('*', function ($view) {
            $userId = Auth::user();
            $phieuGiamGiaThanhToans = collect();
            if($userId){
                $phieuGiamGiaThanhToans = PhieuGiamGia::where('trang_thai', 1)
                ->where(function ($query) use ($userId) {
                    $query->where(function ($q) {
                        $q->where('ngay_bat_dau', '<=', now())
                            ->where('ngay_ket_thuc', '>=', now())
                            ->where('ma_phieu', 'not like', 'BIRTHDAY%'); // Loại trừ phiếu sinh nhật
                    })->orWhere('ma_phieu', 'like', "BIRTHDAY" . Str::upper($userId->username) . "%");
                })
                ->get();
            }
            $view->with('phieuGiamGiaThanhToans', $phieuGiamGiaThanhToans);
        });

            View::composer('*', function ($view) {
                $user = Auth::user();
                $soDuVi = $user?->vi?->so_du ?? 0;
                $view->with('soDuVi', $soDuVi);
            });

    }
}
