<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            // Mengubah tipe kolom yang sudah ada menjadi float
            // Pastikan Anda tahu nama kolom pastinya di DB (perkuliahan atau perkuliahan_total)
            $table->float('akademik_total')->nullable()->change();
            $table->float('sekolah_total')->nullable()->change();
            $table->float('ekonomi_total')->nullable()->change();
            $table->float('perkuliahan_total')->nullable()->change(); // Gunakan 'perkuliahan' jika nama kolom di DB masih itu
            // ATAU
            // $table->float('perkuliahan_total')->nullable()->change(); // Gunakan ini jika Anda sudah punya migrasi yang merename ke 'perkuliahan_total'
        });
    }

    public function down()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            // Mengembalikan tipe kolom ke varchar jika diperlukan (misalnya jika rollback)
            $table->string('akademik_total')->nullable()->change();
            $table->string('sekolah_total')->nullable()->change();
            $table->string('ekonomi_total')->nullable()->change();
            $table->string('perkuliahan_total')->nullable()->change(); // Sesuaikan namanya
        });
    }
};
