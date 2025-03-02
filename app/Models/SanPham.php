<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_san_pham',
        'ma_san_pham',
        'khuyen_mai',
        'hinh_anh',
        'mo_ta',
        'danh_muc_id',
        'trang_thai',
        'created_at',
        'updated_at'
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMucSanPham::class, 'danh_muc_id', 'id');
    }
    public function bienThes()
    {
        return $this->hasMany(BienThe::class, 'san_pham_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where(function ($q) use ($search) {
                $q->where('ten_san_pham', 'like', "%$search%")
                  ->orWhere('ma_san_pham', 'like', "%$search%");
            });
        }
        return $query;
    }
}
