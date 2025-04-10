<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\UserRequest;
use App\Http\Controllers\HelperCommon\Helper;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $lists = User::whereNull('deleted_at')
        ->orderByDesc('id')
        ->paginate(10)
        ->onEachSide(5);
        $roles = \Spatie\Permission\Models\Role::where('name', '!=', 'SuperAdmin')->pluck('name', 'id')->toArray();
        if (!$request->ajax()) {
            session(['previous_url' => url()->previous()]);
        }
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admins.taikhoans.partials.list_rows', compact('lists'))->render(),
                'pagination' => $lists->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }

        return view('admins.taikhoans.index', compact('lists','roles'));
    }


    public function search(Request $request)
    {
        $roles = \Spatie\Permission\Models\Role::where('name', '!=', 'SuperAdmin')->pluck('name', 'id')->toArray();
        $lists = User::with('roles')->superFilter($request)->paginate();
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admins.taikhoans.partials.list_rows', compact('lists'))->render(),
                'pagination' => $lists->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }
        return redirect()->route('users.index');
    }

    public function quickUpdate(Request $request)
    {
        try {

            $ids = $request->json('ids');
            $roles = $request->json('roles');
            $status = $request->json('status');

            // return response()->json([ 'message' => $request->all()]);

            if (!is_array($ids) || empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Không có IDs'], 400);
            }


            $users = User::whereIn('id', $ids)->get();

            if ($users->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy user'], 404);
            }

            foreach ($users as $user) {
                if(!$user->hasRole('SuperAdmin')){
                    if($roles === '[]'){
                        $user->syncRoles([]);
                    }else if($roles && !empty($roles)) {
                        $user->syncRoles($roles);
                    }
                    if ($status !== null) {
                        $user->update(['trang_thai' => $status]);
                    }
                }
            }
            $lists = User::whereNull('deleted_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->onEachSide(5);
            return response()->json([
                'success' => true, // Thêm success để client dễ xử lý
                'message' => 'Cập nhật thành công',
                'html' => view('admins.taikhoans.partials.list_rows', compact('lists'))->render()
            ]);

            // return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
        } catch (\Exception $e) {
            Log::error('QuickUpdate Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi server: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        // dd($roles,User::all());
        // foreach($roles as $item=>$role){
        //     dd($role);
        // }
        return view('admins.taikhoans.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if ($request->hasFile('anh_dai_dien')) {
            $file = $request->file('anh_dai_dien');
            // dd($file);
            $path = $file->store('uploads/user/img','public');
            $data['anh_dai_dien'] = $path;
        } else {
            $data['anh_dai_dien'] = null;
        }
        $data['gioi_tinh'] = $data['gioi_tinh'] == 'Nam' ? 1 : 0;
        $user = User::create([
            "username" => $data['name'],
            "email" => $data['email'],
            "anh_dai_dien" => $data['anh_dai_dien'],
            "ten_nguoi_dung" => $data['ten_nguoi_dung'],
            "dia_chi" => $data['dia_chi'],
            "ngay_sinh" => $data['ngay_sinh'],
            "gioi_tinh" => $data['gioi_tinh'],
            "trang_thai" => $data['trang_thai'],
            "so_dien_thoai" => $data['so_dien_thoai'],
            "password" => bcrypt($data['password']),
        ]);
        if (!empty($data['role']) && $data['role'] != '[]' ) {
            $user->assignRole($data['role']);
        }
        session()->flash('success', 'Tạo thành công tài khoản');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('admins.taikhoans.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $itemId = User::query()->findOrFail($id);
        $roles = $roles = Role::where('name','!=','SuperAdmin')->get();;
        return view('admins.taikhoans.edit',compact('itemId','roles'));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update( string $id)
    {
        $itemId = User::find($id);
        $data = request()->all();
        // dd($data);
        $itemId->update([
            "trang_thai" => $data['trang_thai'],
        ]);
        if (!empty($data['role']) && $data['role'] != "[]") {
            $itemId->syncRoles($data['role']);
        }
        session()->flash('success', 'Sửa thành công tài khoản');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $itemId = DB::table('nhan_viens')->find($id);
        $itemId = User::find($id);
        $deleteSP = $itemId->delete();
        $itemId
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
        session()->flash('success', 'Xóa thành công tài khoản');
        return redirect()->route('users.index');
    }
}
