<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienTheThuocTinh extends Model
{
    use HasFactory;

    protected $table = 'bien_the_thuoc_tinhs';

    public function giaTriThuocTinh()
    {
        return $this->belongsTo(GiaTriThuocTinh::class, 'gia_tri_thuoc_tinh_id');
    }
}
