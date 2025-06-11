<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Menjamin user sudah login
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Jika belum login, kembalikan ke login
        }

        // Ambil nama dosen dari model User (dosen yang sedang login)
        $dosen = Auth::user(); // Pastikan ini mengambil data dosen yang login

        // Ambil data kelas yang diajar oleh dosen ini dari database
        $kelas = \App\Models\Kelas::where('dosen_id', $dosen->id)->with('mahasiswa')->get();

        // Hitung jumlah kelas
        $jumlah_kelas = $kelas->count();

        // Hitung total mahasiswa dari seluruh kelas
        $total_mahasiswa = $kelas->sum(function ($kelas) {
            return $kelas->mahasiswa->count();
        });

        // Tentukan jalur masuk dominan berdasarkan data
        $jalur_masuk_data = $kelas->flatMap(function ($kelas) {
            return $kelas->mahasiswa->pluck('jalur_masuk');
        })->countBy();

        // Ubah data jalur masuk menjadi persentase
        $jalur_masuk_persen = $jalur_masuk_data->map(function ($count) use ($total_mahasiswa) {
            return ($total_mahasiswa > 0) ? round(($count / $total_mahasiswa) * 100, 2) : 0;
        });

        // Tentukan jalur masuk dominan
        $jalur_masuk_dominan = $jalur_masuk_persen->sortDesc()->keys()->first();

        // Siapkan data persentase untuk setiap aspek di setiap kelas
        $kelas->map(function ($k) {
            $total_mahasiswa_kelas = $k->mahasiswa->count();

            $k->persen_akademik = $total_mahasiswa_kelas > 0
                ? round($k->mahasiswa->avg('akademik_total'), 2)
                : 0;

            $k->persen_latar_belakang = $total_mahasiswa_kelas > 0
                ? round($k->mahasiswa->avg('sekolah_total'), 2)
                : 0;

            $k->persen_pola_belajar = $total_mahasiswa_kelas > 0
                ? round($k->mahasiswa->avg('ekonomi_total'), 2)
                : 0;

            $k->persen_perkuliahan = $total_mahasiswa_kelas > 0
                ? round($k->mahasiswa->avg('perkuliahan_total'), 2)
                : 0;

            return $k;
        });

        // Passing data ke view
        return view('dashboard-dosen', compact(
            'jumlah_kelas',
            'total_mahasiswa',
            'jalur_masuk_persen',
            'jalur_masuk_dominan',
            'kelas',
            'dosen'
        ));
    }
}
