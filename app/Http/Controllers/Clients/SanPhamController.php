<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\BienThe;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    public function danhSach(Request $request)
    {
        // Bắt đầu truy vấn chính
        $query = SanPham::with(['danhMuc', 'bienThes'])
            ->where('san_phams.trang_thai', 1)
            ->select([
                'san_phams.id',
                'san_phams.ten_san_pham',
                'san_phams.gia_cu',
                'san_phams.khuyen_mai',
                'san_phams.hinh_anh',
                'san_phams.danh_muc_id',
                'san_phams.trang_thai',
                'san_phams.created_at'
            ]);

        // **Lọc theo từ khóa tìm kiếm**
        if ($request->filled('query')) {
            $query->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->query('query') . '%');
        }

        // **Lọc theo danh mục**
        if ($request->filled('danh_muc_id')) {
            $query->where('san_phams.danh_muc_id', $request->danh_muc_id);
        }

        // **Lọc theo khoảng giá**
        if ($request->filled('price_range')) {
            $ranges = explode(',', $request->price_range);

            $query->where(function ($q) use ($ranges) {
                foreach ($ranges as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereHas('bienThes', function ($subQuery) use ($min, $max) {
                        $subQuery->whereBetween('bien_thes.gia_ban', [(int)$min, (int)$max]);
                    });
                }
            });
        }

        // **Lọc theo số sao**
        if ($request->filled('so_sao')) {
            $soSao = (int)$request->so_sao;
            $query->leftJoin('danh_gias', 'san_phams.id', '=', 'danh_gias.san_pham_id');
            $query->addSelect(\DB::raw('COALESCE(AVG(danh_gias.so_sao), 0) as avg_rating'))
                ->groupBy('san_phams.id');

            if ($soSao == 5) {
                $query->havingRaw('AVG(danh_gias.so_sao) = 5.0');
            } else {
                $query->havingRaw('AVG(danh_gias.so_sao) BETWEEN ? AND ?', [$soSao, $soSao + 0.9]);
            }
        }

        // **Bộ lọc sắp xếp**
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'Giá thấp - cao':
                    // Lọc theo giá thấp nhất của biến thể
                    $query->leftJoin('bien_thes', 'san_phams.id', '=', 'bien_thes.san_pham_id')
                        ->select([
                            'san_phams.id',
                            'san_phams.ten_san_pham',
                            'san_phams.gia_cu',
                            'san_phams.khuyen_mai',
                            'san_phams.hinh_anh',
                            'san_phams.danh_muc_id',
                            'san_phams.trang_thai',
                            'san_phams.created_at',
                            \DB::raw('MIN(bien_thes.gia_ban) as gia_ban') // Lấy giá thấp nhất của biến thể
                        ])
                        ->groupBy('san_phams.id')
                        ->orderBy('gia_ban', 'asc'); // Sắp xếp theo giá thấp nhất
                    break;

                case 'Giá cao - thấp':
                    $query->leftJoin('bien_thes', 'san_phams.id', '=', 'bien_thes.san_pham_id')
                        ->select([
                            'san_phams.id',
                            'san_phams.ten_san_pham',
                            'san_phams.gia_cu',
                            'san_phams.khuyen_mai',
                            'san_phams.hinh_anh',
                            'san_phams.danh_muc_id',
                            'san_phams.trang_thai',
                            'san_phams.created_at',
                            \DB::raw('MIN(bien_thes.gia_ban) as gia_ban')
                        ])
                        ->groupBy('san_phams.id')
                        ->orderByDesc('gia_ban');
                    break;





                case 'Giảm giá % cao - thấp':
                    // Sắp xếp theo giảm giá từ cao đến thấp
                    $query->whereNotNull('san_phams.gia_cu')
                        ->where('san_phams.gia_cu', '>', 0)
                        ->leftJoin('bien_thes', 'san_phams.id', '=', 'bien_thes.san_pham_id')
                        ->select([
                            'san_phams.id',
                            'san_phams.ten_san_pham',
                            'san_phams.gia_cu',
                            'san_phams.khuyen_mai',
                            'san_phams.hinh_anh',
                            'san_phams.danh_muc_id',
                            'san_phams.trang_thai',
                            'san_phams.created_at',
                            \DB::raw('MAX((san_phams.gia_cu - bien_thes.gia_ban) / san_phams.gia_cu) as giam_gia')
                        ])
                        ->groupBy('san_phams.id')
                        ->orderBy('giam_gia', 'desc');
                    break;

                default:
                    // Sắp xếp theo ngày tạo mới nhất
                    $query->orderByDesc('san_phams.created_at');
                    break;
            }
        } else {
            // Mặc định sắp xếp theo ngày tạo mới nhất
            $query->orderByDesc('san_phams.created_at');
        }


        // Thực hiện phân trang sau khi đã áp dụng bộ lọc và sắp xếp
        $sanPhams = $query->paginate(8)->appends($request->except('page'));

        // Lấy danh mục sản phẩm
        $danhMucs = DanhMucSanPham::withCount([
            'sanPhams' => function ($query) {
                $query->where('trang_thai', 1);
            }
        ])->having('san_phams_count', '>', 0)
            ->get();


        if ($request->ajax()) {
            $html = view('clients.sanphams.sanpham_list', compact('sanPhams'))->render();
            return response()->json(['html' => $html]);
        }

        // Trả về view với dữ liệu cần thiết
        return view('clients.sanphams.danhsach', compact('sanPhams', 'danhMucs'));
    }





    // public function chiTiet($id)
    // {
    //     $sanPham = SanPham::with([
    //         'bienThes',
    //         'anhSP',
    //         'danhGias',
    //         'bienThes.giaTriThuocTinhs',
    //         'bienThes.thuocTinh',
    //         'danhGias.nguoiDung',
    //         'danhMuc'
    //     ])
    //         ->where('san_phams.id', $id)
    //         ->where('san_phams.trang_thai', 1)
    //         ->selectRaw('san_phams.*,
    //             COALESCE(AVG(danh_gias.so_sao), 0) as avg_rating,
    //             COUNT(danh_gias.id) as total_reviews')
    //         ->leftJoin('danh_gias', 'san_phams.id', '=', 'danh_gias.san_pham_id')
    //         ->groupBy(
    //             'san_phams.id',
    //             'san_phams.ten_san_pham',
    //             'san_phams.ma_san_pham',
    //             'san_phams.san_pham_slug',
    //             'san_phams.gia_cu',
    //             'san_phams.khuyen_mai',
    //             'san_phams.hinh_anh',
    //             'san_phams.mo_ta',
    //             'san_phams.danh_muc_id',
    //             'san_phams.trang_thai',
    //             'san_phams.created_at',
    //             'san_phams.updated_at',
    //             'san_phams.deleted_at',
    //         )
    //         ->firstOrFail();

    //     // Tính phần trăm giảm giá
    //     $phanTramGiamGia = ($sanPham->gia_cu > 0)
    //         ? round((($sanPham->gia_cu - $sanPham->giaThapNhatCuaSP()) / $sanPham->gia_cu) * 100)
    //         : 0;


    //     // Lấy sản phẩm cùng danh mục (loại trừ sản phẩm hiện tại)
    //     $sanPhamLienQuan = SanPham::where('danh_muc_id', $sanPham->danh_muc_id)
    //         ->where('id', '!=', $sanPham->id) // Loại trừ sản phẩm hiện tại
    //         ->where('trang_thai', 1) // Chỉ lấy sản phẩm đang hoạt động
    //         ->limit(50)
    //         ->get();



    //     $bienThes = BienThe::where('san_pham_id', $id)->get();

    //     $mauSac = $bienThes->groupBy(function ($bienThe) {
    //         $thuocTinh = optional($bienThe->giaTriThuocTinhs)
    //             ->where('thuocTinh.ten_thuoc_tinh', 'Color')->first();
    //         return $thuocTinh ? $thuocTinh->gia_tri : 'Không xác định';
    //     })->map(function ($items) {
    //         $thuocTinh = optional($items->first()->giaTriThuocTinhs)
    //             ->where('thuocTinh.ten_thuoc_tinh', 'Color')->first();

    //         return [
    //             'gia_tri' => $thuocTinh ? $thuocTinh->gia_tri : 'Không xác định',
    //             'anh' => Storage::url(optional($items->first())->anh_bien_the ?? 'default.png'), // Ảnh mặc định của màu
    //             'bien_thes' => $items->map(function ($bienThe) {
    //                 $thuocTinhSize = optional($bienThe->giaTriThuocTinhs
    //                     ->where('thuocTinh.ten_thuoc_tinh', 'Size')->first());
    //                 return [
    //                     'id' => $bienThe->id,
    //                     'gia_tri' => $thuocTinhSize ? $thuocTinhSize->gia_tri : 'Không xác định',
    //                     'gia_ban' => $bienThe->gia_ban,
    //                     'so_luong' => $bienThe->so_luong,
    //                     'anh' => Storage::url($bienThe->anh_bien_the ?? 'default.png') // Ảnh riêng của biến thể (màu + size)
    //                 ];
    //             })->unique('gia_tri')->values()
    //         ];
    //     })->values();

    //     // dd($mauSac);


    //     // Chuyển dữ liệu sang JSON để sử dụng trên giao diện
    //     $mauSacJson = json_encode($mauSac);

    //     return view('clients.sanphams.chitiet', [
    //         'sanPhams' => $sanPham,
    //         'bienThes' => $sanPham->bienThes,
    //         'anhSPs' => $sanPham->anhSP,
    //         'phanTramGiamGia' => $phanTramGiamGia,
    //         'sanPhamLienQuan' => $sanPhamLienQuan,
    //         'mauSac' => $mauSac,
    //         'mauSacJson' => $mauSacJson
    //     ]);
    // }

    public function chiTiet($id)
{
    $sanPham = SanPham::with([
        'bienThes',
        'anhSP',
        'danhGias',
        'bienThes.giaTriThuocTinhs',
        'bienThes.thuocTinh',
        'danhGias.nguoiDung',
        'danhMuc'
    ])
        ->where('san_phams.id', $id)
        ->where('san_phams.trang_thai', 1)
        ->selectRaw('san_phams.*,
            COALESCE(AVG(danh_gias.so_sao), 0) as avg_rating,
            COUNT(danh_gias.id) as total_reviews')
        ->leftJoin('danh_gias', 'san_phams.id', '=', 'danh_gias.san_pham_id')
        ->groupBy(
            'san_phams.id',
            'san_phams.ten_san_pham',
            'san_phams.ma_san_pham',
            'san_phams.san_pham_slug',
            'san_phams.gia_cu',
            'san_phams.khuyen_mai',
            'san_phams.hinh_anh',
            'san_phams.mo_ta',
            'san_phams.danh_muc_id',
            'san_phams.trang_thai',
            'san_phams.created_at',
            'san_phams.updated_at',
            'san_phams.deleted_at',
        )
        ->firstOrFail();

    // Tính phần trăm giảm giá
    $phanTramGiamGia = ($sanPham->gia_cu > 0)
        ? round((($sanPham->gia_cu - $sanPham->giaThapNhatCuaSP()) / $sanPham->gia_cu) * 100)
        : 0;

    // Lấy sản phẩm liên quan
    $sanPhamLienQuan = SanPham::where('danh_muc_id', $sanPham->danh_muc_id)
        ->where('id', '!=', $sanPham->id)
        ->where('trang_thai', 1)
        ->limit(50)
        ->get();

    $bienThes = BienThe::where('san_pham_id', $id)->get();

    $mauSac = $bienThes->groupBy(function ($bienThe) {
        $thuocTinh = optional($bienThe->giaTriThuocTinhs)
            ->where('thuocTinh.ten_thuoc_tinh', 'Color')->first();
        return $thuocTinh ? $thuocTinh->gia_tri : 'Không xác định';
    })->map(function ($items) {
        $thuocTinh = optional($items->first()->giaTriThuocTinhs)
            ->where('thuocTinh.ten_thuoc_tinh', 'Color')->first();

        return [
            'gia_tri' => $thuocTinh ? $thuocTinh->gia_tri : 'Không xác định',
            'anh' => Storage::url(optional($items->first())->anh_bien_the ?? 'default.png'),
            'bien_thes' => $items->map(function ($bienThe) {
                $thuocTinhSize = optional($bienThe->giaTriThuocTinhs
                    ->where('thuocTinh.ten_thuoc_tinh', 'Size')->first());
                return [
                    'id' => $bienThe->id,
                    'gia_tri' => $thuocTinhSize ? $thuocTinhSize->gia_tri : 'Không xác định',
                    'gia_ban' => $bienThe->gia_ban,
                    'so_luong' => $bienThe->so_luong,
                    'anh' => Storage::url($bienThe->anh_bien_the ?? 'default.png')
                ];
            })->unique('gia_tri')->values()
        ];
    })->values();

    $mauSacJson = json_encode($mauSac);

    // Kiểm tra quyền đánh giá
    $danhGiaController = new DanhGiaClientsController();
    $chophep_danhgia = $danhGiaController->kiemTraQuyenDanhGia($id);

    // Tính toán $bienTheDaMua để truyền vào view
    $bienTheDaMua = [];
    if (Auth::check()) {
        $user = User::with(['donHangs.chiTietDonHangs'])->find(Auth::id());
        if ($user) {
            $idBienThes = BienThe::where('san_pham_id', $id)->pluck('id')->toArray();
            if (!empty($idBienThes)) {
                foreach ($user->donHangs as $donHang) {
                    if ($donHang->trang_thai_don_hang >= 4) {
                        $bienTheTrongDon = $donHang->chiTietDonHangs
                            ->whereIn('bien_the_id', $idBienThes)
                            ->pluck('bien_the_id')
                            ->unique();

                        foreach ($bienTheTrongDon as $bienTheId) {
                            $bienTheDaMua[$bienTheId] = ($bienTheDaMua[$bienTheId] ?? 0) + 1;
                        }
                    }
                }
            }
        }
    }

    return view('clients.sanphams.chitiet', [
        'sanPhams' => $sanPham,
        'bienThes' => $sanPham->bienThes,
        'anhSPs' => $sanPham->anhSP,
        'phanTramGiamGia' => $phanTramGiamGia,
        'sanPhamLienQuan' => $sanPhamLienQuan,
        'mauSac' => $mauSac,
        'mauSacJson' => $mauSacJson,
        'chophep_danhgia' => $chophep_danhgia,
        'bienTheDaMua' => $bienTheDaMua // Truyền biến vào view
    ]);
}



    public function sanPhamYeuThich()
    {
        $user = Auth::user();
        return view('clients.sanphams.sanphamyeuthich', compact('user'));
    }

    public function addsanPhamYeuThich(string $id)
    {
        $user = Auth::user();
        $tam =
            `<li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
            <a href="#" class="notifi-wishlist">
                <i data-feather="heart"></i>
            </a>
            <form action="{{ route('add.wishlist',1) }}" method="POST" class="wishlist-form">
                @csrf
            </form>
        </li>`;
        if ($user) {
            if (!$user->sanPhamYeuThichs()->where('san_pham_id', $id)->exists()) {
                $user->sanPhamYeuThichs()->attach($id);
                return response()->json(['message' => 'Thêm thành công vào danh sách yêu thích!'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Sản phẩm đã tồn tại trong danh sách!'], 500);
            }
        } else {
            return response()->json(['message' => 'Bạn chưa đăng nhập!'], 401);
        }
    }

    public function xoaYeuThich($id)
    {
        try {
            $user = Auth::user();

            // Kiểm tra xem sản phẩm có trong danh sách yêu thích không
            if (!$user->sanPhamYeuThichs()->where('san_pham_id', $id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
            }

            // Xóa sản phẩm yêu thích
            $user->sanPhamYeuThichs()->detach($id);

            return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
        } catch (\Exception $e) {
            \Log::error('Lỗi xóa sản phẩm yêu thích: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi server!'], 500);
        }
    }

    public function quickView(Request $request)
    {
        $chiTiet = collect();
        $sanPham = SanPham::with([
            'bienThes.tt.giaTriThuocTinhs'
        ])->find($request->id);
        // return response()->json($sanPham);

        if (!$sanPham) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }

        return response()->json([
            'id' => $sanPham->id,
            'ten_san_pham' => $sanPham->ten_san_pham,
            'gia_moi' => number_format($sanPham->gia_moi, 0, '', '.'),
            'gia_cu' => number_format($sanPham->gia_cu, 0, '', '.'),
            'hinh_anh' => Storage::url($sanPham->hinh_anh ?? 'images/default.png'),
            'mo_ta' => $sanPham->mo_ta,
            'danh_muc' => $sanPham->danhMuc->ten_danh_muc,
            'so_sao' => $sanPham->tinhDiemTrungBinh(),
            'danh_gia' => $sanPham->danhGias->count(),
            'bien_the' => $sanPham->bienThes->map(function ($bienThe) {
                return [
                    'id' => $bienThe->id,
                    'ten_bien_the' => $bienThe->ten_bien_the,
                    'gia_ban' => number_format($bienThe->gia_ban, 0, '', '.'),
                    'anh_bien_the' => Storage::url($bienThe->anh_bien_the ?? 'images/default.png'),
                    'so_luong' => $bienThe->so_luong,
                    'thuoc_tinh_gia_tri' => $bienThe->tt->map(function ($thuocTinh) use ($bienThe) {
                        $giaTri = $bienThe->gttt
                            ->where('thuoc_tinh_id', $thuocTinh->id)
                            ->pluck('gia_tri') // Lấy danh sách giá trị
                            ->toArray(); // Chuyển về mảng

                        return [
                            'id' => $thuocTinh->id,
                            'ten' => $thuocTinh->ten_thuoc_tinh,
                            'gia_tri' => count($giaTri) === 1 ? $giaTri[0] : null // Nếu chỉ có 1 giá trị, lấy nó, ngược lại thì null
                        ];
                    })
                ];
            }),
        ]);
    }
}
