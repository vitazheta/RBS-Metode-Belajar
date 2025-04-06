<?php

namespace App\Models;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'Kelas'; // Nama tabel di database

    protected $fillable = [
        'dosen_id',
        'nama_kelas',
        'kode_matkul',
        'kolom1',
        'kolom2',
    ];
  // public function dosen()
    //{
      //  return $this->belongsTo(Dosen::class);
    //}

    //public function mahasiswa()
    //{
      //  return $this->hasMany(DataMahasiswa::class);
    //}

    //public function metodeBelajar()
    //{
      //  return $this->hasOne(MetodeBelajar::class);
    //}
}
