<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && ($user->trang_thai === 0 )) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error'=>'Tài khoản đã bị cấm']);
        }if ($user->roles->isEmpty()) {
            return response()->view('errors.403', [
                'previousUrl' => url()->previous() !== url()->current() ? url()->previous() : route('index')
            ], 403);
        }


        return $next($request);
    }
}
