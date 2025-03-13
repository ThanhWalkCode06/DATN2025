<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function chiTiet()
    {
        return view('clients.users.chitiet');
    }
}
