<footer class="outer-container">
    <div class="container-footer">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/logo kecil.png') }}" alt="Logo" style="height: 20px; margin-bottom: 10px;">
                <h5 class="d-none d-md-block">Tentang kami</h5>
                <p class="footer-text d-none d-md-block">EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami gaya belajar mahasiswa secara personal.</p>
            </div>

            <div class="col-md-2 d-none d-md-block">
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
                    <a href="https://www.instagram.com/tujuwhan/" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center mt-4">
        <p class="mb-0">© 2025 EdVise. All rights reserved.</p>
    </div>
</footer>

<style>
    /* ========== GAYA FONT UMUM (PERTAMA) ========== */
    .footer-text {
        color: #ffffff !important; /* Gunakan !important untuk menimpa aturan p global */
    }

    .copyright p {
        color: #FFFFFF !important; /* Pastikan teks di dalam div copyright juga putih */
    }

    /* ========== GAYA FOOTER UMUM (KEDUA) ========== */
    footer {
        background-color: #111F43; /* Warna latar belakang footer */
        color: #ffffff; /* Ini akan di-override oleh .footer-text jika lebih spesifik */
        font-family: Poppins, sans-serif;
        padding-top: 15px;
    }

    footer a {
        color: #84A7CF; /* Warna tautan */
        transition: color 0.3s ease;
        font-size: 14px; /* Ukuran font default untuk link di desktop */
    }

    footer a:hover {
        color: #F37AB0; /* Warna tautan saat hover */
    }

    .container-footer {
        padding-left: 50px; /* Tambahkan ruang di sisi kiri untuk desktop */
        padding-right: 20px; /* Tambahkan ruang di sisi kanan untuk desktop */
        margin-top: 50px;
        padding-bottom: 30px; /* Tambahkan padding bawah untuk jarak dari copyright */
    }

    .container-footer h5 {
        font-weight: bold; /* Tebalkan judul */
        color: #ffffff; /* Tambahkan ini agar judul putih */
        font-size: 18px; /* Ukuran font default untuk h5 di desktop */
        margin-bottom: 15px; /* Spasi bawah untuk judul */
    }

    .container-footer p {
        font-size: 14px; /* Ukuran font default untuk teks paragraf di desktop */
        line-height: 1.6; /* Kerapatan baris */
    }

    footer .col-md-4 {
        padding-left: 15px; /* Tambahkan ruang di sisi kiri untuk desktop */
        padding-right: 25px; /* Tambahkan ruang di sisi kanan untuk desktop */
    }

    .copyright {
        background-color: #F37AB0;
        color: #FFFFFF;
        padding: 10px;
        max-width: 100%;
        max-height: max-content;
        font-size: 13px; /* Ukuran font default untuk copyright di desktop */
    }

    /* ========== ATURAN UNTUK DARK MODE ========== */
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

    /* ========== MOBILE STYLES (max-width: 767.98px) ========== */
    @media (max-width: 767.98px) {
        .container-footer {
            padding-left: 15px; /* Mengurangi padding di sisi kiri */
            padding-right: 15px; /* Mengurangi padding di sisi kanan */
            padding-top: 30px; /* Padding atas untuk mobile */
            margin-top: 0; /* Hapus margin atas dari desktop */
            text-align: center; /* Tengahkan semua teks di dalam container utama */
        }
        .container-footer .row {
            flex-direction: column;
            align-items: center; /* Center content horizontally */
        }

        /* Ukuran logo di mobile */
        .container-footer img {
            height: 25px; /* Ukuran logo yang sedikit lebih besar dari sebelumnya tapi tidak terlalu besar */
            margin-bottom: 20px; /* Spasi bawah logo */
        }

        /* Sembunyikan elemen "Tentang kami" dan "Navigasi" */
        .container-footer .col-md-6 h5,
        .container-footer .col-md-6 .footer-text,
        .container-footer .col-md-2 {
            display: none !important; /* Penting agar benar-benar tersembunyi */
        }

        /* Kolom kontak menjadi satu-satunya yang terlihat, ratakan tengah */
        .container-footer .col-md-4 {
            width: 100%; /* Lebar penuh */
            padding: 0; /* Hapus padding samping default col-md-4 */
            margin-top: 0; /* Hapus margin atas dari desktop */
            display: flex; /* Menggunakan flexbox untuk penengahan */
            flex-direction: column; /* Menumpuk item secara vertikal */
            align-items: center; /* Menengahkan item secara horizontal */
        }

        .container-footer .col-md-4 h5 {
            font-size: 16px; /* Ukuran font judul Kontak di mobile */
            margin-bottom: 10px; /* Spasi bawah judul Kontak */
        }

        .container-footer .col-md-4 .footer-text {
            font-size: 13px; /* Ukuran font teks kontak di mobile */
            margin-bottom: 5px; /* Spasi antar baris kontak */
        }

        /* Sosial media icons */
        .container-footer .col-md-4 div {
            display: flex;
            justify-content: center;
            gap: 20px; /* Spasi antar ikon lebih besar */
            width: 100%;
            margin-top: 15px; /* Spasi atas dari teks kontak */
        }

        .container-footer .col-md-4 div a i {
            font-size: 20px; /* Ukuran ikon sosial media di mobile */
        }

        /* Copyright Section */
        .copyright {
            padding: 15px; /* Padding lebih besar untuk copyright di mobile */
            font-size: 12px; /* Ukuran font copyright di mobile */
        }
    }

    /* Untuk perangkat yang sangat kecil (misal iPhone SE, dll.) */
    @media (max-width: 375px) {
        .container-footer {
            padding-left: 10px;
            padding-right: 10px;
        }
        .container-footer img {
            height: 22px; /* Logo sedikit lebih kecil lagi */
        }
        .container-footer .col-md-4 h5 {
            font-size: 15px;
        }
        .container-footer .col-md-4 .footer-text {
            font-size: 12px;
        }
        .container-footer .col-md-4 div a i {
            font-size: 18px;
        }
        .copyright {
            font-size: 11px;
        }
    }
</style>


