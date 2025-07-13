<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        /* ========== GAYA GLOBAL UNTUK LIGHT THEME ========== */
        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            /* PERBAIKAN: Padding top yang cukup untuk mengatasi navbar yang fix */
            /* padding-top: 50px; */
            background-color: #EBEDF4; /* Default background untuk light theme */
            color: #000000; /* Default text color for light theme */
        }

        /* PERBAIKAN: Standardisasi Ukuran Font untuk Judul dan Paragraf Utama */
        h1 {
            font-size: 2.8rem; /* Contoh ukuran untuk h1 */
            font-weight: 700; /* Bold */
            color: #0E1F4D; /* Warna default light mode */
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 2.2rem; /* Contoh ukuran untuk h2 */
            font-weight: 600; /* Semi-bold */
            color: #0E1F4D; /* Warna default light mode */
            margin-bottom: 1.2rem;
        }

        h3 {
            font-size: 1.8rem; /* Contoh ukuran untuk h3 */
            font-weight: 600;
            color: #0E1F4D; /* Warna default light mode */
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem; /* Contoh ukuran untuk paragraf standar */
            line-height: 1.6;
            color: #333333; /* Warna default light mode */
            margin-bottom: 1rem;
        }

        /* ========== GAYA UMUM NAVBAR (Ini dari navbar.blade.php yang di-include) ========== */
        .navbar-custom {
            background: linear-gradient(135deg, #111F43 0%, #3F5694 30%, #000D30 100%);
            border-radius: 0 0 10px 10px;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img { height: 40px; }
        .btn-nav { color: white; text-decoration: none; font-family: Poppins, sans-serif; font-size: 14px; position: relative; padding: 10px 15px; display: inline-block; transition: color 0.3s ease; overflow: hidden; }
        .btn-nav:hover { background-color: transparent !important; color: #84A7CF !important; text-decoration: none; }
        .btn-nav.active { color: #ffffff !important; }
        .btn-nav::after { content: ''; position: absolute; left: 0; bottom: 0; width: 0; height: 2px; background-color: #84A7CF; transition: width 0.3s ease; }
        .btn-nav.active::after { width: 100%; background-color: #ffffff; }
        .btn-log { background-color: #F37AB0; color: #ffffff; border-radius: 7px; padding: 10px 20px; font-size: 14px; text-align: center; text-decoration: none; transition: background-color 0.3s ease, color 0.3s ease; display: inline-block; }
        .btn-log:hover { background-color: #E2A6C1 !important; color: #ffffff !important; }
        .btn-log::after { content: none !important; display: none !important; }

        /* PERBAIKAN: Gaya untuk ikon bulan/matahari di toggle dark mode */
        .form-check-label .bi { /* Menargetkan ikon Bootstrap */
            font-size: 18px;
            cursor: pointer;
            color: #FFFFFF; /* Warna ikon tetap putih */
        }
        /* Jika Anda ingin warna ikon berubah di light/dark mode, bisa tambahkan: */
        /* body.dark-theme .form-check-label .bi { color: #CFD3D6; } */


        @media (min-width: 992px) { /* ... Gaya Anda ... */ }
        @media (max-width: 991.98px) { /* ... Gaya Anda ... */ }

        /* ========== DARK THEME GLOBAL (mempengaruhi seluruh aplikasi) ========== */
        /* PERBAIKAN: Pastikan aturan ini menargetkan html DAN body untuk latar belakang penuh */
        body.dark-theme,
        html.dark-theme {
            background-color: #121212; /* Background gelap saat dark theme */
            color: #ffffff; /* Teks putih default saat dark theme */
        }

        /* PERBAIKAN: Warna teks dark theme untuk judul dan paragraf */
        body.dark-theme h1,
        body.dark-theme h2,
        body.dark-theme h3 {
            color: #FFFFFF; /* Judul putih di dark mode */
        }

        body.dark-theme p {
            color: #CFD3D6; /* Paragraf abu-abu terang di dark mode */
        }

        /* Global Dark Theme untuk form controls */
        body.dark-theme .form-control { background-color: #2D2D2D; color: #FFFFFF; border: none; }
        body.dark-theme .form-control:focus { background-color: #2D2D2D; color: #FFFFFF; }
        body.dark-theme .form-control:not(:placeholder-shown) { background-color: #2D2D2D; color: #ffffff; }
        body.dark-theme input[type="file"] { background-color: #2D2D2D; color: #FFFFFF; border: 1px solid #444444; }
        body.dark-theme input[type="file"]::file-selector-button { background-color: #2D2D2D; color: #FFFFFF; border: 1px solid #444444; }
        body.dark-theme input[type="file"]::file-selector-button:hover { color: #000000; }

        /* --- Navbar Dark Mode (jika ingin navbar juga berubah warnanya) --- */
        body.dark-theme .navbar-custom { background: linear-gradient(135deg, #0B1531 0%, #162449 30%, #000000 100%); }
        body.dark-theme .btn-nav { color: #CFD3D6; }
        body.dark-theme .btn-nav:hover { color: #84A7CF !important; }
        body.dark-theme .btn-nav.active { color: #FFFFFF !important; }
        body.dark-theme .btn-nav.active::after { background-color: #FFFFFF; }
        body.dark-theme .btn-log { background-color: #F481B4; color: #ffffff; }
        body.dark-theme .btn-log:hover { background-color: #E5AFC7 !important; color: #ffffff !important; }

    </style>

</head>
<body>
    @include('layouts.navbar')

    {{-- PENTING: HAPUS <div class="container-fluid mt-4"> INI --}}
    {{-- Dengan ini, setiap halaman anak harus menambahkan <div class="container"> atau <div class="container-fluid"> mereka sendiri --}}
    @yield('content')

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // PERBAIKAN: Bungkus logika utama dalam setTimeout untuk mengatasi null di dashboard
            setTimeout(function() {
                const toggle = document.getElementById("darkModeToggle");
                const body = document.body;
                const html = document.documentElement;
                const icon = document.querySelector('.form-check-label .bi');


                // Fungsi untuk memperbarui ikon berdasarkan tema
                function updateIcon(isDarkMode) {
                    if (icon) {
                        if (isDarkMode) {
                            icon.classList.remove('bi-moon');
                            icon.classList.add('bi-sun');
                        } else {
                            icon.classList.remove('bi-sun');
                            icon.classList.add('bi-moon');
                        }
                    }
                }

                // PERBAIKAN: Fungsi untuk memperbarui semua ikon dan gambar berdasarkan tema (untuk logo dll)
                function updateAllVisuals(isDarkMode) {
                    updateIcon(isDarkMode); // Update ikon toggle navbar

                    // Dapatkan elemen logo EIV di banner
                    const eivLogoBanner = document.getElementById('eivLogoBanner');
                    if (eivLogoBanner) {
                        if (isDarkMode) {
                            eivLogoBanner.src = "{{ asset('images/textlogo-white.png') }}"; // Ganti dengan path logo putih
                        } else {
                            eivLogoBanner.src = "{{ asset('images/textlogo-navy.png') }}"; // Ganti dengan path logo biru
                        }
                    }

                    // Dapatkan elemen logo navbar EdVise
                    const navbarBrandLogo = document.getElementById('navbarBrandLogo');
                    if (navbarBrandLogo) {
                        if (isDarkMode) {
                            navbarBrandLogo.src = "{{ asset('images/logontext-white.png') }}"; // Ganti dengan path logo putih
                        } else {
                            navbarBrandLogo.src = "{{ asset('images/logontext.png') }}"; // Ganti dengan path logo gelap/biru Anda saat ini
                        }
                    }

                    // Panggil update chart jika halaman saat ini memilikinya
                    if (typeof window.updateAllChartsBasedOnTheme === 'function') {
                        window.updateAllChartsBasedOnTheme();
                    }
                }


                // --- MutationObserver untuk sinkronisasi toggle ---
                const observer = new MutationObserver((mutationsList) => {
                    for (const mutation of mutationsList) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            const isBodyDark = body.classList.contains('dark-theme');
                            if (toggle && toggle.checked !== isBodyDark) {
                                toggle.checked = isBodyDark;
                            }
                            updateAllVisuals(isBodyDark); // Panggil fungsi umum update visual
                        }
                    }
                });
                observer.observe(body, { attributes: true, attributeFilter: ['class'] });
                // AKHIR PERBAIKAN MutationObserver

                // Logika Utama Toggle Dark Mode (dijalankan saat halaman dimuat)
                const savedTheme = localStorage.getItem("dark-theme");
                const isInitialDarkMode = savedTheme === "enabled";

                if (isInitialDarkMode) {
                    body.classList.add("dark-theme");
                    html.classList.add("dark-theme");
                    if (toggle) {
                        toggle.checked = true;
                    }
                } else {
                    body.classList.remove("dark-theme");
                    html.classList.remove("dark-theme");
                    if (toggle) {
                        toggle.checked = false;
                    }
                }
                updateAllVisuals(isInitialDarkMode); // Panggil fungsi umum update visual pada pemuatan awal

                // Menambahkan event listener untuk tombol toggle dark mode
                if (toggle) {
                    toggle.addEventListener("change", function () {
                        const isChecked = this.checked;
                        if (isChecked) {
                            body.classList.add("dark-theme");
                            html.classList.add("dark-theme");
                            localStorage.setItem("dark-theme", "enabled");
                        } else {
                            body.classList.remove("dark-theme");
                            html.classList.remove("dark-theme");
                            localStorage.setItem("dark-theme", "disabled");
                        }
                        updateAllVisuals(isChecked); // Panggil fungsi umum update visual setelah toggle
                    });
                }
            }, 100);
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
