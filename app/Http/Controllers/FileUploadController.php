<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Cache;

class FileUploadController extends Controller
{
    // Menampilkan halaman upload file
    public function showUploadForm()
    {
        // Hapus session hanya jika BUKAN dari upload Excel
        if (!$request->has('from_upload')) {
        session()->forget(['processedData', 'nama_kelas', 'kode_mata_kuliah']);
    }
        return view ('dynamic_table');
    }

    public function processUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        $file = $request->file('file');
        $data = Excel::toArray([], $file);
        $rows = $data[0];

        if (empty($rows) || count($rows) < 2) {
            return redirect()->route('simpan.mahasiswa')->with('error', 'File tidak memiliki data yang valid.');
        }

        $header = array_shift($rows);

        // Inisialisasi data hasil proses
        $processedData = [];

        foreach ($rows as $row) {
            // Ambil jalur masuk
            $jalur_masuk = strtolower(trim($row[2])); // Kolom ke-3 adalah jalur masuk

            // Hitung rata-rata berdasarkan jalur masuk
            $akademik_endurance = 0;
            if ($jalur_masuk === 'snbp') {
                $akademik_endurance = $this->calculateAverage($row, range(3, 12)); // Kolom 4-13
            } elseif ($jalur_masuk === 'snbt') {
                $akademik_endurance = $this->calculateAverage($row, range(13, 22)); // Kolom 14-23
            } elseif ($jalur_masuk === 'mandiri') {
                $akademik_endurance = $this->calculateAverage($row, range(23, 32)); // Kolom 24-33
            }

            $latar_belakang = 0;
            if ($jalur_masuk === 'snbp') {
                $latar_belakang = $this->calculateAverage($row, range(33, 42));
            } elseif ($jalur_masuk === 'snbt') {
                $latar_belakang = $this->calculateAverage($row, range(43, 52));
            } elseif ($jalur_masuk === 'mandiri') {
                $latar_belakang = $this->calculateAverage($row, range(53, 62));
            }


            $pola_belajar = $this->calculateAverage($row, range(63, 72));
            $perkuliahan = $this->calculateAverage($row, range(73, 82));

            // Tambahkan data yang sudah diproses
            $processedData[] = [
                'nama' => $row[0], // Kolom 1: Nama
                'asal_sekolah' => $row[1], // Kolom 2: Asal Sekolah
                'jalur_masuk' => $row[2], // Kolom 3: Jalur Masuk
                'akademik_endurance' => $akademik_endurance,
                'latar_belakang' => $latar_belakang,
                'pola_belajar' => $pola_belajar,
                'perkuliahan' => $perkuliahan,
            ];
        }

        // Simpan atau tampilkan data yang sudah diproses
        \Log::info($processedData);
        Cache::put('processedData', $processedData, now()->addMinutes(10));

        return redirect()->route('upload.xlsx')
            ->with('success', 'File berhasil diunggah dan diproses.')
            ->with('processedData', $processedData);
    }

    // Fungsi untuk menghitung rata-rata dari kolom tertentu
    private function calculateAverage($row, $columns)
    {
        $values = array_map(function ($index) use ($row) {
            return isset($row[$index]) ? (float) $row[$index] : 0;
        }, $columns);

        $total = array_sum($values);
        $count = count(array_filter($values, fn($value) => $value > 0));

        return $count > 0 ? round($total / $count, 2) : 0;
    }

    // Fungsi untuk mengunduh data dalam format CSV
    public function downloadCsv()
    {
        // Ambil data dari session
        $processedData = Cache::get('processedData', []);

        // Jika tidak ada data, kembalikan pesan error
        if (empty($processedData)) {
            return redirect()->route('upload.xlsx')->with('error', 'Tidak ada data untuk diunduh.');
        }

        // Buat response untuk file CSV
        $response = new StreamedResponse(function () use ($processedData) {
            $handle = fopen('php://output', 'w');

            // Tulis data ke CSV tanpa tanda kutip
            foreach ($processedData as $data) {
                // Hapus tanda kutip dari setiap elemen data
                $cleanedData = array_map(function ($value) {
                    return str_replace('"', '', $value); // Hapus tanda kutip
                }, [
                    $data['nama'],
                    $data['asal_sekolah'],
                    $data['jalur_masuk'],
                    $data['akademik_endurance'],
                    $data['latar_belakang'],
                    $data['pola_belajar'],
                    $data['perkuliahan'],
                ]);

                fputcsv($handle, $cleanedData, ','); // Gunakan enclosure default
            }

            fclose($handle);
        });

        \Log::info('Memulai proses download CSV');
        \Log::info('Data yang akan diunduh:', Cache::get('processedData'));
        // Atur header untuk file CSV
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="processed_data.csv"');

        return $response;
    }
}
