<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Data statis sementara tanpa database
        $jumlah_kelas = 5;
        $total_mahasiswa = 120;
        $metode_dominan = "Visual";

        $kelas = [
            (object) ['nama_kelas' => 'IK313 - Basis Data A', 'persen_visual' => 83, 'persen_auditori' => 15, 'persen_kinestetik' => 2],
            (object) ['nama_kelas' => 'IK314 - Pemrograman Web', 'persen_visual' => 75, 'persen_auditori' => 20, 'persen_kinestetik' => 5],
        ];


        return view('dashboard-dosen', compact('jumlah_kelas', 'total_mahasiswa', 'metode_dominan', 'kelas'));
    }
}
