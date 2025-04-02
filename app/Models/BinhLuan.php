<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $fillable = ['bai_viet_id', 'user_id', 'parent_id', 'noi_dung'];

    public function baiViet(){
        return $this->belongsTo(BaiViet::class,);
    }

    // Quan hệ với người dùng
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Lấy danh sách các phản hồi (bình luận con)
    public function replies(){
        return $this->hasMany(BinhLuan::class, 'parent_id')->with('replies'); // Đệ quy
    }
}
