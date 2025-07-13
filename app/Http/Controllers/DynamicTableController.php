<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class DynamicTableController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_mata_kuliah' => 'required|string|max:255',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
            'dosen_id' => auth()->guard('dosen')->user()->id,
        ]);

        return redirect()->route('dynamic.table')->with('success', 'Data kelas berhasil disimpan!');
    }

    public function index()
    {
        session()->forget(['processedData', 'nama_kelas', 'kode_mata_kuliah']);
        return view('dynamic_table');
    }
}
