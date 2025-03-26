<?php

namespace App\Providers;

use App\Models\ChiTietGioHang;
use App\Models\Setting;
use App\Models\DanhMucSanPham;
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
                return $item->bienThe->gia_ban ?? 0; // Nếu `bienThe` không tồn tại, lấy 0 để tránh lỗi
            });

            // dd($total); // Debug để kiểm tra tổng
            $view->with(compact('gioHang', 'total'));
        });
    }
}
