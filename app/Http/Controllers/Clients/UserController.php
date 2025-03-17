<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Client\UserRequest;

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

    public function updateInfor(UserRequest $request, string $id){
        $data = $request->all();
        $user = User::findOrFail($id);
        // dd(file_exists(storage_path("app/public/user".Auth::user()->anh_dai_dien)));
        if($request->hasFile('anh_dai_dien')){
            if(Auth::user()->anh_dai_dien && file_exists(storage_path("app/public/".Auth::user()->anh_dai_dien))){
                unlink(storage_path('app/public/'.Auth::user()->anh_dai_dien));
            }
            $fileName = time() . '_' . $request->file('anh_dai_dien')->getClientOriginalName();
            $request->file('anh_dai_dien')->storeAs("public/uploads/user/", $fileName);
            $data['anh_dai_dien'] = 'uploads/user/' . $fileName;
        }
        $user->update($data);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    public function deleteWishList(string $id){

    }
}
