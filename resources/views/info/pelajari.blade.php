<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajari Lebih Lanjut Tentang EdVise</title>

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
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Content -->
    <div class="container text-center py-5">
        <h1 class="fw-bold">Informasi Lebih Lanjut</h1>
        <p>Halaman ini berisi informasi detail mengenai cara penggunaan website.</p>
    </div>
    <div class="container-fluid">
        <div class="container-tutorial p-5 rounded shadow-sm">
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
                <img src="{{ asset('images/tutorial/step4.png') }}" class="img-fluid rounded shadow-sm" alt="Step 4">
            </div>
            <div class="step mb-5">
                <h3>5. Pada halaman Google Form</h3>
                <p> Klik ikon titik tiga di pojok kanan atas, lalu pilih opsi Make a Copy untuk menggandakan form ke akun Anda</p>
                <img src="{{ asset('images/tutorial/step5.png') }}" class="img-fluid rounded shadow-sm" alt="Step 5">
            </div>
            <div class="step mb-5">
                <h3>6. Sebarkan form kuesioner yang telah disalin kepada mahasiswa di kelas Anda.</h3>
                <p>Ikuti panduan di halaman tersebut untuk mengetahui gaya belajar mahasiswa.</p>
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
                <p>Kembali ke website dan klik tombol Olah Data.</p>
                <img src="{{ asset('images/tutorial/step9.png') }}" class="img-fluid rounded shadow-sm" alt="Step 9">
            </div>
            <div class="step mb-5">
                <h3>10. Unggah file .xlsx yang telah Anda unduh sebelumnya.</h3>
                <img src="{{ asset('images/tutorial/step10.png') }}" class="img-fluid rounded shadow-sm" alt="Step 10">
            </div>
            <div class="step mb-5">
                <h3>11. Klik tombol Export ke CSV untuk memproses data.</h3>
                <img src="{{ asset('images/tutorial/step11.png') }}" class="img-fluid rounded shadow-sm" alt="Step 11">
            </div>
            <div class="step mb-5">
                <h3>12. Setelah data diproses</h3>
                <p>Klik tombol Tambahkan data kelas setelah mengunduh CSV.</p>
                <img src="{{ asset('images/tutorial/step12.png') }}" class="img-fluid rounded shadow-sm" alt="Step 12">
            </div>
            <div class="step mb-5">
                <h3>13. Isi data yang diperlukan untuk menambah kelas.</h3>
                <p>Masukkan Nama Kelas, Kode Mata Kuliah, dan unggah file CSV yang sudah dimiliki.</p>
                <img src="{{ asset('images/tutorial/step13.png') }}" class="img-fluid rounded shadow-sm" alt="Step 13">
            </div>
            <div class="step mb-5">
                <h3>14. Klik tombol Simpan Data untuk menyimpan informasi kelas.</h3>
                <img src="{{ asset('images/tutorial/step14.png') }}" class="img-fluid rounded shadow-sm" alt="Step 14">
            </div>
            <div class="step mb-5">
                <h3>15. Klik tombol Generate untuk memulai proses analisis.</h3>
                <img src="{{ asset('images/tutorial/step15.png') }}" class="img-fluid rounded shadow-sm" alt="Step 15">
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

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>

body {
    margin: 0;
    padding: 0;
    width: 100%;
    background-color: #EBEDF4; /* Warna latar belakang */
}

.container-fluid {
    padding-right: 0;
    padding-left: 0;
    max-width: 100%;
}

.container {
    margin-top: 80px;
    padding-right: none;
    padding-left: none;
    max-width: 100%; /* Pastikan lebar penuh */
    font-family: Poppins, sans-serif;
    color: #0E1F4D;
}

.container text-center {
    color: #0E1F4D;
}

.container-tutorial {
    max-width: 1200px;
    margin: 0 auto; /* Memusatkan container secara horizontal */
    margin-bottom: 50px;
    border radius: 20px;
    background-color: #ffffff;
    /* padding: 10px; /* Tambahkan padding untuk konten */
}

.step {
    margin-bottom: 30px;
}

.step h3 {
    font-weight: bold;
    font-size: 1.5rem;
}

.step img {
    height: 300px; /* Tinggi gambar */
    width: 602px; /* Lebar gambar */
    object-fit: cover; /* Menjaga proporsi gambar */
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.step p {
    font-size: 1rem;
    color: #333;
}

.btn-start {
    background-color: #F37AB0; /* Warna dasar tombol */
    color: #ffffff; /* Warna teks */
    border: 2px solid #F37AB0; /* Border dengan warna dasar */
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease-in-out; /* Animasi transisi */
}

.btn-start:hover {
    background-color: #E2A6C1; /* Transparan saat hover */
    color: #ffffff; /* Warna teks berubah */
}

/* Dark Theme */
body.dark-theme {
    background-color: #1B1B1B;
}

body.dark-theme .container {
    color: #FFFFFF;
}

body.dark-theme .container-tutorial {
    background-color: #2D2D2D;
    color: #FFFFFF;
}

body.dark-theme .step h3 {
    color: #FFFFFF;
}

body.dark-theme .step p {
    color: #FFFFFF;
}

</style>
