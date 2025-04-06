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
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
        ]);

        $file = $request->file('csv_file');
        $data = array_map('str_getcsv', file($file));
        $header = array_map('strtolower', array_map('trim', $data[0]));

        unset($data[0]); // Buang header

        foreach ($data as $row) {
            $siswaData = array_combine($header, $row);
    
            Siswa::create([
                'nama' => $siswaData['nama'],
                'email' => $siswaData['email'],
                'jalur_masuk' => $siswaData['jalur_masuk'],
                'akademik' => $siswaData['akademik'],
                'ekonomi' => $siswaData['ekonomi'],
                'endurance' => $siswaData['endurance'],
                'profil_sekolah' => $siswaData['profil_sekolah'],
                'profil_ortu' => $siswaData['profil_ortu'],
                'pola_belajar' => $siswaData['pola_belajar'],
                'adaptasi' => $siswaData['adaptasi'],
                'kelas_id' => $kelas->id,
            ]);
        }
        session(['kelas_id' => $kelas->id]);
        return redirect()->route('dynamic.table')->with('success', 'Kelas dan data siswa berhasil ditambahkan.')->with('kelas_id', $kelas->id);
    }

    public function edit($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        foreach ($kelas->siswa as $index => $siswa) {
            $siswa->update([
                'nama' => $request->nama[$index],
                'email' => $request->email[$index],
                'jalur_masuk' => $request->jalur_masuk[$index],
            ]);
        }

        return redirect()->route('data.kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function index()
    {
        $daftarKelas = \App\Models\Kelas::all();
        return view('kelas.index', compact('daftarKelas'));
    }

    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

}