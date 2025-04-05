<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vi extends Model
{
    use HasFactory;
    protected $table = 'vis'; // bắt buộc vì Laravel sẽ tự động tìm bảng 'vis'

    protected $fillable = ['nguoi_dung_id', 'so_du'];

    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'nguoi_dung_id');
    }

    public function giaodichs()
    {
        return $this->hasMany(GiaoDichVi::class, 'vi_id');
    }
}
