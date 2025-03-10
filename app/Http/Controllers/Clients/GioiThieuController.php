<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GioiThieuController extends Controller
{
    public function home()
    {
        return view('clients.gioithieu');
    }
}
