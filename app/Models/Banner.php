<?php

namespace App\Models;

use App\Traits\SuperFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes,SuperFilterable;

    public $fillable = [
    'title_banner',
    'position',
    'status',
    'start_date',
    'end_date',
    'priority',
    'custom_url'
    ];

    public function bannerImgs(){
        return $this->hasMany(BannerImage::class);
    }
}
