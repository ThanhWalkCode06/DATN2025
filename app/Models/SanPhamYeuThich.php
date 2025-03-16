<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamYeuThich extends Model
{
    use HasFactory;
    protected $table = 'san_pham_yeu_thichs';

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
    // public function sanpham(){
    //     return $this->belongsTo(SanPham::class, 'san_pham_id');
    // }
}
