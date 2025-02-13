<?php

use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BienTheController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\PhieuGiamGiaController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\VaiTroController;
use Illuminate\Support\Facades\Route;



Route::get("/", [ThongKeController::class, "index"])->name('index');
Route::get("/lienhe", [LienHeController::class, "index"])->name('lienhe');
Route::get("/danhgia", [DanhGiaController::class, "index"])->name('danhgia');

Route::resource('danhmucs', DanhMucController::class);
Route::resource('sanphams', SanPhamController::class);
Route::resource('bienthes', BienTheController::class);
Route::resource('taikhoans', TaiKhoanController::class);
Route::resource('donhangs', DonHangController::class);
Route::resource('baiviets', BaiVietController::class);
Route::resource('vaitros', VaiTroController::class);
Route::resource('phieugiamgias', PhieuGiamGiaController::class);
