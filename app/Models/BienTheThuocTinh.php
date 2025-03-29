<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienTheThuocTinh extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_the_id',
        'thuoc_tinh_id',
        'gia_tri_thuoc_tinh_id',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }

    public function thuocTinhs()
    {
        return $this->hasMany(ThuocTinh::class, 'id', 'thuoc_tinh_id');
    }
    public function giaTriThuocTinhs()
    {
        return $this->hasMany(GiaTriThuocTinh::class, 'id', 'gia_tri_thuoc_tinh_id');
    }

    public function donHangs()
    {
        return $this->belongsToMany(DonHang::class, 'chi_tiet_don_hangs', 'bien_the_id', 'don_hang_id')
            ->withPivot('so_luong');
    }
}
