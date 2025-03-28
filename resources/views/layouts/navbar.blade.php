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
        background-color: #1d5b3a !important;
    }

    .btn-nav.active {
        background-color: #246846 !important;
    }

    /* Navbar Styling */
    .navbar-custom {
        background-color: #2E8B57;
        border-radius: 0 0 20px 20px; /* Rounded hanya di bagian bawah */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan halus */
        padding: 10px 20px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
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
            <ul class="navbar-nav ms-auto text-center gap-2">
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
                <!-- Login Button -->
                <li class="nav-item">
                    <a class="btn-nav {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> LOGIN
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
