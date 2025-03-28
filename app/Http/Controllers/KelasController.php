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
            'kode_matkul' => 'required|string|max:20|unique:kelas,kode_matkul',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_matkul' => $request->kode_matkul,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }
}
