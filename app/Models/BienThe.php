<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienThe extends Model
{
    use HasFactory;

    protected $fillable = [
        'san_pham_id',
        'thuoc_tinh_id',
        'gia_tri_thuoc_tinh_id',
        'ten_bien_the',
        'anh_bien_the',
        'gia_nhap',
        'gia_ban',
        'so_luong'
    ];
}
