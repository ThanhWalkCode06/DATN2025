<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperCommon\Helper;

class PaymentVnPay extends Controller
{
    public static function createPayment($donHang)
{
    $orderId = $donHang->id;
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://4f82-2001-ee0-40c1-ad4-703b-cfb4-ab8e-1bbd.ngrok-free.app/vnpay-return?ngrok-skip-browser-warning=true";
    $vnp_TmnCode = "HR1HQAXC";
    $vnp_HashSecret = "F2BM4S7G1E7CXMDUIXX97TFK2C7U79FR";

    $vnp_TxnRef = $orderId;
    $vnp_OrderInfo = "Thanh toán đơn hàng #$orderId";
    $vnp_Amount = $donHang->tong_tien * 100; // Đơn vị VNPAY là VND * 100
    $vnp_Locale = "vn";
    $vnp_BankCode = "";
    $vnp_IpAddr = request()->ip();

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return $vnp_Url;
}

public static function vnpayReturn(Request $request)
{
    $orderId = $request->vnp_TxnRef;
    $vnp_ResponseCode = $request->vnp_ResponseCode; // Mã phản hồi của VNPAY

    if ($vnp_ResponseCode == "00") { // Nếu thanh toán thành công
        try {
            DB::transaction(function () use ($orderId) {
                $order = DB::table('don_hangs')->where('id', $orderId)->lockForUpdate()->first();
                $product = DB::table('san_phams')->where('id', $order->product_id)->first();

                if ($product->stock >= $order->quantity) {
                    // Trừ kho và xác nhận đơn
                    DB::table('san_phams')->where('id', $order->product_id)->update([
                        'stock' => $product->stock - $order->quantity
                    ]);
                    DB::table('don_hangs')->where('id', $orderId)->update([
                        'status' => 'paid'
                    ]);

                    // ✅ Chuyển hướng tới trang đặt hàng thành công
                    return redirect()->route('thanhtoans.dathangthanhcong', ['id' => $orderId]);
                } else {
                    // Hết hàng, từ chối giao dịch
                    DB::table('don_hangs')->where('id', $orderId)->update([
                        'status' => 'failed'
                    ]);

                    return redirect()->route('thanhtoans.dathangthanhcong', ['id' => $orderId])
                        ->with('error', 'Sản phẩm đã hết hàng, đơn hàng không thể thanh toán.');
                }
            });
        } catch (\Exception $e) {
            return redirect()->route('thanhtoans.dathangthanhcong', ['id' => $orderId])
                ->with('error', 'Có lỗi xảy ra trong quá trình xử lý.');
        }
    } else {
        // Giao dịch bị hủy
        DB::table('don_hangs')->where('id', $orderId)->update(['status' => 'failed']);

        return redirect()->route('thanhtoans.dathangthanhcong', ['id' => $orderId])
            ->with('error', 'Thanh toán thất bại hoặc bị hủy.');
    }
}

}
