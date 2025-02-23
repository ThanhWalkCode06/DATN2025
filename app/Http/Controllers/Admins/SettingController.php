<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Validation\Rule;
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

            $data = $request->validate([
                'so_dien_thoai' => ['required', 'digits:10',Rule::unique('users','so_dien_thoai')->ignore(Auth::id())], // Bắt đầu bằng 0, có 10-11 số
                'email' => ['required','email',Rule::unique('users','email')->ignore(Auth::id())],
                'anh_dai_dien' => 'nullable|image|max:2048',
                // 'ten_nguoi_dung' => 'required',
                // 'dia_chi' => 'required',
                // 'ngay_sinh' => 'required|date',
                // 'gioi_tinh' => 'required',
            ]);
            // dd($data);
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

        return redirect()->route('setting-infor.private');
    }
}
}
