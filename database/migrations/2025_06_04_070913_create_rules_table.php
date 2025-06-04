<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Metode ini akan dijalankan saat Anda menjalankan 'php artisan migrate'
     */
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' (primary key, auto-increment)
            $table->string('jalur_masuk'); // Untuk 'SNBP', 'SNBT', 'Mandiri'
            $table->string('akademik');    // Untuk 'RENDAH', 'SEDANG', 'TINGGI'
            $table->string('sekolah');     // Untuk 'KURANG MENDUKUNG', 'MENDUKUNG', 'SANGAT MENDUKUNG'
            $table->string('ekonomi');     // Untuk 'KURANG MENCUKUPI', 'MENCUKUPI', 'SANGAT MENCUKUPI'
            $table->string('perkuliahan'); // Untuk 'KURANG BAIK', 'BAIK', 'SANGAT BAIK'
            $table->text('rekomendasi');   // Kolom untuk menyimpan teks rekomendasi yang panjang

            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at' secara otomatis

            // (Opsional tapi Direkomendasikan) Tambahkan unique constraint
            // Ini akan memastikan tidak ada dua aturan yang persis sama
            // yang mengarah ke rekomendasi yang berbeda (atau sama)
            $table->unique([
                'jalur_masuk',
                'akademik',
                'sekolah',
                'ekonomi',
                'perkuliahan'
            ], 'unique_rule_criteria');
        });
    }

    /**
     * Reverse the migrations.
     * Metode ini akan dijalankan saat Anda menjalankan 'php artisan migrate:rollback'
     */
    public function down(): void
    {
        Schema::dropIfExists('rules'); // Menghapus tabel 'rules' jika migrasi dibatalkan
    }
};
