<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThuocTinh extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $dates = ['deleted_at']; // Định nghĩa cột deleted_at cho soft delete
    protected $fillable = ['ten_thuoc_tinh', 'created_at', 'updated_at', 'deleted_at'];
    public function giaTriThuocTinh()
    {
        return $this->hasMany(GiaTriThuocTinh::class, 'thuoc_tinh_id');
        
    }
}
