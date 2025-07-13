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
            background-color: #EBEDF4; /* Default background untuk light theme */
            color: #000000; /* Default text color for light theme */
        }

        /* ========== GAYA UMUM NAVBAR ========== */
        .navbar-custom {
            background: linear-gradient(135deg, #111F43 0%, #3F5694 30%, #000D30 100%); /* Ini gradient default */
            border-radius: 0 0 10px 10px;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 40px;
        }

        /* ========== GAYA ITEM NAVIGASI (.btn-nav) ========== */
        .btn-nav {
            color: white;
            text-decoration: none;
            font-family: Poppins, sans-serif;
            font-size: 14px;
            position: relative;
            padding: 10px 15px;
            display: inline-block;
            transition: color 0.3s ease;
            overflow: hidden;
        }

        .btn-nav:hover {
            background-color: transparent !important;
            color: #84A7CF !important;
            text-decoration: none;
        }

        .btn-nav.active {
            color: #ffffff !important;
        }

        /* Efek Garis Bawah ::after */
        .btn-nav::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #84A7CF;
            transition: width 0.3s ease;
        }

        .btn-nav.active::after {
            width: 100%;
            background-color: #ffffff;
        }

        /* ========== GAYA TOMBOL LOGIN/LOGOUT (.btn-log) ========== */
        .btn-log {
            background-color: #F37AB0;
            color: #ffffff;
            border-radius: 7px;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block;
        }

        .btn-log:hover {
            background-color: #E2A6C1 !important;
            color: #ffffff !important;
        }

        /* Pastikan btn-log tidak punya garis bawah ::after */
        .btn-log::after {
            content: none !important;
            display: none !important;
        }

        .form-check-label .bi-moon {
            font-size: 18px;
            cursor: pointer;
        }

        /* ========== DESKTOP STYLES (min-width: 992px) ========== */
        @media (min-width: 992px) {
            .navbar-nav .nav-item {
                padding: 0;
                margin-right: 1.5rem;
                display: flex;
                align-items: center;
            }

            .navbar-nav .nav-item:last-child {
                margin-right: 0;
            }

            .btn-nav:hover::after {
                width: 100%;
            }

            .navbar-nav + .form-check.form-switch {
                margin-left: 1rem !important;
            }
        }

        /* ========== MOBILE STYLES (max-width: 991.98px) ========== */
        @media (max-width: 991.98px) {
            .navbar-toggler {
                order: 2;
            }
            .navbar-collapse {
                padding: 10px 0;
            }
            .navbar-nav {
                flex-direction: column;
                gap: 0;
                margin-left: 0 !important;
                width: 100%;
            }

            .navbar-nav .nav-item {
                width: 100%;
                text-align: center;
                padding: 8px 0;
                margin-right: 0;
            }

            .btn-nav::after,
            .btn-nav.active::after {
                content: none;
                display: none;
            }

            .btn-nav.active {
                background-color: #3F5694;
                border-radius: 5px;
                color: #FFFFFF !important;
            }

            .navbar-nav .btn-log {
                margin: 10px auto;
                width: 80%;
                max-width: 200px;
            }
            .btn-log.active {
                background-color: #F37AB0 !important;
                color: #FFFFFF !important;
            }

            .navbar-nav + .form-check.form-switch {
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }

        /* ========== DARK THEME GLOBAL (mempengaruhi seluruh aplikasi) ========== */
        body.dark-theme {
            background-color: #121212; /* Background gelap saat dark theme */
            color: #ffffff; /* Teks putih default saat dark theme */
        }

        /* Global Dark Theme untuk form controls */
        body.dark-theme .form-control {
            background-color: #2D2D2D;
            color: #FFFFFF;
            border: none;
        }
        body.dark-theme .form-control:focus {
            background-color: #2D2D2D;
            color: #FFFFFF;
        }
        body.dark-theme .form-control:not(:placeholder-shown) {
            background-color: #2D2D2D;
            color: #ffffff;
        }
        body.dark-theme input[type="file"] {
            background-color: #2D2D2D;
            color: #FFFFFF;
            border: 1px solid #444444;
        }
        body.dark-theme input[type="file"]::file-selector-button {
            background-color: #2D2D2D;
            color: #FFFFFF;
            border: 1px solid #444444;
        }
        body.dark-theme input[type="file"]::file-selector-button:hover {
            color: #000000;
        }

        /* --- Navbar Dark Mode (jika ingin navbar juga berubah warnanya) --- */
        /* Perlu diperhatikan: `background: linear-gradient` pada .navbar-custom */
        /* Jika ingin gradient juga berubah di dark mode, tambahkan aturan di bawah ini */
        /* Contoh: */
        body.dark-theme .navbar-custom {
            background: linear-gradient(135deg, #0B1531 0%, #162449 30%, #000000 100%);
            /* atau warna solid gelap jika tidak ingin gradient */
            /* background-color: #1a202c; */
        }
        body.dark-theme .btn-nav {
            color: #CFD3D6; /* Teks item nav gelap */
        }
        body.dark-theme .btn-nav:hover {
            color: #84A7CF !important; /* Warna hover gelap */
        }
        body.dark-theme .btn-nav.active {
            color: #FFFFFF !important; /* Warna aktif gelap */
        }
        body.dark-theme .btn-nav.active::after {
            background-color: #FFFFFF; /* Garis bawah aktif gelap */
        }
        body.dark-theme .btn-log {
            background-color: #F481B4; /* Tombol logout gelap */
            color: #ffffff;
        }
        body.dark-theme .btn-log:hover {
            background-color: #E5AFC7 !important;
            color: #ffffff !important;
        }

    </style>

</head>
<body>
    {{-- Ini adalah layout navbar yang di-include --}}
    {{-- Perhatikan, kode navbar di sini adalah yang Anda berikan, tidak ada perubahan pada strukturnya --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/#banner') }}">
                <img src="{{ asset('images/logontext.png') }}" alt="Logo" style="height: 40px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center">
                    @guest
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('pelajari') ? 'active' : '' }}" href="{{ route('pelajari') }}">
                            Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-log {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('dashboard-dosen') ? 'active' : '' }}" href="{{ route('dashboard.dosen') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('daftar-kelas') ? 'active' : '' }}" href="{{ route('kelas.index') }}">
                            Daftar Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('dynamic-table') ? 'active' : '' }}" href="{{ route('dynamic.table') }}">
                            Tambah Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('pelajari') ? 'active' : '' }}" href="{{ route('pelajari') }}">
                            Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-log" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </ul>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" id="darkModeToggle">
                    <label class="form-check-label" for="darkModeToggle">
                        <i class="bi bi-moon text-white"></i>
                    </label>
                </div>
            </div>
        </div>
    </nav>


    {{-- KONTEN UTAMA DARI CHILD VIEW (misal dashboard-dosen.blade.php) --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    @include('layouts.footer')

    {{-- Script JavaScript global --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("darkModeToggle");
            const body = document.body;

            // Mendapatkan status tema yang tersimpan dari localStorage
            const savedTheme = localStorage.getItem("dark-theme");

            // Mengatur status tema saat halaman dimuat berdasarkan localStorage
            if (savedTheme === "enabled") {
                body.classList.add("dark-theme");
                if (toggle) {
                    toggle.checked = true; // Set toggle ke posisi ON
                }
            } else { // Jika savedTheme adalah "disabled" atau null (belum pernah disetel)
                body.classList.remove("dark-theme"); // Pastikan kelas dark-theme dihapus
                if (toggle) {
                    toggle.checked = false; // Set toggle ke posisi OFF
                }
            }

            // Menambahkan event listener untuk tombol toggle dark mode
            if (toggle) { // Pastikan elemen toggle ada sebelum menambahkan event listener
                toggle.addEventListener("change", function () {
                    if (this.checked) {
                        body.classList.add("dark-theme");
                        localStorage.setItem("dark-theme", "enabled");
                    } else {
                        body.classList.remove("dark-theme");
                        localStorage.setItem("dark-theme", "disabled");
                    }

                    // PENTING: Panggil fungsi untuk memperbarui chart di semua halaman (jika ada)
                    // Fungsi updateAllChartsBasedOnTheme ini didefinisikan di script child view
                    // (misal dashboard-dosen.blade.php) dan harus tersedia secara global (misal di window.scope)
                    if (typeof window.updateAllChartsBasedOnTheme === 'function') {
                        window.updateAllChartsBasedOnTheme();
                    }
                });
            }
        });
    </script>
    {{-- Menambahkan script spesifik dari child view (seperti dashboard-dosen.blade.php) --}}
    @yield('scripts')
    {{-- Opsional: Jika Anda menggunakan @push('scripts') di child view --}}
    @stack('scripts')
</body>
</html>



















===================================================================================================================================


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
            background-color: #EBEDF4; /* Default background untuk light theme */
            color: #000000; /* Default text color for light theme */
        }

        /* ========== GAYA UMUM NAVBAR (Ini dari navbar.blade.php yang di-include) ========== */
        .navbar-custom { /* ... Gaya Anda ... */ }
        .navbar-brand img { /* ... Gaya Anda ... */ }
        .btn-nav { /* ... Gaya Anda ... */ }
        .btn-nav:hover { /* ... Gaya Anda ... */ }
        .btn-nav.active { /* ... Gaya Anda ... */ }
        .btn-nav::after { /* ... Gaya Anda ... */ }
        .btn-nav.active::after { /* ... Gaya Anda ... */ }
        .btn-log { /* ... Gaya Anda ... */ }
        .btn-log:hover { /* ... Gaya Anda ... */ }
        .btn-log::after { /* ... Gaya Anda ... */ }
        .form-check-label .bi-moon { /* ... Gaya Anda ... */ }
        @media (min-width: 992px) { /* ... Gaya Anda ... */ }
        @media (max-width: 991.98px) { /* ... Gaya Anda ... */ }

        /* ========== DARK THEME GLOBAL (mempengaruhi seluruh aplikasi) ========== */
        /* Pastikan aturan ini menargetkan html DAN body */
        body.dark-theme,
        html.dark-theme { /* <-- TAMBAHKAN html.dark-theme DI SINI */
            background-color: #121212; /* Background gelap saat dark theme */
            color: #ffffff; /* Teks putih default saat dark theme */
        }

        /* Global Dark Theme untuk form controls */
        body.dark-theme .form-control { /* ... Gaya Anda ... */ }
        body.dark-theme .form-control:focus { /* ... Gaya Anda ... */ }
        body.dark-theme .form-control:not(:placeholder-shown) { /* ... Gaya Anda ... */ }
        body.dark-theme input[type="file"] { /* ... Gaya Anda ... */ }
        body.dark-theme input[type="file"]::file-selector-button { /* ... Gaya Anda ... */ }
        body.dark-theme input[type="file"]::file-selector-button:hover { /* ... Gaya Anda ... */ }

        /* --- Navbar Dark Mode (jika ingin navbar juga berubah warnanya) --- */
        /* ... Gaya Anda ... */

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
            // --- Perubahan di sini: Bungkus logika utama dalam setTimeout ---
            // Penundaan kecil untuk memastikan elemen DOM benar-benar siap
            setTimeout(function() {
                const toggle = document.getElementById("darkModeToggle");
                const body = document.body;
                const html = document.documentElement; // Dapatkan elemen html

                // --- MutationObserver untuk sinkronisasi toggle ---
                const observer = new MutationObserver((mutationsList) => {
                    for (const mutation of mutationsList) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            // Jika kelas body berubah, sinkronkan posisi toggle
                            const isBodyDark = body.classList.contains('dark-theme');
                            if (toggle && toggle.checked !== isBodyDark) {
                                toggle.checked = isBodyDark;
                                // Panggil update chart jika ada perubahan dari sumber eksternal (misal event-handler.js)
                                if (typeof window.updateAllChartsBasedOnTheme === 'function') {
                                    window.updateAllChartsBasedOnTheme();
                                }
                            }
                        }
                    }
                });

                // Mulai mengamati body untuk perubahan atribut 'class'
                observer.observe(body, { attributes: true, attributeFilter: ['class'] });
                // --- Akhir MutationObserver ---

                // --- Logika Utama Toggle Dark Mode ---
                // Mendapatkan status tema yang tersimpan dari localStorage saat halaman pertama kali dimuat
                const savedTheme = localStorage.getItem("dark-theme");

                // Mengatur status tema saat halaman dimuat berdasarkan localStorage
                if (savedTheme === "enabled") {
                    body.classList.add("dark-theme");
                    html.classList.add("dark-theme"); // <-- TAMBAHKAN INI
                    if (toggle) {
                        toggle.checked = true; // Set toggle ke posisi ON
                    }
                } else { // Jika savedTheme adalah "disabled" atau null (belum pernah disetel)
                    body.classList.remove("dark-theme");
                    html.classList.remove("dark-theme"); // <-- TAMBAHKAN INI
                    if (toggle) {
                        toggle.checked = false; // Set toggle ke posisi OFF
                    }
                }

                // Menambahkan event listener untuk tombol toggle dark mode
                if (toggle) {
                    toggle.addEventListener("change", function () {
                        if (this.checked) {
                            body.classList.add("dark-theme");
                            html.classList.add("dark-theme"); // <-- TAMBAHKAN INI
                            localStorage.setItem("dark-theme", "enabled");
                        } else {
                            body.classList.remove("dark-theme");
                            html.classList.remove("dark-theme"); // <-- TAMBAHKAN INI
                            localStorage.setItem("dark-theme", "disabled");
                        }

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
