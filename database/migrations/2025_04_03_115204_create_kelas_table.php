<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up ()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->integer('dosen_id');
            $table->string('nama_kelas');
            $table->string('kode_matkul')->unique;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
