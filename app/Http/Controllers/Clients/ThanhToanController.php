<?php

namespace App\Http\Controllers\Clients;

use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\ThongBao;
use Illuminate\Support\Str;
use App\Events\DatHangEvent;
use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\DB;
use App\Models\PhuongThucThanhToan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PhieuGiamGiaTaiKhoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HelperCommon\Helper;
use App\Http\Requests\Client\ThanhToanRequest;

class ThanhToanController extends Controller
{
    public function gioHang()
    {
        $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the', 'bien_thes.anh_bien_the')
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        // dd($chiTietGioHangs);

        return view('clients.thanhtoans.giohang', compact('chiTietGioHangs'));
    }

    public function thanhToan()
    {
        if (Auth::check()) {
            $chiTietGioHangs = ChiTietGioHang::select('chi_tiet_gio_hangs.*', 'san_phams.ten_san_pham', 'san_phams.san_pham_slug', 'san_phams.gia_cu', 'san_phams.hinh_anh', 'bien_thes.ten_bien_the', 'bien_thes.anh_bien_the')
                ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
                ->join('san_phams', 'san_phams.id', '=', 'san_pham_id')
                ->where('user_id', '=', Auth::user()->id)
                ->get();
            $pttts = PhuongThucThanhToan::all()->toArray();
        } else {
            return view('clients.auth.login');
        }

        return view('clients.thanhtoans.thanhtoan', compact('chiTietGioHangs', 'pttts'));
    }

    public function xuLyThanhToan(ThanhToanRequest $request)
    {
        // return response()->json(['status' => 'success', 'message'=> $request->all()],200);
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Người dùng chưa đăng nhập'], 403);
        }

        $bienThes = BienThe::all();
        $giohang = ChiTietGioHang::where('user_id', Auth::user()->id)->first();
        if (!$giohang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Giỏ hàng trống'
            ], 403);
        }
        $checkquantity = Helper::checkQuantity($user->id);
        if ($checkquantity !== null) {

            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm vượt quá số lượng tồn kho!',
                'over_quantity' => $checkquantity
            ], 500);
        }

        // Thanh toán tiền mặt
        if ($request->phuong_thuc_thanh_toan_id === "1") {
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

            ThongBao::create([
                'user_id' => 1,
                'noi_dung' => 'Có đơn hàng mới: #' . $donHang->ma_don_hang,
                'id_dinh_kem' => $donHang->id,
                'trang_thai' => 0
            ]);

            $this->thongBaoDatHang($donHang);

            // Xử lý voucher nếu có
            if (!empty($request->voucher_code) && $request->giam_gia !== "0") {
                $idVoucher = PhieuGiamGia::where('ma_phieu', $request->voucher_code)->first();
                if ($idVoucher && !str_starts_with($request->voucher_code, 'BIRTHDAY')) {
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else if ($idVoucher && str_starts_with($request->voucher_code, 'BIRTHDAY') && $idVoucher->trang_thai != 0) {
                    $idVoucher->trang_thai = 0;
                    $idVoucher->save();
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Mã giảm giá đã được sử dụng hoặc hết hạn trước đó',
                    ], 500);
                }
            }

            // Chuyển giỏ hàng vào đơn hàng
            $cart = ChiTietGioHang::with('user', 'bienThe')->where('user_id', $user->id)->get();
            foreach ($cart as $item) {
                ChiTietDonHang::create([
                    'don_hang_id' => $donHang->id,
                    'bien_the_id' => $item->bienThe->id,
                    'so_luong' => $item->so_luong,
                    'created_at' => now()
                ]);

                // Cập nhật số lượng tồn kho
                BienThe::where('id', $item->bienThe->id)->update([
                    'so_luong' => DB::raw('so_luong - ' . $item->so_luong)
                ]);
            }

            // Xóa giỏ hàng
            $cart->each->delete();

            return response()->json(['status' => 'success', 'id' => $donHang->id], 200);
        }

        // Thanh toán qua VNPAY
        if ($request->phuong_thuc_thanh_toan_id === "2") {
            if (!empty($request->voucher_code) && $request->giam_gia !== "0") {
                $idVoucher = PhieuGiamGia::where('ma_phieu', $request->voucher_code)->first();
                if ($idVoucher) {
                    Session::put("voucher", $idVoucher->id);
                }
            }

            // return response()->json(['status' => 'success', 'message' => $request->voucher], 200);
            // dd($request->vourcher,1);

            Session::put("ten_nguoi_nhan", $request->ten_nguoi_nhan);
            Session::put("email_nguoi_nhan", $request->email_nguoi_nhan);
            Session::put("sdt_nguoi_nhan", $request->sdt_nguoi_nhan);
            Session::put("dia_chi_nguoi_nhan", $request->dia_chi_nguoi_nhan);

            $vnp_Url = config('services.vnpay.vnp_url');
            $vnp_TmnCode = config('services.vnpay.vnp_tmn_code');
            $vnp_HashSecret = config('services.vnpay.vnp_hash_secret');

            $vnp_ReturnUrl = route('vnpay.return');
            $vnp_TxnRef = now()->timestamp;
            $vnp_OrderInfo = "Thanh toán đơn hàng #$vnp_TxnRef";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->tong_tien * 100; // VNPAY nhận VNĐ x100
            $vnp_Locale = 'vn';
            $vnp_BankCode = '';

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => request()->ip(),
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            ksort($inputData);
            $query = http_build_query($inputData);
            $vnpSecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);
            $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;

            return response()->json([
                'status' => 'vnpay',
                'vnpay_url' => $vnp_Url,
            ]);
        }

        // Thanh toán bằng ví
        if ($request->phuong_thuc_thanh_toan_id === "3") {
            $soDu = $user->vi->so_du ?? 0;
            $tongTien = $request->tong_tien;

            if ($soDu < $tongTien) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Số dư ví không đủ để thanh toán đơn hàng. Số dư hiện tại: ' . number_format($soDu, 0, ',', '.') . ' VNĐ.'
                ], 400);
            }

            // Lưu số dư trước
            $soDuTruoc = $soDu;
            $soDuSau = $soDuTruoc - $tongTien;

            // Trừ tiền trong ví
            $user->vi->decrement('so_du', $tongTien);

            // Tạo đơn hàng
            $donHang = DonHang::create([
                'user_id' => $user->id,
                'ma_don_hang' => Helper::generateOrderCode(),
                'ten_nguoi_nhan' => $request->ten_nguoi_nhan,
                'email_nguoi_nhan' => $request->email_nguoi_nhan,
                'sdt_nguoi_nhan' => $request->sdt_nguoi_nhan,
                'dia_chi_nguoi_nhan' => $request->dia_chi_nguoi_nhan,
                'tong_tien' => $tongTien,
                'ghi_chu' => $request->ghi_chu,
                'phuong_thuc_thanh_toan_id' => 3,
                'trang_thai_don_hang' => 0,
                'trang_thai_thanh_toan' => 1,
                'created_at' => now()
            ]);

            ThongBao::create([
                'user_id' => 1,
                'noi_dung' => 'Có đơn hàng mới: #' . $donHang->ma_don_hang,
                'id_dinh_kem' => $donHang->id,
                'trang_thai' => 0
            ]);

            $maGiaoDich = strtoupper(Str::random(10)); // Ví dụ: 9KJL0PX2QZ

            // Lưu giao dịch ví
            DB::table('giaodichvis')->insert([
                'vi_id' => $user->vi->id,
                'ma_giao_dich' =>  $maGiaoDich,
                'so_tien' => -$tongTien,
                'loai' => 'Mua hàng',
                'mo_ta' => '🛒 Mua hàng | Đơn #' . $donHang->ma_don_hang
                    . "\n💰 Số dư: " . number_format($soDuTruoc, 0, ',', '.')
                    . ' ➝ ' . number_format($soDuSau, 0, ',', '.') . ' VNĐ',

                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Gửi thông báo
            $this->thongBaoDatHang($donHang);

            // Lưu voucher nếu có
            if (!empty($request->voucher_code) && $request->giam_gia !== "0") {
                $idVoucher = PhieuGiamGia::where('ma_phieu', $request->voucher_code)->first();
                if ($idVoucher && !str_starts_with($request->voucher_code, 'BIRTHDAY')) {
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else if ($idVoucher && str_starts_with($request->voucher_code, 'BIRTHDAY') && $idVoucher->trang_thai != 0) {
                    $idVoucher->trang_thai = 0;
                    $idVoucher->save();
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Mã giảm giá đã được sử dụng hoặc hết hạn trước đó',
                    ], 500);
                }
            }

            // Thêm chi tiết đơn hàng từ giỏ hàng
            $cart = ChiTietGioHang::with('user', 'bienThe')->where('user_id', $user->id)->get();
            foreach ($cart as $item) {
                ChiTietDonHang::create([
                    'don_hang_id' => $donHang->id,
                    'bien_the_id' => $item->bienThe->id,
                    'so_luong' => $item->so_luong,
                    'created_at' => now()
                ]);

                BienThe::where('id', $item->bienThe->id)->update([
                    'so_luong' => DB::raw('so_luong - ' . $item->so_luong)
                ]);
            }

            // Xóa giỏ hàng
            $cart->each->delete();

            return response()->json([
                'status' => 'success',
                'id' => $donHang->id,
                'message' => 'Thanh toán bằng ví thành công.',
                'so_du_con_lai' => number_format($user->vi->fresh()->so_du, 0, ',', '.') . ' VNĐ'
            ], 200);
        }



        return response()->json(['status' => 'error', 'message' => 'Lỗi phương thức'], 500);
    }


    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") { // Thanh toán thành công
            $user = Auth::user();

            // Lấy giỏ hàng của người dùng trước khi xóa
            $cart = ChiTietGioHang::with('bienThe.sanPham')->where('user_id', $user->id)->get();

            // Tạo đơn hàng mới
            $donHang = DonHang::create([
                'user_id' => $user->id,
                'ma_don_hang' => $request->vnp_TxnRef,
                'ten_nguoi_nhan' => Session::pull("ten_nguoi_nhan"),
                'tong_tien' => $request->vnp_Amount / 100,
                'email_nguoi_nhan' => Session::pull("email_nguoi_nhan"),
                'sdt_nguoi_nhan' => Session::pull("sdt_nguoi_nhan"),
                'dia_chi_nguoi_nhan' => Session::pull("dia_chi_nguoi_nhan"),
                'phuong_thuc_thanh_toan_id' => 2,
                'trang_thai_don_hang' => 0,
                'trang_thai_thanh_toan' => 1, // Đã thanh toán
                'created_at' => now()
            ]);

            ThongBao::create([
                'user_id' => 1,
                'noi_dung' => 'Có đơn hàng mới: #' . $donHang->ma_don_hang,
                'id_dinh_kem' => $donHang->id,
                'trang_thai' => 0
            ]);

            $this->thongBaoDatHang($donHang);

            if (Session::has('voucher')) {
                $voucherId = Session::get('voucher');
                $idVoucher = PhieuGiamGia::where('id', $voucherId)->first();
                Session::forget("voucher");
                if ($idVoucher && !str_starts_with($idVoucher->ma_phieu, 'BIRTHDAY')) {
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else if ($idVoucher && str_starts_with($idVoucher->ma_phieu, 'BIRTHDAY') && $idVoucher->trang_thai != 0) {
                    $idVoucher->trang_thai = 0;
                    $idVoucher->save();
                    DB::table('phieu_giam_gia_tai_khoans')->insert([
                        'phieu_giam_gia_id' => $idVoucher->id,
                        'user_id' => $user->id,
                        'order_id' => $donHang->id,
                        'created_at' => now(),
                    ]);
                } else {
                    $donHang->delete();
                    return redirect('/thanhtoan')->with('error', 'Voucher đã được áp dụng trước đó hoặc hết hạn!');
                }
            }

            // Duyệt qua từng sản phẩm trong giỏ hàng để thêm vào chi tiết đơn hàng
            foreach ($cart as $item) {
                ChiTietDonHang::create([
                    'don_hang_id' => $donHang->id,
                    'bien_the_id' => $item->bien_the_id,
                    'so_luong' => $item->so_luong,
                    'san_pham_id' => $item->san_pham_id,
                    'created_at' => now()
                ]);

                $bienThe = BienThe::where('id', $item->bien_the_id)->first();

                if ($bienThe->so_luong >= $item->so_luong) {
                    $bienThe->decrement('so_luong', $item->so_luong);
                } else {
                    ChiTietDonHang::where('don_hang_id', $donHang->id)->delete();
                    $donHang->delete();
                    return redirect('/thanhtoan')->with('error', "Sản phẩm {$item->bienThe->sanPham->ten_san_pham} {$item->bienThe->ten_bien_the} không đủ hàng!");
                }
            }

            // Xóa giỏ hàng sau khi đã lưu bản sao
            ChiTietGioHang::where('user_id', $user->id)->delete();

            // Lấy lại chi tiết đơn hàng để gửi về view
            $chiTietDonHangs = ChiTietDonHang::where('id', $donHang->id)->get();
            return redirect()->route('thanhtoans.dathangthanhcong', $donHang->id);
        } else {
            return redirect('/thanhtoan')->with('error', 'Thanh toán thất bại!');
        }
    }

    public function datHangThanhCong(Request $request, string $id)
    {
        $donHang = DonHang::select('don_hangs.*', 'phuong_thuc_thanh_toans.ten_phuong_thuc')
            ->join('phuong_thuc_thanh_toans', 'phuong_thuc_thanh_toans.id', '=', 'phuong_thuc_thanh_toan_id')
            ->where('don_hangs.id', '=', $id)
            ->find($id);

        $voucher = PhieuGiamGiaTaiKhoan::with('phieuGiamGia')->where('order_id', $id)->first();
        // dd($voucher->phieuGiamGia->ma_phieu);
        $chiTietDonHangs = ChiTietDonHang::select(
            'chi_tiet_don_hangs.*',
            'san_phams.ten_san_pham',
            'san_phams.id',
            'san_phams.san_pham_slug',
            'san_phams.gia_cu',
            'bien_thes.gia_ban',
            'san_phams.hinh_anh',
            'bien_thes.ten_bien_the',
            'bien_thes.anh_bien_the',
            'don_hangs.created_at'
        )
            ->join('bien_thes', 'bien_thes.id', '=', 'bien_the_id')
            ->join('san_phams', 'san_phams.id', '=', 'bien_thes.san_pham_id')
            ->join('don_hangs', 'don_hangs.id', '=', 'bien_thes.san_pham_id')
            ->where('don_hang_id', '=', $donHang->id)
            ->get();

        return view('clients.thanhtoans.dathangthanhcong', compact('donHang', 'chiTietDonHangs', 'voucher'));
    }

    public function thongBaoDatHang($donHang)
    {
        broadcast(new DatHangEvent($donHang))->toOthers();
        return response()->json(['message' => 'Đơn hàng đã đặt thành công!', 'order' => $donHang]);
    }
}
