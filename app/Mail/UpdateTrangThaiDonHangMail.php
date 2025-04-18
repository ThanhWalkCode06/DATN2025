<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateTrangThaiDonHangMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donhang;
    public $trangThaiText;
    public $user;

    public function __construct($donhang, $trangThaiText, $user)
    {
        $this->donhang = $donhang;
        $this->trangThaiText = $trangThaiText;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("Đơn hàng #{$this->donhang->ma_don_hang} - {$this->trangThaiText}")
            ->view('emails.donhang_trangthai');
    }
}
