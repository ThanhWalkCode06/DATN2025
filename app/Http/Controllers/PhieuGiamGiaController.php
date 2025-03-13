<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;

class PhieuGiamGiaController extends Controller
{
    public function __construct() {}
    /**
     * Hiển thị danh sách phiếu giảm giá.
     */
    public function index()
    {
        // Lấy danh sách phiếu giảm giá và phân trang (10 mục mỗi trang)
        $phieuGiamGias = PhieuGiamGia::orderBy('created_at', 'desc')->paginate(10);

        // Trả về view với dữ liệu đã phân trang
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
            'gia_tri' => 'required|numeric|min:1|max:99.99',
            'trang_thai' => 'required|in:0,1',
        ], [
            'ten_phieu.unique' => 'Tên phiếu giảm giá đã tồn tại.',
            'ma_phieu.unique' => 'Mã giảm giá đã tồn tại.',
            'ngay_bat_dau.after_or_equal' => 'Không được bắt đầu từ ngày trước hôm nay.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'gia_tri.min' => 'Giá trị giảm giá phải lớn hơn 0.',
            'gia_tri.max' => 'Giá trị giảm giá phải dưới 100.',
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
            ],
            [
                'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu không được trước hôm nay.',
                'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
                'gia_tri.min' => 'Giá trị giảm giá phải lớn hơn 0.',
                'gia_tri.max' => 'Giá trị giảm giá phải nhỏ hơn 100.',
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
}
