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
            /* PERBAIKAN: Padding top untuk mengatasi navbar yang fix */
            /* padding-top: 110px; */
            background-color: #EBEDF4; /* Default background untuk light theme */
            color: #000000; /* Default text color for light theme */
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

        /* Global Dark Theme untuk form controls */
        body.dark-theme .form-control { background-color: #2D2D2D; color: #FFFFFF; border: none; }
        body.dark-theme .form-control:focus { background-color: #2D2D2D; color: #FFFFFF; }
        body.dark-theme .form-control:not(:placeholder-shown) { background-color: #2D2D2D; color: #ffffff; }
        body.dark-theme input[type="file"] { background-color: #2D2D2D; color: #FFFFFF; border: 1px solid #444444; }
        body.dark-theme input[type="file"]::file-selector-button { background-color: #2D2D2D; color: #FFFFFF; border: 1px solid #444444; }
        body.dark-theme input[type="file"]::file-selector-button:hover { color: #000000; }

        /* --- Navbar Dark Mode (jika ingin navbar juga berubah warnanya) --- */
        /* ... Gaya Anda ... */
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

    <div class="container mt-4">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // PERBAIKAN: Bungkus logika utama dalam setTimeout untuk mengatasi null di dashboard
            setTimeout(function() {
                const toggle = document.getElementById("darkModeToggle");
                const body = document.body;
                const html = document.documentElement; // PERBAIKAN: Dapatkan elemen html
                const icon = document.querySelector('.form-check-label .bi'); // PERBAIKAN: Dapatkan elemen ikon

                // Fungsi untuk memperbarui ikon berdasarkan tema
                function updateIcon(isDarkMode) {
                    if (icon) {
                        if (isDarkMode) {
                            icon.classList.remove('bi-moon');
                            icon.classList.add('bi-sun'); // PERBAIKAN: Set ikon matahari untuk dark mode
                        } else {
                            icon.classList.remove('bi-sun');
                            icon.classList.add('bi-moon'); // PERBAIKAN: Set ikon bulan untuk light mode
                        }
                    }
                }

                // --- MutationObserver untuk sinkronisasi toggle ---
                // Observer ini akan mengamati perubahan kelas pada elemen body
                // dan memastikan tombol toggle serta ikonnya selalu sinkron.
                const observer = new MutationObserver((mutationsList) => {
                    for (const mutation of mutationsList) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            const isBodyDark = body.classList.contains('dark-theme');
                            if (toggle && toggle.checked !== isBodyDark) {
                                toggle.checked = isBodyDark;
                            }
                            updateIcon(isBodyDark); // PERBAIKAN: Panggil updateIcon di sini
                            if (typeof window.updateAllChartsBasedOnTheme === 'function') {
                                window.updateAllChartsBasedOnTheme();
                            }
                        }
                    }
                });
                observer.observe(body, { attributes: true, attributeFilter: ['class'] });
                // AKHIR PERBAIKAN MutationObserver

                // Logika Utama Toggle Dark Mode (dijalankan saat halaman dimuat)
                const savedTheme = localStorage.getItem("dark-theme");
                const isInitialDarkMode = savedTheme === "enabled"; // Tentukan status awal

                if (isInitialDarkMode) {
                    body.classList.add("dark-theme");
                    html.classList.add("dark-theme"); // PERBAIKAN: Tambahkan kelas ke html
                    if (toggle) {
                        toggle.checked = true;
                    }
                } else {
                    body.classList.remove("dark-theme");
                    html.classList.remove("dark-theme"); // PERBAIKAN: Hapus kelas dari html
                    if (toggle) {
                        toggle.checked = false;
                    }
                }
                updateIcon(isInitialDarkMode); // PERBAIKAN: Panggil updateIcon pada pemuatan awal

                // Menambahkan event listener untuk tombol toggle dark mode
                if (toggle) {
                    toggle.addEventListener("change", function () {
                        const isChecked = this.checked; // Dapatkan status terbaru dari toggle
                        if (isChecked) {
                            body.classList.add("dark-theme");
                            html.classList.add("dark-theme"); // PERBAIKAN: Tambahkan kelas ke html
                            localStorage.setItem("dark-theme", "enabled");
                        } else {
                            body.classList.remove("dark-theme");
                            html.classList.remove("dark-theme"); // PERBAIKAN: Hapus kelas dari html
                            localStorage.setItem("dark-theme", "disabled");
                        }
                        updateIcon(isChecked); // PERBAIKAN: Panggil updateIcon setelah toggle
                        if (typeof window.updateAllChartsBasedOnTheme === 'function') {
                            window.updateAllChartsBasedOnTheme();
                        }
                    });
                }
            }, 100); // Penundaan 100 milidetik
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
