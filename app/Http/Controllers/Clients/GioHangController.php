<?php

namespace App\Http\Controllers\Clients;

use App\Models\BienThe;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperCommon\Helper;
use App\Models\PhieuGiamGia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GioHangController extends Controller
{
    public function gioHang()
    {
        $user = Auth::user();
        if($user){
            $chiTietGioHangs = $user->gioHang()->with('bienThe')->get();
        }else{
            $chiTietGioHangs = [];
        }
        // dd($chiTietGioHangs);

        return view('clients.thanhtoans.giohang', compact('chiTietGioHangs'));
    }
    public function storegioHang(Request $request){

        if(Auth::check()) {
            $userId = Auth::user()->id;
            $bienTheId = $request->id_bienthe;
            $quantity = $request->quantity;

            // Tìm sản phẩm trong giỏ hàng của user
            $chiTiet = ChiTietGioHang::where('user_id', $userId)
                ->where('bien_the_id', $bienTheId)
                ->first();


            // Lấy thông tin biến thể
            $bienThe = BienThe::find($bienTheId);

            if (!$bienThe) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Biến thể không tồn tại'
                ], 404);
            }

            if ($chiTiet) {
                // Kiểm tra số lượng tồn kho
                if ($chiTiet->so_luong + $quantity <= $bienThe->so_luong) {
                    $chiTiet->increment('so_luong', $quantity);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Tổng số lượng vượt quá kho'
                    ], 403);
                }
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                $chiTiet = ChiTietGioHang::create([
                    'user_id' => $userId,
                    'bien_the_id' => $bienTheId,
                    'so_luong' => $quantity,
                ]);
            }
            $userCart = ChiTietGioHang::where('user_id', $userId)->get();
            // Tính tổng giá tiền (có nhân với số lượng)
            $totalPrice = $userCart->sum(function ($item) {
                return ($item->bienThe->gia_ban ?? 0) * $item->so_luong;
            });

            // Tính tổng số sản phẩm trong giỏ hàng
            $totalItem = $userCart->count();

            return response()->json([
                'status' => 'success',
                'message' => 'Thêm vào giỏ hàng thành công!',
                "cart" => [
                    "totalItem" => $totalItem,
                    "totalPrice" => $totalPrice,
                    'items' => $userCart->map(function ($item) {
                        return [
                            'id' => optional($item->bienThe->sanPham)->id ?? 'Không xác định',
                            'id_cart' => $item->id ?? 'Không xác định',
                            'name' => optional($item->bienThe->sanPham)->ten_san_pham ?? 'Không xác định',
                            'name_bienthe' => $item->bienThe->ten_bien_the ?? 'Không xác định',
                            'image' => Storage::url(optional($item->bienThe)->anh_bien_the) ?? 'Không xác định',
                            'quantity' => $item->so_luong,
                            'price' => optional($item->bienThe)->gia_ban ?? 0,
                        ];
                    })
                ]
            ]);

        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn chưa đăng nhập'
            ], 403);
        }

    }

    public function xoagioHang(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'Bạn chưa đăng nhập'], 403);
    }

    $chiTiet = ChiTietGioHang::where('id', $request->id)
    ->where('user_id', $user->id)
    ->first();

    if ($chiTiet) {
        $chiTiet->delete();
        $userCart = ChiTietGioHang::where('user_id', $user->id)->get();
        $totalItem = ChiTietGioHang::where('user_id', $user->id)->count();

        $totalPrice =  $userCart->sum(fn($cartItem) => optional($cartItem->bienThe)->gia_ban * optional($cartItem)->so_luong ?? 0);
        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
            "totalItem" => $totalItem,
            'totalPrice' => $totalPrice,
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
}

public function nhapvoucher(Request $request){
    $code = $request->code;
    $currentTotal = (int) $request->total;
    $voucher = PhieuGiamGia::where('ma_phieu', $code)->first();

    $check = Helper::checkVoucher($code,Auth::user()->id);
    if($check != ''){
        return response()->json([
            'success' => false,
            'message' => 'Mã này bạn đã dùng trước đó!',
            'discount' => number_format(0, 0, ',', '.'),
            'newTotal' => number_format($currentTotal, 0, ',', '.')
        ],403);
    }

    if($voucher) {
        // $toiThieu = $voucher->muc_gia_toi_thieu;
        if(($currentTotal - 10000) < $voucher->muc_gia_toi_thieu){
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng phải tối thiểu '.number_format($voucher->muc_gia_toi_thieu,0,'','.').'đ ! (Không tính tiền ship)',
                'discount' => 0,
                'newTotal' => $currentTotal
            ],403);
        }

        if((empty($voucher->ngay_ket_thuc) && empty($voucher->ngay_bat_dau) &&  $voucher->trang_thai == 1) || ($voucher->ngay_ket_thuc > now() && $voucher->trang_thai == 1)) {
            $discount = $voucher->gia_tri;
            $discountAmount = $currentTotal * ($discount / 100);
            if($discountAmount >= $voucher->muc_giam_toi_da){
                $discountAmount = $voucher->muc_giam_toi_da;
            }
            $newTotal =  max(0, $currentTotal - $discountAmount);

            return response()->json([
                'success' => true,
                'discount' => number_format($discountAmount, 0, ',', '.'),
                'newTotal' => number_format($newTotal, 0, ',', '.')
            ]);
        }
        if($voucher->ngay_ket_thuc < now() || $voucher->trang_thai == 0){
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn!',
                'discount' => 0,
                'newTotal' => $currentTotal
            ],403);
        }
    }else{
        return response()->json([
            'success' => false,
            'message' => 'Mã giảm giá không tồn tại!',
            'discount' => 0,
            'newTotal' => $currentTotal
        ],403);
    }

}

public function acceptThanhToan(Request $request){
    $user = Auth::user();
    if($user){

        foreach ($request->cartData as $item) {
            $cartItem = ChiTietGioHang::where('user_id', $user->id)
                ->where('id', $item['id'])
                ->first();

            if ($cartItem) {
                $cartItem->update(['so_luong' => $item['quantity']]);
            } else {
                $mess = "Không tìm thấy sản phẩm có bien_the_id = ".$item['id']." và = cho user_id = $user->id";
            }
        }
        $userCart = ChiTietGioHang::where('user_id', $user->id)->get();
        $totalPrice =  $userCart->sum(fn($cartItem) => optional($cartItem->bienThe)->gia_ban * optional($cartItem)->so_luong ?? 0);
        return response()->json([
            'status' => 'success',
            'totalPrice' => $totalPrice,
            'message' => $mess ?? 0
        ]);
    }else{
        return response()->json([
            'status' => 'error',
            'message' => 'Bạn chưa đăng nhập'
        ], 403);
    }

}

}
