@extends('layouts.app')

@section('title', 'Upload File Excel')

@section('content')

<style>
    .custom-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .custom-table thead {
        background-color: #0e1e4b;
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

    .custom-table tbody tr:hover {
        background-color: #e6f0fa;
        transition: all 0.2s ease-in-out;
    }

    .btn-upload {
        background-color: #0e1e4b; /* Warna latar belakang */
        color: white; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 8px 16px; /* Jarak dalam tombol */
        border-radius: 6px; /* Lengkungan tombol */
        font-size: 14px; /* Ukuran font */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-upload:hover {
        background-color: #355c99; /* Warna latar belakang saat hover */
        color: white; /* Warna teks tetap putih */
    }

    .btn-export {
        background-color: #f2c84b; /* Warna hijau */
        color: black; /* Warna teks */
        border: none; /* Hilangkan border */
        padding: 8px 16px; /* Jarak dalam tombol */
        border-radius: 6px; /* Lengkungan tombol */
        font-size: 14px; /* Ukuran font */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-export:hover {
        background-color: #d4ac30; /* Warna hijau gelap saat hover */
        color: black; /* Warna teks tetap putih */
    }
</style>

<div class="container" style="padding-top: 70px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
        Pengolahan Data Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>

    <!-- Tombol Toggle -->
    <button class="btn btn-link p-0 text-decoration-none small d-flex align-items-center"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#tutorialPengisian"
            aria-expanded="false"
            aria-controls="tutorialPengisian"
            id="toggleBtn"
            style="color: #0e1e4b; margin-top: 0px; margin-bottom: 8px;">
        <span id="toggleIcon">📘</span> &nbsp; Lihat panduan pengisian
    </button>

    <!-- Konten Collapse -->
    <div class="collapse mt-2" id="tutorialPengisian">
        <div class="card border-0 shadow-sm" style="background-color: #fdf9ed; font-size: 0.9rem; color: #0e1e4b; margin-bottom: 10px;">
            <div class="card-body">
                <p class="mb-1">Pastikan file Excel yang Anda unggah memiliki format berikut:</p>
                <ul class="mb-1 ps-3">
                    <li><strong>Nama</strong>: Nama lengkap mahasiswa</li>
                    <li><strong>Asal Sekolah</strong>: Sekolah asal mahasiswa</li>
                    <li><strong>Jalur Masuk</strong>: Jalur masuk (SNBP, SNBT, Mandiri)</li>
                    <li><strong>Pertanyaan untuk section Akademik an Endurance</strong>: 10 kolom</li>
                    <li><strong>Pertanyaan untuk section Latar Belakang</strong>: 10 kolom</li>
                    <li><strong>Pertanyaan untuk section Pola Belajar</strong>: 10 kolom</li>
                    <li><strong>Pertanyaan untuk section Perkuliahan</strong>: 10 kolom</li>
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
    <h2 class="mt-3 mb-3 fw-bold position-relative d-inline-block" style="color: #0E1F4D; font-size: 1.25rem;"> <!-- Tambahkan margin atas dan bawah -->
        Data Yang Telah Diolah
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>
    <table class="custom-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Jalur Masuk</th>
                <th>Akademik Endurance</th>
                <th>Latar Belakang</th>
                <th>Pola Belajar</th>
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
                        <td>{{ $data['akademik_endurance'] }}</td>
                        <td>{{ $data['latar_belakang'] }}</td>
                        <td>{{ $data['pola_belajar'] }}</td>
                        <td>{{ $data['perkuliahan'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-muted">Belum ada data. Silakan unggah file Excel untuk memulai pengolahan data.</td>
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
            toggleIcon.textContent = '📘'; // Saat tertutup
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