<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function showPelajari()
    {
        return view('info.pelajari'); // pastikan file blade-nya ada
    }
}

