@extends('layouts.app')

@section('title', 'Export Berhasil')

@section('content')

<style>
    /* Tambahkan gaya untuk tombol */
    .btn {
        background-color: #f2c84b; /* Warna kuning */
        color: black; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 6px 18px; /* Ukuran tombol lebih kecil */
        font-size: 0.85rem; /* Ukuran font lebih kecil */
        border-radius: 10px; /* Lengkungan lebih besar untuk membuat tombol lonjong */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn:hover {
        background-color: #d4ac30; /* Warna kuning gelap saat hover */
        color: black; /* Warna teks tetap hitam */
    }
</style>

<div class="container text-center" style="padding-top: 100px;">
    <!-- Ubah ukuran judul -->
    <h1 class="fw-bold" style="color: #0E1F4D; font-size: 1.5rem;">Data mahasiswa yang telah diolah berhasil di-export</h1>
    <p class="mt-3" style="font-size: 1.1rem; color: #6c757d;">File CSV Anda telah berhasil dibuat dan siap untuk diunduh.</p>
    
    <!-- Tombol dengan gaya baru -->
    <a href="{{ route('dynamic.table') }}" 
       class="btn mt-4">
        Tambahkan Data Kelas
    </a>
</div>

@endsection