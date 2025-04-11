<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;

class HasilRekomendasiController extends Controller
{
    public function show($id)
    {
        // Ambil data kelas berdasarkan id
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);

        // Cek apakah dosen yang login adalah pemilik kelas ini
        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        // Ambil semua data mahasiswa di kelas tersebut
        $mahasiswa = DataMahasiswa::where('kelas_id', $kelas->id)->get();

        // Hitung jumlah masing-masing gaya belajar
        $jumlahVisual = $mahasiswa->where('profil', 'Visual')->count();
        $jumlahAuditori = $mahasiswa->where('profil', 'Auditori')->count();
        $jumlahKinestetik = $mahasiswa->where('profil', 'Kinestetik')->count();

        // Kirim semua data ke view
        return view('hasil_rekomendasi', compact(
            'kelas',
            'mahasiswa',
            'jumlahVisual',
            'jumlahAuditori',
            'jumlahKinestetik'
        ));
    }
}
