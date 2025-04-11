<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMahasiswaTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('jalur_masuk');
            $table->double('kesiapan_akademik', 8, 2)->nullable();
            $table->double('kesiapan_ekonomi', 8, 2)->nullable();
            $table->double('endurance_cita_cita', 8, 2)->nullable();
            $table->double('profil_sekolah', 8, 2)->nullable();
            $table->double('profil_ortu', 8, 2)->nullable();
            $table->double('pola_belajar', 8, 2)->nullable();
            $table->double('kemampuan_adaptasi', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_mahasiswa');
    }
}
