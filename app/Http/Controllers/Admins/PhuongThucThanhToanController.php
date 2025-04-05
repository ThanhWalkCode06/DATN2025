<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PhuongThucThanhToan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\PtttRequest;
use App\Http\Requests\Admins\UserRequest;
use App\Http\Requests\Admins\PtttStoreRequest;

class PhuongThucThanhToanController extends Controller
{
    public function index(Request $request)
    {
        $lists = PhuongThucThanhToan::whereNull('deleted_at')
        ->orderByDesc('id')
        ->paginate(10)
        ->onEachSide(5);


        return view('admins.pttt.index', compact('lists'));
    }


    public function search(Request $request)
    {
        $key = trim($request->key);
        if (empty($key)) {
            return redirect()->route('phuongthucthanhtoans.index');
        }

        $lists = PhuongThucThanhToan::where('ten_phuong_thuc', 'like', '%' . $request->key . '%')
        ->orwhere('trang_thai', 'like', '%' . $request->key . '%')
        ->orderBy('id', 'DESC')
        ->paginate(10)
        ->appends(['key' => $key]);
        return view('admins.pttt.index', compact('lists'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.pttt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PtttStoreRequest $request)
    {
        $data = $request->validated();

        $checksoftDelete = PhuongThucThanhToan::withTrashed()
        ->where('ten_phuong_thuc',trim($data['ten_phuong_thuc']))
        ->whereNotNull('deleted_at')->first();

        if($checksoftDelete){
            $checksoftDelete->restore();

        }else{
            $user = PhuongThucThanhToan::create($data);
        }
        session()->flash('success', 'Tạo thành công phương thức thanh toán');
        return redirect()->route('phuongthucthanhtoans.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $user = PhuongThucThanhToan::find($id);
    //     return view('admins.pttt.show', compact('user'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $itemId = PhuongThucThanhToan::query()->findOrFail($id);
        return view('admins.pttt.edit',compact('itemId'));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(PtttRequest $request, string $id)
    {
        $itemId = PhuongThucThanhToan::withTrashed()->find($id);
        $data = $request->validated();
        $itemId->update($data);
        session()->flash('success', 'Sửa thành công phương thức thanh toán');
        return redirect()->route('phuongthucthanhtoans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $itemId = DB::table('nhan_viens')->find($id);
        $itemId = PhuongThucThanhToan::find($id);
        $deleteSP = $itemId->delete();
        $itemId
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
        session()->flash('success', 'Xóa thành công phương thức thanh toán');
        return redirect()->route('phuongthucthanhtoans.index');
    }
}
