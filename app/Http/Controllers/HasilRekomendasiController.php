<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa; // Pastikan nama model mahasiswa Anda benar (misal: App\Models\Student)
use App\Models\Rule;          // Import Model Rule yang sudah kita buat

class HasilRekomendasiController extends Controller
{
    public function show($id)
    {
        // 1. Ambil Data Kelas dan Mahasiswa
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);

        // Cek otorisasi
        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        $students = $kelas->mahasiswa;

        // Jika tidak ada mahasiswa di kelas
        if ($students->isEmpty()) {
            return view('hasil_rekomendasi', [
                'kelas' => $kelas,
                'students' => $students,
                'mainClassRecommendation' => 'Tidak ada mahasiswa di kelas ini.',
                'mainClassPercentage' => 0,
                'jalurHighlights' => [],
                // Kunci chartData diinisialisasi dengan huruf kapital semua
                'chartData' => ['SNBP' => [], 'SNBT' => [], 'MANDIRI' => []]
            ]);
        }

        // 2. Proses Data Mahasiswa: Tambahkan Atribut Teks Kategori
        $students->each(function ($mhs) {
            $mhs->akademik_text = $this->getKategoriText('akademik', $mhs->akademik_total);
            $mhs->sekolah_text = $this->getKategoriText('sekolah', $mhs->sekolah_total);
            $mhs->ekonomi_text = $this->getKategoriText('ekonomi', $mhs->ekonomi_total);
            $mhs->perkuliahan_text = $this->getKategoriText('perkuliahan', $mhs->perkuliahan_total);
        });

        // 3. Persiapkan Data untuk Chart (Rata-rata Nilai Numerik per Jalur)
        // Ambil semua jalur masuk unik dari data mahasiswa, dan pastikan jadi huruf kapital
        $allJalurMasukInClassNormalized = $students->pluck('jalur_masuk')->unique()->map(function ($item) {
            return strtoupper($item);
        })->sort()->toArray();

        $chartData = [];
        $aspectsForChart = ['akademik', 'sekolah', 'ekonomi', 'perkuliahan'];

        foreach ($allJalurMasukInClassNormalized as $jalurNormalized) {
            // Gunakan $jalurNormalized untuk mengelompokkan siswa
            // Penting: students->where('jalur_masuk', $jalur) harus sesuai dengan casing di DB (bukan yang normalized)
            $originalJalurCasing = $students->pluck('jalur_masuk')->firstWhere(function($value) use ($jalurNormalized) {
                return strtoupper($value) === $jalurNormalized;
            });

            $studentsInJalur = $students->where('jalur_masuk', $originalJalurCasing);

            $chartData[$jalurNormalized] = []; // Kunci di $chartData akan selalu huruf kapital (misal 'MANDIRI')
            foreach ($aspectsForChart as $aspect) {
                $columnName = $aspect . '_total';
                $chartData[$jalurNormalized][$columnName] = $studentsInJalur->avg($columnName) ?? 0;
            }
        }

        // --- MULAI LOGIKA REKOMENDASI UTAMA & SOROTAN JALUR ---

        $allIndividualRecommendations = [];
        $individualRecommendationsByJalur = [];

        // Inisialisasi array untuk setiap jalur dengan kunci huruf kapital
        foreach ($allJalurMasukInClassNormalized as $jalurNormalized) {
            $individualRecommendationsByJalur[$jalurNormalized] = [];
        }

        // 4. Hitung Rekomendasi Individu untuk Setiap Mahasiswa
        foreach ($students as $student) {
            // Normalisasi jalur_masuk mahasiswa ke huruf kapital untuk pencocokan aturan
            $normalizedStudentJalurMasuk = strtoupper($student->jalur_masuk);

            $studentCategorizedProfile = [
                'jalur_masuk' => $normalizedStudentJalurMasuk, // Ini akan cocok dengan kolom 'jalur_masuk' di tabel 'rules'
                'akademik' => $student->akademik_text,
                'sekolah' => $student->sekolah_text,
                'ekonomi' => $student->ekonomi_text,
                'perkuliahan' => $student->perkuliahan_text,
            ];

            $recommendationRule = Rule::where($studentCategorizedProfile)->first();
            $rec = $recommendationRule ? $recommendationRule->rekomendasi : "Rekomendasi Tidak Ditemukan (Aturan tidak cocok)";

            $allIndividualRecommendations[] = $rec;

            // Simpan rekomendasi individu ke array per jalur (dengan kunci huruf kapital)
            if (isset($individualRecommendationsByJalur[$normalizedStudentJalurMasuk])) {
                $individualRecommendationsByJalur[$normalizedStudentJalurMasuk][] = $rec;
            }
        }

        // 5. Tentukan Rekomendasi Utama Kelas (Yang Paling Umum)
        $mainClassRecommendation = "Tidak ada rekomendasi dominan";
        $mainClassPercentage = 0;
        if (!empty($allIndividualRecommendations)) {
            $counts = array_count_values($allIndividualRecommendations);
            arsort($counts);
            $mainClassRecommendation = key($counts);
            $mainClassFreq = current($counts);
            $mainClassPercentage = (count($allIndividualRecommendations) > 0) ? ($mainClassFreq / count($allIndividualRecommendations)) * 100 : 0;
        }

        // 6. Tentukan Sorotan Rekomendasi per Jalur (Highlight)
        $jalurHighlights = [];
        foreach ($allJalurMasukInClassNormalized as $jalurNormalized) { // Loop menggunakan kunci yang sudah dinormalisasi
            $jalurRecs = $individualRecommendationsByJalur[$jalurNormalized];
            if (!empty($jalurRecs)) {
                $jalurCounts = array_count_values($jalurRecs);
                arsort($jalurCounts);
                $dominantJalurRec = key($jalurCounts);
                $dominantJalurFreq = current($jalurCounts);
                $jalurPercentage = (count($jalurRecs) > 0) ? ($dominantJalurFreq / count($jalurRecs)) * 100 : 0;

                $jalurHighlights[$jalurNormalized] = [ // Simpan dengan kunci huruf kapital
                    'recommendation' => $dominantJalurRec,
                    'count' => count($jalurRecs),
                    'percentage' => $jalurPercentage,
                ];
            } else {
                $jalurHighlights[$jalurNormalized] = [
                    'recommendation' => null,
                    'count' => 0,
                    'percentage' => 0,
                ];
            }
        }

        // --- AKHIR LOGIKA REKOMENDASI BARU ---

        // 7. Kirim Semua Data ke Blade View
        return view('hasil_rekomendasi', [
            'kelas' => $kelas,
            'students' => $students,
            'chartData' => $chartData, // chartData sekarang punya kunci MANDIRI (kapital)
            'mainClassRecommendation' => $mainClassRecommendation,
            'mainClassPercentage' => $mainClassPercentage,
            'jalurHighlights' => $jalurHighlights, // jalurHighlights juga punya kunci MANDIRI (kapital)
        ]);
    }

    // --- Fungsi getKategoriText (tetap sama) ---
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
        return (string) $nilai;
    }
    // --- AKHIR getKategoriText ---

    // --- PASTIKAN FUNGSI LAMA (rekomendasiBelajar, getRuleSetX, getAlasanX) SUDAH DIHAPUS ---
}
