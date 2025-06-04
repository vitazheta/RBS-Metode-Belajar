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
            ['jalur_masuk' => 'SNBO', 'akademik' => 'SEDANG', 'sekolah' => 'MENDUKUNG', 'ekonomi' => 'MENCUKUPI', 'perkuliahan' => 'KURANG BAIK', 'rekomendasi' => 'Penjelasan mendalam disertai contoh langsung dari dosen'],
            ['jalur_masuk' => 'SNBT', 'akademik' => 'TINGGI', 'sekolah' => 'SANGAT MENDUKUNG', 'ekonomi' => 'MENCUKUPI', 'perkuliahan' => 'BAIK', 'rekomendasi' => 'Sediakan materi ringkasan, berikan tugas mencatat atau membuat jurnal belajar'],
            // ... tambahkan semua aturan Anda di sini
            ['jalur_masuk' => 'SNBT', 'akademik' => 'RENDAH', 'sekolah' => 'MENDUKUNG', 'ekonomi' => 'MENCUKUPI', 'perkuliahan' => 'BAIK', 'rekomendasi' => 'Menggunakan video pembelajaran dan diskusi kelompok aktif'],
            ['jalur_masuk' => 'SNBT', 'akademik' => 'RENDAH', 'sekolah' => 'Kurang Mendukung', 'ekonomi' => 'MENCUKUPI', 'perkuliahan' => 'BAIK', 'rekomendasi' => 'Menggunakan video pembelajaran dan diskusi kelompok aktif'],
            // ... dan seterusnya untuk SNBT dan Mandiri
        ];

        foreach ($rulesData as $rule) {
            Rule::create($rule); // Ini akan menyimpan setiap aturan ke database
        }
    }
}
