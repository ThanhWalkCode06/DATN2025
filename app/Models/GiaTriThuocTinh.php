<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiaTriThuocTinh extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'thuoc_tinh_id',
        'gia_tri'
    ];

    public function thuocTinh()
    {
        return $this->belongsTo(ThuocTinh::class, 'thuoc_tinh_id');
    }

}
