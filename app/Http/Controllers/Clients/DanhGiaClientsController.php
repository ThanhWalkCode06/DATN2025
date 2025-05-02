<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\BienThe;
use App\Models\DanhGia;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DanhGiaClientsController extends Controller
{
    // public function danhSachDanhGia($san_pham_id)
    // {
    //     $danhGias = DanhGia::where('san_pham_id', $san_pham_id)
    //         ->where('trang_thai', 1) // Chỉ lấy đánh giá có trạng thái hiển thị
    //         // ->with(['nguoiDung', 'bienThe'])
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return response()->json($danhGias);
    // }
    public function danhSachDanhGia($san_pham_id, Request $request)
    {
        $perPage = 10; // Số bản ghi mỗi trang
        $danhGias = DanhGia::where('san_pham_id', $san_pham_id)
            ->where('trang_thai', 1)
            ->with(['nguoiDung', 'bienThe'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'danhGias' => $danhGias->items(),
            'current_page' => $danhGias->currentPage(),
            'last_page' => $danhGias->lastPage(),
            'total' => $danhGias->total(),
            'per_page' => $danhGias->perPage(),
        ]);
    }

    public function kiemTraQuyenDanhGia($san_pham_id, $don_hang_id = null)
    {
        if (!Auth::check()) {
            return false; // Chưa đăng nhập
        }

        $user = User::with(['donHangs.chiTietDonHangs'])->find(Auth::id());
        if (!$user) {
            return false; // Người dùng không tồn tại
        }

        // Lấy danh sách biến thể của sản phẩm
        $idBienThes = BienThe::where('san_pham_id', $san_pham_id)->pluck('id')->toArray();
        if (empty($idBienThes)) {
            return false; // Không có biến thể
        }

        // Kiểm tra các biến thể đã mua trong đơn hàng cụ thể (nếu có)
        $bienTheDaMua = [];
        foreach ($user->donHangs as $donHang) {
            if ($donHang->trang_thai_don_hang == 4 && (!$don_hang_id || $donHang->id == $don_hang_id)) {
                $bienTheTrongDon = $donHang->chiTietDonHangs
                    ->whereIn('bien_the_id', $idBienThes)
                    ->pluck('bien_the_id')
                    ->unique();

                foreach ($bienTheTrongDon as $bienTheId) {
                    $bienTheDaMua[$bienTheId] = ($bienTheDaMua[$bienTheId] ?? 0) + 1;
                }
            }
        }

        return !empty($bienTheDaMua); // Trả về true nếu có ít nhất một biến thể đã mua
    }

    public function themDanhGia(Request $request, $san_pham_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
        }

        $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])->find(Auth::id());

        if (!$user) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Người dùng không tồn tại.');
        }

        // Lấy danh sách biến thể của sản phẩm hiện tại
        $idBienThes = BienThe::where('san_pham_id', $san_pham_id)->pluck('id')->toArray();

        if (empty($idBienThes)) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Sản phẩm này không có biến thể để đánh giá.');
        }

        // Tìm các biến thể đã mua
        $bienTheDaMua = [];
        foreach ($user->donHangs as $donHang) {
            if ($donHang->trang_thai_don_hang == 4) {
                $bienTheTrongDon = $donHang->chiTietDonHangs
                    ->whereIn('bien_the_id', $idBienThes)
                    ->pluck('bien_the_id')
                    ->unique();

                foreach ($bienTheTrongDon as $bienTheId) {
                    $bienTheDaMua[$bienTheId] = ($bienTheDaMua[$bienTheId] ?? 0) + 1;
                }
            }
        }

        // Nếu nhiều biến thể và chưa chọn → bắt chọn
        if (count($bienTheDaMua) > 1 && !$request->filled('bien_the_id')) {
            session()->put('bienTheDaMua_' . $san_pham_id, $bienTheDaMua);
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('chophep_danhgia', true)
                ->with('error_binhluan', 'Vui lòng chọn biến thể bạn muốn đánh giá.');
        }

        // Nếu chỉ có 1 biến thể → tự động gán
        $bienTheId = $request->input('bien_the_id') ?? array_key_first($bienTheDaMua);

        if (!$bienTheId || !isset($bienTheDaMua[$bienTheId])) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn chưa mua biến thể này.');
        }

        // Kiểm tra số lượt đã đánh giá
        $soLuotDaDanhGia = DanhGia::where('user_id', $user->id)
            ->where('san_pham_id', $san_pham_id)
            ->where('bien_the_id', $bienTheId)
            ->count();

        if ($soLuotDaDanhGia >= $bienTheDaMua[$bienTheId]) {
            return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
                ->with('error_binhluan', 'Bạn đã đánh giá đủ số lượt cho biến thể này. Hãy mua thêm để tiếp tục đánh giá.');
        }

        $request->validate([
            'so_sao' => 'required|integer|min:1|max:5',
            'nhan_xet' => 'nullable|string'
        ]);

        DanhGia::create([
            'user_id' => $user->id,
            'san_pham_id' => $san_pham_id,
            'bien_the_id' => $bienTheId,
            'so_sao' => $request->so_sao,
            'nhan_xet' => $request->nhan_xet ?? '',
            'trang_thai' => 1
        ]);

        // Xoá session sau khi đánh giá xong để tránh lỗi khi chuyển sản phẩm
        session()->forget('bienTheDaMua_' . $san_pham_id);

        return redirect()->route('sanphams.chitiet', ['id' => $san_pham_id])
            ->with('success', 'Gửi đánh giá thành công.')
            ->with('daMuaHang', true);
    }


    public function themDanhGiaDonHang(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
    }

    $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])->find(Auth::id());
    if (!$user) {
        return redirect()->back()->with('error_binhluan', 'Người dùng không tồn tại.');
    }

    $sanPhamId = $request->input('san_pham_id');
    $bienTheId = $request->input('bien_the_id');
    $donHangId = $request->input('don_hang_id'); // Nhận don_hang_id từ form

    // Kiểm tra sản phẩm và biến thể
    $sanPham = SanPham::find($sanPhamId);
    $bienThe = BienThe::find($bienTheId);
    if (!$sanPham || !$bienThe || $bienThe->san_pham_id != $sanPhamId) {
        return redirect()->back()->with('error_binhluan', 'Sản phẩm hoặc biến thể không hợp lệ.');
    }

    // Kiểm tra đơn hàng
    $donHang = DonHang::find($donHangId);
    if (!$donHang || $donHang->user_id != $user->id || $donHang->trang_thai_don_hang != 4) {
        return redirect()->back()->with('error_binhluan', 'Đơn hàng không hợp lệ hoặc chưa hoàn thành.');
    }

    // Kiểm tra biến thể trong đơn hàng
    $bienTheDaMua = $donHang->chiTietDonHangs
        ->where('bien_the_id', $bienTheId)
        ->pluck('bien_the_id')
        ->unique();

    if (!$bienTheDaMua->contains($bienTheId)) {
        return redirect()->back()->with('error_binhluan', 'Bạn chưa mua biến thể này trong đơn hàng này.');
    }

    // Kiểm tra xem đã đánh giá biến thể này trong đơn hàng này chưa
    $daDanhGia = DanhGia::where('user_id', $user->id)
        ->where('san_pham_id', $sanPhamId)
        ->where('bien_the_id', $bienTheId)
        ->where('don_hang_id', $donHangId)
        ->exists();

    if ($daDanhGia) {
        return redirect()->back()->with('error_binhluan', 'Bạn đã đánh giá biến thể này trong đơn hàng này.');
    }

    // Xác thực dữ liệu
    $request->validate([
        'so_sao' => 'required|integer|min:1|max:5',
        'nhan_xet' => 'nullable|string|max:1000',
        'hinh_anh_danh_gia.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video' => 'nullable|mimetypes:video/mp4,video/mpeg,video/quicktime|max:20480',
    ]);

    // Xử lý hình ảnh
    $imagePaths = [];
    if ($request->hasFile('hinh_anh_danh_gia')) {
        $images = $request->file('hinh_anh_danh_gia');
        if (count($images) > 5) {
            return redirect()->back()->with('error_binhluan', 'Bạn chỉ được tải lên tối đa 5 hình ảnh.');
        }

        foreach ($images as $image) {
            $path = $image->store('danh_gia/images', 'public');
            $imagePaths[] = $path;
        }
    }

    // Xử lý video
    $videoPath = null;
    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoPath = $video->store('danh_gia/videos', 'public');
    }

    // Tạo đánh giá
    DanhGia::create([
        'user_id' => $user->id,
        'san_pham_id' => $sanPhamId,
        'bien_the_id' => $bienTheId,
        'don_hang_id' => $donHangId, // Lưu don_hang_id
        'so_sao' => $request->so_sao,
        'nhan_xet' => $request->nhan_xet ?? '',
        'hinh_anh_danh_gia' => $imagePaths,
        'video' => $videoPath,
        'trang_thai' => 1,
    ]);

    return redirect()->back()->with('success', 'Gửi đánh giá thành công.');
}

    // public function themDanhGiaDonHang(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
    //     }

    //     $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])->find(Auth::id());

    //     if (!$user) {
    //         return redirect()->back()->with('error_binhluan', 'Người dùng không tồn tại.');
    //     }

    //     $sanPhamId = $request->input('san_pham_id');
    //     $bienTheId = $request->input('bien_the_id');

    //     // Kiểm tra sản phẩm và biến thể có tồn tại
    //     $sanPham = SanPham::find($sanPhamId);
    //     $bienThe = BienThe::find($bienTheId);

    //     if (!$sanPham || !$bienThe || $bienThe->san_pham_id != $sanPhamId) {
    //         return redirect()->back()->with('error_binhluan', 'Sản phẩm hoặc biến thể không hợp lệ.');
    //     }

    //     // Kiểm tra đơn hàng đã mua biến thể này
    //     $bienTheDaMua = [];
    //     foreach ($user->donHangs as $donHang) {
    //         if ($donHang->trang_thai_don_hang == 4) { // Đơn hàng hoàn thành
    //             $bienTheTrongDon = $donHang->chiTietDonHangs
    //                 ->where('bien_the_id', $bienTheId)
    //                 ->pluck('bien_the_id')
    //                 ->unique();

    //             foreach ($bienTheTrongDon as $id) {
    //                 $bienTheDaMua[$id] = ($bienTheDaMua[$id] ?? 0) + 1;
    //             }
    //         }
    //     }

    //     if (!isset($bienTheDaMua[$bienTheId])) {
    //         return redirect()->back()->with('error_binhluan', 'Bạn chưa mua biến thể này.');
    //     }

    //     // Kiểm tra số lượt đã đánh giá
    //     $soLuotDaDanhGia = DanhGia::where('user_id', $user->id)
    //         ->where('san_pham_id', $sanPhamId)
    //         ->where('bien_the_id', $bienTheId)
    //         ->count();

    //     if ($soLuotDaDanhGia >= $bienTheDaMua[$bienTheId]) {
    //         return redirect()->back()->with('error_binhluan', 'Bạn đã đánh giá đủ số lượt cho biến thể này. Hãy mua thêm để tiếp tục đánh giá.');
    //     }

    //     // Xác thực dữ liệu
    //     $request->validate([
    //         'so_sao' => 'required|integer|min:1|max:5',
    //         'nhan_xet' => 'nullable|string'
    //     ]);

    //     // Tạo đánh giá
    //     DanhGia::create([
    //         'user_id' => $user->id,
    //         'san_pham_id' => $sanPhamId,
    //         'bien_the_id' => $bienTheId,
    //         'so_sao' => $request->so_sao,
    //         'nhan_xet' => $request->nhan_xet ?? '',
    //         'trang_thai' => 1
    //     ]);

    //     return redirect()->back()->with('success', 'Gửi đánh giá thành công.');
    // }



    //     public function themDanhGiaDonHang(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login.client')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
    //     }

    //     $user = User::with(['danhGias', 'donHangs.chiTietDonHangs'])->find(Auth::id());

    //     if (!$user) {
    //         return redirect()->back()->with('error_binhluan', 'Người dùng không tồn tại.');
    //     }

    //     $sanPhamId = $request->input('san_pham_id');
    //     $bienTheId = $request->input('bien_the_id');

    //     // Kiểm tra sản phẩm và biến thể có tồn tại
    //     $sanPham = SanPham::find($sanPhamId);
    //     $bienThe = BienThe::find($bienTheId);

    //     if (!$sanPham || !$bienThe || $bienThe->san_pham_id != $sanPhamId) {
    //         return redirect()->back()->with('error_binhluan', 'Sản phẩm hoặc biến thể không hợp lệ.');
    //     }

    //     // Kiểm tra xem user đã từng mua bất kỳ biến thể nào của sản phẩm này không
    //     $daMuaSanPhamNay = false;

    //     foreach ($user->donHangs as $donHang) {
    //         if ($donHang->trang_thai_don_hang == 4) { // Đơn hàng hoàn thành
    //             foreach ($donHang->chiTietDonHangs as $ct) {
    //                 if ($ct->bienThe && $ct->bienThe->san_pham_id == $sanPhamId) {
    //                     $daMuaSanPhamNay = true;
    //                     break 2;
    //                 }
    //             }
    //         }
    //     }

    //     if (!$daMuaSanPhamNay) {
    //         return redirect()->back()->with('error_binhluan', 'Bạn chưa mua sản phẩm này.');
    //     }

    //     // Kiểm tra xem user đã từng đánh giá sản phẩm này chưa
    //     $daDanhGiaSanPham = DanhGia::where('user_id', $user->id)
    //         ->where('san_pham_id', $sanPhamId)
    //         ->exists();

    //     if ($daDanhGiaSanPham) {
    //         return redirect()->back()->with('error_binhluan', 'Bạn chỉ được đánh giá 1 lần cho mỗi sản phẩm.');
    //     }

    //     // Xác thực dữ liệu
    //     $request->validate([
    //         'so_sao' => 'required|integer|min:1|max:5',
    //         'nhan_xet' => 'nullable|string'
    //     ]);

    //     // Tạo đánh giá
    //     DanhGia::create([
    //         'user_id' => $user->id,
    //         'san_pham_id' => $sanPhamId,
    //         'bien_the_id' => $bienTheId, // Vẫn lưu để hiển thị chi tiết
    //         'so_sao' => $request->so_sao,
    //         'nhan_xet' => $request->nhan_xet ?? '',
    //         'trang_thai' => 1
    //     ]);

    //     return redirect()->back()->with('success', 'Gửi đánh giá thành công.');
    // }
}
