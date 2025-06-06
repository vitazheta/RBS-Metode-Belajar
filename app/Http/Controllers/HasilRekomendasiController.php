<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa; // Sesuaikan jika nama modelnya Student atau yang lain
use App\Models\Rule;          // Import Model Rule yang sudah kita buat

class HasilRekomendasiController extends Controller
{
    public function show($id)
    {
        // 1. Ambil Data Kelas dan Mahasiswa
        // Pastikan relasi 'mahasiswa' ada di Model Kelas Anda
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);

        // Cek otorisasi: Dosen yang login adalah pemilik kelas ini
        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        $students = $kelas->mahasiswa; // Menggunakan $students agar konsisten dengan pembahasan sebelumnya

        // Jika tidak ada mahasiswa di kelas, siapkan data kosong dan tampilkan view
        if ($students->isEmpty()) {
            return view('hasil_rekomendasi', [
                'kelas' => $kelas,
                'students' => $students,
                'mainClassRecommendation' => 'Tidak ada mahasiswa di kelas ini.',
                'mainClassPercentage' => 0,
                'jalurHighlights' => [],
                'chartData' => ['SNBP' => [], 'SNBT' => [], 'Mandiri' => []] // Kirim data kosong untuk chart
            ]);
        }

        // 2. Proses Data Mahasiswa: Tambahkan Atribut Teks Kategori
        // Loop melalui setiap mahasiswa untuk menambahkan atribut kategori teks
        // ini akan digunakan baik untuk tampilan tabel maupun untuk pencocokan aturan
        $students->each(function ($mhs) {
            $mhs->akademik_text = $this->getKategoriText('akademik', $mhs->akademik_total);
            $mhs->sekolah_text = $this->getKategoriText('sekolah', $mhs->sekolah_total);
            $mhs->ekonomi_text = $this->getKategoriText('ekonomi', $mhs->ekonomi_total);
            $mhs->perkuliahan_text = $this->getKategoriText('perkuliahan', $mhs->perkuliahan_total);
        });

        // 3. Persiapkan Data untuk Chart (Rata-rata Nilai Numerik per Jalur)
        // Ini adalah bagian yang sudah ada dan berfungsi dengan baik untuk grafik Anda
        $allJalurMasukInClass = $students->pluck('jalur_masuk')->unique()->sort()->toArray();
        $chartData = [];
        $aspectsForChart = ['akademik', 'sekolah', 'ekonomi', 'perkuliahan'];

        foreach ($allJalurMasukInClass as $jalur) {
            $studentsInJalur = $students->where('jalur_masuk', $jalur);
            $chartData[$jalur] = [];
            foreach ($aspectsForChart as $aspect) {
                $columnName = $aspect . '_total'; // Sesuaikan dengan nama kolom di DB Anda
                // Pastikan menggunakan avg() dengan null coalescing operator jika tidak ada data
                $chartData[$jalur][$columnName] = $studentsInJalur->avg($columnName) ?? 0;
            }
        }

        // --- MULAI LOGIKA REKOMENDASI BARU (Menggantikan fungsi rekomendasiBelajar lama) ---

        $allIndividualRecommendations = [];
        $individualRecommendationsByJalur = [];

        // Inisialisasi array untuk setiap jalur yang ada di data mahasiswa
        foreach ($allJalurMasukInClass as $jalur) {
            $individualRecommendationsByJalur[$jalur] = [];
        }

        // 4. Hitung Rekomendasi Individu untuk Setiap Mahasiswa
        foreach ($students as $student) {
            // Bentuk profil terkategorisasi untuk pencocokan dengan tabel rules
            // Pastikan casing di sini cocok dengan data di tabel 'rules' Anda
            $studentCategorizedProfile = [
                'jalur_masuk' => strtoupper($student->jalur_masuk), // Normalisasi ke huruf kapital
                'akademik' => $student->akademik_text,     // Contoh: 'Rendah', 'Sedang', 'Tinggi'
                'sekolah' => $student->sekolah_text,       // Contoh: 'Kurang Mendukung', 'Mendukung'
                'ekonomi' => $student->ekonomi_text,       // Contoh: 'Kurang Mencukupi', 'Mencukupi'
                'perkuliahan' => $student->perkuliahan_text, // Contoh: 'Kurang Baik', 'Baik'
            ];

            // Cari rekomendasi dari tabel 'rules' di database
            $recommendationRule = Rule::where($studentCategorizedProfile)->first();

            // Jika aturan tidak ditemukan, berikan pesan default
            $rec = $recommendationRule ? $recommendationRule->rekomendasi : "Rekomendasi Tidak Ditemukan (Aturan tidak cocok)";

            $allIndividualRecommendations[] = $rec;
            // Pastikan jalur masuk ada dalam array yang sudah diinisialisasi
            if (isset($individualRecommendationsByJalur[$student->jalur_masuk])) {
                $individualRecommendationsByJalur[$student->jalur_masuk][] = $rec;
            }
        }

        // 5. Tentukan Rekomendasi Utama Kelas (Yang Paling Umum)
        $mainClassRecommendation = "Tidak ada rekomendasi dominan";
        $mainClassPercentage = 0;
        if (!empty($allIndividualRecommendations)) {
            $counts = array_count_values($allIndividualRecommendations);
            arsort($counts); // Urutkan dari yang paling banyak
            $mainClassRecommendation = key($counts); // Ambil rekomendasi pertama
            $mainClassFreq = current($counts); // Ambil jumlahnya
            $mainClassPercentage = (count($allIndividualRecommendations) > 0) ? ($mainClassFreq / count($allIndividualRecommendations)) * 100 : 0;
        }

        // 6. Tentukan Sorotan Rekomendasi per Jalur (Highlight)
        $jalurHighlights = [];
        foreach ($allJalurMasukInClass as $jalur) {
            $jalurRecs = $individualRecommendationsByJalur[$jalur];
            if (!empty($jalurRecs)) {
                $jalurCounts = array_count_values($jalurRecs);
                arsort($jalurCounts);
                $dominantJalurRec = key($jalurCounts);
                $dominantJalurFreq = current($jalurCounts);
                $jalurPercentage = (count($jalurRecs) > 0) ? ($dominantJalurFreq / count($jalurRecs)) * 100 : 0;

                $jalurHighlights[$jalur] = [
                    'recommendation' => $dominantJalurRec,
                    'count' => count($jalurRecs), // Jumlah siswa di jalur ini
                    'percentage' => $jalurPercentage,
                ];
            } else {
                $jalurHighlights[$jalur] = [
                    'recommendation' => null,
                    'count' => 0,
                    'percentage' => 0,
                ];
            }
        }

        // --- AKHIR LOGIKA REKOMENDASI BARU ---


        // 7. Kirim Semua Data ke Blade View
        // Pastikan nama view-nya 'hasil_rekomendasi'
        return view('hasil_rekomendasi', [
            'kelas' => $kelas,
            'students' => $students, // Collection mahasiswa yang sudah ada atribut _text
            'chartData' => $chartData,
            'mainClassRecommendation' => $mainClassRecommendation, // Rekomendasi utama kelas
            'mainClassPercentage' => $mainClassPercentage,         // Persentase rekomendasi utama
            'jalurHighlights' => $jalurHighlights,                 // Sorotan rekomendasi per jalur
        ]);
    }

    // --- Fungsi getKategoriText (TETAP SAMA seperti yang terakhir Anda ubah) ---
    // Fungsi ini akan mengubah nilai numerik (float) menjadi kategori teks.
    private function getKategoriText($aspekNamaSingkat, $nilai)
    {
        $nilai = (float) $nilai;

        if ($aspekNamaSingkat === 'akademik') {
            if ($nilai <= 2) return 'Rendah';
            if ($nilai <= 3) return 'Sedang';
            return 'Tinggi';
        } else if ($aspekNamaSingkat === 'sekolah') {
            if ($nilai <= 2) return 'Kurang Mendukung';
            if ($nilai <= 3) return 'Mendukung';
            return 'Sangat Mendukung';
        } else if ($aspekNamaSingkat === 'ekonomi') {
            if ($nilai <= 2) return 'Kurang Mencukupi';
            if ($nilai <= 3) return 'Mencukupi';
            return 'Sangat Mencukupi';
        } else if ($aspekNamaSingkat === 'perkuliahan') {
            if ($nilai <= 2) return 'Kurang Baik';
            if ($nilai <= 3) return 'Baik';
            return 'Sangat Baik';
        }
        return (string) $nilai; // Fallback jika aspek tidak dikenal
    }
    // --- AKHIR getKategoriText ---

    // --- FUNGSI rekomendasiBelajar() LAMA DAN getRuleSetX() / getAlasanX() TIDAK DIGUNAKAN LAGI ---
    // Pastikan Anda MENGHAPUS secara fisik fungsi-fungsi ini dari Controller Anda.
    // Ini termasuk:
    // - public function rekomendasiBelajar($data) { ... }
    // - private function getRuleSetAkademik() { ... }
    // - private function getAlasanAkademik() { ... }
    // - private function getRuleSetSekolah() { ... }
    // - private function getAlasanSekolah() { ... }
    // - private function getRuleSetEkonomi() { ... }
    // - private function getAlasanEkonomi() { ... }
    // - private function getRuleSetPerkuliahan() { ... }
    // - private function getAlasanPerkuliahan() { ... }
}
