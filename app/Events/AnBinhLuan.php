<?php

namespace App\Events;

use App\Models\DanhGia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AnBinhLuan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $danhGia;

    public function __construct(DanhGia $danhGia)
    {
        $this->danhGia = $danhGia;
    }

    public function broadcastOn()
    {
        return new Channel('comment-hidden-' . $this->danhGia->user_id);
    }

    public function broadcastAs()
    {
        return 'hide-comment';
    }

    public function broadcastWith()
    {
        return [
            'message' => 'Bình luận của bạn đã bị ẩn bởi quản trị viên.',
            'comment_id' => $this->danhGia->id,
            'reasons' => $this->danhGia->ly_do_an,
            'product_name' => optional($this->danhGia->sanPham)->ten_san_pham ?? 'Không xác định'
        ];
    }
}
