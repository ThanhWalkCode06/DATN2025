<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

<<<<<<< HEAD
class SanPham extends Model  
{  
    use HasFactory;  

    protected $fillable = [  
        'ten_san_pham',  
        'ma_san_pham',  
        'khuyen_mai',  
        'hinh_anh',  
        'mo_ta',  
        'danh_muc_id',  
        'trang_thai',  
        'created_at',
        'updated_at'
    ];  
    
    
 
    public function danhMuc()  
    {  
        return $this->belongsTo(DanhMucSanPham::class, 'danh_muc_id', 'id'); 
    }  
}
=======
class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_san_pham',
        'ma_san_pham',
        'khuyen_mai',
        'hinh_anh',
        'mo_ta',
        'danh_muc_id',
        'trang_thai'
    ];
}
>>>>>>> 0c37ef05cc633316008540523e4656e9f80097a8
