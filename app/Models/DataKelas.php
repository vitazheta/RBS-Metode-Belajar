<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;

    protected $table = 'data_kelas'; // Nama tabel di database

    protected $fillable = ['nama_kelas','kode_matkul','kolom1','kolom2',];
}
