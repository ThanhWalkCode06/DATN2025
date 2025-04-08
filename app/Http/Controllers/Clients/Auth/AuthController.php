<?php

namespace App\Http\Controllers\Clients\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\Mail\ResetPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        if (Auth::user()) {
            return redirect()->back();
        }
        return view('clients.auth.login');
    }

    public function storeLogin(Request $request)
    {
        $user = $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Vui lòng nhập tên đăng nhập',
                'password.required' => 'Vui lòng nhập mật khẩu',

            ]
        );

        if (Auth::attempt($user)) {
            if ($request->remember_token == true) {
                // dd($request->remember_token);
                $currentUser = Auth::user();
                $currentUser->remember_token = $request->remember_token;
                $currentUser->save();

                setcookie('remember_token', $request->remember_token, time() + (86400 * 30), "/"); // 30 ngày
                setcookie('username', $request->username, time() + (86400 * 30), "/");
            }
            $userName = Auth::user()->username;
            // dd($userName);
            // $roles = Auth::user()->getRoleNames()->first();
            // dd($roles);
            session(['userName' => $userName]);
            return  redirect()->route('home');
        }
        return redirect()->back()->withErrors([
            'error' => 'Tài khoản hoặc mật khẩu không đúng'
        ]);
    }

    public function showRegister()
    {
        return view('clients.auth.register');
    }

    public function storeRegister(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],
            [
                'username.required' => 'Vui lòng nhập tên đăng nhập',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.required' => 'Vui lòng nhập mật khẩu dài ít nhất 6 kí tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'username.unique' => 'Tên tài khoản đã tồn tại',

            ]
        );

        $user = User::create($data);
        return redirect()->route('login.client')->with('success', 'Đăng ký thành công!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Cookie::queue(Cookie::forget('remember_token'));
        Cookie::queue(Cookie::forget('name'));
        $request->session()->forget('userName');
        return redirect()->route('home');
    }
    public function showForgetPass()
    {
        return view('clients.auth.forgetPass');
    }

    public function sendLinkForgetPass(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        // dd($user,$request->email);
        $email = $request->email;
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'email.exists' => 'Email này không tồn tại trong hệ thống',
            ]
        );
        if ($user) {
            // // Tạo token
            $token = Str::random(60);
            // Lưu token vào bảng password_resets
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => now()]
            );
            Mail::to($email)->send(new ResetPass($token, ''));
            return redirect()->route('login.client')->with(['success' => 'Bạn đã có thể vào gmail để lấy đường link lấy lại mật khẩu!']);
        }
        return redirect()->back()->withErrors([
            'error' => 'Thông tin người dùng không đúng'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function showResetPass(string $token)
    {

        return view('clients.auth.reset_passToken', compact('token'));
    }

    public function storeResetPass(Request $request, $token)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], [
            'password.required' => 'Mật khẩu không được để trống',
            'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
            'confirm_password.same' => 'Xác nhận mật khẩu không trùng với mật khẩu mới',
        ]);
        $user = DB::table('password_reset_tokens')->where('token', $token)->first();
        // dd($user);
        $email = $user->email;
        $pass = bcrypt($request->password);
        DB::table('users')->where('email', $email)->update(['password' => $pass]);
        return redirect()->route('login.client')->with(['success' => 'Đổi mật khẩu thành công.']);
    }

    public function editPass()
    {
        if (Auth::user()) {
            return view('clients.auth.editPass');
        } else {
            abort(403);
        }
    }

    public function UpdatePass(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $request->validate(
                [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                ],
                [
                    'password.required' => 'Mật khẩu không được để trống',
                    'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
                    'confirm_password.same' => 'Xác nhận mật khẩu không trùng với mật khẩu mới',
                ]
            );
            $pass = bcrypt($request->password);
            // dd($pass, $user->id);
            DB::table('users')->where('id', $user->id)->update(['password' => $pass]);
            $this->logout($request);

            return redirect()->route('login.client')->with(['success' => 'Bạn đã có thể đăng nhập với mật khẩu mới!']);
        } else {
            abort(403);
        }
    }
}
