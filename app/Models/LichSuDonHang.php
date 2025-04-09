<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuDonHang extends Model
{
    use HasFactory;

    protected $fillable = [
        'don_hang_id',
        'trang_thai'
    ];
}
