@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="fw-bold">Informasi Lebih Lanjut</h1>
    <p>Ini adalah halaman informasi detail tentang fitur dan sistem yang digunakan.</p>
</div>
<div class="container py-5">
    <h1 class="mb-4">Tutorial Penggunaan Website</h1>

    <div class="step mb-5">
        <h3>1. Masuk ke Halaman Utama</h3>
        <p>Klik Tombol "Login" di pojok kanan atas halaman.</p>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>
    <div class="step mb-5">
        <h3>2. Jika belum memiliki akun klik button "sign up"</h3>
        <p>Masukan Username, dan Password.</p>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>3. Jika sudah memiliki akun</h3>
        <p>Langsung saja menuju halaman Sign In, lalu masukkan Username dan Password.</p>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>
    <div class="step mb-5">
        <h3>4. Anda Berhasil Masuk</h3>
        <p>Setelah masuk, klik tombol Download Template Google Form untuk mendapatkan template kuesioner yang akan dibagikan kepada mahasiswa.</p>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>
    <div class="step mb-5">
        <h3>5. Pada halaman Google Form</h3>
        <p> Klik ikon titik tiga di pojok kanan atas, lalu pilih opsi Make a Copy untuk menggandakan form ke akun Anda</p>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>6. Sebarkan form kuesioner yang telah disalin kepada mahasiswa di kelas Anda.</h3>
        <p>Ikuti panduan di halaman tersebut untuk memilih atau mengetahui gaya belajar kamu.</p>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>
    <div class="step mb-5">
        <h3>7. Pastikan seluruh mahasiswa telah mengisi kuesioner tersebut.</h3>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>
    <div class="step mb-5">
        <h3>8. Buka menu Form Responses</h3>
        <p> Lalu unduh hasilnya dalam format .xlsx.</p>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>9. Setelah file berhasil diunduh</h3>
        <p>Kembali ke website dan klik tombol Olah Data.</p>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>
    <div class="step mb-5">
        <h3>10. Unggah file .xlsx yang telah Anda unduh sebelumnya.</h3>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>
    <div class="step mb-5">
        <h3>11. Klik tombol Generate untuk memproses data.</h3>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>12. Setelah data diproses</h3>
        <p>Klik tombol Download CSV untuk mengunduh hasilnya.</p>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>
    <div class="step mb-5">
        <h3>13. Buka tab Tambah Kelas pada menu utama.</h3>
        <p>Masukkan Nama Kelas, Kode Mata Kuliah, dan unggah file CSV yang sudah dimiliki.</p>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>

    <div class="step mb-5">
        <h3>14. Klik tombol Simpan Data untuk menyimpan informasi kelas.</h3>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>15. Klik tombol Generate untuk memulai proses analisis.</h3>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>
    <div class="step mb-5">
        <h3>16. Hasil rekomendasi akan ditampilkan secara otomatis di halaman.</h3>
        <img src="{{ asset('images/tutorial/step1.png') }}" class="img-fluid rounded shadow-sm" alt="Step 1">
    </div>
    <div class="step mb-5">
        <h3>17. Jika ingin menyimpan hasil rekomendasi, klik tombol Export PDF.</h3>
        <img src="{{ asset('images/tutorial/step2.png') }}" class="img-fluid rounded shadow-sm" alt="Step 2">
    </div>
    <div class="step mb-5">
        <h3>18. Proses selesai! 🎉</h3>
        <img src="{{ asset('images/tutorial/step3.png') }}" class="img-fluid rounded shadow-sm" alt="Step 3">
    </div>


</div>
@endsection
