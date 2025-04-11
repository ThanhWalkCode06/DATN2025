<?php

namespace App\Mail;

use App\Models\PhieuGiamGia;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BirthdayCouponMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $coupon;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, PhieuGiamGia $coupon)
    {
        $this->user = $user;
        $this->coupon = $coupon;
        $this->url = route('home');
    }

    public function build()
    {
        return $this->subject('Chúc mừng sinh nhật! Đây là mã giảm giá của bạn')
            ->view('emails.birthday_coupon');
    }
}
