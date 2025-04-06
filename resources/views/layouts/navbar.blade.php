<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* Warna Hover dan Aktif */
    .btn-nav {
        padding: 10px 15px; /* Mengurangi padding agar jarak lebih rapat */
        border-radius: 20px;
        color: white;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .btn-nav:hover {
        background-color: #84A7CF !important;
    }

    .btn-nav.active {
        background-color: #0E1F4D !important;
    }
    
    /* button login & logout */
    .btn-log {
        background-color: #F37AB0;
    }

    .btn-log:hover {
        background-color: transparent !important;
        color: #F37AB0 !important;
        border: 2px solid #F37AB0;
    }

    /* Navbar Styling */
    .navbar-custom {
        background-color: #0E1F4D;
        border-radius: 0 0 20px 20px; /* Rounded hanya di bagian bawah */
        padding: 10px 20px;
        position: fixed;  /* Menempel di layar */
        top: 0;  /* Melekat di bagian atas */
        left: 0;  /* Mulai dari sisi kiri */
        width: 100%;  /* Lebar penuh */
        z-index: 1000;  /* Agar tetap di atas elemen lain */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk efek elegan */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/#banner') }}">
            <img src="{{ asset('images/logontext.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center gap-2">
                <!-- Menampilkan link Home dan Info untuk pengunjung yang belum login -->
                @guest
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-door"></i> HOME
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('info') ? 'active' : '' }}" href="{{ url('/info') }}">
                            <i class="bi bi-info-circle"></i> INFO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav btn-log {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> LOGIN
                        </a>
                    </li>
                @endguest

                <!-- Menampilkan link Dashboard, Tambah Kelas, dan Logout untuk pengguna yang sudah login -->
                @auth
                    <li class="nav-item">
                        <a class="btn-nav {{ request()->is('dashboard-dosen') ? 'active' : '' }}" href="{{ route('dashboard.dosen') }}">
                            <i class="bi bi-house-door"></i> DASHBOARD
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="btn-nav {{ request()->is('dynamic-table') ? 'active' : '' }}" href="{{ route('dynamic.table') }}">

                            <i class="bi bi-plus-circle"></i> TAMBAH KELAS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-nav btn-log" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> LOGOUT
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
