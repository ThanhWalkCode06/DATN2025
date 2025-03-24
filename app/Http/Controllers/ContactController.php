<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
        public function send(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        // Hợp nhất họ và tên
        $details = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message']
        ];

        Mail::send('emails.contact', ['details' => $details], function ($message) use ($details) {
            $message->to('starsseven.2025@gmail.com')
                ->subject('Liên hệ mới từ ' . $details['name']);
        });

        return back()->with('success', 'Tin nhắn đã được gửi thành công!');
    }
}
