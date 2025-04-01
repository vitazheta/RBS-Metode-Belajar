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

    // Data lainnya
    $jumlah_kelas = 5;
    $total_mahasiswa = 120;
    $metode_dominan = "Visual";

    $kelas = [
        (object) ['nama_kelas' => 'IK313 - Basis Data A', 'persen_visual' => 83, 'persen_auditori' => 15, 'persen_kinestetik' => 2],
        (object) ['nama_kelas' => 'IK314 - Pemrograman Web', 'persen_visual' => 75, 'persen_auditori' => 20, 'persen_kinestetik' => 5],
    ];

    // Passing data ke view
    return view('dashboard-dosen', compact('jumlah_kelas', 'total_mahasiswa', 'metode_dominan', 'kelas', 'dosen')); // Pastikan 'dosen' ada di sini
}

}
