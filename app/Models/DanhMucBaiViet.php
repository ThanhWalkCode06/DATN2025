<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMucBaiViet extends Pivot
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'ten_danh_muc',
        'mo_ta'
    ];

    protected $table = 'danh_muc_bai_viets';

    public $timestamp = false;

    protected $date = ['delete_at'];
    public function baiViets()
    {
        return $this->hasMany(BaiViet::class, 'danh_muc_id');
    }
}
