<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_danh_muc',
        'mo_ta'
    ];
}
