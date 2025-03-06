<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocTinh extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'ten_thuoc_tinh'
    ];
    protected $dates = ['deleted_at']; // Định nghĩa cột deleted_at cho soft delete
    public function giaTriThuocTinh()
    {
        return $this->hasMany(GiaTriThuocTinh::class, 'thuoc_tinh_id');
        
    }
}
