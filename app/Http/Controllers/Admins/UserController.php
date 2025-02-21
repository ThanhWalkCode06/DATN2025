<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            $lists = User::whereNull('deleted_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->onEachSide(5);
            return view('admins.taikhoans.index',compact('lists'));
        }else{
            $lists = User::where('name','like','%'.$request->key.'%')
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

        return view('admins.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        // dd($request->all());
        try{
        foreach ($request->name as $index => $name) {
            Permission::create([
                'name' => $name,
                'description' => $request->description[$index],
                'guard_name' => 'web',
            ]);
        }
        session()->flash('success', 'Tạo thành công vai trò');
        return redirect()->route('permissions.index');
        }catch(Exception $e){
            session()->flash('error', 'Lỗi tạo vai trò'.$e);
            return redirect()->back();
        }

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
        $itemId = Permission::query()->findOrFail($id);
        return view('admins.permission.edit',compact('itemId'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itemId = Permission::find($id);
        $data = $request->validate([
            'name' => ['required', Rule::unique('permissions', 'name')->ignore($id)],
            'description' => ['required'],
        ],[
            'name.required' => 'Tên quyền không được để trống',
            'name.unique' => 'Tên quyền này đã tồn tại',
            'description.required' => 'Mô tả quyền không được để trống',
        ]);
        // dd($data);
        $itemId->where('id',$id)->update($data);
        session()->flash('success', 'Update quyền thành công');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $itemId = DB::table('nhan_viens')->find($id);
        $itemId = Permission::find($id);
        // dd($itemId);
        $deleteSP = $itemId->delete();
        $itemId
        ->where('id', $id)
        ->update(['deleted_at' => Carbon::now()]);
        session()->flash('success', 'Xóa thành công vai trò');
        return redirect()->route('permissions.index');
    }
}
