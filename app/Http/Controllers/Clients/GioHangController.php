<?php

namespace App\Http\Controllers\Clients;

use App\Models\BienThe;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use App\Http\Controllers\Controller;
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
                            'image' => Storage::url(optional($item->bienThe->sanPham)->hinh_anh) ?? 'Không xác định',
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
        $totalPrice =  $userCart->sum(fn($cartItem) => optional($cartItem->bienThe)->gia_ban ?? 0);
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

    if (!$voucher || $voucher->ngay_ket_thuc < now() || $voucher->trang_thai == 0) {
        return response()->json([
            'success' => false,
            'message' => 'Mã giảm giá không tồn tại hoặc đã hết hạn!'
        ],403);
    }

    // Giả sử giảm giá 10% tổng đơn hàng
    $discount = $voucher->gia_tri;
    $discountAmount = $currentTotal * ($discount / 100);
    $newTotal =  max(0, $currentTotal - $discountAmount);

    return response()->json([
        'success' => true,
        'discount' => number_format($discountAmount, 0, ',', '.'),
        'newTotal' => number_format($newTotal, 0, ',', '.')
    ]);
}

}
