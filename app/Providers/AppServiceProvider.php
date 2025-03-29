<?php

namespace App\Providers;

use App\Models\BaiViet;
use App\Models\Setting;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\DB;
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
        View::composer('layouts.client', function ($view) {
            $view->with('categories', ClientDanhMucSanPham::all());
        });

        View::composer('*', function ($view) {
            $view->with('danhMucs', ClientDanhMucSanPham::all());
        });
        View::composer('clients.blocks.header', function ($view) {
            $user = Auth::user();
            $gioHang = $user ? ChiTietGioHang::where('user_id', $user->id)->get() : collect();
            $total = $gioHang->sum(function ($item) {
                return $item->bienThe->gia_ban * $item->so_luong ?? 0; // Nếu `bienThe` không tồn tại, lấy 0 để tránh lỗi
            });

            // dd($total); // Debug để kiểm tra tổng
            $view->with(compact('gioHang', 'total'));
        });
        View::composer('clients.blocks.footer', function ($view) {
            $user = Auth::user();
            $baivietSupport = BaiViet::orderBy('id','asc')->limit(2)->get();

            // dd($total); // Debug để kiểm tra tổng
            $view->with(compact('baivietSupport'));
        });
        View::composer('clients.blocks.extra', function ($view) {
            $topOrderProducts = ChiTietDonHang::select('bien_thes.san_pham_id', DB::raw('SUM(chi_tiet_don_hangs.so_luong) as total_quantity'))
            ->join('bien_thes', 'chi_tiet_don_hangs.bien_the_id', '=', 'bien_thes.id') // Nối với bảng biến thể
            ->groupBy('bien_thes.san_pham_id') // Nhóm theo sản phẩm
            ->orderByDesc('total_quantity') // Sắp xếp giảm dần theo số lượng bán
            ->take(4) // Lấy 4 sản phẩm bán chạy nhất
            ->with('bienThe.sanPham') // Lấy thông tin sản phẩm
            ->get();


            $view->with(compact('topOrderProducts'));
        });
    }
}
