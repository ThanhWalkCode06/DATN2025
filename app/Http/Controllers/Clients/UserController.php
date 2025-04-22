<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\BienThe;
use App\Models\DonHang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LichSuDonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Client\UserRequest;
use App\Models\PhieuGiamGiaTaiKhoan;

class UserController extends Controller
{
    public function chiTiet()
    {
        $user = Auth::user();
        // dd($user);
        $donHangsPaginate = $user->donHangs()
            ->orderBy('id', 'desc')
            ->paginate(8);

        $i = 0;
        if ($user) {
            foreach ($donHangsPaginate as $item) {
                $i += ($item->trang_thai_don_hang == 0) ? 1 : 0;
            }
            return view('clients.users.chitiet', compact('user', 'i', 'donHangsPaginate'));
        } else {
            return redirect()->route('login.client');
        }
    }

    public function updateInfor(UserRequest $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        // dd(file_exists(storage_path("app/public/user".Auth::user()->anh_dai_dien)));
        if ($request->hasFile('anh_dai_dien')) {
            if (Auth::user()->anh_dai_dien && file_exists(storage_path("app/public/" . Auth::user()->anh_dai_dien)) && !file_exists(storage_path("app/public/images"))) {
                unlink(storage_path('app/public/' . Auth::user()->anh_dai_dien));
            }
            $fileName = time() . '_' . $request->file('anh_dai_dien')->getClientOriginalName();
            $request->file('anh_dai_dien')->storeAs("public/uploads/user/", $fileName);
            $data['anh_dai_dien'] = 'uploads/user/' . $fileName;
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function orderTracking(string $id)
    {
        if (Auth::user()) {
            $donHang = DonHang::where('id', $id)->first();
            $lichSuDonHangs = LichSuDonHang::where('don_hang_id', '=', $id)->get();
            if ($donHang) {
                $checkVoucher = PhieuGiamGiaTaiKhoan::with('phieuGiamGia')->where('order_id', $donHang->id)->first();
                // dd($donHang);
                $bienThes = DonHang::where('id', $id)->with('bienThes')->first();
                $bienThesPaginated = $bienThes->bienThes()->paginate(5);

                $bienThesList = $bienThesPaginated->map(fn($bienThe) => [
                    'bien_the_id' => $bienThe->id,
                    'anh_bien_the' => $bienThe->anh_bien_the,
                    'ten_bien_the' => $bienThe->sanPham->ten_san_pham . ' - ' . $bienThe->ten_bien_the,
                    'gia_ban' => $bienThe->gia_ban,
                    'so_luong' => $bienThe->pivot->so_luong,
                    'id_san_pham' => $bienThe->san_pham_id,
                ]);
                // dd($bienThesList);
                return view('clients.users.ordertracking', compact('donHang', 'lichSuDonHangs', 'bienThesList', 'bienThesPaginated', 'checkVoucher'));
            } else {
                abort(404);
            }
        } else {
            return redirect()->route('login.client');
        }
    }

    public function updateTrangThai(Request $request, string $id)
    {
        // Tìm đơn hàng
        $donHang = DonHang::find($id);

        if ($donHang) {
            // Xác nhận Hủy hàng
            if ($request->trang_thai == -1) {
                // Kiểm tra trạng thái thanh toán và trạng thái đơn hàng
                if ($donHang->trang_thai_don_hang <= 1) { // Đơn hàng chưa giao (chưa hoàn thành)
                    // Trường hợp chưa thanh toán
                    if ($donHang->trang_thai_thanh_toan == 0) {
                        // Hủy đơn hàng mà không cần hoàn tiền
                        $chiTietDonHangs = ChiTietDonHang::where('don_hang_id', $donHang->id)->get();
                        foreach ($chiTietDonHangs as $chiTiet) {
                            $bienThe = BienThe::find($chiTiet->bien_the_id);
                            if ($bienThe) {
                                $bienThe->increment('so_luong', $chiTiet->so_luong);
                            }
                        }

                        // Cập nhật trạng thái đơn hàng
                        $donHang->update([
                            "trang_thai_don_hang" => $request->trang_thai,
                            "ly_do" => $request->ly_do
                        ]);

                        $lichSuDonHang = [
                            'don_hang_id' => $donHang->id,
                            'trang_thai' => $request->trang_thai
                        ];

                        LichSuDonHang::create($lichSuDonHang);

                        return redirect()->back()->with('success', 'Huỷ đơn hàng thành công');
                    }

                    // Trường hợp đã thanh toán
                    if ($donHang->trang_thai_thanh_toan == 1) {
                        // Lấy ví người dùng
                        $nguoiDung = $donHang->nguoiDung;
                        $vi = $nguoiDung->vi ?? $nguoiDung->vi()->create(['so_du' => 0]);

                        // Cộng lại tiền vào ví nếu đơn hàng đã thanh toán
                        $vi->so_du += $donHang->tong_tien;
                        $vi->save();

                        // Ghi log giao dịch hoàn tiền với mô tả đầy đủ
                        $soDuTruoc = $vi->so_du - $donHang->tong_tien; // vì đã cộng tiền trước đó
                        $maGiaoDich = strtoupper(Str::random(10)); // Ví dụ: 9KJL0PX2QZ
                        $vi->giaodichs()->create([
                            'so_tien' => $donHang->tong_tien,
                            'ma_giao_dich' => $maGiaoDich,
                            'loai' => 'Hoàn tiền',
                            'trang_thai' => 1,
                            'mo_ta' => "↩️ Hoàn tiền do hủy đơn hàng {$donHang->ma_don_hang}\n 💰 Số dư: "
                                . number_format($soDuTruoc, 0, ',', '.')
                                . " ➝ "
                                . number_format($vi->so_du, 0, ',', '.')
                                . " VNĐ",
                        ]);

                        // Hoàn lại số lượng sản phẩm trong kho
                        $chiTietDonHangs = ChiTietDonHang::where('don_hang_id', $donHang->id)->get();
                        foreach ($chiTietDonHangs as $chiTiet) {
                            $bienThe = BienThe::find($chiTiet->bien_the_id);
                            if ($bienThe) {
                                $bienThe->increment('so_luong', $chiTiet->so_luong);
                            }
                        }

                        // Cập nhật trạng thái đơn hàng
                        $donHang->update([
                            "trang_thai_don_hang" => $request->trang_thai,
                            "ly_do" => $request->ly_do
                        ]);


                        // Kiểm tra số dư ví sau khi hoàn tiền
                        $soDu = number_format($vi->so_du, 0, ',', '.');

                        // Thông báo cho người dùng về số dư hiện tại
                        return redirect()->back()->with('success', 'Huỷ đơn hàng thành công. Số dư ví hiện tại của bạn là: 💰' . $soDu . ' VNĐ');
                    }
                } else {
                    return redirect()->back()->with('error', 'Không thể hủy đơn hàng khi trạng thái không phù hợp');
                }
            }

            // trả hàng
            if ($request->trang_thai == 5) {
                if ($donHang->trang_thai_don_hang == 3) {
                    // Trả hàng vào kho
                    $chiTietDonHangs = ChiTietDonHang::where('don_hang_id', $donHang->id)->get();
                    foreach ($chiTietDonHangs as $chiTiet) {
                        $bienThe = BienThe::find($chiTiet->bien_the_id);
                        if ($bienThe) {
                            $bienThe->increment('so_luong', $chiTiet->so_luong);
                        }
                    }

                    // Nếu đã thanh toán, hoàn tiền vào ví (chỉ với VNPAY hoặc Ví)
                    if ($donHang->trang_thai_thanh_toan == 1 && in_array($donHang->phuong_thuc_thanh_toan_id, [2, 3])) {
                        $user = $donHang->nguoiDung;

                        // Cộng tiền vào ví
                        $user->vi->increment('so_du', $donHang->tong_tien);
                        $soDuMoi = $user->vi->so_du;

                        // Ghi lịch sử hoàn tiền
                        $soDuTruoc = $soDuMoi - $donHang->tong_tien;
                        $maGiaoDich = strtoupper(Str::random(10)); // Ví dụ: 9KJL0PX2QZ
                        DB::table('giaodichvis')->insert([
                            'vi_id' => $user->vi->id,
                            'ma_giao_dich' => $maGiaoDich,
                            'so_tien' => $donHang->tong_tien,
                            'loai' => 'Hoàn tiền',
                            'trang_thai' => 1,
                            'mo_ta' => "↩️ Hoàn tiền do trả đơn hàng {$donHang->ma_don_hang}\n 💰 Số dư: "
                                . number_format($soDuTruoc, 0, ',', '.')
                                . " ➝ "
                                . number_format($soDuMoi, 0, ',', '.')
                                . " VNĐ",
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        // Gửi thông báo thành công và hiển thị số dư
                        session()->flash('success', 'Đơn hàng đã được trả và hoàn tiền thành công. Số dư ví hiện tại: ' . number_format($soDuMoi, 0, ',', '.') . ' VNĐ');
                    } else {
                        session()->flash('success', 'Đơn hàng đã được trả thành công.');
                    }


                    // Cập nhật trạng thái đơn hàng
                    $donHang->update([
                        "trang_thai_don_hang" => $request->trang_thai,
                        "trang_thai_thanh_toan" => 2,
                        "ly_do" => $request->ly_do,
                    ]);

                    $lichSuDonHang = [
                        'don_hang_id' => $donHang->id,
                        'trang_thai' => $request->trang_thai
                    ];

                    LichSuDonHang::create($lichSuDonHang);

                    return redirect()->back();
                }
            }


            // Trạng thái đơn hàng là "đã giao" (trạng thái = 4)
            if ($request->trang_thai == 4) {
                if ($donHang->trang_thai_don_hang == 3) {
                    $donHang->update([
                        "trang_thai_don_hang" => $request->trang_thai
                    ]);

                    $lichSuDonHang = [
                        'don_hang_id' => $donHang->id,
                        'trang_thai' => $request->trang_thai
                    ];

                    LichSuDonHang::create($lichSuDonHang);
                    return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
                }
            }

            return redirect()->back()->with('error', 'Cập nhật trạng thái đơn hàng thất bại');
        } else {
            abort(404);
        }
    }
}
