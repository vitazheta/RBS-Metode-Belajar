@extends('layouts.app')

@section('content')
<style>
    /*
    PENTING:
    - Hapus semua CSS GLOBAL (html, body, dan semua body.dark-theme global) di sini.
      Semua itu sudah di app.blade.php.
    - Hanya sisakan CSS yang spesifik untuk elemen-elemen di halaman ini.
    */

    /* CSS Umum Halaman Ini (Light Mode Default) */
    .container.text-center { /* Kontainer judul utama */
        margin-top: 80px; /* Sesuaikan dengan tinggi navbar, atau hapus jika app.blade.php sudah punya padding global */
        color: #0E1F4D;
        font-family: Poppins, sans-serif;
    }
    .container-fluid {
        padding-right: 0;
        padding-left: 0;
        max-width: 100%;
    }
    .container-tutorial {
        max-width: 1200px;
        margin: 0 auto;
        margin-bottom: 50px;
        border-radius: 20px;
        background-color: #ffffff;
        /* HAPUS padding: 50px; INI */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .step {
        margin-bottom: 30px;
    }
    .step h3 {
        font-weight: bold;
        font-size: 1.5rem;
        color: #0E1F4D; /* Warna judul langkah */
    }
    .step img {
        height: auto;
        max-width: 800px; /* Sesuaikan nilai ini sesuai lebar ideal gambar */
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        display: block;
        margin: 0 auto;
    }
    .step p {
        font-size: 1rem;
        color: #333; /* Warna teks paragraf */
    }
    .btn-start {
        background-color: #F37AB0;
        color: #ffffff;
        border: 2px solid #F37AB0;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }
    .btn-start:hover {
        background-color: #E2A6C1;
        color: #ffffff;
    }

    /* --- DARK THEME STYLES (KHUSUS UNTUK KOMPONEN DI HALAMAN INI) --- */
    body.dark-theme .container.text-center h1,
    body.dark-theme .container.text-center p {
        color: #FFFFFF;
    }
    body.dark-theme .container-tutorial {
        background-color: #2D2D2D;
        color: #FFFFFF;
    }
    body.dark-theme .container-tutorial h3 {
        color: #FFFFFF;
    }
    body.dark-theme .container-tutorial p {
        color: #CFD3D6;
    }
    body.dark-theme .btn-start {
        background-color: #F481B4;
        color: #FFFFFF;
        border-color: #F481B4;
    }
    body.dark-theme .btn-start:hover {
        background-color: #E5AFC7;
    }

</style>

{{-- Konten Utama Halaman Pelajari --}}
<div class="container text-center py-5">
    <h1 class="fw-bold">Informasi Lebih Lanjut</h1>
    <p>Halaman ini berisi informasi detail mengenai cara penggunaan website.</p>
</div>
<div class="container-fluid">
    {{-- PERBAIKAN: Hanya gunakan kelas Bootstrap padding di sini --}}
    <div class="container-tutorial px-4 py-5 rounded shadow-sm">
        <div class="step mb-5">
            <h3>1. Masuk ke Halaman Utama</h3>
            <p>Klik Tombol "Login" di pojok kanan atas halaman.</p>
            <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
        </div>
        <div class="step mb-5">
            <h3>2. Jika belum memiliki akun klik button "sign up"</h3>
            <p>Isi data-data yang diperlukan dengan lengkap.</p>
            <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
            <img src="{{ asset('images/tutorial/step2.2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
        </div>
        <div class="step mb-5">
            <h3>3. Jika sudah memiliki akun</h3>
            <p>Langsung saja menuju halaman Sign In, lalu masukkan Username dan Password.</p>
            <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
        </div>
        <div class="step mb-5">
            <h3>4. Anda Berhasil Masuk</h3>
            <p>Setelah masuk, klik tombol Download Template Google Form untuk mendapatkan template kuesioner yang akan dibagikan kepada mahasiswa.</p>
            <img src="{{ asset('images/tutorial/step21.png') }}" class="img-fluid rounded shadow-sm" alt="Step 4">
        </div>
        <div class="step mb-5">
            <h3>5. Pada halaman Google Form</h3>
            <p> Klik ikon titik tiga di pojok kanan atas, lalu pilih opsi Make a Copy untuk menggandakan form ke akun Anda</p>
            <img src="{{ asset('images/tutorial/step5.png') }}" class="img-fluid rounded shadow-sm" alt="Step 5">
        </div>
        <div class="step mb-5">
            <h3>6. Sebarkan form kuesioner yang telah disalin kepada mahasiswa di kelas Anda.</h3>
            <p>Ikuti panduan di halaman tersebut untuk mengetahui gaya belajar mahasiswa.</p>
        </div>
        <div class="step mb-5">
            <h3>7. Pastikan seluruh mahasiswa telah mengisi kuesioner tersebut.</h3>
        </div>
        <div class="step mb-5">
            <h3>8. Buka menu Form Responses</h3>
            <p> Lalu unduh hasilnya dalam format .xlsx.</p>
            <img src="{{ asset('images/tutorial/step8.png') }}" class="img-fluid rounded shadow-sm" alt="Step 8">
        </div>
        <div class="step mb-5">
            <h3>9. Setelah file berhasil diunduh</h3>
            <p>Kembali ke website dan klik toggle Tambah Kelas Olah Data.</p>
            <img src="{{ asset('images/tutorial/step22.png') }}" class="img-fluid rounded shadow-sm" alt="Step 9">
        </div>
        <div class="step mb-5">
            <h3>10. Unggah file .xlsx yang telah Anda unduh sebelumnya.</h3>
            <img src="{{ asset('images/tutorial/step23.png') }}" class="img-fluid rounded shadow-sm" alt="Step 10">
        </div>
        <div class="step mb-5">
            <h3>11. Input Nama Kelas dan Kode Mata Kuliah</h3>
            <p>Setelah proses unggah selesai, silakan isi Nama Kelas dan Kode Mata Kuliah</p>
            <img src="{{ asset('images/tutorial/step25.png') }}" class="img-fluid rounded shadow-sm" alt="Step 12">
        </div>
        <div class="step mb-5">
            <h3>12. Klik tombol Simpan Data untuk menyimpan informasi kelas.</h3>
            <p>Gulir ke bawah untuk menemukan tombol Simpan Data</p>
            <img src="{{ asset('images/tutorial/step26.png') }}" class="img-fluid rounded shadow-sm" alt="Step 14">
        </div>
        <div class="step mb-5">
            <h3>13. Ringkasan Data Kelas.</h3>
            <p>Silakan cek keseuaian data kelas Anda, pada proses ini Anda masih dapat mengubah atau menghapus data kelas pada tabel sebelumnya.</p>
            <img src="{{ asset('images/tutorial/step27.png') }}" class="img-fluid rounded shadow-sm" alt="Step 14">
        </div>
        <div class="step mb-5">
            <h3>14. Klik tombol Generate untuk memulai proses analisis.</h3>
            <img src="{{ asset('images/tutorial/step28.png') }}" class="img-fluid rounded shadow-sm" alt="Step 15">
        </div>
        <div class="step mb-5">
            <h3>16. Hasil rekomendasi akan ditampilkan secara otomatis di halaman.</h3>
            <img src="{{ asset('images/tutorial/step16.png') }}" class="img-fluid rounded shadow-sm" alt="Step 16">
        </div>
        <div class="step mb-5">
            <h3>17. Jika ingin menyimpan hasil rekomendasi, klik tombol Export PDF.</h3>
            <p>Anda akan mendapatkan hasil rekomendasi berbentuk PDF.</p>
            <img src="{{ asset('images/tutorial/step17.png') }}" class="img-fluid rounded shadow-sm" alt="Step 17">
        </div>
        <div class="step">
            <h3>18. Proses selesai! 🎉</h3>
            <p>Anda akan mendapatkan hasil rekomendasi berbentuk PDF.</p>
            <img src="{{ asset('images/tutorial/step18.png') }}" alt="Step 18">
        </div>
        <div class="text-center mt-5">
            <p class="fw-bold">Klik tombol di bawah ini untuk memulai</p>
            <a href="{{ url('/#banner') }}" class="btn btn-start">Mulai</a>
        </div>
    </div>
</div>

@endsection
