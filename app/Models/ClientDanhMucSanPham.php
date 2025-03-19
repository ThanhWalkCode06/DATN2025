<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDanhMucSanPham extends Model
{
    use HasFactory;
    protected $table = 'danh_muc_san_phams';
    protected $fillable = ['ten_danh_muc', 'anh_danh_muc', 'mo_ta'];
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
}
