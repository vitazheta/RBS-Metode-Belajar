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
            $table->unsignedBigInteger('kelas_id');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('jalur_masuk');
            $table->float('profil_sekolah')->nullable();
            $table->float('kesiapan_akademik')->nullable();
            $table->float('kesiapan_ekonomi')->nullable();
            $table->float('dukungan_ortu')->nullable();
            $table->float('endurance_cita-cita')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
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
