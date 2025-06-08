<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;
use Illuminate\Support\Facades\Auth;

class DataMahasiswaController extends Controller
{
    public function simpan(Request $request)
    {
        $mahasiswaArray = $request->mahasiswa ?? [];
        if (!is_array($mahasiswaArray)) $mahasiswaArray = [];

        $kelas = new Kelas();
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->kode_mata_kuliah = $request->kode_mata_kuliah;
        $kelas->dosen_id = Auth::guard('dosen')->id();
        $kelas->save();

        foreach ($mahasiswaArray as $data) {
            $nama = $data['nama'] ?? null;
            if (empty($nama)) continue;
            DataMahasiswa::create([
                'kelas_id' => $kelas->id,
                'nama_lengkap' => $nama,
                'asal_sekolah' => $data['asal_sekolah'] ?? null,
                'jalur_masuk' => $data['jalur_masuk'] ?? null,
                'akademik_total' => $data['akademik'] ?? null,
                'sekolah_total' => $data['sekolah'] ?? null,
                'ekonomi_total' => $data['ekonomi'] ?? null,
                'perkuliahan_total' => $data['perkuliahan'] ?? null,
            ]);
        }

        return redirect()->route('hasil.rekomendasi', ['id' => $kelas->id]);
    }
}
