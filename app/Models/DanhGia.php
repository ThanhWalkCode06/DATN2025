<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_gias';

    protected $fillable = [
        'user_id',
        'san_pham_id',
        'bien_the_id',
        'don_hang_id',
        'so_sao',
        'nhan_xet',
        'trang_thai',
        'hinh_anh_danh_gia',
        'video',
    ];

    // Liên kết với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Liên kết với Sản phẩmq
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bienThe()
    {
        return $this->belongsTo(BienThe::class, 'bien_the_id'); // nhớ đúng tên cột
    }
    // Liên kết với Đơn hàng
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }
     // Accessor để lấy danh sách hình ảnh dưới dạng mảng
     public function getHinhAnhDanhGiaAttribute($value)
     {
         return $value ? json_decode($value, true) : [];
     }
 
     // Mutator để lưu hình ảnh dưới dạng JSON
     public function setHinhAnhDanhGiaAttribute($value)
     {
         $this->attributes['hinh_anh_danh_gia'] = json_encode($value);
     }
}
