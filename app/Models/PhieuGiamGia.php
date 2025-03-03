<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhieuGiamGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ma_phieu',
        'ten_phieu',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'gia_tri',
        'mo_ta'
    ];
}
