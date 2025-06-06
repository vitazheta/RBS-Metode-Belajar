@extends('layouts.app')

@section('title', 'Export Berhasil')

@section('content')

<style>
    body { 
        background-color: #EBEDF4;
    }

    .container {
        margin-bottom: 200px;
        color: #0E1F4D;
    }
    .btn {
        background-color: #F37AB0; /* Warna kuning */
        color: white; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 6px 18px; /* Ukuran tombol lebih kecil */
        font-size: 0.85rem; /* Ukuran font lebih kecil */
        border-radius: 5px; /* Lengkungan lebih besar untuk membuat tombol lonjong */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn:hover {
        background-color: #E2A6C1; /* Warna kuning gelap saat hover */
        color: #ffffff; /* Warna teks tetap hitam */
    }

    body.dark-theme {
        background-color: #1B1B1B;
        color: #FFFFFF;
    }

    body.dark-theme .container {
        color: #FFFFFF;
    }
</style>

<div class="container text-center" style="padding-top: 100px;">
    <!-- Ubah ukuran judul -->
    <h1 class="fw-bold" style="font-size: 1.5rem;">Data mahasiswa yang telah diolah berhasil di export</h1>
    <p class="mt-3" style="font-size: 1.1rem; color: #6c757d;">File CSV telah diunduh, silahkan lanjut mengunggah data dengan menekan tombol dibawah ini!</p>
    
    <!-- Tombol dengan gaya baru -->
    <a href="{{ route('dynamic.table') }}" 
        class="btn mt-4">
        Tambahkan Data Kelas
    </a>
</div>

@endsection