<?php

namespace App\Http\Controllers\Clients;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\DB;
use App\Models\PhuongThucThanhToan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HelperCommon\Helper;
use App\Http\Requests\Client\ThanhToanRequest;
use App\Models\BienThe;
use App\Models\GioHang;
use App\Models\PhieuGiamGia;

class ThanhToanController extends Controller
{
    public function gioHang()
    {
        $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.gia_moi', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        // dd($chiTietGioHangs);

        return view('clients.thanhtoans.giohang', compact('chiTietGioHangs'));
    }

    public function thanhToan()
    {
        if(Auth::check()){
            $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.gia_moi', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        $pttts = PhuongThucThanhToan::all()->toArray();
        }else{
            return view('clients.auth.login');
        }

        return view('clients.thanhtoans.thanhtoan', compact('chiTietGioHangs','pttts'));
    }

    public function xuLyThanhToan(ThanhToanRequest $request){

    // return response()->json(['message' => $request->all()], 200);
    $user = Auth::user();
    $bienThes = BienThe::all();
    if($user){
        $giohang = ChiTietGioHang::where('user_id',Auth::user()->id)->first();
        if(!$giohang){
            return response()->json([
                'status' => 'error',
                'message' => 'Giỏ hàng trống'
            ],403);
        }
        if($request->chinh_sach == 0){
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn phải đồng ý với chính sách mua hàng'
            ],403);
        }
        $checkquantity = Helper::checkQuantity($user->id);
        if($checkquantity == null){
            // checkVourcher
            if($request->phuong_thuc_thanh_toan_id === "1"){
                $donHang = DonHang::create([
                    'user_id' => $user->id,
                    'ma_don_hang' => Helper::generateOrderCode(),
                    'ten_nguoi_nhan' => $request->ten_nguoi_nhan,
                    'email_nguoi_nhan' => $request->email_nguoi_nhan,
                    'sdt_nguoi_nhan' => $request->sdt_nguoi_nhan,
                    'dia_chi_nguoi_nhan' => $request->dia_chi_nguoi_nhan,
                    'tong_tien' => $request->tong_tien,
                    'ghi_chu' => $request->ghi_chu,
                    'phuong_thuc_thanh_toan_id' => 1,
                    'trang_thai_don_hang' => 0,
                    'trang_thai_thanh_toan' => 0,
                    'created_at' => now()
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lỗi phương thức',
                ],500);
            }

            if($request->voucher_code != ''){
                $idVoucher = PhieuGiamGia::where('ma_phieu',$request->voucher_code)->first();
                if($idVoucher){
                    $item = DB::table('phieu_giam_gia_tai_khoans')
                ->insert([
                    'phieu_giam_gia_id' => $idVoucher->id,
                    'user_id' => $user->id,
                    'order_id' => $donHang->id,
                    'created_at' => now(),
                ]);
                }
            }
            $cart = ChiTietGioHang::with('user','bienThe')->where('user_id',$user->id)->get();
                foreach($cart as $item){
                    $chiTietDonHang = ChiTietDonHang::create([
                        'don_hang_id' => $donHang->id,
                        'bien_the_id' => $item->bienThe->id,
                        'so_luong' =>   $item->so_luong,
                        'created_at' => now()
                    ]);
                    BienThe::where('id', $item->bienThe->id)->update([
                        'so_luong' => DB::raw('so_luong - ' . $item->so_luong)
                    ]);
                }
            $cart->each->delete();
            return response()->json([
                'status' => 'success',
                'id' => $donHang->id
            ],200);

        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm vượt quá số lượng tồn kho!',
                'over_quantity' => $checkquantity
            ],500);
        }
    }
    }

    public function datHangThanhCong(Request $request, string $id)
    {
        $donHang = DonHang::select('don_hangs.*', 'phuong_thuc_thanh_toans.ten_phuong_thuc')
            ->join('phuong_thuc_thanh_toans', 'phuong_thuc_thanh_toans.id', '=', 'phuong_thuc_thanh_toan_id')
            ->where('don_hangs.id', '=', $id)
            ->find($id);
        // dd($id,$donHang);
        $chiTietDonHangs = ChiTietDonHang::select(
            'chi_tiet_don_hangs.*',
            'san_phams.ten_san_pham',
            'san_phams.id',
            'san_phams.san_pham_slug',
            'san_phams.gia_cu',
            'bien_thes.gia_ban',
            'san_phams.hinh_anh',
            'bien_thes.ten_bien_the',
            'don_hangs.created_at'
        )
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'bien_thes.san_pham_id')
            ->where('don_hang_id', '=', $donHang->id)
            ->get();

        return view('clients.thanhtoans.dathangthanhcong', compact('donHang', 'chiTietDonHangs'));
    }
}
