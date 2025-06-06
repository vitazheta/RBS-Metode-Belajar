<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule; // Pastikan Anda mengimpor Model Rule

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opsional: Hapus semua aturan yang ada sebelumnya jika Anda ingin memulai dari nol
        // Ini sangat direkomendasikan saat Anda mengisi data dummy untuk pengujian
        Rule::truncate();

        // Definisi kategori untuk setiap aspek
        // Pastikan casing (huruf kapital/kecil) SAMA PERSIS dengan output getKategoriText Anda
        $jalurMasukCategories = ['SNBP', 'SNBT', 'Mandiri'];
        $akademikCategories = ['Rendah', 'Sedang', 'Tinggi'];
        $sekolahCategories = ['Kurang Mendukung', 'Mendukung', 'Sangat Mendukung'];
        $ekonomiCategories = ['Kurang Mencukupi', 'Mencukupi', 'Sangat Mencukupi'];
        $perkuliahanCategories = ['Kurang Baik', 'Baik', 'Sangat Baik'];

        $allRules = [];
        $ruleNumber = 1;

        // Loop untuk menghasilkan semua kombinasi aturan
        foreach ($jalurMasukCategories as $jalurMasuk) {
            foreach ($akademikCategories as $akademik) {
                foreach ($sekolahCategories as $sekolah) {
                    foreach ($ekonomiCategories as $ekonomi) {
                        foreach ($perkuliahanCategories as $perkuliahan) {
                            $allRules[] = [
                                'jalur_masuk' => $jalurMasuk,
                                'akademik' => $akademik,
                                'sekolah' => $sekolah,
                                'ekonomi' => $ekonomi,
                                'perkuliahan' => $perkuliahan,
                                'rekomendasi' => 'Rekomendasi Umum ' . $ruleNumber, // Teks rekomendasi dummy
                                // created_at dan updated_at akan diisi otomatis oleh Eloquent
                            ];
                            $ruleNumber++;
                        }
                    }
                }
            }
        }

        // Masukkan semua aturan ke database
        foreach ($allRules as $ruleData) {
            Rule::create($ruleData);
        }

        $this->command->info('Total ' . count($allRules) . ' aturan rekomendasi dummy berhasil di-seed.');
    }
}
