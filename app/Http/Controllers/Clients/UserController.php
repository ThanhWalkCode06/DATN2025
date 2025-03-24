<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\BienThe;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Client\UserRequest;

class UserController extends Controller
{
    public function chiTiet()
    {
        $user = Auth::user();
        // dd($user);
        $donHangsPaginate = $user->donHangs()->paginate(5);
        $i = 0;
        if($user){
            foreach($donHangsPaginate as $item){
                $i += ($item->trang_thai_don_hang == 0) ? 1 : 0;
            }
            return view('clients.users.chitiet',compact('user','i','donHangsPaginate'));
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

    public function orderTracking(string $id){
        if(Auth::user()){
            $donHang = DonHang::where('id',$id)->get();

            $bienThes = DonHang::where('id', $id)->with('bienThes')->first();
            $bienThesPaginated = $bienThes->bienThes()->paginate(5);

            $bienThesList = $bienThesPaginated->map(fn($bienThe) => [
                'anh_bien_the' => $bienThe->anh_bien_the,
                'ten_bien_the' => $bienThe->sanPham->ten_san_pham . ' - ' . $bienThe->ten_bien_the,
                'gia_ban' => $bienThe->gia_ban,
                'so_luong' => $bienThe->pivot->so_luong,
                'id_san_pham' => $bienThe->san_pham_id,
            ]);
            // dd($bienThesList);
            return view('clients.users.ordertracking', compact('donHang','bienThesList','bienThesPaginated'));
        }else{
            return redirect()->route('login.client');
        }
    }

    public function updateTrangThai(Request $request,string $id){
        $donHang = DonHang::find($id);
        // dd($donHang,$request->trang_thai);
        $donHang->update([
            "trang_thai_don_hang" => $request->trang_thai
        ]);
        return redirect()->back()->with('success','Cập nhật trạng thái đơn hàng thành công');
    }
}
