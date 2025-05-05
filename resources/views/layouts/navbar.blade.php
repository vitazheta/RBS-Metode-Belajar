<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* Warna Hover dan Aktif */
    .btn-nav {
        padding: 20px 25px; /* Mengurangi padding agar jarak lebih rapat */
        border-radius: 20px;
        color: white;
        text-decoration: none;
        transition: background 0.3s ease;
        font-family: Poppins, sans-serif;
        font-size: 14px;
    }

    .btn-nav:hover {
        background-color: transparent !important; /* Hilangkan background */
        color: #84A7CF !important; /* Warna teks saat hover */
        text-decoration: none; /* Hilangkan garis bawah default */
        position: relative; /* Untuk pseudo-element */
    }

    /* Hover Effect */
    .btn-nav:hover::after {
        content: ''; /* Tambahkan elemen kosong */
        position: absolute;
        left: 0;
        bottom: 0; /* Garis muncul tepat di bawah navbar */
        width: 100%; /* Panjang garis sesuai tombol */
        height: 2px; /* Ketebalan garis */
        background-color: #84A7CF; /* Warna garis saat hover */
        /* transition: width 0.3s ease;  Animasi garis */
    }

    /* Default State */
    .btn-nav::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0; /* Garis muncul tepat di bawah navbar */
        width: 0; /* Garis tidak terlihat saat tidak di-hover */
        height: 2px;
        background-color: #84A7CF; /* Warna garis */
        /* transition: width 0.3s ease;  Animasi garis */
    }

    .btn-nav.active {
        color: #ffffff !important; /* Warna teks saat aktif */
        position: relative;
    }

    .btn-nav.active::after {
        content: ''; /* Tambahkan elemen kosong */
        position: absolute;
        left: 0;
        bottom: 0; /* Garis muncul tepat di bawah navbar */
        width: 100%; /* Panjang garis sesuai tombol */
        height: 2px; /* Ketebalan garis */
        background-color: #ffffff; /* Warna garis saat aktif */
    }

    /* button login & logout */
    .btn-log {
        background-color: #F37AB0; /* Warna latar belakang */
        color: #ffffff; /* Warna teks */
        border: none; /* Hilangkan border */
        border-radius: 50px; /* Membuat tombol berbentuk lingkaran */
        padding: 10px 20px; /* Menambahkan padding untuk ukuran tombol */
        font-size: 14px; /* Ukuran teks */
        text-align: center; /* Pusatkan teks */
        text-decoration: none; /* Hilangkan underline */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-log:hover {
        background-color: transparent !important; /* Warna latar belakang saat hover */
        color: #F37AB0 !important; /* Warna teks saat hover */
        border: 2px solid #F37AB0; /* Tambahkan border saat hover */
        text-decoration: none; /* Pastikan underline tetap hilang saat hover */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    /* Navbar Styling */
    .navbar-custom {
        background: linear-gradient(135deg, #0E1F4D 0%, #3F5694 30%, #000D30 100%); /* Gradasi dengan efek pantulan */
        border-radius: 0 0 10px 10px; /* Rounded hanya di bagian bawah */
        padding: 10px 20px;
        position: fixed;  /* Menempel di layar */
        top: 0;  /* Melekat di bagian atas */
        left: 0;  /* Mulai dari sisi kiri */
        width: 100%;  /* Lebar penuh */
        height: 60px;
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

                <!-- Menampilkan link Dashboard, Tambah Kelas, dan Logout untuk pengguna yang sudah login -->
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
                    <li>
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
        </div>
    </div>
</nav>
