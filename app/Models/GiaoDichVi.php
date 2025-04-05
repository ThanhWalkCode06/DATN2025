<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoDichVi extends Model
{
    use HasFactory;
    protected $table = 'giaodichvis';

    protected $fillable = ['vi_id', 'so_tien', 'loai', 'mo_ta'];

    public function vi()
    {
        return $this->belongsTo(Vi::class, 'vi_id');
    }
}
