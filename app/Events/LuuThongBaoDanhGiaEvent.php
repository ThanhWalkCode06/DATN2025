<?php

namespace App\Events;

use App\Models\ThongBao;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LuuThongBaoDanhGiaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thongBao;

    public function __construct(ThongBao $thongBao)
    {
        $this->thongBao = $thongBao;
    }

    public function broadcastOn()
    {
        return new Channel('notifications-' . $this->thongBao->user_id);
    }

    public function broadcastAs()
    {
        return 'new-notification';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->thongBao->id,
            'noi_dung' => $this->thongBao->noi_dung,
            'nhan_xet' => $this->thongBao->danhGia->nhan_xet ?? null,
            'created_at' => $this->thongBao->created_at->diffForHumans(), // "1 giờ trước"
            'created_at_full' => $this->thongBao->created_at->format('d/m/Y H:i'), // Ngày tháng đầy đủ: "19/04/2025 14:30"
            'product_name' => optional($this->thongBao->danhGia->sanPham)->ten_san_pham ?? 'Không xác định',
            'ly_do_an' => $this->thongBao->danhGia->ly_do_an ?? null,
        ];
    }
}