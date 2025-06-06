<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule; // Pastikan Anda mengimpor Model Rule

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Metode ini akan dipanggil saat Anda menjalankan db:seed
     */
    public function run(): void
    {
        // (Opsional) Hapus data lama jika Anda ingin memulai dari nol setiap kali seeder dijalankan
        Rule::truncate();

        $rulesData = [
            // Contoh aturan yang sudah kita diskusikan (LENGKAPI SEMUA ATURAN ANDA DI SINI)
            ['jalur_masuk' => 'SNBP', 'akademik' => 'Tinggi', 'sekolah' => 'Mendukung', 'ekonomi' => 'Sangat Mencukupi', 'perkuliahan' => 'Kurang Baik', 'rekomendasi' => 'Rule 1'],
            ['jalur_masuk' => 'Mandiri', 'akademik' => 'Tinggi', 'sekolah' => 'Sangat Mendukung', 'ekonomi' => 'Sangat Mencukupi', 'perkuliahan' => 'Baik', 'rekomendasi' => 'Rule 2'],
            // ... tambahkan semua aturan Anda di sini
            ['jalur_masuk' => 'SNBT', 'akademik' => 'Sedang', 'sekolah' => 'Sangat Mendukung', 'ekonomi' => 'Sangat Mencukupi', 'perkuliahan' => 'Kurang Baik', 'rekomendasi' => 'Rule 3'],
            ['jalur_masuk' => 'SNBP', 'akademik' => 'Tinggi', 'sekolah' => 'Sangat Mendukung', 'ekonomi' => 'Sangat Mencukupi', 'perkuliahan' => 'Baik', 'rekomendasi' => 'Rule 4'],
            // ... dan seterusnya untuk SNBT dan Mandiri
        ];

        foreach ($rulesData as $rule) {
            Rule::create($rule); // Ini akan menyimpan setiap aturan ke database
        }
    }
}
