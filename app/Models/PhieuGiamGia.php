<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhieuGiamGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ma_phieu',
        'ten_phieu',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'gia_tri',
        'trang_thai',
        'mo_ta',
        'muc_giam_toi_da',
        'muc_gia_toi_thieu',
    ];

   public function phieu_giam_gia_tai_khoans()
{
    return $this->hasMany(PhieuGiamGiaTaiKhoan::class, 'phieu_giam_gia_id');
}


}
