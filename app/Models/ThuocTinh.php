<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThuocTinh extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ten_thuoc_tinh','deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public function giaTriThuocTinhs()

    {
        return $this->hasMany(GiaTriThuocTinh::class, 'thuoc_tinh_id');

    }
}
