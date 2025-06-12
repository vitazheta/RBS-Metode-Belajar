<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Daftar Kelas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
    </style>
</head>

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
        /* font-size: 40px; */
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
        color: #6C757D;
        margin-top: 15px;
    }

    .card-kelas {
        width: 100%;
        max-width: 100%;
        height: 120px;
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
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-detail-kelas:hover {
        background-color: #E2A6C1 !important; /* Warna latar belakang saat hover */
        color: #FFFFFF !important; /* Warna teks saat hover */
    }

    .content-wrapper {
        min-height: calc(100vh - 100px); /* Pastikan konten utama memenuhi layar */
        margin-bottom: 100px; /* Tambahkan ruang kosong sebelum footer */
    }

    .buton-kelas {
        display: flex;
        gap: 10px;
    }

    /* Dark Theme */
    body.dark-theme {
        background-color: #1B1B1B; /* Warna latar belakang gelap */
    }

    body.dark-theme .daftar-kelas-title {
        color: #FFFFFF;
    }

    body.dark-theme .desc-daftar-kelas {
        color: #CFD3D6;
    }

    body.dark-theme .card-kelas {
        color: #ffffff;
        background-color: #2D2D2D;
    }

    body.dark-theme .card-body .card-title {
        color: #FFFFFF;
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
                <div class="card card-kelas" data-id="{{ $kelas->id }}">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <!-- Icon di samping Nama Kelas -->
                            <i class="fas fa-chalkboard-teacher me-3 mt-1"></i> <!-- Ganti dengan icon yang sesuai -->
                            <div>
                                <h5 class="card-title mb-1">Kelas {{ $kelas->nama_kelas }}</h5>
                                <p class="card-text mb-0">Kode Mata Kuliah: {{ $kelas->kode_mata_kuliah }}</p>
                            </div>
                        </div>
                        <div class="buton-kelas d-flex flex-column justify-content-end">
                            <a href="{{ route('hasil.rekomendasi', $kelas->id) }}" class="btn btn-sm btn-detail-kelas">Detail Kelas</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function removeRow(button) {
        if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
            const row = button.closest('.card'); // Ambil elemen card terdekat
            const kelasId = row.getAttribute('data-id'); // Ambil ID kelas dari atribut data-id

            fetch(`/kelas/${kelasId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Tambahkan CSRF token
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.remove(); // Hapus elemen card dari DOM
                    alert(data.success);
                } else {
                    alert('Gagal menghapus kelas.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            });
        }
    }
</script>

@endsection

