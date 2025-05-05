{{-- resources/views/kelas/daftar_kelas.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')

<style>
    html, body {
    height: 100%; /* Pastikan tinggi halaman mencakup seluruh layar */
    }

    body {
        font-family: 'Poppins', sans-serif;
        padding-top: 10px; /* Sesuaikan dengan tinggi navbar */
        background-color: #EBEDF4;
    }

    .daftar-kelas-title {
        font-size: 40px;
        font-weight: bold;
        color: #0E1F4D;
        position: relative;
    }

    .daftar-kelas-title span {
        display: block;
        margin-top: 4px;
        height: 4px;
        width: 25%;
        background-color: #84A7CF;
    }

    .desc-daftar-kelas {
        font-size: 20px;
        color: #54585C;
        margin-top: 15px;
    }

    .card-kelas {
        width: 100%;
        max-width: 100%;
        height: 100px;
        margin: 0 auto;
        border: 0px;
    }

    .card-kelas .card-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .card-body .card-title {
        font-size: 20px;
        font-weight: bold;
        color: #0E1F4D;
    }

    .btn-detail-kelas {
        background-color: #F37AB0; /* Warna latar belakang */
        color: #ffffff; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 5px 15px; /* Padding untuk ukuran tombol */
        font-size: 14px; /* Ukuran teks */
        border-radius: 5px; /* Membuat sudut tombol sedikit melengkung */
        text-decoration: none; /* Hilangkan underline */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-detail-kelas:hover {
        background-color: transparent !important; /* Warna latar belakang saat hover */
        color: #F37AB0 !important; /* Warna teks saat hover */
        border: 2px solid #F37AB0;
        text-decoration: none; /* Pastikan underline tetap hilang saat hover */
    }

    .content-wrapper {
        min-height: calc(100vh - 100px); /* Pastikan konten utama memenuhi layar */
        margin-bottom: 100px; /* Tambahkan ruang kosong sebelum footer */
    }

</style>

<div class="container content-wrapper mt-4" style="color: #0E1F4D; padding-top: 70px;">
    <div class="mb-4">
        <h2 class="daftar-kelas-title">
            Daftar Kelas
            <span></span>
        </h2>
        <p class="desc-daftar-kelas">
            Halaman ini menampilkan daftar kelas yang telah Anda buat. 
        </p>
    </div>

    <div class="row">
        @foreach ($daftarKelas as $kelas)
            <div class="col-12 mb-3">
                <div class="card card-kelas">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <!-- Icon di samping Nama Kelas -->
                            <i class="fas fa-chalkboard-teacher me-3 mt-1"></i> <!-- Ganti dengan icon yang sesuai -->
                            <div>
                                <h5 class="card-title mb-1">Kelas {{ $kelas->nama_kelas }}</h5>
                                <p class="card-text mb-0">Kode Mata Kuliah: {{ $kelas->kode_mata_kuliah }}</p>
                            </div>
                        </div>
                        <a href="{{ route('hasil.rekomendasi', $kelas->id) }}" class="btn btn-sm btn-detail-kelas">Detail Kelas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

