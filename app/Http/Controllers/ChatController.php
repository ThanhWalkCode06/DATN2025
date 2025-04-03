<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
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
        $nguoiGui = User::find(Auth::user()->id);
        $nguoiNhan = User::find(1);

        $chat = Chat::create([
            'nguoi_gui_id' => Auth::user()->id,
            'nguoi_nhan_id' => 1,
            'ten_nguoi_gui' => $nguoiGui->ten_nguoi_dung,
            'ten_nguoi_nhan' => $nguoiNhan->ten_nguoi_dung,
            'noi_dung' => $request->noi_dung,
            'created_at' => now()
        ]);

        broadcast(new ChatEvent($chat))->toOthers();
        return response()->json(['message' => 'Gửi tin nhắn thành công!', 'chat' => $chat]);
    }
}
