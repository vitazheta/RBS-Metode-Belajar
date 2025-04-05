<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_mata_kuliah' => 'required|string|max:20|unique:kelas,kode_mata_kuliah',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }
}
