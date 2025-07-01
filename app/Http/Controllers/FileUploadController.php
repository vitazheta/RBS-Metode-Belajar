<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Cache;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-excel');
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
            return redirect()->route('upload.xlsx')->with('error', 'File tidak memiliki data yang valid.');
        }

        $header = array_shift($rows);
        $processedData = [];

        foreach ($rows as $row) {
            $nama = $row[0] ?? '-';
            $sekolah = $row[1] ?? '-';
            $jalur = strtolower(trim($row[2] ?? ''));

            $akademik = (float) ($row[3] ?? 0);
            $endurance = (float) ($row[4] ?? 0);
            $sekolahScore = (float) ($row[5] ?? 0);
            $ortu = (float) ($row[6] ?? 0);
            $ekonomi = (float) ($row[7] ?? 0);
            $pola = (float) ($row[8] ?? 0);
            $adaptasi = (float) ($row[9] ?? 0);

            $akademik_endurance = round(($akademik + $endurance) / 2, 2);
            $latar_belakang = round(($sekolahScore + $ortu + $ekonomi) / 3, 2);
            $pola_belajar = round(($pola + $adaptasi) / 2, 2);
            $perkuliahan = round(($akademik + $endurance + $sekolahScore + $ortu + $ekonomi + $pola + $adaptasi) / 7, 2);

            $processedData[] = [
                'nama' => $nama,
                'asal_sekolah' => $sekolah,
                'jalur_masuk' => ucfirst($jalur),
                'akademik_endurance' => $akademik_endurance,
                'latar_belakang' => $latar_belakang,
                'pola_belajar' => $pola_belajar,
                'perkuliahan' => $perkuliahan,
            ];
        }

        Cache::put('processedData', $processedData, now()->addMinutes(10));

        return redirect()->route('upload.xlsx')
            ->with('success', 'File berhasil diunggah dan diproses.')
            ->with('processedData', $processedData);
    }

    public function downloadCsv()
    {
        $processedData = Cache::get('processedData', []);

        if (empty($processedData)) {
            return redirect()->route('upload.xlsx')->with('error', 'Tidak ada data untuk diunduh.');
        }

        $response = new StreamedResponse(function () use ($processedData) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Nama', 'Asal Sekolah', 'Jalur Masuk', 'Akademik & Endurance', 'Latar Belakang', 'Pola Belajar', 'Proses Perkuliahan']);

            foreach ($processedData as $data) {
                fputcsv($handle, [
                    $data['nama'],
                    $data['asal_sekolah'],
                    $data['jalur_masuk'],
                    $data['akademik_endurance'],
                    $data['latar_belakang'],
                    $data['pola_belajar'],
                    $data['perkuliahan'],
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="processed_data.csv"');

        return $response;
    }
}
