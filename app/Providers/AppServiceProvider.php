<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\ClientDanhMucSanPham;
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
    }
}
