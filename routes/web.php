<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BienTheController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\PhieuGiamGiaController;
use App\Http\Controllers\Admins\Auth\AuthController;

// Login Admin Controller
Route::prefix('admin')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login/restore', 'login')->name('login.restore');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register/restore', 'register')->name('register.restore');

    Route::get('/forgetPass', 'showForgetPass')->name('pass.forget');
    Route::post('/forgetPass/restore', 'sendLinkForgetPass')->name('pass.sendLinkForgetPass');

    Route::get('/getTokenOfPass/{token}', 'showResetPass')->name('showResetPass');
    Route::post('/getTokenOfPass/{token}/restore', 'storeResetPass')->name('storeResetPass.store');

    Route::get('/pass/edit', 'editPass')->name('pass.edit');
    Route::put('/pass/update', 'updatePass')->name('pass.update');
});


Route::get("/", [ThongKeController::class, "index"])->name('index');
Route::get("/lienhe", [LienHeController::class, "index"])->name('lienhe');
Route::get("/danhgia", [DanhGiaController::class, "index"])->name('danhgia');

Route::resource('danhmucs', DanhMucSanPhamController::class);
Route::resource('sanphams', SanPhamController::class);
Route::resource('bienthes', BienTheController::class);
Route::resource('taikhoans', TaiKhoanController::class);
Route::resource('donhangs', DonHangController::class);
Route::resource('baiviets', BaiVietController::class);
Route::resource('vaitros', VaiTroController::class);
Route::resource('phieugiamgias', PhieuGiamGiaController::class);


Route::get('mail', function () {
    return view('admins.auth.mailForgetPass');
});
