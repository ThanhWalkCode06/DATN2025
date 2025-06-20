<?php

namespace App\Models;

use App\Traits\SuperFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhieuGiamGia extends Model
{
    use HasFactory, SoftDeletes, SuperFilterable;

    protected $fillable = [
        'danh_muc_id',
        'ma_phieu',
        'ten_phieu',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'kieu_giam',
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
