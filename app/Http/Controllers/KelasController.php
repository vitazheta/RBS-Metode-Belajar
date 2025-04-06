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
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
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

    // Fungsi untuk generate metode belajar
    public function generateMetode(Request $request)
    {
        $dataSiswa = session('data'); // Ambil data siswa dari session
        $namaKelas = session('nama_kelas')[0] ?? 'Kelas X';
        $kodeMatkul = session('kode_mata_kuliah')[0] ?? 'MAT101';

        if (!$dataSiswa) {
            return redirect()->back()->with('error', 'Tidak ada data siswa untuk diproses.');
        }

        // Simulasi hasil analisis
        $metodeCounts = [
            'Visual' => 15,
            'Auditori' => 10,
            'Kinestetik' => 5,
        ];
        $total = array_sum($metodeCounts);
        $dominant = array_keys($metodeCounts, max($metodeCounts))[0];

        session([
            'kelas_data' => [
                'nama_kelas' => $namaKelas,
                'kode_matkul' => $kodeMatkul,
                'metode_counts' => $metodeCounts,
                'total_mahasiswa' => $total,
                'metode_dominan' => $dominant,
                'siswa' => $dataSiswa,
            ]
        ]);

        return redirect()->route('data.kelas');
    }

    // Fungsi untuk tampilkan halaman Data Kelas
    public function dataKelas()
    {
        $kelasData = session('kelas_data');

        if (!$kelasData) {
            return redirect()->route('dynamic.table')->with('error', 'Belum ada data kelas yang di-generate.');
        }

        return view('data_kelas', compact('kelasData'));
    }
}
