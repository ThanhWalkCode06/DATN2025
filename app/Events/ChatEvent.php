<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return [
        //     new Channel('chat.' . $this->chat->channel),
        // ];
        // Phát sự kiện tới cả kênh của người gửi và người nhận
        return [
            new Channel('chat.' . $this->chat->nguoi_nhan_id),
            new Channel('chat.' . $this->chat->nguoi_gui_id),
        ];
    }

    public function broadcastAs()
    {
        return 'send-chat';
    }

    public function broadcastWith()
    {
        return [
            'chat' => [
                'id' => $this->chat->id,
                'nguoi_gui_id' => $this->chat->nguoi_gui_id,
                'nguoi_nhan_id' => $this->chat->nguoi_nhan_id,
                'ten_nguoi_gui' => $this->chat->ten_nguoi_gui,
                'ten_nguoi_nhan' => $this->chat->ten_nguoi_nhan,
                'noi_dung' => $this->chat->noi_dung,
                'hinh_anh' => $this->chat->hinh_anh,
                'created_at' => $this->chat->created_at->toDateTimeString(),
            ]
        ];
    }
}
