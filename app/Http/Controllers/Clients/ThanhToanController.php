<?php

namespace App\Http\Controllers\Clients;

use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\PhieuGiamGia;
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
        $checkquantity = Helper::checkQuantity($user->id);
        if($checkquantity == null){
            $donHang = null;
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

//     public function xuLyThanhToan(Request $request)
//     {
//         // return response()->json(['message' => $request->all()], 200);
//         $user = Auth::user();
//         if (!$user) {
//             return response()->json(['status' => 'error', 'message' => 'Chưa đăng nhập'], 403);
//         }

//         $giohang = ChiTietGioHang::where('user_id', $user->id)->first();
//         if (!$giohang) {
//             return response()->json(['status' => 'error', 'message' => 'Giỏ hàng trống'], 403);
//         }

//         $checkquantity = Helper::checkQuantity($user->id);
//         if ($checkquantity !== null) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Sản phẩm vượt quá số lượng tồn kho!',
//                 'over_quantity' => $checkquantity
//             ], 500);
//         }

//         if ($request->phuong_thuc_thanh_toan_id == "1") { // Thanh toán COD
//             $donHang = DonHang::create([
//                 'user_id' => $user->id,
//                 'ma_don_hang' => Helper::generateOrderCode(),
//                 'ten_nguoi_nhan' => $request->ten_nguoi_nhan,
//                 'email_nguoi_nhan' => $request->email_nguoi_nhan,
//                 'sdt_nguoi_nhan' => $request->sdt_nguoi_nhan,
//                 'dia_chi_nguoi_nhan' => $request->dia_chi_nguoi_nhan,
//                 'tong_tien' => $request->tong_tien,
//                 'ghi_chu' => $request->ghi_chu,
//                 'phuong_thuc_thanh_toan_id' => 1,
//                 'trang_thai_don_hang' => 0,
//                 'trang_thai_thanh_toan' => 0,
//                 'created_at' => now()
//             ]);
//             $this->xuLyChiTietDonHang($donHang, $request->voucher_code);
//             return response()->json(['status' => 'success', 'id' => $donHang->id], 200);
//         }

//         if ($request->phuong_thuc_thanh_toan_id == "2") { // Thanh toán VNPAY
//             $vnp_TmnCode = env('VNP_TMN_CODE');
//             $vnp_HashSecret = env('VNP_HASH_SECRET');
//             $vnp_Url = env('VNP_URL');
//             $vnp_ReturnUrl = env('VNP_RETURN_URL');

//             $vnp_TxnRef = Helper::generateOrderCode(); // Chưa tạo đơn hàng
//             $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
//             $vnp_OrderType = "billpayment";
//             $vnp_Amount = $request->tong_tien * 100;
//             $vnp_Locale = "vn";
//             $vnp_IpAddr = request()->ip();

//             $inputData = [
//                 "vnp_Version" => "2.1.0",
//                 "vnp_TmnCode" => $vnp_TmnCode,
//                 "vnp_Amount" => $vnp_Amount,
//                 "vnp_Command" => "pay",
//                 "vnp_CreateDate" => date('YmdHis'),
//                 "vnp_CurrCode" => "VND",
//                 "vnp_IpAddr" => $vnp_IpAddr,
//                 "vnp_Locale" => $vnp_Locale,
//                 "vnp_OrderInfo" => $vnp_OrderInfo,
//                 "vnp_OrderType" => $vnp_OrderType,
//                 "vnp_ReturnUrl" => $vnp_ReturnUrl . "?order_code=" . $vnp_TxnRef,
// "vnp_TxnRef" => $vnp_TxnRef
//             ];

//             ksort($inputData);
//             $query = "";
//             $hashdata = "";
//             foreach ($inputData as $key => $value) {
//                 $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
//                 $query .= urlencode($key) . "=" . urlencode($value) . '&';
//             }

//             $vnpSecureHash = hash_hmac('sha512', ltrim($hashdata, '&'), $vnp_HashSecret);
//             $vnp_Url .= "?" . $query . "vnp_SecureHash=" . $vnpSecureHash;

//             // Chuyển hướng thẳng đến VNPAY thay vì trả về JSON
//             return redirect()->away($vnp_Url);
//         }


//         // return response()->json(['status' => 'error', 'message' => 'Lỗi phương thức'], 500);
//     }
}
