<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPass extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $url;
    /**
     * Create a new message instance.
     */
    public function __construct($token,$type)
    {
        $this->token = $token;
        if ($type === 'admin') {
            $this->url = route('showResetPass', ['token' => $token]);
        } else {
            $this->url = route('showResetPass.client', ['token' => $token]);
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Website Seven Star',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admins.auth.mailForgetPass',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
                    ->with([
                        'token' => $this->token,
                    ]);
    }
}
