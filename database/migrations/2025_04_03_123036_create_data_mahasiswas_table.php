<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Data_Mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->integer('kelas_id');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('jalur_masuk');
            $table->string('profil_sekolah');
            $table->string('kesiapan_akademik');
            $table->string('kesiapan_ekonomi');
            $table->string('dukungan_ortu');
            $table->string('endurance_cita-cita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Data_Mahasiswa');
    }
};
