@extends('layouts.app')

@section('content')

<style>
    /*
    PENTING:
    - Semua CSS GLOBAL (seperti untuk html, body, dan semua aturan body.dark-theme)
      serta CSS untuk NAVBAR dan FOOTER harus berada di app.blade.php.
    - DI SINI HANYA ADA CSS YANG SPESIFIK UNTUK ELEMEN-ELEMEN DI HALAMAN RESET PASSWORD INI.
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

    /* Add padding to the container to prevent collision with the navbar */
    .container.auth-container {
        padding-top: 80px; /* Adjust this value based on your navbar's height */
        padding-bottom: 20px; /* Add some padding at the bottom as well */
        min-height: 100vh;
        display: flex; /* Ensure flex properties are applied */
        justify-content: center;
        align-items: center;
    }

    /* General card styling for auth pages */
    .card-auth {
        position: relative;
        z-index: 10;
        width: 800px;
        border: none;
        border-radius: 30px;
        overflow: hidden; /* Changed from visible to hidden for perfect border-radius */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .reset-form-section { /* Class for the password reset form part (left side in desktop) */
        background-color: #FFFFFF; /* Default light mode background */
        border-radius: 20px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Keep shadow for this section if needed */
    }

    .info-reset-section { /* Class for the info/welcome part (right side in desktop) */
        background-color: #0E1F4D; /* Default light mode background */
        border-radius: 20px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Keep shadow for this section if needed */
        color: #FFFFFF; /* Default light mode text color for this section */
    }

    /* Perbaikan: Atur warna teks deskripsi di bagian kanan secara spesifik (reset) */
    .info-reset-section p {
        color: rgba(255, 255, 255, 0.8); /* Agak transparan tapi masih putih di light mode */
        margin-bottom: 25px; /* Tambah sedikit margin bawah */
        font-size: 0.95rem; /* Sedikit lebih kecil untuk deskripsi */
    }

    /* DARK THEME STYLES (KHUSUS UNTUK HALAMAN RESET PASSWORD INI) */
    body.dark-theme .card-auth {
        /* Adjust shadow or border in dark mode if needed */
    }

    /* Dark theme for the form section (left side) */
    body.dark-theme .reset-form-section {
        background-color: #2D2D2D !important; /* Form background in dark mode */
        color: #E0E0E0; /* Text color in form in dark mode */
    }
    body.dark-theme .reset-form-section h2,
    body.dark-theme .reset-form-section p,
    body.dark-theme .reset-form-section .invalid-feedback {
        color: #E0E0E0 !important; /* Ensure text in form is visible in dark mode */
    }
    body.dark-theme .reset-form-section .form-control {
        background-color: #3A3A3A; /* Input field background in dark mode */
        border-color: #555555; /* Input field border in dark mode */
        color: #E0E0E0; /* Input text color in dark mode */
    }
    body.dark-theme .reset-form-section .form-control::placeholder {
        color: #A0A0A0; /* Placeholder color in dark mode */
    }
    body.dark-theme .reset-form-section .btn {
        background-color: #162449 !important; /* Reset button in dark mode (adjust if different) */
        color: #FFFFFF !important;
    }
    body.dark-theme .reset-form-section .btn:hover {
        background-color: #0E1F4D !important; /* Hover state for Reset button */
    }


    /* Dark theme for the info/welcome section (right side) */
    body.dark-theme .info-reset-section {
        background-color: #162449 !important; /* Dark mode background */
        color: #FFFFFF !important; /* Main text color */
    }
    /* Kunci perbaikan: Warna teks deskripsi di bagian kanan untuk dark mode */
    body.dark-theme .info-reset-section p {
        color: #CFD3D6 !important; /* Lighter color for visibility in dark mode */
    }

    /* --- RESPONSIVE STYLES --- */
    @media (max-width: 767.98px) {
        .container.auth-container {
            padding: 20px 15px; /* Add vertical and horizontal padding on mobile */
            padding-top: 80px; /* Ensure padding-top is still applied on mobile */
        }
        .card-auth {
            width: 100% !important; /* Take full width */
            border-radius: 15px !important; /* Reduce overall border-radius */
            flex-direction: column; /* Stack sections top-bottom */
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); /* Smaller shadow */
        }
        .reset-form-section,
        .info-reset-section {
            width: 100% !important;
            border-radius: 15px !important; /* Rounded corners on all sides */
            padding: 30px 20px !important; /* Adjust padding */
        }
        /* Special handling for stacked sections */
        .reset-form-section {
            border-bottom-left-radius: 0px !important; /* To make it seamlessly stack with the bottom part */
            border-bottom-right-radius: 0px !important;
        }
        .info-reset-section {
            border-top-left-radius: 0px !important; /* To make it seamlessly stack with the top part */
            border-top-right-radius: 0px !important;
            margin-top: -1px; /* To prevent a 1px gap due to border-radius */
        }

        .reset-form-section h2,
        .info-reset-section h2 {
            font-size: 1.8rem; /* Smaller heading */
            margin-bottom: 10px; /* Reduce bottom margin */
        }
        .reset-form-section p,
        .info-reset-section p {
            font-size: 0.85rem; /* Smaller description */
            margin-bottom: 20px; /* Adjust bottom margin */
        }
        .reset-form-section .mb-3 {
            margin-bottom: 15px !important; /* Reduce margin between form fields */
        }
        .reset-form-section .btn {
            font-size: 0.9rem; /* Smaller button size */
            padding: 8px 15px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .card-auth {
            width: 90% !important;
        }
    }
</style>

<div class="container d-flex justify-content-center align-items-center auth-container"> {{-- Add auth-container class for padding --}}
    <div class="card card-auth"> {{-- Use .card-auth class --}}
        <div class="row g-0">
            <div class="col-md-6 p-5 reset-form-section"> {{-- Add reset-form-section --}}
                <h2 class="fw-bold text-center">Reset Kata Sandi</h2>
                <p class="text-center">Masukkan kata sandi baru Anda</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password Baru" required autocomplete="new-password">
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn text-white w-100 rounded-pill py-2">
                                {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 info-reset-section"> {{-- Add info-reset-section and remove text-white --}}
                <h2 class="fw-bold">
                <span style="color: white;">Halo,</span>
                <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                <p>Silakan buat kata sandi baru yang mudah Anda ingat.</p>
            </div>
        </div>
    </div>
</div>
@endsection
