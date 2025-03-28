<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'bien_the_id',
        'so_luong'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bienThe()
    {
        return $this->belongsTo(BienThe::class, 'bien_the_id');
    }
}
