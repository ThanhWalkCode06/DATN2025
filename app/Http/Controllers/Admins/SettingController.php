<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request){
    if($request->isMethod('get')){
        if(Auth::check()){
            $user = Auth::user();
            return view('admins.setting.infor_setting.index', compact('user'));
        }
        return view('admins.setting.infor_setting.index');
    }else if($request->isMethod('post')){
        try{
            $data = $request->validate([
                'so_dien_thoai' => ['required', 'regex:/^0[0-9]{9,10}$/'], // Bắt đầu bằng 0, có 10-11 số
                'email' => 'required|email',
                'anh_dai_dien' => 'nullable|image|max:2048'
            ]);
            // dd(Auth::user()->id);
            if($request->hasFile('anh_dai_dien')){
                if(Auth::user()->anh_dai_dien && file_exists(storage_path("app/public/".Auth::user()->anh_dai_dien))){
                    // dd('in');
                    unlink(storage_path('app/public/'.Auth::user()->anh_dai_dien)); // Xóa ảnh c�� nếu có
                }
                // dd('out');
                $data['anh_dai_dien'] = $request->anh_dai_dien->store('uploads/user/img','public');
            }
            // dd($request->hasFile($request->anh_dai_dien));
            User::where('id',Auth::user()->id)->update($data);
            session()->flash('success', 'Sửa thông tin thành công!');
        }catch(Exception $e){
            dd($e);
            session()->flash('error', 'Sửa thông tin thất bại!');
            return redirect()->back()->withInput($request->all());
        }
        return redirect()->back();
    }
}
}
