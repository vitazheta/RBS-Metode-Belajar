<nav class="navbar navbar-expand-lg navbar-dark {{ request()->is('/') ? 'bg-dark' : 'bg-black' }}">
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
            <ul class="navbar-nav ms-auto text-center gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Info</a>
                </li>
                <!-- Login Button -->
                <li class="nav-item">
                    <a href="#" class="btn btn-danger px-3">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
