<?php

namespace App\Http\Controllers\Admins;

use App\Models\Banner;
use App\Models\SanPham;
use App\Models\BannerImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;
use Debugbar;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = Banner::whereNull('deleted_at')->orderByDesc('id')->paginate(12);
        return view('admins.banners.index', compact('lists'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $lists = Banner::superFilter($request)->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admins.banners.partials.list_rows', compact('lists'))->render(),
                'pagination' => $lists->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }
        return view('admins.banners.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listDanhMucSP = DanhMucSanPham::all();
        $listSanPham = SanPham::all();
        return view('admins.banners.create', compact('listDanhMucSP', 'listSanPham'));
    }

    public function upload(Request $request)
    {
        try {
            // Kiểm tra xem product_images có tồn tại và là mảng không
            if ($request->hasFile('product_images')) {
                $paths = []; // Mảng lưu đường dẫn các file đã upload

                // Lặp qua từng file trong mảng product_images
                foreach ($request->file('product_images') as $image) {
                    // Kiểm tra file có hợp lệ không
                    // if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $uniqueName = time() . '_' . Str::random(10) . '.' . $extension;
                    // $path = $image->storeAs('banners', $uniqueName, 'public');
                    $paths[] = $uniqueName; // Thêm đường dẫn vào mảng
                    // }
                }

                // Trả về mảng các đường dẫn file đã upload
                return response()->json(['path' => $paths], 200);
            } else {
                return response()->json(['error' => 'No images provided'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store files: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
public function store(StoreBannerRequest $request)
{
    // dd($request->all());
    $images = $request->file('images');
    if (!$images || count($images) == 0) {
        return redirect()->back()->with('error', 'Vui lòng thêm ảnh');
    }

        // Tạo banner
        $newBanner = Banner::create([
            'position' => $request->position,
            'priority' => $request->do_uu_tien,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'custom_url' => $request->link_url, // tùy chọn
        ]);

    foreach ($images as $index => $image) {
        if ($image && $image->isValid()) {
            $uniqueName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            // Lưu file vào storage/app/public/banners
            $path = $image->storeAs('banners', $uniqueName, 'public');
            $content_button = $request->content_input[$index];
            $status_button = $request->trang_thai_button[$index];

            // Xác định URL theo loại liên kết
            $loai = $request->loai_lien_ket[$index] ?? null;
            // dd($loai,$request->loai_lien_ket);
            if ($loai == 'sanpham') {
                $url = $request->sanpham[$index] ?? null;
            } elseif ($loai == 'danhmuc') {
                $url = $request->danhmuc[$index] ?? null;
            } elseif ($loai == 'tuychinh') {
                $url = $request->custom_url[$index] ?? null;
            } else {
                $url = null;
            }

            // Tạo bản ghi BannerImage
            BannerImage::create([
                'banner_id' => $newBanner->id,
                'image_url' => $path,
                'link_type' => $loai,
                'sort_order' => 1,
                'link_url' => $url,
                'title' => $request->title[$index],
                'content' => $request->content[$index],
                'descript' => $request->descript[$index],
                'content_button' => $content_button,
                'status_button' => $status_button,
            ]);
        }
    }
    session()->flash('success', 'Thêm banner thành công');
    return response()->json([
        'redirect' => route('bannerAdmin.index')
    ]);
}

    public function quickUpdate(Request $request)
    {
        try {
            $ids = $request->json('ids');
            $filters = $request->json('filters'); // chứa toàn bộ các filter linh hoạt

            if (!is_array($ids) || empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Không có IDs'], 400);
            }

            $users = Banner::whereIn('id', $ids)->get();

            if ($users->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy user'], 404);
            }

            // Chỉ chấp nhận update những field này để tránh bị chèn field độc hại
            $allowedFields = ['status']; // bạn bổ sung các field hợp lệ

            foreach ($users as $user) {
                // Duyệt từng field gửi lên
                foreach ($filters as $key => $value) {
                    if (in_array($key, $allowedFields)) {
                        $user->update([$key => $value]);
                    }
                }
            }

            $lists = Banner::whereNull('deleted_at')
                ->orderByDesc('id')
                ->paginate(10)
                ->onEachSide(5);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'html' => view('admins.banners.partials.list_rows', compact('lists'))->render()
            ]);

        } catch (\Exception $e) {
            Log::error('QuickUpdate Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi server: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listDanhMucSP = DanhMucSanPham::all();
        $listSanPham = SanPham::all();
        $BannerItem = Banner::with('bannerImgs')->where('id',$id)->first();
        if($BannerItem){
            // dd($BannerItem->bannerImgs);
            return view('admins.banners.edit', compact('listDanhMucSP', 'listSanPham','BannerItem'));
        }else{
            session()->flash('error', 'Banner không tồn tại');
        return redirect()->route('bannerAdmin.index');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBannerRequest $request, string $id)
    {
        $itemBanner = Banner::with('bannerImgs')->where('id',$id)->first();
        $itemBannerImgs = BannerImage::where('banner_id',$itemBanner->id)->get();
        $images = $request->file('images');
        if (!$images || count($images) == 0) {
            return redirect()->back()->with('error', 'Vui lòng thêm ảnh');
        }
            // Tạo banner
            $itemBanner->update([
                'title' => $request->title,
                'position' => $request->position,
                'priority' => $request->do_uu_tien,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'custom_url' => $request->link_url, // tùy chọn
            ]);

        if(!$itemBanner){
            session()->flash('error', 'Banner không tồn tại');
            return response()->json([
                'redirect' => route('bannerAdmin.index')
            ]);
        }else{
            $img = BannerImage::where('banner_id',$itemBanner->id)->get();
            foreach($img as $item){
                if($item->image_url && Storage::disk('public')->exists($item->image_url)){
                    Storage::disk('public')->delete($item->image_url);

                }
                $item->delete();
            }

            foreach ($images as $index => $image) {
                if ($image && $image->isValid()) {
                    $uniqueName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                    // Lưu file vào storage/app/public/banners
                    $path = $image->storeAs('banners', $uniqueName, 'public');
                    $content_button = $request->content_input[$index];
                    $status_button = $request->trang_thai_button[$index];
                    // Xác định URL theo loại liên kết
                    $loai = $request->loai_lien_ket[$index] ?? null;
                    // dd($loai,$request->loai_lien_ket);
                    if ($loai == 'sanpham') {
                        $url = $request->sanpham[$index] ?? null;
                    } elseif ($loai == 'danhmuc') {
                        $url = $request->danhmuc[$index] ?? null;
                    } elseif ($loai == 'tuychinh') {
                        $url = $request->custom_url[$index] ?? null;
                    } else {
                        $url = null;
                    }
                    // Tạo bản ghi BannerImage
                    BannerImage::create([
                        'banner_id' => $itemBanner->id,
                        'image_url' => $path,
                        'link_type' => $loai,
                        'sort_order' => 1,
                        'link_url' => $url,
                        'title' => $request->title[$index],
                        'content' => $request->content[$index],
                        'descript' => $request->descript[$index],
                        'content_button' => $content_button,
                        'status_button' => $status_button,
                        ]);
                }
            }
            session()->flash('success', 'Sửa banner thành công');
            return response()->json([
                'redirect' => route('bannerAdmin.index')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::where('id',$id)->first();
        if($banner){
            $img = BannerImage::where('banner_id',$banner->id)->get();
            foreach($img as $item){
                if($item->image_url && Storage::disk('public')->exists($item->image_url)){
                    Storage::disk('public')->delete($item->image_url);
                }
            }
            $banner->delete();
            $banner
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
        }else{
            return redirect()->route('bannerAdmin.index')->with(['error' => 'Id không tồn tại']);
        }
        return redirect()->route('bannerAdmin.index')->with(['success' => 'Xóa thành công']);
    }
}
