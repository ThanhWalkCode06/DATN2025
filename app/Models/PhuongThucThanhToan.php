<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhuongThucThanhToan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'ten_phuong_thuc',
        'trang_thai'
    ];
}
