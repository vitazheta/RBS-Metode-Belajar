<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\DataMahasiswa;
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

        // Simpan data kelas
        $kelas = Kelas::create([
            'dosen_id' => Auth::user()->id, // asumsi user login adalah dosen
            'nama_kelas' => $request->nama_kelas,
            'kode_matkul' => $request->kode_matkul,
        ]);

        $file = $request->file('csv_file');
        $data = array_map('str_getcsv', file($file));
        $header = array_map('strtolower', array_map('trim', $data[0]));

        unset($data[0]); // Buang header

        foreach ($data as $row) {
            $siswaData = array_combine($header, $row);
    
            DataMahasiswa::create([
                'kelas_id' => $kelas->id,
                'nama_lengkap' => $row[0],
                'email' => $row[1],
                'jalur_masuk' => $row[2],
                'kesiapan_akademik' => $row[3],
                'kesiapan_ekonomi' => $row[4],
                'endurance_cita-cita' => $row[5],
                'profil_sekolah' => $row[6],
                'profil_ortu' => $row[7],
                'pola_belajar' => $row[8],
                'kemampuan_adaptasi' => $row[9],
            ]);
        }
        session(['kelas_id' => $kelas->id]);
        return redirect()->route('kelas.show', $kelas->id);
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