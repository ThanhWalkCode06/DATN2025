<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiaTriThuocTinh extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['thuoc_tinh_id', 'gia_tri', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
}
