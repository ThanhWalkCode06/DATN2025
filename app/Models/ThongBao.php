<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "noi_dung",
        "id_dinh_kem",
        "trang_thai"
    ];
}
