<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

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
        'created_at'  
    ];  

    // Liên kết với bảng danh_muc_san_phams  
    public function danhMuc()  
    {  
        return $this->belongsTo(DanhMucSanPham::class, 'danh_muc_id', 'id'); // Xác định rõ các trường khóa  
    }  
}