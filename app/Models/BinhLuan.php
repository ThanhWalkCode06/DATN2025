<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $table = 'binh_luans';

    protected $fillable = [
        'bai_viet_id',
        'user_id',
        'parent_id',
        'noi_dung',
        'trang_thai',
    ];
    protected $casts = [
        'trang_thai' => 'boolean',
    ];


    // Mối quan hệ với bài viết
    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'bai_viet_id');
    }

    // Mối quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mối quan hệ với bình luận cha
    public function parent()
    {
        return $this->belongsTo(BinhLuan::class, 'parent_id');
    }

    // Mối quan hệ với các bình luận con (replies)
    public function replies()
    {
        return $this->hasMany(BinhLuan::class, 'parent_id');
    }

    // Scope lọc bình luận hiển thị (trang_thai = 1)
    public function scopeHienThi($query)
    {
        return $query->where('trang_thai', 1);
    }
}
