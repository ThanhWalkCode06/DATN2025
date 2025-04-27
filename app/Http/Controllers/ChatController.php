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

    // public function getChatUsers()
    // {
    //     $user_id = Auth::user()->id;

    //     // Lấy danh sách người dùng mà Admin đã từng trò chuyện (dù là người gửi hoặc người nhận)
    //     $users = User::select('users.id', 'users.username')
    //         ->whereIn('users.id', function ($query) use ($user_id) {
    //             $query->select('nguoi_gui_id')
    //                 ->from('chats')
    //                 ->where('nguoi_nhan_id', $user_id)
    //                 ->where('nguoi_gui_id', '!=', $user_id)
    //                 ->union(
    //                     \DB::table('chats')
    //                         ->select('nguoi_nhan_id')
    //                         ->where('nguoi_gui_id', $user_id)
    //                         ->where('nguoi_nhan_id', '!=', $user_id)
    //                 );
    //         })
    //         ->distinct()
    //         ->get();

    //     // Thêm số lượng tin nhắn chưa đọc
    //     $users->each(function ($user) use ($user_id) {
    //         $user->unread_count = Chat::where('nguoi_gui_id', $user->id)
    //             ->where('nguoi_nhan_id', $user_id)
    //             ->where('trang_thai', false)
    //             ->count();
    //     });

    //     return response()->json($users)->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    // }

    public function getChatUsers()
{
    $user_id = Auth::user()->id;

    // Lấy danh sách người dùng mà Admin đã từng trò chuyện (dù là người gửi hoặc người nhận)
    $users = User::select('users.id', 'users.username')
        ->whereIn('users.id', function ($query) use ($user_id) {
            $query->select('nguoi_gui_id')
                ->from('chats')
                ->where('nguoi_nhan_id', $user_id)
                ->where('nguoi_gui_id', '!=', $user_id)
                ->union(
                    \DB::table('chats')
                        ->select('nguoi_nhan_id')
                        ->where('nguoi_gui_id', $user_id)
                        ->where('nguoi_nhan_id', '!=', $user_id)
                );
        })
        ->distinct()
        ->get();

    // Thêm số lượng tin nhắn chưa đọc và thời gian tin nhắn mới nhất
    $users->each(function ($user) use ($user_id) {
        // Đếm số tin nhắn chưa đọc từ người dùng này gửi đến admin
        $user->unread_count = Chat::where('nguoi_gui_id', $user->id)
            ->where('nguoi_nhan_id', $user_id)
            ->where('trang_thai', false)
            ->count();

        // Lấy thời gian tin nhắn mới nhất giữa admin và người dùng này
        $latest_message = Chat::where(function ($query) use ($user_id, $user) {
                $query->where('nguoi_gui_id', $user_id)
                      ->where('nguoi_nhan_id', $user->id);
            })
            ->orWhere(function ($query) use ($user_id, $user) {
                $query->where('nguoi_gui_id', $user->id)
                      ->where('nguoi_nhan_id', $user_id);
            })
            ->orderBy('created_at', 'desc')
            ->first();

        $user->latest_message_time = $latest_message ? $latest_message->created_at->toDateTimeString() : null;
    });

    // Sắp xếp danh sách người dùng theo thời gian tin nhắn mới nhất (giảm dần)
    $users = $users->sortByDesc('latest_message_time')->values();

    \Log::info('Chat users fetched', [
        'user_id' => $user_id,
        'users' => $users->toArray(),
    ]);

    return response()->json($users)->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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

        if (!$nguoiGui || !$nguoiNhan) {
            return response()->json(['message' => 'Người gửi hoặc người nhận không tồn tại'], 404);
        }

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
            'noi_dung' => $request->input('noi_dung') ?? '',
            'hinh_anh' => $hinhAnh,
            'channel' => $request->input('channel'),
            'trang_thai' => false,
            'created_at' => now(),
        ]);

        \Log::info('Broadcasting ChatEvent', [
            'chat' => $chat->toArray(),
            'channels' => [
                'to_nguoi_nhan' => 'chat.' . $chat->nguoi_nhan_id,
                'to_nguoi_gui' => 'chat.' . $chat->nguoi_gui_id,
            ]
        ]);

        broadcast(new ChatEvent($chat))->toOthers();

        return response()->json([
            'chat' => [
                'id' => $chat->id,
                'nguoi_gui_id' => $chat->nguoi_gui_id,
                'nguoi_nhan_id' => $chat->nguoi_nhan_id,
                'ten_nguoi_gui' => $chat->ten_nguoi_gui,
                'ten_nguoi_nhan' => $chat->ten_nguoi_nhan,
                'noi_dung' => $chat->noi_dung,
                'hinh_anh' => $chat->hinh_anh,
                'created_at' => $chat->created_at->toDateTimeString(),
            ],
            'message' => 'Tin nhắn đã được gửi thành công',
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
