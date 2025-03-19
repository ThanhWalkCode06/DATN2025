<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function chiTiet()
    {
        $user = Auth::user();
        $i = 0;
        if($user){
            foreach($user->donHangs as $item){
                $i += ($item->trang_thai_don_hang == 0) ? 1 : 0;
            }
            return view('clients.users.chitiet',compact('user','i'));
        }else{
            return redirect()->route('login.client');
        }

    }

    public function deleteWishList(string $id){

    }
}
