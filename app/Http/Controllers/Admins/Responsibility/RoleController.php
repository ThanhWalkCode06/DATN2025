<?php

namespace App\Http\Controllers\Admins\Responsibility;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Responsibility\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            $lists = Role::whereNull('deleted_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->onEachSide(5);
            return view('admins.vaitros.index',compact('lists'));
        }else{
            $lists = Role::where('name','like','%'.$request->key.'%')
            ->orderBy('id','DESC')->paginate(10);
            return view('admins.vaitros.index',compact('lists'));
        }

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('-', $permission->name)[0]; // Lấy phần đầu làm nhóm (order, product, user,...)
        });
        // dd($permissions);
        return view('admins.vaitros.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::withTrashed()->where('name', $request->name)->whereNotNull('deleted_at')->first();
        if($role){
            $role->restore();
        }else{
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
        }
        if($request->permissions){
            $role->syncPermissions(Permission::whereIn('name', $request->permissions)->get());
        }
        session()->flash('success', 'Tạo thành công vai trò');
        return redirect()->route('roles.index');



    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $itemId = \Spatie\Permission\Models\Role::find($id);
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('-', $permission->name)[0]; // Lấy phần đầu làm nhóm (order, product, user,...)
        });

        return view('admins.vaitros.edit',compact('permissions','itemId'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itemId = Role::find($id);
        $role = Role::withTrashed()->where('name', $request->name)->whereNotNull('deleted_at')->first();
        $data = $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')->whereNull('deleted_at')->ignore($id)],
        ],[
            'name.required' => 'Tên vai trò không được để trống',
            'name.unique' => 'Tên vai trò này đã tồn tại',
        ]);
        // dd($role);
        if($role){
            $itemId = Role::find($id);
            $deleteSP = $itemId->delete();
            $itemId->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);

            $role->restore();
            $role->syncPermissions($request->permissions);
        }else{
            $itemId->update($data);
            $itemId->syncPermissions($request->permissions);
        }
        session()->flash('success', 'Update vai trò thành công');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $itemId = DB::table('nhan_viens')->find($id);
        $itemId = Role::find($id);
        $deleteSP = $itemId->delete();
        $itemId
        ->where('id', $id)
        ->update(['deleted_at' => Carbon::now()]);
        session()->flash('success', 'Xóa thành công vai trò');
        return redirect()->route('roles.index');
    }
}
