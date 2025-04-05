<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'anh_dai_dien',
        'ten_nguoi_dung',
        'dia_chi',
        'ngay_sinh',
        'gioi_tinh',
        'so_dien_thoai',
        'trang_thai',
        'email',
        'username',


    ];

    public function sanPhamYeuThichs()
    {
        return $this->belongsToMany(SanPham::class, 'san_pham_yeu_thichs', 'user_id', 'san_pham_id');
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'user_id');
    }

    public function gioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'user_id');
    }

    public function danhGias()
    {
        return $this->hasMany(danhGia::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */ 
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $guard_name = 'web';

    public function vi()
    {
        return $this->hasOne(Vi::class, 'nguoi_dung_id');
    }

    public function layHoacTaoVi() {
        return $this->vi ?? $this->vi()->create(['so_du' => 0]);
    }
    
}
