<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiViet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bai_viets';

    protected $fillable = ['user_id', 'tieu_de', 'danh_muc_id', 'noi_dung', 'anh_bia'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function danhMuc()
    {
        return $this->belongsTo(DanhMucSanPham::class);
    }
}
