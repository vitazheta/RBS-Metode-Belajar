@extends('layouts.app')

@section('content')
<style>
    /* CSS Spesifik untuk Halaman Pelajari (Light Mode Default) */

    /* Menyesuaikan padding-top untuk konten utama halaman */
    .hero-section {
        padding-top: 100px; /* Sesuaikan dengan tinggi navbar Anda (misal: 70px + sedikit ruang) */
        padding-bottom: 30px;
        color: #0E1F4D;
        font-family: 'Poppins', sans-serif;
    }
    body.dark-theme .hero-section {
        color: #FFFFFF;
    }

    .container-tutorial {
        max-width: 1000px; /* Batasi lebar maksimum kontainer tutorial agar tidak terlalu melebar di layar besar */
        margin: 0 auto 50px auto; /* Margin bawah 50px, tengah otomatis */
        border-radius: 15px; /* Sedikit lebih kecil agar lembut */
        background-color: #ffffff;
        padding: 40px; /* Sesuaikan padding internal agar ada ruang */
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1); /* Shadow yang sedikit lebih menonjol */
    }
    body.dark-theme .container-tutorial {
        background-color: #2D2D2D;
        box-shadow: 0px 8px 20px rgba(255, 255, 255, 0.08);
    }

    .step {
        margin-bottom: 40px; /* Tambah jarak antar langkah */
        border-bottom: 1px solid #eee; /* Garis pemisah antar langkah */
        padding-bottom: 30px; /* Padding bawah untuk garis pemisah */
    }

    .step:last-child { /* Hapus garis pemisah di langkah terakhir */
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .step h3 {
        font-weight: 700; /* Lebih tebal */
        font-size: 1.8rem; /* Ukuran lebih besar untuk judul langkah */
        color: #0E1F4D;
        margin-bottom: 15px; /* Jarak antara judul langkah dan paragraf/gambar */
        /* Hapus properti position, padding-left, dan ::before jika Anda ingin angkanya langsung di HTML */
    }
    body.dark-theme .step h3 {
        color: #FFFFFF;
    }

    /* Jika Anda ingin sedikit gaya pada angka, Anda bisa tambahkan ini */
    .step h3 span.step-number {
        display: inline-block;
        background-color: #84A7CF; /* Warna badge */
        color: #FFFFFF;
        border-radius: 50%;
        width: 35px; /* Ukuran badge sedikit lebih besar agar angka terlihat jelas */
        height: 35px;
        line-height: 35px; /* Pusatkan teks vertikal */
        text-align: center;
        font-size: 1.2rem; /* Ukuran angka lebih besar */
        font-weight: bold;
        margin-right: 15px; /* Jarak antara angka dan teks judul */
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        flex-shrink: 0; /* Pastikan tidak mengecil di flexbox */
    }
    body.dark-theme .step h3 span.step-number {
        background-color: #5A6E8C;
        box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }


    .step img {
        width: 100%; /* Gambar akan mengisi lebar kontainernya */
        height: auto;
        max-width: 700px; /* Batasi lebar maksimum gambar agar tidak terlalu besar */
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); /* Shadow lebih jelas */
        display: block;
        margin: 25px auto; /* Jarak atas-bawah gambar */
    }
    body.dark-theme .step img {
        box-shadow: 0px 4px 15px rgba(255, 255, 255, 0.08); /* Shadow gelap di dark mode */
    }

    .step p {
        font-size: 1.1rem; /* Ukuran teks paragraf sedikit lebih besar */
        line-height: 1.8; /* Jarak baris lebih lega */
        color: #333;
        margin-bottom: 15px; /* Jarak bawah paragraf */
    }
    body.dark-theme .step p {
        color: #CFD3D6;
    }

    /* Penyesuaian untuk daftar di dalam tutorial */
    .step ul {
        margin-top: 10px;
        margin-bottom: 10px;
        padding-left: 25px;
    }
    .step ul li {
        margin-bottom: 5px;
        color: #444;
    }
    body.dark-theme .step ul li {
        color: #BDC3C7;
    }
    .step ul strong {
        color: #0E1F4D;
    }
    body.dark-theme .step ul strong {
        color: #FFFFFF;
    }

    .btn-start {
        background-color: #F37AB0;
        color: #ffffff;
        border: 2px solid #F37AB0;
        padding: 12px 25px; /* Padding lebih besar */
        font-size: 1.1rem; /* Font lebih besar */
        font-weight: bold;
        border-radius: 8px; /* Sudut sedikit lebih tumpul */
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        display: inline-block; /* Agar bisa pakai margin auto jika di text-center */
    }
    .btn-start:hover {
        background-color: #E2A6C1;
        color: #ffffff;
        transform: translateY(-2px); /* Efek sedikit naik saat hover */
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    body.dark-theme .btn-start {
        background-color: #F481B4;
        color: #FFFFFF;
        border-color: #F481B4;
    }
    body.dark-theme .btn-start:hover {
        background-color: #E5AFC7;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(255,255,255,0.05);
    }

    /* Responsivitas untuk ukuran layar kecil */
    @media (max-width: 768px) {
        .hero-section {
            padding-top: 80px; /* Sedikit kurang padding di mobile */
            padding-bottom: 20px;
        }
        .hero-section h1 {
            font-size: 2.2rem; /* Ukuran judul lebih kecil */
        }
        .hero-section p {
            font-size: 0.9rem;
        }
        .container-tutorial {
            padding: 20px; /* Kurangi padding di mobile */
            margin-bottom: 30px;
        }
        .step {
            margin-bottom: 30px;
            padding-bottom: 20px;
        }
        .step h3 {
            font-size: 1.4rem; /* Ukuran judul langkah lebih kecil */
        }
        .step h3 span.step-number {
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 1rem;
            margin-right: 10px;
        }
        .step p {
            font-size: 0.95rem; /* Paragraf lebih kecil di mobile */
        }
        .btn-start {
            padding: 10px 20px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 1.8rem;
        }
        .container-tutorial {
            border-radius: 10px;
        }
    }
</style>

{{-- Konten Utama Halaman Pelajari --}}
{{-- Menggunakan div baru untuk section judul utama --}}
<div class="container text-center hero-section">
    <h1 class="fw-bold">Informasi Lebih Lanjut</h1>
    <p class="lead">Halaman ini berisi informasi detail mengenai cara penggunaan website EdVise.</p>
</div>

{{-- Memastikan tutorial berada dalam container yang rapi --}}
<div class="container-tutorial">
    <div class="step">
        <h3><span class="step-number">1</span> Masuk ke Halaman Utama</h3>
        <p>Klik Tombol "Login" di pojok kanan atas halaman.</p>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman utama EdVise dengan tombol Login di kanan atas.">
    </div>
    <div class="step">
        <h3><span class="step-number">2</span> Jika Belum Memiliki Akun, Klik "Sign Up"</h3>
        <p>Isi data-data yang diperlukan dengan lengkap dan pastikan semua kolom terisi dengan benar.</p>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm mb-3" alt="Tampilan halaman Login dengan opsi Sign Up.">
        <img src="{{ asset('images/tutorial/step2.2.png') }}" class="img-fluid rounded shadow-sm" alt="Formulir pendaftaran akun (Sign Up) dengan kolom isian.">
    </div>
    <div class="step">
        <h3><span class="step-number">3</span> Jika Sudah Memiliki Akun, Langsung ke Halaman Sign In</h3>
        <p>Masukkan Username dan Password Anda untuk login.</p>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman Sign In dengan kolom username dan password.">
    </div>
    <div class="step">
        <h3><span class="step-number">4</span> Anda Berhasil Masuk ke Dashboard</h3>
        <p>Setelah berhasil masuk, klik tombol "Buat Template Formulir Disini" pada dashboard untuk mendapatkan template kuesioner yang akan dibagikan kepada mahasiswa.</p>
        <img src="{{ asset('images/tutorial/step21.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan Dashboard Dosen dengan tombol 'Buat Template Formulir Disini'.">
    </div>
    <div class="step">
        <h3><span class="step-number">5</span> Pada Halaman Google Form</h3>
        <p>Klik ikon titik tiga di pojok kanan atas formulir, lalu pilih opsi "Make a Copy" untuk menggandakan form ke akun Google Drive Anda. Ini penting agar Anda memiliki salinan form yang bisa diedit dan hasilnya tersimpan di akun Anda.</p>
        <img src="{{ asset('images/tutorial/step5.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan Google Form dengan menu 'Make a Copy' terbuka.">
    </div>
    <div class="step">
        <h3><span class="step-number">6</span> Sebarkan Formulir Kuesioner kepada Mahasiswa</h3>
        <p>Bagikan form kuesioner yang telah Anda salin kepada seluruh mahasiswa di kelas yang Anda ampu. Pastikan mereka mengisinya dengan lengkap dan jujur.</p>
        <p>Formulir ini dirancang untuk mengumpulkan data penting yang akan membantu EdVise menganalisis gaya belajar mahasiswa.</p>
    </div>
    <div class="step">
        <h3><span class="step-number">7</span> Pastikan Seluruh Mahasiswa Telah Mengisi Kuesioner</h3>
        <p>Proses analisis rekomendasi akan lebih akurat jika semua data mahasiswa lengkap. Mohon pastikan tidak ada mahasiswa yang terlewat.</p>
    </div>
    <div class="step">
        <h3><span class="step-number">8</span> Unduh Hasil Respons dalam Format .xlsx</h3>
        <p>Setelah semua mahasiswa mengisi, buka menu "Form Responses" pada Google Form Anda. Kemudian, unduh hasilnya dalam format Microsoft Excel (.xlsx).</p>
        <img src="{{ asset('images/tutorial/step8.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan Google Form Responses dengan opsi untuk mengunduh data.">
    </div>
    <div class="step">
        <h3><span class="step-number">9</span> Kembali ke Website EdVise dan Akses Fitur "Tambah Kelas"</h3>
        <p>Navigasikan kembali ke website EdVise. Pada navigasi utama, klik menu "Tambah Kelas" untuk melanjutkan proses pengolahan data.</p>
        <img src="{{ asset('images/tutorial/step22.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan Dashboard EdVise dengan menu 'Tambah Kelas' yang aktif.">
    </div>
    <div class="step">
        <h3><span class="step-number">10</span> Unggah File .xlsx Respons Mahasiswa</h3>
        <p>Di halaman "Tambah Kelas", temukan bagian "Import dari Excel" dan unggah file .xlsx yang telah Anda unduh sebelumnya dari Google Form.</p>
        <img src="{{ asset('images/tutorial/step23.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman Tambah Kelas dengan opsi unggah file Excel.">
    </div>
    <div class="step">
        <h3><span class="step-number">11</span> Input Nama Kelas dan Kode Mata Kuliah</h3>
        <p>Setelah file berhasil diunggah, data mahasiswa akan muncul di tabel. Lengkapi informasi "Nama Kelas" (misal: Pendidikan Ilmu Komputer B - 2021) dan "Kode Mata Kuliah" (misal: IK-303 Sistem Basis Data) di bagian atas tabel.</p>
        <img src="{{ asset('images/tutorial/step25.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman Tambah Kelas dengan kolom input Nama Kelas dan Kode Mata Kuliah.">
    </div>
    <div class="step">
        <h3><span class="step-number">12</span> Klik Tombol "Simpan Data Kelas"</h3>
        <p>Gulir ke bagian bawah halaman dan klik tombol "Simpan Data Kelas" untuk menyimpan semua data yang telah Anda masukkan, termasuk data mahasiswa dan informasi kelas.</p>
        <img src="{{ asset('images/tutorial/step26.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman Tambah Kelas dengan tombol 'Simpan Data Kelas'.">
    </div>
    <div class="step">
        <h3><span class="step-number">13</span> Verifikasi Ringkasan Data Kelas</h3>
        <p>Setelah menyimpan, sebuah ringkasan data kelas akan ditampilkan. Ini adalah kesempatan Anda untuk mengecek kembali kesesuaian data. Pada tahap ini, Anda masih dapat mengubah atau menghapus data kelas pada tabel di atas ringkasan jika diperlukan.</p>
        <img src="{{ asset('images/tutorial/step27.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan ringkasan data kelas setelah disimpan.">
    </div>
    <div class="step">
        <h3><span class="step-number">14</span> Klik Tombol "Generate" untuk Analisis</h3>
        <p>Jika data sudah akurat, klik tombol "Generate" yang akan muncul di bawah ringkasan data. Ini akan memulai proses analisis data dan menghasilkan rekomendasi pembelajaran.</p>
        <img src="{{ asset('images/tutorial/step28.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan ringkasan data kelas dengan tombol 'Generate'.">
    </div>
    <div class="step">
        <h3><span class="step-number">15</span> Hasil Rekomendasi Akan Ditampilkan</h3>
        <p>Setelah proses analisis selesai, hasil rekomendasi pembelajaran yang disesuaikan dengan karakteristik mahasiswa di kelas Anda akan ditampilkan secara otomatis di halaman.</p>
        <img src="{{ asset('images/tutorial/step16.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman hasil rekomendasi pembelajaran.">
    </div>
    <div class="step">
        <h3><span class="step-number">16</span> Simpan Hasil Rekomendasi dalam PDF (Opsional)</h3>
        <p>Jika Anda ingin menyimpan hasil rekomendasi untuk referensi di kemudian hari, klik tombol "Export PDF". Anda akan mendapatkan dokumen PDF berisi rekomendasi lengkap.</p>
        <img src="{{ asset('images/tutorial/step17.png') }}" class="img-fluid rounded shadow-sm" alt="Tampilan halaman rekomendasi dengan tombol 'Export PDF'.">
    </div>
    <div class="step">
        <h3><span class="step-number">17</span> Proses Selesai! 🎉</h3>
        <p>Selamat! Anda telah berhasil mengolah data dan mendapatkan rekomendasi pembelajaran untuk kelas Anda. EdVise siap mendukung proses belajar mengajar Anda.</p>
        <img src="{{ asset('images/tutorial/step18.png') }}" alt="Tampilan akhir proses di EdVise.">
    </div>
    <div class="text-center mt-5 mb-4">
        <p class="fw-bold fs-5 mb-3">Siap untuk memulai? Klik tombol di bawah ini!</p>
        <a href="{{ url('/#banner') }}" class="btn btn-start">Mulai Sekarang</a>
    </div>
</div>

@endsection
