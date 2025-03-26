<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* Styling untuk tombol navbar */
    .btn-nav {
        padding: 8px 16px; /* Mengecilkan padding agar hover lebih kecil */
        border-radius: 10px; /* Mengurangi sudut membulat */
        color: white;
        text-decoration: none;
        transition: background 0.3s ease;
        display: inline-block;
    }

    /* Hover effect */
    .btn-nav:hover {
        background-color: #1d5b3a !important;
    }

    /* Tombol aktif */
    .btn-nav.active {
        background-color: #246846 !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2E8B57;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/KFC.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center gap-2"> <!-- Mengurangi jarak antar tombol -->
                <li class="nav-item">
                    <a class="btn-nav nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door"></i> HOME
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn-nav nav-link {{ request()->is('info') ? 'active' : '' }}" href="{{ url('/info') }}">
                        <i class="bi bi-info-circle"></i> INFO
                    </a>
                </li>
                <!-- Login Button -->
                <li class="nav-item">
                    <a class="btn-nav nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> LOGIN
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
