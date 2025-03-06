<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    public function index()
    {
        return view('clients.baiviets.index');
    }

    public function show()
    {
        return view('clients.baiviets.show');
    }
}
