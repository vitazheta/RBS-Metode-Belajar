<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa;

class RekomendasiMetodeController extends Controller
{
    public function index()
    {
        $data = DataMahasiswa::latest()->first();

        $rataRata = ($data->akademik + $data->ekonomi + $data->endurance + $data->profil_sekolah + $data->profil_ortu + $data->pola_belajar + $data->adaptasi) / 7;

        if ($rataRata >= 4) {
            $metode = 'Problem-Based Learning';
            $alasan = 'Mahasiswa menunjukkan kesiapan tinggi di hampir semua aspek, cocok untuk pembelajaran yang menantang dan mandiri.';
        } elseif ($rataRata >= 3) {
            $metode = 'Collaborative Learning';
            $alasan = 'Mahasiswa berada pada tingkat kesiapan sedang, sehingga cocok belajar dalam kelompok untuk saling melengkapi.';
        } elseif ($rataRata >= 2) {
            $metode = 'Guided Instruction';
            $alasan = 'Mahasiswa membutuhkan arahan lebih dari dosen, sehingga metode belajar terstruktur dan dibimbing lebih sesuai.';
        } else {
            $metode = 'Direct Instruction';
            $alasan = 'Mahasiswa perlu penguatan dasar secara intensif, pembelajaran langsung dari dosen lebih tepat.';
        }

        return view('rekomendasimetode', compact('metode', 'alasan'));
    }
}
