<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DynamicTableController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman dynamic table
        return view('dynamic_table');
    }
}
