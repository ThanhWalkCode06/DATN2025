<?php

namespace App\Models;

use App\Traits\SuperFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory, SoftDeletes,SuperFilterable;

    protected $fillable = [
        'ten_san_pham',
        'ma_san_pham',
        // 'khuyen_mai',
        'gia_cu',
        'hinh_anh',
        'mo_ta',
        'chat_lieu',
        'form',
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
    public function anhSP()
    {
        return $this->hasMany(AnhSanPham::class, 'san_pham_id',);
    }

    public function usersYeuThich()
{
    return $this->belongsToMany(User::class, 'san_pham_yeu_thichs', 'san_pham_id', 'user_id');
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

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'san_pham_id');
    }

    public function tinhDiemTrungBinh()
    {
        return $this->danhGias->avg('so_sao') ?? 0; // Tính điểm trung bình đánh giá
    }

    public function soLuongDanhGia()
    {
        return $this->danhGias->count(); // Đếm số lượt đánh giá
    }


    public function giaThapNhatCuaSP()
    {
        return $this->bienThes->min('gia_ban') ?? 0;
    }

    public function phanTramGiamGia()
    {
        $giaBan = $this->giaThapNhatCuaSP(); // Lấy giá bán thấp nhất từ biến thể
        if ($this->gia_cu > 0 && $giaBan > 0 && $this->gia_cu > $giaBan) {
            return round((($this->gia_cu - $giaBan) / $this->gia_cu) * 100, 0);
        }
        return 0;
    }
}
