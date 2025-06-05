@extends('layouts.app')

@section('title', 'Upload File Excel')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #EBEDF4;
    }

    .container{
        margin-bottom: 50px;
        color: #0E1F4D;
    }

    .card-collapse {
        background-color: #FFFFFF;
        color: #0E1F4D;
        padding: 20px;
        border-radius: 5px;
    }

    input[type="file"] {
        background-color: #ffffff; /* Ubah latar belakang menjadi #2D2D2D */
        color: #000000; /* Ubah warna teks menjadi putih */
        padding: 6px 12px; /* Sesuaikan padding */
        border-radius: 4px; /* Tambahkan border radius */
    }

    input[type="file"]::file-selector-button {
        background-color: #ffffff; /* Ubah latar belakang tombol */
        color: #000000; /* Ubah warna teks tombol */
        padding: 6px 12px; /* Sesuaikan padding tombol */
        border-radius: 4px; /* Tambahkan border radius pada tombol */
        cursor: pointer; /* Ubah kursor menjadi pointer */
    }

    .form-control {
        background-color: #ffffff; /* Perbaikan dari 'backround-color' */
        color: #000000; /* Tambahkan warna teks agar kontras */
    }

    .form-control:focus {
        background-color: #ffffff; /* Perbaikan dari 'backround-color' */
        color: #000000; /* Tambahkan warna teks agar kontras */
    }

    .form-control:not(:placeholder-shown) {
        background-color: #ffffff; /* Ubah latar belakang menjadi #2D2D2D */
        color: #000000; /* Pastikan teks tetap terlihat dengan warna putih */
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .custom-table thead {
        background-color: #0E1F4D;
        color: white;
    }

    .custom-table th,
    .custom-table td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f0f4fa;
    }

    .custom-table tbody .text-belom-ada {
        color: #6C757D;
    }

    .table-title {
        color: #0E1F4D;
    }

    .btn-upload {
        background-color: #0E1F4D; /* Warna latar belakang */
        color: white; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 8px 16px; /* Jarak dalam tombol */
        border-radius: 6px; /* Lengkungan tombol */
        font-size: 14px; /* Ukuran font */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-upload:hover {
        background-color: #70788F; /* Warna latar belakang saat hover */
        color: #FFFFFF;
    }

    .btn-export {
        background-color: #F37AB0; /* Warna hijau */
        color: white; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 8px 16px; /* Jarak dalam tombol */
        border-radius: 6px; /* Lengkungan tombol */
        font-size: 14px; /* Ukuran font */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-export:hover {
        background-color: #E2A6C1; /* Warna latar belakang saat hover */
        color: #FFFFFF;
    }

    #toggleBtn {
        color: #0E1F4D; /* Warna default */
        margin-top: 0px;
        margin-bottom: 8px;
        transition: color 0.3s ease; /* Animasi transisi */
    }

    #toggleBtn:hover {
        color: #70788F; /* Warna saat hover */
    }

    body.dark-theme {
        background-color: #1B1B1B; /* Warna latar belakang gelap */
    }

    body.dark-theme .container {
        color: #FFFFFF; /* Warna teks gelap */
    }

    body.dark-theme #toggleBtn {
        color: #FFFFFF; /* Warna default */
        margin-top: 0px;
        margin-bottom: 8px;
        transition: color 0.3s ease; /* Animasi transisi */
    }

    body.dark-theme #toggleBtn:hover {
        color: #777F95; /* Warna saat hover */
    }

    body.dark-theme .card-collapse {
        background-color: #2D2D2D;
        color: #FFFFFF;
    }

    body.dark-theme input[type="file"] {
        background-color: #2D2D2D; /* Ubah latar belakang menjadi #2D2D2D */
        color: #FFFFFF; /* Ubah warna teks menjadi putih */
        border: 1px solid #444444; /* Tambahkan border agar lebih terlihat */
        padding: 6px 12px; /* Sesuaikan padding */
        border-radius: 4px; /* Tambahkan border radius */
    }

    body.dark-theme input[type="file"]::file-selector-button {
        background-color: #2D2D2D; /* Ubah latar belakang tombol */
        color: #FFFFFF; /* Ubah warna teks tombol */
        border: 1px solid #444444; /* Tambahkan border pada tombol */
        padding: 6px 12px; /* Sesuaikan padding tombol */
        border-radius: 4px; /* Tambahkan border radius pada tombol */
        cursor: pointer; /* Ubah kursor menjadi pointer */
    }

    body.dark-theme .form-control {
        background-color: #2D2D2D; /* Perbaikan dari 'backround-color' */
        color: #FFFFFF; /* Tambahkan warna teks agar kontras */
        border: none;
    }

    body.dark-theme .form-control:focus {
        background-color: #2D2D2D; /* Perbaikan dari 'backround-color' */
        color: #FFFFFF; /* Tambahkan warna teks agar kontras */
    }

    body.dark-theme .form-control:not(:placeholder-shown) {
        background-color: #2D2D2D; /* Ubah latar belakang menjadi #2D2D2D */
        color: #ffffff; /* Pastikan teks tetap terlihat dengan warna putih */
    }

    body.dark-theme .table-title {
        color: #FFFFFF;
    }

    body.dark-theme .custom-table tbody {
        background-color: #2D2D2D;
        color: white;
    }

    body.dark-theme .custom-table tbody .text-belom-ada {
        color: #CFD3D6;
    }

    body.dark-theme .custom-table tbody tr:nth-child(even) {
        background-color: #1B1B1B;
    }

    body.dark-theme .btn-upload:hover {
        background-color: #70788F; /* Warna latar belakang saat hover */
        color: #FFFFFF;
    }
</style>

<div class="container" style="padding-top: 70px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block">
        Pengolahan Data Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    <!-- Tombol Toggle -->
    <button class="btn btn-link p-0 text-decoration-none small d-flex align-items-center"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#tutorialPengisian"
            aria-expanded="false"
            aria-controls="tutorialPengisian"
            id="toggleBtn">
        <span id="toggleIcon">🔽</span> &nbsp; Lihat panduan pengisian
    </button>

    <!-- Konten Collapse -->
    <div class="collapse mt-2" id="tutorialPengisian">
        <div class="card-collapse border-0 shadow-sm" style="font-size: 0.9rem; margin-bottom: 10px;">
            <div class="card-body">
                <p class="mb-1">Pastikan file Excel yang Anda unggah memiliki format berikut:</p>
                <ul class="mb-1 ps-3">
                    <li><strong>Nama</strong>: Nama lengkap mahasiswa</li>
                    <li><strong>Asal Sekolah</strong>: Sekolah asal mahasiswa</li>
                    <li><strong>Jalur Masuk</strong>: Jalur masuk (SNBP, SNBT, Mandiri)</li>
                    <li><strong>Pertanyaan untuk section Akademik, Profil Sekolah, Kesiapan Ekonomi, dan Proses Kuliah Tiap Jalur</strong></li>
                </ul>
                <p class="mb-0">Gunakan template Excel yang sesuai untuk menghindari kesalahan pengolahan data.</p>
            </div>
        </div>
    </div>

    <!-- FORM UPLOAD -->
    <form action="{{ route('upload.xlsx.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3"> <!-- Tambahkan margin bawah yang lebih besar -->
            <label for="file" class="form-label">Pilih File Excel (.xlsx)</label>
            <div class="d-flex align-items-center">
                <input type="file" class="form-control @error('file') is-invalid @enderror me-3" id="file" name="file" required style="flex: 1; max-width: none;">
                <button type="submit" class="btn btn-upload">Upload Data</button>
            </div>
            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </form>

    <!-- TABEL DATA -->
    <h2 class="table-title mt-3 mb-3 fw-bold position-relative d-inline-block" style="font-size: 1.25rem;"> <!-- Tambahkan margin atas dan bawah -->
        Data Yang Telah Diolah
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>
    <table class="custom-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Jalur Masuk</th>
                <th>Akademik</th>
                <th>Profil Sekolah</th>
                <th>Kesiapan Ekonomi</th>
                <th>Perkuliahan</th>
            </tr>
        </thead>
        <tbody>
            @if(session('processedData'))
                @foreach(session('processedData') as $data)
                    <tr>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['asal_sekolah'] }}</td>
                        <td>{{ $data['jalur_masuk'] }}</td>
                        <td>{{ $data['akademik'] }}</td>
                        <td>{{ $data['sekolah'] }}</td>
                        <td>{{ $data['ekonomi'] }}</td>
                        <td>{{ $data['perkuliahan'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-belom-ada">Belum ada data. Silakan unggah file Excel untuk memulai pengolahan data.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- TOMBOL EXPORT CSV -->
    @if(session('processedData'))
        <button id="exportCsvBtn" class="btn btn-export mt-3">Export ke CSV</button>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const collapseEl = document.getElementById('tutorialPengisian');
        const toggleIcon = document.getElementById('toggleIcon');

        collapseEl.addEventListener('show.bs.collapse', function () {
            toggleIcon.textContent = '🔼'; // Saat terbuka
        });

        collapseEl.addEventListener('hide.bs.collapse', function () {
            toggleIcon.textContent = '🔽'; // Saat tertutup
        });

        const exportCsvBtn = document.getElementById('exportCsvBtn');

        if (exportCsvBtn) {
            exportCsvBtn.addEventListener('click', function () {
                // Unduh file CSV
                fetch('{{ route('download.csv')}}')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengunduh file CSV.');
                        }
                        return response.blob();
                    })
                    .then(blob => {
                        // Buat URL untuk file CSV
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'processed_data.csv';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);

                        // Redirect ke halaman export-success
                        window.location.href = '{{ route('export.success') }}';
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                        alert('Gagal mengunduh file CSV.');
                    });
            });
        }
    });
</script>

@endsection