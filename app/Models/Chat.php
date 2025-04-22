<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nguoi_gui_id',
        'nguoi_nhan_id',
        'ten_nguoi_gui',
        'ten_nguoi_nhan',
        'noi_dung',
        'trang_thai',
        'hinh_anh',
        'channel',
    ];
}
