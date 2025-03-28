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
    public static function uploadAlbum($sanPhamId, $token)
{
    if(is_array(request()->file('album_anh'))){
        // dd(1,$token);
        if($token === false){
                foreach (request()->file('album_anh') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs("public/uploads/album/", $fileName);

                    AnhSanPham::create([
                        'san_pham_id' => $sanPhamId,
                        'link_anh_san_pham' => "uploads/album/" . $fileName
                    ]);
                }
        }else{
            $album = AnhSanPham::find($sanPhamId);
            // dd(1,$album);
            if($album){
                if ($album->anh_bien_the) {
                    Storage::delete('public/' . $album->anh_bien_the);
                }
                $album->delete();
            }
                foreach (request()->file('album_anh') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs("public/uploads/album/", $fileName);

                    AnhSanPham::create([
                        'san_pham_id' => $sanPhamId,
                        'link_anh_san_pham' => "uploads/album/" . $fileName
                    ]);
                }


        }
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
