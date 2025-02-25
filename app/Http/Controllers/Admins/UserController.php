<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            $lists = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'SuperAdmin');
            })
            ->whereNull('deleted_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->onEachSide(5);
            return view('admins.taikhoans.index',compact('lists'));
        }else{
            $lists = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'SuperAdmin');
            })
            ->where('name','like','%'.$request->key.'%')
            ->orwhere('email','like','%'.$request->key.'%')
            ->orderBy('id','DESC')->paginate(10);
            return view('admins.taikhoans.index',compact('lists'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name','!=','SuperAdmin')->get();
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
        // dd($request->hasFile('anh_dai_dien'));
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
            "name" => $data['name'],
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
        return view('admins.taikhoans.show',compact('user'));
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
    public function update(Request $request, string $id)
    {
        $itemId = User::find($id);
        $data = $request->all();
// dd($data);
        // if ($request->hasFile('anh_dai_dien')) {
        //     if($itemId->anh_dai_dien && file_exists(storage_path("app/public/".$itemId->anh_dai_dien))){
        //         unlink(storage_path("app/public/".$itemId->anh_dai_dien));
        //     }
        //     $file = $request->file('anh_dai_dien');
        //     $path = $file->store('uploads/user/img','public');
        //     $data['anh_dai_dien'] = $path;
        // } else {
        //     $data['anh_dai_dien'] = $itemId->anh_dai_dien;
        // }
        // $data['gioi_tinh'] = $data['gioi_tinh'] == 'Nam' ? 1 : 0;

        $itemId->update([
            // "name" => $data['name'],
            // "email" => $data['email'],
            // "anh_dai_dien" => $data['anh_dai_dien'],
            // "ten_nguoi_dung" => $data['ten_nguoi_dung'],
            // "dia_chi" => $data['dia_chi'],
            // "ngay_sinh" => $data['ngay_sinh'],
            // "gioi_tinh" => $data['gioi_tinh'],
            // "so_dien_thoai" => $data['so_dien_thoai'],
            "trang_thai" => $data['trang_thai'],
            // "password" => bcrypt($data['password']),
        ]);
        if (!empty($data['role']) && $data['role'] != "[]") {
            $itemId->syncRoles($data['role']);
        }
        session()->flash('success', 'Update thành công tài khoản');
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
