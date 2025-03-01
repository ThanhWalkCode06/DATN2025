<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'san_pham_id',
        'so_sao',
        'nhan_xet',
        'trang_thai'
    ];
}
