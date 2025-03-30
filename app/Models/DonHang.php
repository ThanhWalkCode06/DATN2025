<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_don_hang',
        'user_id',
        'ten_nguoi_nhan',
        'email_nguoi_nhan',
        'sdt_nguoi_nhan',
        'dia_chi_nguoi_nhan',
        'tong_tien',
        'ghi_chu',
        'phuong_thuc_thanh_toan_id',
        'trang_thai_don_hang',
        'trang_thai_thanh_toan'
    ];

    public function user()
    {
        return $this->belongsTo(SanPhamYeuThich::class, 'user_id');
    }

    public function bienThes()
    {
        return $this->belongsToMany(BienThe::class, 'chi_tiet_don_hangs', 'don_hang_id', 'bien_the_id')
            ->withPivot('so_luong');
    }

    public function chiTietDonHangs() {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
    
}
