<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <--- PASTIKAN INI ADA!

class RenameKpiColumnsAgainToTotals extends Migration
{
    public function up()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            // Menggunakan raw SQL untuk mengubah nama kolom
            // Ini lebih kompatibel dengan berbagai versi MySQL/MariaDB
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN akademik_endurance akademik_total VARCHAR(255) NULL');
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN latar_belakang sekolah_total VARCHAR(255) NULL');
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN pola_belajar ekonomi_total VARCHAR(255) NULL');
            // Kolom 'perkuliahan' tidak perlu diubah namanya
            // Jika perkuliahan memiliki tipe data lain (misal INT, DECIMAL), ganti VARCHAR(255) NULL sesuai
            // Contoh: DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN perkuliahan perkuliahan_total DECIMAL(8,2) NULL');
        });
    }

    public function down()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            // Mengembalikan nama kolom ke yang lama saat rollback
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN akademik_total akademik_endurance VARCHAR(255) NULL');
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN sekolah_total latar_belakang VARCHAR(255) NULL');
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN ekonomi_total pola_belajar VARCHAR(255) NULL');
        });
    }
}
