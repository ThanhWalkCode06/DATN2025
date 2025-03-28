<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_gias';

    protected $fillable = [
        'user_id',
        'san_pham_id',
        'so_sao',
        'nhan_xet',
        'trang_thai'
    ];

    // Liên kết với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Liên kết với Sản phẩmq
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
