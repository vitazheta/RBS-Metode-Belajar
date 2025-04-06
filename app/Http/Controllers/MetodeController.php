<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodeController extends Controller
{
    public function generate(Request $request)
    {
        $dataSiswa = session('data'); // ambil data dari session CSV
        $nama_kelas = $request->input('nama_kelas')[0] ?? 'Kelas Tanpa Nama';

        $hasil = [
            'nama_kelas' => $nama_kelas,
            'siswa' => [],
            'count' => [
                'Visual' => 0,
                'Auditori' => 0,
                'Kinestetik' => 0
            ]
        ];

        if (is_array($dataSiswa)) {
            foreach ($dataSiswa as $row) {
                $metode = $this->tentukanMetode($row);
                $hasil['siswa'][] = [
                    'nama' => $row[0],
                    'email' => $row[1],
                    'jalur_masuk' => $row[2],
                    'pola' => $row[3],
                    'adaptasi' => $row[4],
                    'endurance' => $row[5],
                    'metode' => $metode
                ];
                $hasil['count'][$metode]++;
            }
        }

        // cari metode dominan
        arsort($hasil['count']);
        $hasil['dominant'] = array_key_first($hasil['count']);

        session()->put('kelas_tergenerate', $hasil);

        return redirect()->route('data.kelas')->with('success', 'Metode berhasil digenerate!');
    }

    private function tentukanMetode($row)
    {
        // Sederhana: gabungkan 3 aspek dan nilai terbanyak
        $data = [$row[3], $row[4], $row[5]];
        $count = array_count_values($data);
        arsort($count);
        return array_key_first($count); // return metode dominan
    }

    public function showDataKelas()
    {
        $data = session('kelas_tergenerate');
        return view('data_kelas', compact('data'));
    }
}
