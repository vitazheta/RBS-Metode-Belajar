<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenamePerkuliahanToPerkuliahanTotal extends Migration
{
    public function up()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            // Asumsi tipe datanya VARCHAR(255) NULL seperti kolom lain
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN perkuliahan perkuliahan_total VARCHAR(255) NULL');
        });
    }

    public function down()
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            DB::statement('ALTER TABLE data_mahasiswa CHANGE COLUMN perkuliahan_total perkuliahan VARCHAR(255) NULL');
        });
    }
}
