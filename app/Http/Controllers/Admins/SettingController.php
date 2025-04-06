<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function common(Request $request){
        if($request->isMethod('get')){
            return view('admins.setting.configuration.index');
        }else if($request->isMethod('post')){

        $data = $request->validate([
            'logo' => 'image',
            'location' => 'required',
            'name_website' => 'required',
            'url_map' => 'required',
            'email_owner' => 'required',
            'phone' => 'required',
        ],
        [
            'logo.required' => 'Logo không được bỏ trống',
            'location.required' => 'Logo không được bỏ trống',
            'name_website.required' => 'Logo không được bỏ trống',
            'url_map.required' => 'Link google map không được trống',
            'phone.required' => 'Logo không được bỏ trống',
            'logo.image' => 'Logo phải là một hình ảnh',
            'logo.mimes' => 'Logo phải có đuôi.jpg,.png,.gif',
            'logo.max' => 'Kích thước logo phải nhỏ hơn 2MB',
            'email_owner.required' => 'Vui lòng nhập mail chủ sở hữu',

        ]);
        $setting = Setting::first(); // Lấy setting hiện tại
        if (!$setting) {
            $setting = new Setting();
        }
        // dd(Storage::exists("public/".$setting->logo),"app/public/".$setting->logo);
        if ($request->hasFile('logo')) {
            if($setting->logo && Storage::exists($setting->logo) ) {
                Storage::delete($setting->logo);
            }
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs("public/logos/", $fileName);
            $data['logo'] = "public/logos/".$fileName;;
        }
        $setting->fill($data);
        $setting->save();

        return back()->with('success', 'Cập nhật thành công!');
    }
        //     $data = $request->except('_token');
        //     // dd($data);
        //     foreach ($data as $key => $value) {
        //         $this->updateEnv($key, $value);
        //     }
        //     Artisan::call('config:clear');
        //     session()->flash('success', 'Cấu hình đã được cập nhật!');
        //     return redirect()->back();
        // }
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
                unlink(storage_path('app/public/'.Auth::user()->anh_dai_dien));
            }
            $fileName = time() . '_' . $request->file('anh_dai_dien')->getClientOriginalName();
            $request->file('anh_dai_dien')->storeAs("public/uploads/user/", $fileName);
            $data['anh_dai_dien'] = 'uploads/user/' . $fileName;;
        }

        // dd($request->hasFile($request->anh_dai_dien));
        User::where('id',Auth::user()->id)->update($data);
        session()->flash('success', 'Sửa thông tin thành công!');

        return redirect()->route('setting-infor.private');
    }
}

//     public function uploadLogo(Request $request){
//         $setting = Setting::first(); // Lấy setting hiện tại
//         if (!$setting) {
//             $setting = new Setting();
//         }

//         if ($request->hasFile('logo')) {
//             $logoPath = $request->file('logo')->store('logos', 'public'); // Lưu vào storage/public/logos
//             $setting->logo = 'storage/' . $logoPath;
//         }

//         $setting->save();

//         return back()->with('success', 'Cập nhật logo thành công!');
//     }
}
