<?php

namespace App\Http\Controllers\Admins\Auth;

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
        return view('admins.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        // $user = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);
        // if(Auth::attempt($user)){
        //     if($request->remember_token == true) {
        //         $currentUser = Auth::user();
        //         $currentUser->remember_token = $request->remember_token;
        //         $currentUser->save();

        //         setcookie('remember_token', $request->remember_token, time() + (86400 * 30), "/"); // 30 ngày
        //         setcookie('name', $request->username, time() + (86400 * 30), "/");

        //     }
        //     $userName = Auth::user()->name;
        //     // $roles = Auth::user()->getRoleNames()->first();
        //     // dd($roles);
        //     // session(['userName' => $userName, 'roleNames' => $roles]);
        //     redirect()->intended('/');
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        // Auth::logout();
        // Cookie::queue(Cookie::forget('remember_token'));
        // Cookie::queue(Cookie::forget('name'));
        // $request->session()->forget('userName');
        return redirect()->route('admin.logout');
    }
    public function showForgetPass(){
        return view('admins.auth.forgetPass');
    }

    public function sendLinkForgetPass(Request $request){
    //     $user = User::query()->where('email',$request->email)->first();
    //     $email = $request->email;
    //     $request->validate([
    //         'email' =>'required|email|exists:users,email',
    //     ],['email.exists' => 'Email not exists']);

    // // Tạo token
    $token = Str::random(60);
    // Lưu token vào bảng password_resets
    // DB::table('password_reset_tokens')->updateOrInsert(
    //     ['email' => $email],
    //     ['token' => $token, 'created_at' => now()]
    // );
    Mail::to('thanhnguyen062004@gmail.com')->send(new ResetPass($token));

    return redirect()->route('login')->with(['success' => 'you can check your mail let access link!']);
}
    /**
     * Display the specified resource.
     */
    public function showResetPass(string $token){

        return view('admins.auth.reset_passToken',compact('token'));
    }

    public function storeResetPass(Request $request, $token){
        // $user = DB::table('password_reset_tokens')->where('token',$token)->first();
        // $email = $user->email;
        // $request->validate([
        //     'password' => 'required',
        //     'confirm_password' => 'required|same:password',
        // ]);
        // $pass = bcrypt($request->password);
        // DB::table('users')->where('email', $email)->update(['password' => $pass]);

    return redirect()->route('login')->with('success','You could login');
    }

    public function editPass(){
        if(Auth::user()){
        return view('admins.auth.editPass');
        }else{
            abort(403);
        }
    }

    public function UpdatePass(Request $request){
    if(Auth::user()){
        $user = Auth::user();
    //     $request->validate([
    //         'password' => 'required',
    //         'confirm_password' => 'required|same:password',
    //     ]);
    //     $pass = bcrypt($request->password);
    //     // dd($pass, $user->id);
    //     DB::table('users')->where('id', $user->id)->update(['password' => $pass]);

    // return redirect()->route('login')->with('success',', you did change password. Please login again');
    }else{
        abort(403);
    }
    }
}
