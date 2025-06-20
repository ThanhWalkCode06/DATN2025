<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'content',
        'descript',
        'banner_id',
        'image_url',
        'caption',
        'sort_order',
        'link_url',
        'link_type',
        'status_button',
        'content_button',
    ];

    public function banner(){
        return $this->belongsToMany(Banner::class,'banner_id');
    }
}
