<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{

    public function common(Request $request){
        if($request->isMethod('get')){
            return view('admins.setting.configuration.index');
        }else if($request->isMethod('post')){
            $data = $request->except('_token');
            // dd($data);
            foreach ($data as $key => $value) {
                $this->updateEnv($key, $value);
            }
            Artisan::call('config:clear');
            session()->flash('success', 'Cấu hình đã được cập nhật!');
            return redirect()->back();
        }
    }
    public function mail(Request $request){
        if($request->isMethod('post')){
            $data = $request->except('_token');

        // Xử lý lưu vào file .env
        foreach ($data as $key => $value) {
            $this->updateEnv($key, $value); // Ghi vào file .env
            config()->set(str_replace('MAIL_', 'mail.', strtolower($key)), $value); // Cập nhật ngay lập tức
        }
        Artisan::call('config:clear');
        session()->flash('success', 'Cấu hình đã được cập nhật!');
        return redirect()->back();
        }
    }

    function updateEnv($key, $value)
{
    $envPath = base_path('.env');
    $envContent = file_get_contents($envPath);

    if (strpos($value, ' ') !== false) {
        $value = '"' . $value . '"';
    }

    // Cập nhật `.env`
    $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
    file_put_contents($envPath, $envContent);

    return true;
}


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
            'ten_nguoi_dung' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => ['required','date'
            ,'before_or_equal:' . now()->subYear(18)->format('Y-m-d')
            ],
            'gioi_tinh' => 'required',
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.unique' => 'Email này đã tồn tại vui lòng nhập email khác',

            'anh_dai_dien.image' => 'Vui lòng nhập định dạng ảnh max 2048mb',
            'anh_dai_dien.required' => 'Vui lòng chọn hình ảnh',

            'ten_nguoi_dung.required' => 'Vui lòng nhập tên ',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ dùng',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh ',
            'ngay_sinh.before_or_equal' => 'Chưa đủ 18 tuổi',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính ',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại',
            'so_dien_thoai.digits' => 'Vui lòng nhập số điện thoại có 10 số',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',
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
