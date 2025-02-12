<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function index()
    {
        return view('admins.danhgia');
    }
}
