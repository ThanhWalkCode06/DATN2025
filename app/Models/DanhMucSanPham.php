<?php 
 
namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

<<<<<<< HEAD
class DanhMucSanPham extends Model  
{  
    use HasFactory;  

    protected $fillable = [  
        'ten_danh_muc',  
        'anh_danh_muc',  
        'mo_ta',  
    ];  

    public function sanPhams()  
    {  
        return $this->hasMany(SanPham::class, 'danh_muc_id', 'id');  
    }  
}
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMucSanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_muc_san_phams';

    protected $fillable = [
        'ten_danh_muc',
        'anh_danh_muc',
        'mo_ta',
    ];
}
>>>>>>> 0c37ef05cc633316008540523e4656e9f80097a8
