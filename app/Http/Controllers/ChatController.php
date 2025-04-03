<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Chat;
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
        $chat = Chat::create([
            'nguoi_gui_id' => Auth::user()->id,
            'nguoi_nhan_id' => 1,
            'noi_dung' => $request->noi_dung,
            'created_at' => now()
        ]);

        broadcast(new ChatEvent($chat))->toOthers();
        return response()->json(['message' => 'Gửi tin nhắn thành công!', 'chat' => $chat]);
    }
}
