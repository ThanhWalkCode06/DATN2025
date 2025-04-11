<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoDichVi extends Model
{
    use HasFactory;
    protected $table = 'giaodichvis';

    protected $fillable = [
        'vi_id',
        'ma_giao_dich',
        'so_tien',
        'loai',
        'mo_ta',
        'ten_ngan_hang',
        'so_tai_khoan',
        'ten_nguoi_nhan',
    ];

    public function vi()
    {
        return $this->belongsTo(Vi::class, 'vi_id');
    }
}
