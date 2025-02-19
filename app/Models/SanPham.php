<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_san_pham',
        'gia_san_pham',
        'gia_khuyen_mai',
        'hinh_anh',
        'so_luong',
        'luot_xem',
        'mo_ta',
        'danh_muc_id',
        'trang_thai'
    ];
}
