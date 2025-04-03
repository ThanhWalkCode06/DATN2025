<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuGiamGiaTaiKhoan extends Model
{
    use HasFactory;

    protected $table = 'phieu_giam_gia_tai_khoans';

    protected $fillable = ['phieu_giam_gia_id', 'user_id', 'order_id'];

    // Quan hệ với bảng phiếu giảm giá
    public function phieuGiamGia()
    {
        return $this->belongsTo(PhieuGiamGia::class, 'phieu_giam_gia_id');
    }

    // Quan hệ với bảng user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với bảng đơn hàng (nếu cần)
    public function order()
    {
        return $this->belongsTo(DonHang::class, 'order_id');
    }
}

