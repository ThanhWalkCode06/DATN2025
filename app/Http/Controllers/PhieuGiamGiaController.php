<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PhieuGiamGiaController extends Controller
{
    public function __construct() {}
    /**
     * Hiển thị danh sách phiếu giảm giá.
     */
    public function index(Request $request)
    {
        // Lấy danh sách phiếu giảm giá và phân trang (10 mục mỗi trang)
        $phieuGiamGias = PhieuGiamGia::orderBy('created_at', 'desc')->paginate(10);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admins.phieugiamgias.partials.list_rows', compact('phieuGiamGias'))->render(),
                'pagination' => $phieuGiamGias->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }
        // Trả về view với dữ liệu đã phân trang
        return view('admins.phieugiamgias.index', compact('phieuGiamGias'));
    }

    public function search(Request $request)
    {
// dd($request->all());
        $phieuGiamGias = PhieuGiamGia::superFilter($request)->paginate(10);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admins.phieugiamgias.partials.list_rows', compact('phieuGiamGias'))->render(),
                'pagination' => $phieuGiamGias->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }
        return view('admins.phieugiamgias.index', compact('phieuGiamGias'));
    }

    /**
     * Hiển thị form tạo mới phiếu giảm giá.
     */
    public function create()
    {
        return view('admins.phieugiamgias.create');
    }

    /**
     * Lưu phiếu giảm giá vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_phieu' => [
                'required',
                'string',
                'max:255',
                Rule::unique('phieu_giam_gias', 'ten_phieu')->whereNull('deleted_at'),
            ],
            'ma_phieu' => [
                'required',
                'string',
                'max:50',
                Rule::unique('phieu_giam_gias', 'ma_phieu')->whereNull('deleted_at'),
            ],
            'ngay_bat_dau' => 'required|date|after_or_equal:today',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'muc_giam_toi_da' => 'numeric|min:5000',
            'muc_gia_toi_thieu' => 'numeric|min:0',
        ], [
            'ten_phieu.unique' => 'Tên phiếu giảm giá đã tồn tại.',
            'ma_phieu.unique' => 'Mã giảm giá đã tồn tại.',
            'ngay_bat_dau.after_or_equal' => 'Không được bắt đầu từ ngày trước hôm nay.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'gia_tri.min' => 'Giá trị giảm giá phải lớn hơn 0.',
            'gia_tri.max' => 'Giá trị giảm giá phải dưới 100.',

            'muc_giam_toi_da.numeric' => 'Phải là giá trị số.',
            'muc_gia_toi_thieu.numeric' => 'Phải là giá trị số.',
            'muc_giam_toi_da.min' => 'Ít nhất phải 5.000 đ',
            'muc_gia_toi_thieu.min' => 'Ít nhất phải 0 đ',
        ]);

        // Kiểm tra nếu có bản ghi bị xóa mềm
        $phieuGiamGia = PhieuGiamGia::withTrashed()
            ->where('ma_phieu', $request->ma_phieu)
            ->first();

        if ($phieuGiamGia) {
            $phieuGiamGia->restore(); // Khôi phục bản ghi bị xóa mềm
            $phieuGiamGia->update($request->all()); // Cập nhật lại dữ liệu
            return redirect()->route('phieugiamgias.index')->with('success', 'Phiếu giảm giá đã được khôi phục!');
        }

        // Nếu không có bản ghi nào, tạo mới
        PhieuGiamGia::create($request->all());

        return redirect()->route('phieugiamgias.index')->with('success', 'Thêm phiếu giảm giá thành công!');
    }

    /**
     * Hiển thị chi tiết phiếu giảm giá.
     */
    public function show(PhieuGiamGia $phieuGiamGia)
    {
        return view('admins.phieugiamgias.show', compact('phieuGiamGia'));
    }

    /**
     * Hiển thị form chỉnh sửa phiếu giảm giá.
     */
    public function edit($id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);
        return view('admins.phieugiamgias.edit', compact('phieuGiamGia'));
    }

    /**
     * Cập nhật phiếu giảm giá.
     */
    public function update(Request $request, $id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);

        // Kiểm tra dữ liệu đầu vào
        $request->validate(
            [
                'ten_phieu' => 'required|string|max:255',
                'ma_phieu' => 'required|string|max:50',
                'ngay_bat_dau' => 'required|date|after_or_equal:today',
                'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
                'gia_tri' => 'required|numeric|min:1|max:99.99',
                'trang_thai' => 'required|in:0,1',
                'muc_giam_toi_da' => 'numeric|min:5000',
                'muc_gia_toi_thieu' => 'numeric|min:0',
            ],
            [
                'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu không được trước hôm nay.',
                'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
                'gia_tri.min' => 'Giá trị giảm giá phải lớn hơn 0.',
                'gia_tri.max' => 'Giá trị giảm giá phải nhỏ hơn 100.',
                'muc_giam_toi_da.numeric' => 'Phải là giá trị số.',
                'muc_gia_toi_thieu.numeric' => 'Phải là giá trị số.',
                'muc_giam_toi_da.min' => 'Ít nhất phải 5.000 đ',
                'muc_gia_toi_thieu.min' => 'Ít nhất phải 0 đ',
            ]
        );

        // Cập nhật dữ liệu
        $phieuGiamGia->update($request->all());

        return redirect()->route('phieugiamgias.index')->with('success', 'Cập nhật mã giảm giá thành công');
    }

    /**
     * Xóa phiếu giảm giá.
     */
    public function destroy($id)
    {
        $phieuGiamGia = PhieuGiamGia::findOrFail($id);
        $phieuGiamGia->delete();

        return redirect()->route('phieugiamgias.index')->with('success', 'Xóa thành công!');
    }


    // public function showCart()
    // {
    //     $userId = Auth::id(); // Get the logged-in user's ID

    //     if (!$userId) {
    //         return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem mã giảm giá.');
    //     }

    //     // Get discount vouchers for the logged-in user
    //     $phieuGiamGiaThanhToans = PhieuGiamGia::where('trang_thai', 1)
    //         ->where('ngay_bat_dau', '<=', now()) // Start date is in the past
    //         ->where('ngay_ket_thuc', '>=', now()) // End date is in the future
    //         ->whereHas('phieu_giam_gia_tai_khoans', function ($query) use ($userId) {
    //             $query->where('user_id', $userId);
    //         })
    //         ->get();
    //         if ($phieuGiamGiaThanhToans->isEmpty()) {
    //             // Optionally log something or return a default empty message
    //             // Example: Log::info('No discount vouchers found.');
    //         }
    //     // Pass the variable to the view, even if it's empty
    //     return view('clients.thanhtoans.thanhtoan', compact('phieuGiamGiaThanhToans')); // Ensure $phieuGiamGias is always passed
    // }

}
