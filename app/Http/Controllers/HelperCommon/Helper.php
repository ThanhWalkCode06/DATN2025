<?php

namespace App\Http\Controllers\HelperCommon;

use App\Models\BienThe;
use App\Models\GioHang;
use App\Models\AnhSanPham;
use Illuminate\Support\Str;
use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Helper extends Controller{
    public static function uploadAlbum($sanPhamId, $token,$deletedImages)
{
    // if(is_array(request()->file('album_anh'))){
        // dd(1,$token);
        if($token === false){
            if(is_array(request()->file('album_anh'))){
                foreach (request()->file('album_anh') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs("uploads/album/", $fileName, 'public');

                    AnhSanPham::create([
                        'san_pham_id' => $sanPhamId,
                        'link_anh_san_pham' =>  $path
                    ]);
                }
            }
        }else{
            $album = AnhSanPham::where('san_pham_id', $sanPhamId)->get();

            if (!empty($deletedImages)) {
                foreach ($deletedImages as $imageId) {
                    $image = AnhSanPham::find($imageId);
                    if ($image) {
                        Storage::delete('public/' . $image->link_anh_san_pham);
                        $image->delete();
                    }
                }
            }

            // if (is_array(request()->file('album_anh'))) {
            //     if ($album->isNotEmpty()) { // Kiểm tra có dữ liệu không
            //         foreach ($album as $item) {
            //             if ($item->anh_bien_the && Storage::exists($item->anh_bien_the)) {
            //                 Storage::delete($item->anh_bien_the);
            //             }
            //         }
            //         $album->each->delete(); // Xóa tất cả bản ghi sau khi xóa file
            //     }
            // }


            if (request()->hasFile('album_anh')) {
                foreach (request()->file('album_anh') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs("uploads/album/", $fileName, 'public'); // Đúng storage

                    AnhSanPham::create([
                        'san_pham_id' => $sanPhamId,
                        'link_anh_san_pham' => $path
                    ]);
                }
            }


        // }
    }


}

public static function checkQuantity($userID){
    $gioHang = ChiTietGioHang::where('user_id', $userID)->get();

    // Lấy danh sách biến thể có trong giỏ hàng
    $bienTheIds = $gioHang->pluck('bien_the_id')->toArray();
    $bienThes = BienThe::with('sanPham')->whereIn('id', $bienTheIds)->get();

    $spOverQuantity = []; // Mảng chứa danh sách sản phẩm vượt số lượng

    foreach ($gioHang as $item) {
        foreach ($bienThes as $bienThe) {
            if ($item->bien_the_id == $bienThe->id && $bienThe->so_luong < $item->so_luong) {
                $spOverQuantity[] = [
                    'ten_san_pham' => $bienThe->sanPham->ten_san_pham." ".$bienThe->ten_bien_the,
                    'so_luong_ton_kho' => $bienThe->so_luong,
                    'so_luong_muon_mua' => $item->so_luong,
                ];
            }
        }
    }

    return !empty($spOverQuantity) ? $spOverQuantity : null;
}

public static function generateOrderCode()
{
    return 'DH' . date('YmdHis') . strtoupper(Str::random(5));
}
public static function checkVoucher($codeVoucher,$idUser)
{
    $voucher = PhieuGiamGia::where('ma_phieu',$codeVoucher)->first();
    $message = '';
    if($voucher){
        $check = DB::table('phieu_giam_gia_tai_khoans')
        ->where('phieu_giam_gia_id',$voucher->id)
        ->where('user_id',$idUser)
        ->get();
        if($check->isNotEmpty()){
            $message = "Mã này đã được bạn sử dụng trước đó";
        }else{
            $message = '';
        }
        return $message;
    }
}

}
