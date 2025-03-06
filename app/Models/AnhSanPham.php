<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhSanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'san_pham_id',
        'link_anh_san_pham',
    ];

    public function SanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
