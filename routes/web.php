<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BienTheController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\ThuocTinhController;
use App\Http\Controllers\Admins\UserController;

use App\Http\Controllers\PhieuGiamGiaController;
use App\Http\Controllers\Admins\SettingController;

use App\Http\Controllers\DanhMucBaiVietController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\Admins\Auth\AuthController;
use App\Http\Controllers\Admins\Responsibility\RoleController;
use App\Http\Controllers\Admins\Responsibility\PermissionController;

// Login Admin Controller
Route::prefix('/admin')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login/restore', 'login')->name('login.store');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register/restore', 'register')->name('register.store');

    Route::get('/forgetPass', 'showForgetPass')->name('pass.forget');
    Route::post('/forgetPass/restore', 'sendLinkForgetPass')->name('pass.sendLinkForgetPass');

    Route::get('/getTokenOfPass/{token}', 'showResetPass')->name('showResetPass');
    Route::post('/getTokenOfPass/{token}/restore', 'storeResetPass')->name('storeResetPass.store');

    Route::get('/pass/edit', 'editPass')->name('pass.edit');
    Route::post('/pass/update', 'updatePass')->name('pass.update');
});
Route::prefix('admin')->middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::match(['post', 'get'], '/setting-infor', [SettingController::class, 'index'])->name('setting-infor.private');
    Route::middleware(['role:SuperAdmin'])->group(function () {
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::match(['post', 'get'], '/configuration-mail', [SettingController::class, 'mail'])->name('configuration.setting-mail');
        Route::match(['post', 'get'], '/configuration-common', [SettingController::class, 'common'])->name('configuration.common');
    });
    Route::get('/checkrole', function () {
        $permissions = App\Models\Role::findByName('admin')->getPermissionNames();
        dd($permissions, Auth::user()->roles);
    });
    // Route::get('/checkrole',function(){
    //     Auth::user()->syncRoles('SuperAdmin');
    //     dd(Auth::user()->hasRole('SuperAdmin'));
    // });

    Route::get("/", [ThongKeController::class, "index"])->name('index');
    Route::get("/lienhe", [LienHeController::class, "index"])->name('lienhe');
    Route::get("/danhgias", [DanhGiaController::class, "index"])->name('danhgias');

    // Chức năng thì cho vào đây đánh tên route->name phải giống quyền

    Route::middleware('dynamic')->group(function () {
        Route::resource('danhmucsanphams', DanhMucSanPhamController::class);
        Route::resource('sanphams', SanPhamController::class);
        Route::resource('bienthes', BienTheController::class);
        Route::resource('users', UserController::class);
        Route::resource('thuoctinhs', ThuocTinhController::class);
        Route::resource('donhangs', DonHangController::class);
        Route::resource('baiviets', BaiVietController::class);
        Route::resource('danhmucbaiviets', DanhMucBaiVietController::class);
        Route::resource('baiviets', BaiVietController::class);
        Route::resource('phieugiamgias', PhieuGiamGiaController::class);
    });
});


// Route::get('mail', function () {
//     return view('admins.auth.mailForgetPass');
// });
