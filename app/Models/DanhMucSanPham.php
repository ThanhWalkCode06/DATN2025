<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMucSanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_muc_san_phams';

    protected $fillable = [
        'ten_danh_muc',
        'anh_danh_muc',
        'mo_ta',
    ];
}
