<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;



class KelasController extends Controller
{
    public function index()
    {
        $daftarKelas = Kelas::all();
        return view('kelas.index', compact('daftarKelas'));
    }

    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        foreach ($kelas->mahasiswa as $index => $mhs) {
            $mhs->update([
                'nama_lengkap' => $request->nama[$index],
                'email' => $request->email[$index],
                'jalur_masuk' => $request->jalur_masuk[$index],
                // Tambahkan field lain jika perlu
            ]);
        }

        return redirect()->route('data.kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function preview(Request $request)
    {
        session([
            'summary' => [
                'nama_kelas' => $request->nama_kelas,
                'kode_mata_kuliah' => $request->kode_mata_kuliah,
                'mahasiswa' => $request->mahasiswa // dari input JSON atau array form
            ]
        ]);

        return back();
    }

    public function store(Request $request)
    {
        // Decode JSON dari input hidden
        $mahasiswa = json_decode($request->input('mahasiswa_data'), true);

        // Validasi dasar untuk kelas
        $validatedKelas = $request->validate([
            'nama_kelas' => 'required|string',
            'kode_mata_kuliah' => 'required|string',
        ]);

        // Validasi data mahasiswa manual setelah decode
        if (!is_array($mahasiswa) || count($mahasiswa) === 0) {
            return back()->withErrors(['mahasiswa_data' => 'Data mahasiswa tidak valid.']);
        }

        foreach ($mahasiswa as $mhs) {
            // Cek field wajib
            if (empty($mhs['nama']) || empty($mhs['email'])) {
                return back()->withErrors(['mahasiswa_data' => 'Semua mahasiswa harus punya nama dan email.']);
            }
        }

        // Simpan kelas
        $kelas = Kelas::create([
            'dosen_id' => auth()->user()->id,
            'nama_kelas' => $validatedKelas['nama_kelas'],
            'kode_mata_kuliah' => $validatedKelas['kode_mata_kuliah'],
        ]);

        // Simpan data mahasiswa
        foreach ($mahasiswa as $mhs) {
            DataMahasiswa::create([
                'kelas_id' => $kelas->id,
                'nama' => $mhs['nama'],
                'email' => $mhs['email'],
                'jalur_masuk' => $mhs['jalur_masuk'] ?? null,
                'kesiapan_akademik' => $mhs['kesiapan_akademik'] ?? null,
                'kesiapan_ekonomi' => $mhs['kesiapan_ekonomi'] ?? null,
                'endurance_cita_cita' => $mhs['endurance_cita_cita'] ?? null,
                'profil_sekolah' => $mhs['profil_sekolah'] ?? null,
                'profil_ortu' => $mhs['profil_ortu'] ?? null,
                'pola_belajar' => $mhs['pola_belajar'] ?? null,
                'adaptasi' => $mhs['adaptasi'] ?? null,
            ]);
        }

        return redirect()->route('hasil.rekomendasi', ['kelas' => $kelas->id]);
    }


}
