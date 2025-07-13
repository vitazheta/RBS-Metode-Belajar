<footer class="outer-container">
    <div class="container-footer">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/logo kecil.png') }}" alt="Logo" style="height: 20px; margin-bottom: 10px;">
                <h5>Tentang kami</h5>
                <p class="footer-text">EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami gaya belajar mahasiswa secara personal.</p>
            </div>

            <div class="col-md-2">
                <h5>Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('pelajari') }}" class="text-white text-decoration-none">Info</a></li>
                    <li><a href="{{ route('kelas.index') }}" class="text-white text-decoration-none">Daftar Kelas</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5>Kontak</h5>
                <p class="footer-text">Email: pddiktilayananpmb@gmail.com</p>
                <p class="footer-text">Telepon: +62 812 2040 1530</p>
                <div>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center mt-4">
        <p class="mb-0">© 2025 EdVise. All rights reserved.</p>
    </div>
</footer>

<style>
/* Tambahkan aturan baru ini */
.footer-text {
    color: #ffffff !important; /* Gunakan !important untuk menimpa aturan p global */
}

.copyright p {
    color: #FFFFFF !important; /* Pastikan teks di dalam div copyright juga putih */
}

/* Jika Anda juga mengimplementasikan dark mode untuk footer */
body.dark-theme .copyright p {
    color: #CFD3D6 !important; /* Warna teks di dark mode */
}
/* Pertahankan gaya footer yang sudah ada */
footer {
    background-color: #111F43; /* Warna latar belakang footer */
    color: #ffffff; /* Ini akan di-override oleh .footer-text jika lebih spesifik */
    font-family: Poppins, sans-serif;
    padding-top: 15px;
}

footer a {
    color: #84A7CF; /* Warna tautan */
    transition: color 0.3s ease;
    font-size: 14px;
}

footer a:hover {
    color: #F37AB0; /* Warna tautan saat hover */
}

.container-footer {
    padding-left: 50px; /* Tambahkan ruang di sisi kiri */
    padding-right: 20px; /* Tambahkan ruang di sisi kanan */
    margin-top: 50px;
}

.container-footer h5 {
    font-weight: bold; /* Tebalkan judul */
    color: #ffffff; /* Tambahkan ini agar judul putih */
}
.container-footer p {
    font-size: 14px; /* Ukuran font untuk teks */
    /* Hapus atau komentari 'color' di sini jika Anda menggunakan .footer-text */
    /* color: #ffffff; */ /* Ini akan menimpa #333333, tapi jika pakai .footer-text sudah cukup */
}

footer .col-md-4 {
    padding-left: 15px; /* Tambahkan ruang di sisi kiri */
    padding-right: 25px; /* Tambahkan ruang di sisi kanan */
}

.copyright {
    background-color: #F37AB0;
    color: #FFFFFF;
    padding: 10px;
    max-width: 100%;
    max-height: max-content;
}

/* Aturan untuk dark mode */
body.dark-theme footer {
    background-color: #0B1531; /* Sesuaikan dengan background dark mode yang Anda inginkan */
}

body.dark-theme .footer-text {
    color: #CFD3D6 !important; /* Warna teks di dark mode */
}

body.dark-theme .container-footer h5 {
    color: #FFFFFF; /* Warna judul di dark mode */
}

body.dark-theme footer a {
    color: #84A7CF; /* Warna tautan di dark mode */
}

body.dark-theme footer a:hover {
    color: #F37AB0; /* Warna tautan hover di dark mode */
}

body.dark-theme .copyright {
    background-color: #F481B4; /* Sesuaikan dengan background dark mode yang Anda inginkan */
    color: #FFFFFF;
}
</style>
