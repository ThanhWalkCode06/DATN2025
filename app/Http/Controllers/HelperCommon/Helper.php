<?php

namespace App\Http\Controllers\HelperCommon;

use App\Models\AnhSanPham;
use Illuminate\Http\Request;
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


}
