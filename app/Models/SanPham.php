<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_san_pham',
        'ma_san_pham',
        'khuyen_mai',
        'luot_xem',
        'mo_ta',
        'danh_muc_id',
        'trang_thai'
    ];
}
