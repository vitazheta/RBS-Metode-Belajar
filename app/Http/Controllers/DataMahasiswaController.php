<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;
use Illuminate\Support\Facades\Auth;


class DataMahasiswaController extends Controller
{
    public function generate(Request $request)
    {
        return "Generate berhasil!";
    }

    public function simpan(Request $request)
{
    \Log::info('Nama Kelas:', [$request->nama_kelas]);
    \Log::info('Mahasiswa JSON:', [$request->mahasiswa]);
    \Log::info('Request diterima:', $request->all());

    // Simpan data kelas
    $kelas = new Kelas();
    $kelas->nama_kelas = $request->nama_kelas;
    $kelas->kode_mata_kuliah = $request->kode_mata_kuliah;
    $kelas->dosen_id = Auth::guard('dosen')->id();
    \Log::info('Dosen yang login:', [Auth::guard('dosen')->user()]);

    $saved = $kelas->save();
    \Log::info('Berhasil simpan kelas?', [$saved]);
    \Log::info('ID kelas:', [$kelas->id]);


    // Decode JSON dulu!
    $mahasiswaArray = $request->mahasiswa;


    foreach ($mahasiswaArray as $data) {

       if (!$data['nama']) continue; // Skip data yang tidak lengkap
        \Log::info('Isi data mahasiswa:', $data);

        $mahasiswaBaru = DataMahasiswa::create([
            'kelas_id' => $kelas->id,
            'nama_lengkap' => $data['nama'],
            'asal_sekolah' => $data['asal_sekolah'],
            'jalur_masuk' => $data['jalur_masuk'],
            'akademik_endurance' => $data['akademik_endurance'],
            'latar_belakang' => $data['latar_belakang'],
            'pola_belajar' => $data['pola_belajar'],
            'perkuliahan' => $data['perkuliahan'],
        ]);

        \Log::info('Berhasil simpan mahasiswa:', $mahasiswaBaru->toArray());
    }

     // 3. Redirect ke halaman hasil rekomendasi kelas yang baru disimpan
     return redirect()->route('hasil.rekomendasi', ['id' => $kelas->id]);

    // return redirect()->route('dashboard.dosen')->with('success', 'Data berhasil disimpan.');
}




}
