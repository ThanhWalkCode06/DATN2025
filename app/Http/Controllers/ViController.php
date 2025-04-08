<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $query = $vi->giaodichs()->latest();

    // Lọc theo ngày nếu có
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

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

public function formNapTien() {
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

    if ($secureHash === $vnp_SecureHash && $request->vnp_ResponseCode == '00') {
        $user = Auth::user();
        $soTienNap = Session::pull('nap_tien_so_tien');

        if ($user && $soTienNap) {
            $user->vi->increment('so_du', $soTienNap);

            DB::table('giaodichvis')->insert([
                'vi_id' => $user->vi->id,
                'so_tien' => $soTienNap,
                'loai' => 'Nạp tiền',
                'mo_ta' => 'Nạp tiền qua VNPAY',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('vi')->with('success', 'Nạp tiền thành công!');
    }

    return redirect()->route('vi')->with('error', 'Nạp tiền thất bại!');
}

    


}
