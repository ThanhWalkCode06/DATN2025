<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;

    protected $fillable = [
        'don_hang_id',
        'bien_the_id',
        'so_luong'
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function bienThe()
    {
        return $this->belongsTo(BienThe::class, 'bien_the_id');
    }

    public function sanPham()
    {
        return $this->belongsTo(sanPham::class, 'san_pham_id');
    }
}
