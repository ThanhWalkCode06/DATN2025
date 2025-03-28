<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienThe extends Model
{
    use HasFactory;

    protected $fillable = [
        'san_pham_id',
        // 'thuoc_tinh_id',
        // 'gia_tri_thuoc_tinh_id',
        'ten_bien_the',
        'anh_bien_the',
        'gia_nhap',
        'gia_ban',
        'so_luong'
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

    public function tt()
    {
        return $this->belongsToMany(ThuocTinh::class, 'bien_the_thuoc_tinhs', 'bien_the_id', 'thuoc_tinh_id')
                    ->withPivot('gia_tri_thuoc_tinh_id'); // Lấy ID giá trị thuộc tính
    }

    public function gttt()
    {
        return $this->hasManyThrough(
            GiaTriThuocTinh::class,
            BienTheThuocTinh::class,
            'bien_the_id', // Khóa ngoại ở bảng `bien_the_thuoc_tinhs`
            'id', // Khóa chính ở `gia_tri_thuoc_tinhs`
            'id', // Khóa chính ở `bien_thes`
            'gia_tri_thuoc_tinh_id' // Liên kết `bien_the_thuoc_tinhs` với `gia_tri_thuoc_tinhs`
        );
    }

    public function gioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'bien_the_id');
    }
}
