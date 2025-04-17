<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function showAdminChat()
    {
        return view('admins.chat');
    }

    public function getChatUsers()
    {
        $user_id = Auth::user()->id;
        $users = Chat::select('users.id', 'users.ten_nguoi_dung')
            ->where('nguoi_nhan_id', '=', $user_id)
            ->join('users', 'nguoi_gui_id', '=', 'users.id')
            ->distinct()
            ->get();

        return response()->json($users);
    }

    public function getMessages($nguoi_nhan_id)
    {
        $user_id = Auth::user()->id;

        $messages = Chat::where(function ($query) use ($user_id, $nguoi_nhan_id): void {
            $query->where('nguoi_gui_id', $user_id)
                ->where('nguoi_nhan_id', $nguoi_nhan_id);
        })
            ->orWhere(function ($query) use ($user_id, $nguoi_nhan_id): void {
                $query->where('nguoi_gui_id', $nguoi_nhan_id)
                    ->where('nguoi_nhan_id', $user_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendChat(Request $request)
{

   

    $nguoiGui = User::find($request->input('nguoi_gui_id'));
    $nguoiNhan = User::find($request->input('nguoi_nhan_id'));

    // Khởi tạo biến lưu đường dẫn hình ảnh/video
    $hinhAnh = null;

    // Kiểm tra nếu có file media (hình ảnh hoặc video) được gửi kèm
    if ($request->hasFile('media')) {
        $file = $request->file('media');
        
        // Tạo tên file với dấu thời gian để tránh trùng lặp
        $tenTep = time() . '_' . $file->getClientOriginalName();
        
        // Lưu file vào thư mục 'uploads/chats' trong storage
        $duongDan = $file->storeAs('uploads/chats', $tenTep, 'public');
        
        // Lấy đường dẫn công khai của file
        $hinhAnh = asset('storage/' . $duongDan);
    }

    // Nếu không có nội dung và không có hình ảnh thì trả về lỗi
    if (!$request->input('noi_dung') && !$hinhAnh) {
        return response()->json(['message' => 'Vui lòng gửi tin nhắn hoặc hình ảnh'], 400);
    }

    // Tạo bản ghi chat mới
    $chat = Chat::create([
        'nguoi_gui_id' => $nguoiGui->id,
        'nguoi_nhan_id' => $nguoiNhan->id,
        'ten_nguoi_gui' => $nguoiGui->ten_nguoi_dung,
        'ten_nguoi_nhan' => $nguoiNhan->ten_nguoi_dung,
        'noi_dung' => $request->noi_dung ?? '',
        'hinh_anh' => $hinhAnh,
        'channel' => $request->input('channel'),
        'created_at' => now()
    ]);

    // Phát sự kiện chat cho các client khác
    broadcast(new ChatEvent($chat))->toOthers();

    // return response()->json(['message' => 'Gửi tin nhắn thành công!', 'chat' => $chat]);
      // Trả về tin nhắn và thời gian gửi
    return response()->json([
        'chat' => $chat,
        'created_at' => $chat->created_at->toDateTimeString(),
    ]);
}

    

}
