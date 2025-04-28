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
            $table->string('asal_sekolah');
            $table->string('jalur_masuk');
            $table->double('akademik_endurance', 8, 2)->nullable();
            $table->double('latar_belakang', 8, 2)->nullable();
            $table->double('pola_belajar', 8, 2)->nullable();
            $table->double('perkuliahan', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_mahasiswa');
    }
}
