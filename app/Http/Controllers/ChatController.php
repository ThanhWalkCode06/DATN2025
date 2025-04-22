<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessageNotification;

class ChatController extends Controller
{
    public function showAdminChat()
    {
        return view('admins.chat');
    }

    public function getChatUsers()
    {
        $user_id = Auth::user()->id;
        $users = Chat::select('users.id', 'users.username')
            ->where('nguoi_nhan_id', '=', $user_id)
            ->join('users', 'nguoi_gui_id', '=', 'users.id')
            ->distinct()
            ->get();
        // Thêm số lượng tin nhắn chưa đọc cho mỗi người dùng
    $users->each(function ($user) use ($user_id) {
        $user->unread_count = Chat::where('nguoi_gui_id', $user->id)
            ->where('nguoi_nhan_id', $user_id)
            ->where('trang_thai', false)
            ->count();
    });

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

            return response()->json($messages)->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    public function sendChat(Request $request)
    {
        $nguoiGui = User::find($request->input('nguoi_gui_id'));
        $nguoiNhan = User::find($request->input('nguoi_nhan_id'));
    
        $hinhAnh = null;
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $tenTep = time() . '_' . $file->getClientOriginalName();
            $duongDan = $file->storeAs('uploads/chats', $tenTep, 'public');
            $hinhAnh = asset('storage/' . $duongDan);
        }
    
        if (!$request->input('noi_dung') && !$hinhAnh) {
            return response()->json(['message' => 'Vui lòng gửi tin nhắn hoặc hình ảnh'], 400);
        }
    
        $chat = Chat::create([
            'nguoi_gui_id' => $nguoiGui->id,
            'nguoi_nhan_id' => $nguoiNhan->id,
            'ten_nguoi_gui' => $nguoiGui->username,
            'ten_nguoi_nhan' => $nguoiNhan->username,
            'noi_dung' => $request->noi_dung ?? '',
            'hinh_anh' => $hinhAnh,
            'channel' => $request->input('channel'),
            'trang_thai' => false,
            'created_at' => now()
        ]);
    
        \Log::info('Broadcasting ChatEvent', [
            'chat' => $chat->toArray(),
            'channel' => 'chat.' . $chat->nguoi_nhan_id
        ]);
    
        broadcast(new ChatEvent($chat))->toOthers();
    
        return response()->json([
            'chat' => $chat,
            'created_at' => $chat->created_at->toDateTimeString(),
        ]);
    }


public function markAsRead($partner_id)
{
    $user_id = Auth::id();

    // Đánh dấu tất cả tin nhắn từ partner_id gửi đến user_id là đã đọc
    $updated = Chat::where('nguoi_gui_id', $partner_id)
        ->where('nguoi_nhan_id', $user_id)
        ->where('trang_thai', false)
        ->update(['trang_thai' => true]);

    \Log::info('Mark as read called', [
        'user_id' => $user_id,
        'partner_id' => $partner_id,
        'updated_rows' => $updated
    ]);

    return response()->json([
        'message' => 'Tin nhắn đã được đánh dấu là đã đọc',
        'updated_rows' => $updated
    ]);
}

}
