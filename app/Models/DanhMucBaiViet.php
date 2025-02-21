<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DanhMucBaiViet extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'ten_danh_muc',
        'mo_ta'
    ];
}
