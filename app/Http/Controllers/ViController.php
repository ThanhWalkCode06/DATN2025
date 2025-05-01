<?php

namespace App\Http\Controllers;

use App\Models\GiaoDichVi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ViController extends Controller
{
    public function hienThi(Request $request)
    {
        $user = Auth::user();
        $vi = $user->layHoacTaoVi();

        // Khởi tạo query giao dịch
        $query = $vi->giaodichs();

        // Lọc theo ngày nếu có
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Lọc theo trạng thái nếu có
        if ($request->filled('trang_thai') && in_array($request->trang_thai, ['0', '1', '2'])) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('loai')) {
            $query->where('loai', $request->loai);
        }
        // 👉 Ưu tiên trạng thái Chờ xử lý (0), sau đó theo thời gian
        // $query->orderByRaw("trang_thai = 0 DESC")
        //     ->orderBy('created_at', 'desc');
        $query->orderByRaw("
            CASE 
                WHEN trang_thai = 0 THEN 0
                ELSE 1
            END ASC,
            CASE 
                WHEN trang_thai = 0 THEN created_at
                ELSE NULL
            END ASC,
            CASE 
                WHEN trang_thai != 0 THEN created_at
                ELSE NULL
            END DESC
        ");

        // Phân trang kết quả
        $giaodichs = $query->paginate(10);

        return view('clients.vis.index', compact('vi', 'giaodichs'));
    }


    public function xuLyNapTien(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Bạn cần đăng nhập để nạp tiền'], 401);
        }

        $sotien = (int) $request->so_tien;

        if ($sotien <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Số tiền không hợp lệ'], 400);
        }


        if ($sotien > 10000000) {
            return response()->json(['status' => 'error', 'message' => 'Bạn chỉ có thể nạp tối đa 10 triệu mỗi lần'], 400);
        }

        // Lấy id ví
        $vi = $user->vi; // giả sử user có quan hệ 1-1 với bảng ví
        if (!$vi) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy ví'], 404);
        }

        // Tổng tiền đã nạp trong ngày
        $tongTrongNgay = GiaoDichVi::where('vi_id', $vi->id)
            ->where('loai', 'Nạp tiền')
            ->where('trang_thai', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('so_tien');

        if ($tongTrongNgay + $sotien > 10000000) {
            return response()->json(['status' => 'error', 'message' => 'Bạn chỉ được nạp tối đa 10 triệu mỗi ngày'], 400);
        }

        // Tổng tiền đã nạp trong tháng
        $tongTrongThang = GiaoDichVi::where('vi_id', $vi->id)
            ->where('loai', 'Nạp tiền')
            ->where('trang_thai', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('so_tien');

        if ($tongTrongThang + $sotien > 30000000) {
            return response()->json(['status' => 'error', 'message' => 'Bạn chỉ được nạp tối đa 30 triệu mỗi tháng'], 400);
        }

        // Lưu tạm số tiền nạp để xử lý sau khi thanh toán
        Session::put('nap_tien_so_tien', $sotien);

        // Gọi VNPAY
        $vnp_Url = config('services.vnpay.vnp_url');
        $vnp_TmnCode = config('services.vnpay.vnp_tmn_code');
        $vnp_HashSecret = config('services.vnpay.vnp_hash_secret');

        $vnp_ReturnUrl = config('services.vnpay.vnp_return_url'); // sử dụng từ .env
        $vnp_TxnRef = now()->timestamp;
        $vnp_OrderInfo = "Nạp tiền vào ví #$vnp_TxnRef";
        $vnp_OrderType = 'topup';
        $vnp_Amount = $sotien * 100;
        $vnp_Locale = 'vn';

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
            'status' => 'success',
            'url' => $vnp_Url
        ]);
    }

    public function formNapTien()
    {
        return view('clients.vis.nap_tien'); // tạo file này nếu chưa có
    }


    public function vnpayReturn(Request $request)
    {
        $inputData = $request->all();
        $vnp_HashSecret = config('services.vnpay.vnp_hash_secret');

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $query = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $query, $vnp_HashSecret);

        $soTienNap = Session::pull('nap_tien_so_tien');

        if ($secureHash === $vnp_SecureHash && $request->vnp_ResponseCode == '00') {
            $user = Auth::user();

            if ($user && $soTienNap) {
                $vi = $user->vi;
                $soDuTruoc = $vi->so_du;
                $soDuSau = $soDuTruoc + $soTienNap;

                // Cộng tiền
                $vi->increment('so_du', $soTienNap);

                // Ghi giao dịch
                DB::table('giaodichvis')->insert([
                    'vi_id' => $vi->id,

                    'ma_giao_dich' => $request->vnp_TxnRef,
                    'so_tien' => $soTienNap,
                    'loai' => 'Nạp tiền',
                    'mo_ta' => "💸 Nạp tiền qua VNPAY\n 💰 Số dư: " . number_format($soDuTruoc, 0, ',', '.') . " ➝ " . number_format($soDuSau, 0, ',', '.') . " VNĐ",


                    'trang_thai' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


            return redirect()->route('vi')->with('success', 'Nạp tiền thành công!');
        }

        // Trường hợp thất bại
        $user = Auth::user();
        if ($user && $soTienNap) {
            DB::table('giaodichvis')->insert([
                'vi_id' => $user->vi->id,
                'ma_giao_dich' => $request->vnp_TxnRef,
                'so_tien' => $soTienNap,
                'loai' => 'Nạp tiền',
                'mo_ta' => 'Nạp tiền thất bại qua VNPAY',
                'trang_thai' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('vi')->with('error', 'Nạp tiền thất bại!');
    }




    public function formRutTien(Request $request)
    {
        $nganHangs = config('nganhang');

        // Nếu có truyền mã ngân hàng trong request thì tìm tên
        $ten_ngan_hang = null;
        if ($request->has('nganhang')) {
            $ten_ngan_hang = collect($nganHangs)->firstWhere('code', $request->ngan_hang)['name'] ?? $request->ngan_hang;
        }

        return view('clients.vis.rut_tien', compact('nganHangs', 'ten_ngan_hang'));
    }






    public function xuLyRutTien(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để sử dụng chức năng này.');
        }

        $request->validate([
            'so_tien' => 'required|numeric|min:10000',
            'ten_ngan_hang' => 'required|string|max:255',
            'so_tai_khoan' => 'required|string|max:255',
            'ten_nguoi_nhan' => 'required|string|max:255',
        ]);

        $soTienRut = (int) $request->so_tien;
        $vi = $user->layHoacTaoVi();

        // Tính tổng số tiền của các giao dịch rút tiền đang chờ xử lý
        $tongTienDangCho = $vi->giaodichs()
            ->where('loai', 'Rút tiền')
            ->where('trang_thai', 0)
            ->sum('so_tien');

        // Kiểm tra tổng số tiền chờ + mới có vượt quá số dư không
        if (($tongTienDangCho + $soTienRut) > $vi->so_du) {
            return back()->with('error', 'Tổng số tiền các yêu cầu rút đang chờ vượt quá số dư ví của bạn.');
        }
        $maGiaoDich = strtoupper(Str::random(10)); // Ví dụ: 9KJL0PX2QZ

        // Ghi nhận yêu cầu rút tiền - CHƯA TRỪ TIỀN
        DB::table('giaodichvis')->insert([
            'vi_id' => $vi->id,
            'ma_giao_dich' => $maGiaoDich,
            'so_tien' => $soTienRut,
            'loai' => 'Rút tiền',

            'mo_ta' => "💸 Yêu cầu rút tiền\n"
                . "💰 Số dư hiện tại: " . number_format($vi->so_du, 0, ',', '.') . " VNĐ\n"
                . "🏦 Ngân hàng: {$request->ten_ngan_hang}\n"
                . "🔢 Số tài khoản: {$request->so_tai_khoan}\n"
                . "👤 Người nhận: {$request->ten_nguoi_nhan}",

            'trang_thai' => 0,
            'ten_ngan_hang' => $request->ten_ngan_hang,
            'so_tai_khoan' => $request->so_tai_khoan,
            'ten_nguoi_nhan' => $request->ten_nguoi_nhan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('vi')->with('success', 'Yêu cầu rút tiền đã được gửi. Vui lòng chờ xác nhận.');
    }

    // public function updateTrangThaiTungGiaoDich(Request $request)
    // {
    //     $giaoDich = GiaoDichVi::findOrFail($request->id);
    //     $trangThai = $request->input('trang_thai');
    //     $lyDoChung = $request->input('ly_do'); // lấy lý do nếu có
    //     $daXuLy = 0;
    //     if ($giaoDich->trang_thai != 0) {
    //         return back()->with('error', 'Chỉ có thể cập nhật giao dịch đang chờ xử lý.');
    //     }

    //     $giaoDich->trang_thai = $request->trang_thai;

    //     if ($giaoDich->loai === 'Rút tiền') {
    //         $vi = $giaoDich->vi;
    //         $vi->refresh(); 
    //         $soDuTruoc = $vi->so_du;

    //         if ($trangThai == 1) {
    //             // Duyệt rút
    //             if ($soDuTruoc >= $giaoDich->so_tien) {
    //                 $vi->so_du -= $giaoDich->so_tien;
    //                 $vi->save();
    //                 // $vi->refresh(); // Đảm bảo lấy số dư mới nhất
    //                 $giaoDich->mo_ta = "💸 Rút tiền từ ví\n"
    //                     . "💰Số dư: " . number_format($soDuTruoc, 0, ',', '.') . " ➝ " . number_format($vi->so_du, 0, ',', '.') . " VNĐ\n"
    //                     . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
    //                     . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
    //                     . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}";
    //                 $giaoDich->trang_thai = 1;
    //                 $giaoDich->save();
    //                 $daXuLy++;
    //             } else {
    //                 return back()->with('error', 'Ví không đủ số dư để duyệt rút tiền.');
    //             }

    //         } elseif ($trangThai == 2) {
    //             // Huỷ rút
    //             $vi->refresh(); // cập nhật lại số dư để hiển thị chính xác
    //             $giaoDich->trang_thai = 2;
    //             $giaoDich->mo_ta = "❌ Yêu cầu rút tiền đã bị huỷ\n"
    //                 . "⏱ Thời gian: " . now()->format('d/m/Y H:i') . "\n"
    //                 . "📝 Lý do: {$lyDoChung}\n"
    //                 . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
    //                 . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
    //                 . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}\n"
    //                 . "💰 Số dư hiện tại: " . number_format($giaoDich->vi->so_du, 0, ',', '.') . " VNĐ";
    //             $giaoDich->save();
    //             $daXuLy++;
    //         }
    //     } else {
    //         $giaoDich->trang_thai = $trangThai;
    //         $giaoDich->save();
    //         $daXuLy++;
    //     }
    //     $giaoDich->save();

    //     return back()->with('success', 'Cập nhật trạng thái thành công.');
    // }

    public function updateTrangThaiTungGiaoDich(Request $request)
    {
        try {
            $giaoDich = GiaoDichVi::findOrFail($request->id);
            $trangThai = $request->input('trang_thai');
            $lyDoChung = $request->input('ly_do'); // lấy lý do nếu có

            if ($giaoDich->trang_thai != 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chỉ có thể cập nhật giao dịch đang chờ xử lý.'
                ], 400);
            }

            if ($giaoDich->loai === 'Rút tiền') {
                $vi = $giaoDich->vi;
                $vi->refresh();
                $soDuTruoc = $vi->so_du;

                if ($trangThai == 1) {
                    // Duyệt rút tiền
                    if ($soDuTruoc >= $giaoDich->so_tien) {
                        $vi->so_du -= $giaoDich->so_tien;
                        $vi->save();

                        $giaoDich->mo_ta = "💸 Rút tiền từ ví\n"
                            . "💰Số dư: " . number_format($soDuTruoc, 0, ',', '.') . " ➝ " . number_format($vi->so_du, 0, ',', '.') . " VNĐ\n"
                            . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
                            . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
                            . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}";
                        $giaoDich->trang_thai = 1;
                        $giaoDich->save();
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Ví không đủ số dư để duyệt rút tiền.'
                        ], 400);
                    }
                } elseif ($trangThai == 2) {

                    // Huỷ rút tiền
                    $vi->refresh();
                    $giaoDich->trang_thai = 2;
                    $giaoDich->mo_ta = "❌ Yêu cầu rút tiền đã bị huỷ\n"
                        . "🕒 Thời gian huỷ: " . now()->format('H:i d/m/Y ') . "\n"
                        . "📝 Lý do: {$lyDoChung}\n"
                        . "🏦 Ngân hàng: {$giaoDich->ten_ngan_hang}\n"
                        . "🔢 Số tài khoản: {$giaoDich->so_tai_khoan}\n"
                        . "👤 Người nhận: {$giaoDich->ten_nguoi_nhan}\n"
                        . "💰 Số dư hiện tại: " . number_format($vi->so_du, 0, ',', '.') . " VNĐ";
                    $giaoDich->save();
                    // Trả về thông báo huỷ giao dịch
                    return response()->json([
                        'success' => 'success',
                        'message' => 'Huỷ giao dịch thành công.'
                    ]);
                }
            } else {

                // Giao dịch không phải rút tiền
                $giaoDich->trang_thai = $trangThai;
                $giaoDich->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật trạng thái thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi máy chủ: ' . $e->getMessage()
            ], 500);
        }
    }
}
