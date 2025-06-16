@extends('layouts.app')

@section('content')

<style>
    /*
    PENTING:
    - Semua CSS GLOBAL (seperti untuk html, body, dan semua aturan body.dark-theme)
      serta CSS untuk NAVBAR dan FOOTER harus berada di app.blade.php.
    - DI SINI HANYA ADA CSS YANG SPESIFIK UNTUK ELEMEN-ELEMEN DI HALAMAN REGISTER INI.
    */

    /* Default body styles (should ideally be in app.blade.php) */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #EBEDF4; /* Light mode default */
    }

    /* DARK MODE for body (must be defined in app.blade.php) */
    body.dark-theme {
        background-color: #1A1A1A; /* Example dark background */
    }

    /* General card styling for login/register pages */
    .card-auth { /* Use a more general class name for auth cards */
        position: relative;
        z-index: 10;
        width: 800px;
        border: none;
        border-radius: 30px;
        overflow: hidden; /* Change visible to hidden for perfect border-radius */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-signin-section { /* Class for the info/sign-in part (left side in desktop) */
        background-color: #0E1F4D; /* Default light mode background */
        border-radius: 20px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        color: #FFFFFF; /* Default light mode text color for this section */
    }

    /* Perbaikan: Atur warna teks deskripsi di bagian kiri secara spesifik (register) */
    .info-signin-section p {
        color: rgba(255, 255, 255, 0.8); /* Agak transparan tapi masih putih di light mode */
        margin-bottom: 25px; /* Tambah sedikit margin bawah agar tidak terlalu mepet tombol */
        font-size: 0.95rem; /* Sedikit lebih kecil untuk deskripsi */
    }

    .register-form-section { /* Class for the registration form part (right side in desktop) */
        background-color: #FFFFFF; /* Default light mode background */
        border-radius: 20px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* DARK THEME STYLES (KHUSUS UNTUK HALAMAN REGISTER INI) */
    body.dark-theme .card-auth {
        /* Adjust shadow or border in dark mode if needed */
    }

    /* Dark theme for the info/sign-in section (left side) */
    body.dark-theme .info-signin-section {
        background-color: #162449 !important; /* Dark mode background */
        color: #FFFFFF !important; /* Main text color */
    }
    /* Kunci perbaikan: Warna teks deskripsi di bagian kiri untuk dark mode */
    body.dark-theme .info-signin-section p {
        color: #CFD3D6 !important; /* Lighter color for visibility in dark mode */
    }
    body.dark-theme .info-signin-section .btn-outline-light {
        color: #FFFFFF !important;
        border-color: #FFFFFF !important;
    }
    body.dark-theme .info-signin-section .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #FFFFFF !important;
    }

    /* Dark theme for the registration form section (right side) */
    body.dark-theme .register-form-section {
        background-color: #2D2D2D !important; /* Form background in dark mode */
        color: #E0E0E0; /* Text color in form in dark mode */
    }
    body.dark-theme .register-form-section h2,
    body.dark-theme .register-form-section p,
    body.dark-theme .register-form-section .text-danger {
        color: #E0E0E0 !important; /* Ensure text in form is visible in dark mode */
    }
    body.dark-theme .register-form-section .form-control {
        background-color: #3A3A3A; /* Input field background in dark mode */
        border-color: #555555; /* Input field border in dark mode */
        color: #E0E0E0; /* Input text color in dark mode */
    }
    body.dark-theme .register-form-section .form-control::placeholder {
        color: #A0A0A0; /* Placeholder color in dark mode */
    }
    body.dark-theme .register-form-section .btn {
        background-color: #F481B4 !important; /* SIGN UP button in dark mode (adjust if different from login) */
        color: #FFFFFF !important;
    }
    body.dark-theme .register-form-section .btn:hover {
        background-color: #E5AFC7 !important; /* Hover state for SIGN UP button */
    }

    /* --- RESPONSIVE STYLES --- */
    @media (max-width: 767.98px) {
        .container {
            padding: 20px 15px; /* Add vertical and horizontal padding on mobile */
        }
        .card-auth {
            width: 100% !important; /* Take full width */
            border-radius: 15px !important; /* Reduce overall border-radius */
            flex-direction: column; /* Stack sections top-bottom */
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); /* Smaller shadow */
        }
        .info-signin-section,
        .register-form-section {
            width: 100% !important;
            border-radius: 15px !important; /* Rounded corners on all sides */
            padding: 30px 20px !important; /* Adjust padding */
        }
        /* Special handling for stacked sections */
        .info-signin-section {
            border-bottom-left-radius: 0px !important; /* To make it seamlessly stack with the bottom part */
            border-bottom-right-radius: 0px !important;
        }
        .register-form-section {
            border-top-left-radius: 0px !important; /* To make it seamlessly stack with the top part */
            border-top-right-radius: 0px !important;
            margin-top: -1px; /* To prevent a 1px gap due to border-radius */
        }

        .info-signin-section h2 {
            font-size: 1.8rem; /* Smaller heading for info section */
            margin-bottom: 10px; /* Reduce bottom margin */
        }
        .info-signin-section p {
            font-size: 0.85rem; /* Smaller description for info section */
            margin-bottom: 20px; /* Adjust bottom margin */
        }
        .info-signin-section .btn {
            font-size: 0.9rem; /* Smaller button size */
            padding: 8px 15px !important;
        }

        .register-form-section h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .register-form-section p {
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .register-form-section .mb-3 {
            margin-bottom: 15px !important; /* Reduce margin between form fields */
        }
        .register-form-section .btn {
            font-size: 0.9rem;
            padding: 8px 15px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .card-auth {
            width: 90% !important;
        }
    }

</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 100px 0px 20px 0px">
    <div class="card card-auth"> {{-- Use .card-auth class --}}
        <div class="row g-0">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 info-signin-section"> {{-- Remove text-white, add info-signin-section --}}
                <h2 class="fw-bold">
                    <span style="color: white;">Halo,</span>
                    <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                {{-- PERBAIKAN: Hapus kelas text-white di sini. Warna diatur via CSS .info-signin-section p --}}
                <p>Sudah memiliki akun? Silakan login dengan tombol di bawah</p>
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN IN</a>
            </div>

            <div class="col-md-6 bg-white p-5 register-form-section"> {{-- Add register-form-section --}}
                <h2 class="fw-bold text-center">SIGN UP</h2>
                <p class="text-center">Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ old('username') }}">
                        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn text-white w-100 rounded-pill py-2"
                                style="background-color: #0E1F4D; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#70788F';"
                                onmouseout="this.style.backgroundColor='#0E1F4D';">
                                SIGN UP
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
