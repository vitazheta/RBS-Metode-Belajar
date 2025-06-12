<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* ========== GAYA UMUM NAVBAR ========== */
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

    /* ========== DARK MODE (hanya untuk elemen NAVBARD) ========== */
    /* Hapus definisi body.dark-theme dari sini, karena sudah di app.blade.php */
    /* .navbar-custom.dark-theme { */
    /* background: linear-gradient(135deg, #162449 0%, #90B0D4 30%, #0B1531 100%); */
    /* } */
    /* Jika Anda ingin navbar juga berubah di dark theme, pindahkan aturan ini ke app.blade.php atau pastikan ia di-load setelah app.blade.php */
    .btn-nav.dark-theme {
        color: #000000; /* ini mungkin perlu diatur ulang agar kontras dengan navbar gelap */
    }

    .btn-log.dark-theme {
        background-color: #F481B4;
        color: #000000;
    }

    .btn-log.dark-theme:hover {
        background-color: #E5AFC7;
        color: #000000;
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
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/#banner') }}">
            <img src="{{ asset('images/logontext.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center"> @guest
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

<script>
    // Script dark mode sudah di app.blade.php, ini duplikasi
    // document.addEventListener("DOMContentLoaded", function () {
    //     const toggle = document.getElementById("darkModeToggle");
    //     const body = document.body;

    //     if (localStorage.getItem("dark-theme") === "enabled") {
    //         body.classList.add("dark-theme");
    //         toggle.checked = true;
    //     }

    //     toggle.addEventListener("change", function () {
    //         if (this.checked) {
    //             body.classList.add("dark-theme");
    //             localStorage.setItem("dark-theme", "enabled");
    //         } else {
    //             body.classList.remove("dark-theme");
    //             localStorage.setItem("dark-theme", "disabled");
    //         }
    //     });
    // });
</script>
