<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    // Menampilkan halaman upload file
    public function showUploadForm()
    {
        return view ('upload-excel');
    }

    // Memproses file yang diunggah
    public function processUpload(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Hanya menerima file Excel
        ]);

        // Ambil file yang diunggah
        $file = $request->file('file');

        // Proses file menggunakan Laravel Excel
        $data = Excel::toArray([], $file);

        // Ambil sheet pertama
        $rows = $data[0];

        // Pastikan ada data
        if (empty($rows) || count($rows) < 2) {
            return redirect()->route('upload.xlsx')->with('error', 'File tidak memiliki data yang valid.');
        }

        // Ambil header (baris pertama)
        $header = array_shift($rows);

        // Hapus kolom pertama dari setiap baris (mulai dari baris kedua)
        foreach ($rows as &$row) {
            array_shift($row);
        }
        unset($row); // break reference

        // Sekarang $rows hanya berisi data mulai dari baris kedua dan kolom kedua

        // Matriks untuk pertanyaan dengan kedudukan Berbeda
        function matriksSetara() {
            return [
                1 => [1 => 1.0, 2 => 1.5, 3 => 2.0, 4 => 2.5],
                2 => [1 => 1.5, 2 => 2.0, 3 => 2.5, 4 => 3.0],
                3 => [1 => 2.0, 2 => 2.5, 3 => 3.0, 4 => 3.5],
                4 => [1 => 2.5, 2 => 3.0, 3 => 3.5, 4 => 4.0],
            ];
        }

        // Matriks untuk pertanyaan dengan kedudukan Berbeda
        function matriksBerbeda() {
        // Kolom = nilai lebih tinggi, Baris = nilai lebih rendah
            return [
                1 => [1 => 1.00, 2 => 1.34, 3 => 1.68, 4 => 2.02],
                2 => [1 => 1.66, 2 => 2.00, 3 => 2.34, 4 => 2.68],
                3 => [1 => 2.32, 2 => 2.66, 3 => 3.00, 4 => 3.34],
                4 => [1 => 2.98, 2 => 3.32, 3 => 3.66, 4 => 4.00],
            ];
        }

        $setara = matriksSetara();
        $berbeda = matriksBerbeda();

/////////////////////////////////////////////////////////// SNBP /////////////////////////////////////////////////////
// Proses KPI Akademik SNBP (kolom 4, 5, 6)
        $hasilAkademikSNBP = [];
        foreach ($rows as $rowIdx => $row) {

            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v4 = (int)$row[3];
            $v5 = (int)$row[4];
            $v6 = (int)$row[5];

            $bobot_4_5 = $berbeda[$v4][$v5] ?? null;
            $bobot_6_5 = $berbeda[$v6][$v5] ?? null;
            $bobot_4_6 = $setara[$v4][$v6] ?? null;

            // Simpan ke array
            $bobotArr = array_filter([$bobot_4_5, $bobot_4_6, $bobot_6_5]);
            $rataAkademikSNBP = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilAkademikSNBP[] = [
                'nama' => $row[0] ?? '',
                'rata_akademik' => $rataAkademikSNBP,
                'bobot_4_5' => $bobot_4_5,
                'bobot_4_6' => $bobot_4_6,
                'bobot_6_5' => $bobot_6_5,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 4vs5=$bobot_4_5, 4vs6=$bobot_4_6, 6vs5=$bobot_6_5", [
                'v4' => $v4, 'v5' => $v5, 'v6' => $v6
            ]); 
        }

//Proses KPI Profil Sekolah SNBP (kolom 13, 14, 15, 16)
        $hasilSekolahSNBP = [];
        foreach ($rows as $rowIdx => $row) {

            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v13 = (int)$row[12];
            $v14 = (int)$row[13];
            $v15 = (int)$row[14];
            $v16 = (int)$row[15];

            $bobot_13_14 = $setara[$v13][$v14] ?? null;
            $bobot_13_15 = $berbeda[$v13][$v15] ?? null;
            $bobot_13_16 = $berbeda[$v13][$v16] ?? null;
            $bobot_14_15 = $berbeda[$v14][$v15] ?? null;
            $bobot_14_16 = $berbeda[$v14][$v16] ?? null;
            $bobot_15_16 = $setara[$v15][$v16] ?? null;

            // Hitung rata-rata bobot KPI Profil Sekolah
            $bobotArr = array_filter([
                $bobot_13_14, $bobot_13_15, $bobot_13_16,
                $bobot_14_15, $bobot_14_16, $bobot_15_16
            ]);
            $rataSekolahSNBP = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilSekolahSNBP[] = [
                'nama' => $row[0] ?? '',
                'rata_profil' => $rataSekolahSNBP,
                'bobot_13_14' => $bobot_13_14,
                'bobot_13_15' => $bobot_13_15,
                'bobot_13_16' => $bobot_13_16,
                'bobot_14_15' => $bobot_14_15,
                'bobot_14_16' => $bobot_14_16,
                'bobot_15_16' => $bobot_15_16,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 13vs14=$bobot_13_14, 13vs15=$bobot_13_15, 13vs16=$bobot_13_16, 14vs15=$bobot_14_15, 14vs16=$bobot_14_16, 15vs16=$bobot_15_16", [
                'v13' => $v13, 'v14' => $v14, 'v15' => $v15, 'v16' => $v16
            ]);
        }
//Proses KPI Kesiapan Ekonomi SNBP (kolom 17, 18, 19)
        $hasilEkonomiSNBP = [];
        foreach ($rows as $rowIdx => $row) {

            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v17 = (int)$row[16];
            $v18 = (int)$row[17];
            $v19 = (int)$row[18];

            $bobot_18_17 = $berbeda[$v18][$v17] ?? null;
            $bobot_19_17 = $berbeda[$v19][$v17] ?? null;
            $bobot_18_19 = $setara[$v18][$v19] ?? null;

            // Hitung rata-rata bobot KPI Kesiapan Ekonomi
            $bobotArr = array_filter([$bobot_18_17, $bobot_19_17, $bobot_18_19]);
            $rataEkonomiSNBP = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilEkonomiSNBP[] = [
                'nama' => $row[0] ?? '',
                'rata_ekonomi' => $rataEkonomiSNBP,
                'bobot_18_17' => $bobot_18_17,
                'bobot_19_17' => $bobot_19_17,
                'bobot_18_19' => $bobot_18_19,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 18vs17=$bobot_18_17, 19vs17=$bobot_19_17, 18vs19=$bobot_18_19", [
                'v17' => $v17, 'v18' => $v18, 'v19' => $v19
            ]);
        }

/////////////////////////////////////////////////////////// SNBT /////////////////////////////////////////////////////
// Proses KPI Akademik SNBT (kolom 7, 8, 9)
        $hasilAkademikSNBT = [];
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v7 = (int)$row[6];
            $v8 = (int)$row[7];
            $v9 = (int)$row[8];

            // Perbandingan sesuai aturan matriks berbeda/setara
            $bobot_7_8 = $berbeda[$v7][$v8] ?? null;
            $bobot_7_9 = $setara[$v7][$v9] ?? null;
            $bobot_9_8 = $berbeda[$v9][$v8] ?? null;

            // Hitung rata-rata bobot KPI Akademik SNBT
            $bobotArr = array_filter([$bobot_7_8, $bobot_7_9, $bobot_9_8]);
            $rataAkademikSNBT = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            // Simpan ke array hasil jika perlu
            $hasilAkademikSNBT[] = [
                'nama' => $row[0] ?? '',
                'rata_akademik' => $rataAkademikSNBT,
                'bobot_7_8' => $bobot_7_8,
                'bobot_7_9' => $bobot_7_9,
                'bobot_9_8' => $bobot_9_8,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 7vs8=$bobot_7_8, 7vs9=$bobot_7_9, 9vs8=$bobot_9_8", [
                'v7' => $v7, 'v8' => $v8, 'v9' => $v9
            ]);
        }

// Proses KPI Profil Sekolah SNBT (kolom 20, 21, 22)
        $hasilSekolahSNBT = [];
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v20 = (int)$row[19];
            $v21 = (int)$row[20];
            $v22 = (int)$row[21];

            $bobot_20_21 = $berbeda[$v20][$v21] ?? null;
            $bobot_20_22 = $setara[$v20][$v22] ?? null;
            $bobot_22_21 = $berbeda[$v22][$v21] ?? null;

            // Hitung rata-rata bobot KPI Profil Sekolah SNBT
            $bobotArr = array_filter([$bobot_20_21, $bobot_20_22, $bobot_22_21]);
            $rataSekolahSNBT = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilSekolahSNBT[] = [
                'nama' => $row[0] ?? '',
                'rata_profil' => $rataSekolahSNBT,
                'bobot_20_21' => $bobot_20_21,
                'bobot_20_22' => $bobot_20_22,
                'bobot_22_21' => $bobot_22_21,
            ];

    
            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 20vs21=$bobot_20_21, 20vs22=$bobot_20_22, 22vs21=$bobot_22_21", [
                'v20' => $v20, 'v21' => $v21, 'v22' => $v22
            ]);
        }

// Proses KPI Kesiapan Ekonomi SNBT (kolom 23, 24, 25)
        $hasilEkonomiSNBT = [];
        foreach ($rows as $rowIdx => $row) {

           // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v23 = (int)$row[22];
            $v24 = (int)$row[23];
            $v25 = (int)$row[24];

            $bobot_24_23 = $berbeda[$v24][$v23] ?? null;
            $bobot_25_23 = $berbeda[$v25][$v23] ?? null;
            $bobot_24_25 = $setara[$v24][$v25] ?? null;

            // Hitung rata-rata bobot KPI Kesiapan Ekonomi SNBT
            $bobotArr = array_filter([$bobot_24_23, $bobot_25_23, $bobot_24_25]);
            $rataEkonomiSNBT = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilEkonomiSNBT[] = [
                'nama' => $row[0] ?? '',
                'rata_ekonomi' => $rataEkonomiSNBT,
                'bobot_24_23' => $bobot_24_23,
                'bobot_24_25' => $bobot_25_23,
                'bobot_23_25' => $bobot_24_25,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 24vs23=$bobot_24_23, 25vs23=$bobot_25_23, 24vs25=$bobot_24_25", [
                'v23' => $v23, 'v24' => $v24, 'v25' => $v25
            ]);
        }

/////////////////////////////////////////////////////////// Mandiri /////////////////////////////////////////////////////
// Proses KPI Akademik Mandiri (kolom 10, 11, 12)
        $hasilAkademikMandiri = [];
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v10 = (int)$row[9];
            $v11 = (int)$row[10];
            $v12 = (int)$row[11];

            $bobot_10_11 = $setara[$v10][$v11] ?? null;
            $bobot_10_12 = $berbeda[$v10][$v12] ?? null; 
            $bobot_11_12 = $berbeda[$v11][$v12] ?? null; 

            // Hitung rata-rata bobot KPI Akademik Mandiri
            $bobotArr = array_filter([$bobot_10_11, $bobot_10_12, $bobot_11_12]);
            $rataAkademikMandiri = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilAkademikMandiri[] = [
                'nama' => $row[0] ?? '',
                'rata_akademik' => $rataAkademikMandiri,
                'bobot_10_11' => $bobot_10_11,
                'bobot_10_12' => $bobot_10_12,
                'bobot_11_12' => $bobot_11_12,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 10vs11=$bobot_10_11, 10vs12=$bobot_10_12, 11vs12=$bobot_11_12", [
                'v10' => $v10, 'v11' => $v11, 'v12' => $v12
            ]);
        }

// Proses KPI Profil Sekolah Mandiri (kolom 26, 27, 28)
        $hasilSekolahMandiri = [];
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v26 = (int)$row[25];
            $v27 = (int)$row[26];
            $v28 = (int)$row[27];

            $bobot_26_27 = $berbeda[$v26][$v27] ?? null; 
            $bobot_26_28 = $setara[$v26][$v28] ?? null;
            $bobot_28_27 = $berbeda[$v28][$v27] ?? null;

            // Hitung rata-rata bobot KPI Profil Sekolah Mandiri
            $bobotArr = array_filter([$bobot_26_27, $bobot_26_28, $bobot_28_27]);
            $rataSekolahMandiri = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilSekolahMandiri[] = [
                'nama' => $row[0] ?? '',
                'rata_profil' => $rataSekolahMandiri,
                'bobot_26_27' => $bobot_26_27,
                'bobot_26_28' => $bobot_26_28,
                'bobot_28_27' => $bobot_28_27,
            ];
            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 26vs27=$bobot_26_27, 26vs28=$bobot_26_28, 28vs27=$bobot_28_27", [
                'v26' => $v26, 'v27' => $v27, 'v28' => $v28
            ]);
        }

// Proses KPI Kesiapan Ekonomi Mandiri (kolom 29, 30, 31)
        $hasilEkonomiMandiri = []; 
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v29 = (int)$row[28];
            $v30 = (int)$row[29];
            $v31 = (int)$row[30];

            $bobot_30_29 = $berbeda[$v30][$v29] ?? null;
            $bobot_31_29 = $berbeda[$v31][$v29] ?? null;
            $bobot_30_31 = $setara[$v30][$v31] ?? null;

            // Hitung rata-rata bobot KPI Kesiapan Ekonomi Mandiri
            $bobotArr = array_filter([$bobot_30_29, $bobot_31_29, $bobot_30_31]);
            $rataEkonomiMandiri = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilEkonomiMandiri[] = [
            'nama' => $row[0] ?? '',
            'rata_ekonomi' => $rataEkonomiMandiri,
            'bobot_30_29' => $bobot_30_29,
            'bobot_31_29' => $bobot_31_29,
            'bobot_30_31' => $bobot_30_31,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 30vs29=$bobot_30_29, 31vs29=$bobot_31_29, 30vs31=$bobot_30_31", [
            'v29' => $v29, 'v30' => $v30, 'v31' => $v31
            ]);
        }

    /////////////////////////////////////////////////////////// SELURUH JALUR /////////////////////////////////////////////////////
    // Proses KPI Proses Perkuliahan (kolom 32, 33, 34, 35)
        $hasilProsesPerkuliahan = [];
        foreach ($rows as $rowIdx => $row) {
            
            // Ambil nilai jawaban (asumsi index mulai dari 0)
            $v32 = (int)$row[31];
            $v33 = (int)$row[32];
            $v34 = (int)$row[33];
            $v35 = (int)$row[34];

            // Perbandingan sesuai aturan matriks berbeda/setara
            $bobot_33_32 = $berbeda[$v33][$v32] ?? null;
            $bobot_34_32 = $berbeda[$v34][$v32] ?? null;
            $bobot_35_32 = $berbeda[$v35][$v32] ?? null;
            $bobot_33_34 = $setara[$v33][$v34] ?? null;
            $bobot_33_35 = $setara[$v33][$v35] ?? null;
            $bobot_34_35 = $setara[$v34][$v35] ?? null;

            // Hitung rata-rata bobot KPI Proses Perkuliahan
            $bobotArr = array_filter([
            $bobot_33_32, $bobot_34_32, $bobot_35_32,
            $bobot_33_34, $bobot_33_35, $bobot_34_35
            ]);
            $rataProsesPerkuliahan = count($bobotArr) ? array_sum($bobotArr) / count($bobotArr) : null;

            $hasilProsesPerkuliahan[] = [
            'nama' => $row[0] ?? '',
            'rata_proses_perkuliahan' => $rataProsesPerkuliahan,
            'bobot_33_32' => $bobot_33_32,
            'bobot_34_32' => $bobot_34_32,
            'bobot_35_32' => $bobot_35_32,
            'bobot_33_34' => $bobot_33_34,
            'bobot_33_35' => $bobot_33_35,
            'bobot_34_35' => $bobot_34_35,
            ];

            // Tampilkan hasil di log
            Log::info("Baris $rowIdx: 33vs32=$bobot_33_32, 34vs32=$bobot_34_32, 35vs32=$bobot_35_32, 33vs34=$bobot_33_34, 33vs35=$bobot_33_35, 34vs35=$bobot_34_35", [
            'v32' => $v32, 'v33' => $v33, 'v34' => $v34, 'v35' => $v35
            ]);
        }
          
        // Simpan data ke cache untuk digunakan di halaman hasil
        Cache::put('excel_data', $rows);

        $processedData = [];
        foreach ($rows as $rowIdx => $row) {
            $jalur = strtolower(trim($row[2] ?? '')); // Pastikan index sesuai file kamu

            // Cari data hasil per mahasiswa (pastikan urutan array hasil sama dengan $rows)
            $akademik = null;
            $sekolah = null;
            $ekonomi = null;
            $perkuliahan = null;

            if ($jalur === 'snbp') {
                $akademik = $hasilAkademikSNBP[$rowIdx]['rata_akademik'] ?? null;
                $sekolah = $hasilSekolahSNBP[$rowIdx]['rata_profil'] ?? null;
                $ekonomi = $hasilEkonomiSNBP[$rowIdx]['rata_ekonomi'] ?? null;
                $perkuliahan = $hasilProsesPerkuliahan[$rowIdx]['rata_proses_perkuliahan'] ?? null;
            } elseif ($jalur === 'snbt') {
                $akademik = $hasilAkademikSNBT[$rowIdx]['rata_akademik'] ?? null;
                $sekolah = $hasilSekolahSNBT[$rowIdx]['rata_profil'] ?? null;
                $ekonomi = $hasilEkonomiSNBT[$rowIdx]['rata_ekonomi'] ?? null;
                $perkuliahan = $hasilProsesPerkuliahan[$rowIdx]['rata_proses_perkuliahan'] ?? null;
            } elseif ($jalur === 'mandiri') {
                $akademik = $hasilAkademikMandiri[$rowIdx]['rata_akademik'] ?? null;
                $sekolah = $hasilSekolahMandiri[$rowIdx]['rata_profil'] ?? null;
                $ekonomi = $hasilEkonomiMandiri[$rowIdx]['rata_ekonomi'] ?? null;
                $perkuliahan = $hasilProsesPerkuliahan[$rowIdx]['rata_proses_perkuliahan'] ?? null;
            }

            $processedData[] = [
                'nama' => $row[0] ?? '',
                'asal_sekolah' => $row[1] ?? '',
                'jalur_masuk' => strtoupper($jalur),
                'akademik' => $akademik !== null ? number_format($akademik, 2) : null,
                'sekolah' => $sekolah !== null ? number_format($sekolah, 2) : null,
                'ekonomi' => $ekonomi !== null ? number_format($ekonomi, 2) : null,
                'perkuliahan' => $perkuliahan !== null ? number_format($perkuliahan, 2) : null,
            ];
        }

        // Kirim ke view (atau session, sesuai kebutuhan)
        session(['processedData' => $processedData]);
        session(['columns' => ['nama', 'asal_sekolah', 'jalur_masuk', 'akademik', 'sekolah', 'ekonomi', 'perkuliahan']]);

        return redirect()->route('upload.xlsx')->with('success', 'File berhasil diproses.');
    }
}