@extends('layouts.app')

@section('content')

<style>
    /*
    PENTING:
    - Semua CSS GLOBAL (seperti untuk html, body, dan semua aturan body.dark-theme)
      serta CSS untuk NAVBAR dan FOOTER harus berada di app.blade.php.
    - DI SINI HANYA ADA CSS YANG SPESIFIK UNTUK ELEMEN-ELEMEN DI HALAMAN LOGIN INI.
    */

    body {
        /* Ini seharusnya ada di app.blade.php, tapi saya biarkan di sini jika Anda tidak bisa mengedit app.blade.php */
        font-family: 'Poppins', sans-serif;
        background-color: #EBEDF4; /* Light mode default */
    }

    /* DARK MODE untuk body (harus didefinisikan di app.blade.php) */
    body.dark-theme {
        background-color: #1A1A1A; /* Contoh background gelap */
    }
    .container {
            padding: 100px 0px 20px 0px; /* Tambah padding vertikal dan samping di mobile */
        }

    .card-login { /* Beri nama kelas yang lebih spesifik untuk kartu login utama */
        position: relative;
        z-index: 10;
        width: 800px;
        border: none;
        border-radius: 30px;
        overflow: hidden; /* Ubah visible menjadi hidden agar border-radius bekerja sempurna */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .login-form-section { /* Kelas untuk bagian form login (kiri) */
        border-radius: 20px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    .signup-info-section { /* Kelas untuk bagian info signup (kanan) */
        background-color: #0E1F4D; /* Default light mode background */
        border-radius: 20px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        color: #FFFFFF; /* Default light mode text color untuk bagian ini */
    }

    /* Perbaikan: Atur warna teks deskripsi di bagian kanan secara spesifik */
    .signup-info-section p {
        color: rgba(255, 255, 255, 0.8); /* Agak transparan tapi masih putih di light mode */
        margin-bottom: 25px; /* Tambah sedikit margin bawah agar tidak terlalu mepet tombol */
        font-size: 0.95rem; /* Sedikit lebih kecil untuk deskripsi */
    }

    /* DARK THEME STYLES (KHUSUS UNTUK HALAMAN LOGIN INI) */
    body.dark-theme .card-login {
        /* Sesuaikan shadow atau border di dark mode jika perlu */
    }

    body.dark-theme .login-form-section {
        background-color: #2D2D2D !important; /* Latar belakang form login di dark mode */
        color: #E0E0E0; /* Warna teks di form login di dark mode */
    }

    body.dark-theme .login-form-section h2,
    body.dark-theme .login-form-section p,
    body.dark-theme .login-form-section .text-muted {
        color: #E0E0E0 !important; /* Pastikan teks di form terlihat di dark mode */
    }
    body.dark-theme .login-form-section .form-control {
        background-color: #3A3A3A; /* Input field background di dark mode */
        border-color: #555555; /* Border input field di dark mode */
        color: #E0E0E0; /* Input text color di dark mode */
    }
    body.dark-theme .login-form-section .form-control::placeholder {
        color: #A0A0A0; /* Placeholder color di dark mode */
    }
    body.dark-theme .login-form-section .btn {
        background-color: #162449 !important; /* Tombol SIGN IN di dark mode */
        color: #FFFFFF !important;
    }
    body.dark-theme .login-form-section .btn:hover {
        background-color: #777F95 !important;
    }


    body.dark-theme .signup-info-section {
        background-color: #162449 !important; /* Latar belakang info signup di dark mode */
        color: #FFFFFF !important; /* Teks utama di dark mode (sudah putih) */
    }

    /* PERBAIKAN PENTING: Warna teks deskripsi di bagian kanan untuk dark mode */
    body.dark-theme .signup-info-section p {
        color: #CFD3D6 !important; /* Warna terang agar terlihat di dark mode */
    }
    body.dark-theme .signup-info-section .btn-outline-light {
        color: #FFFFFF !important;
        border-color: #FFFFFF !important;
    }
    body.dark-theme .signup-info-section .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #FFFFFF !important;
    }


    /* --- RESPONSIVE STYLES --- */
    @media (max-width: 767.98px) {
        .container {
            padding: 20px 15px; /* Tambah padding vertikal dan samping di mobile */
        }
        .card-login {
            width: 100% !important; /* Ambil lebar penuh */
            border-radius: 15px !important; /* Kurangi border-radius keseluruhan */
            flex-direction: column; /* Tumpuk bagian atas-bawah */
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); /* Shadow lebih kecil */
        }
        .login-form-section,
        .signup-info-section {
            width: 100% !important;
            border-radius: 15px !important; /* Sudut membulat di semua sisi */
            padding: 30px 20px !important; /* Sesuaikan padding */
        }
        .login-form-section {
            border-bottom-left-radius: 0px !important; /* Agar menempel sempurna dengan bagian bawah */
            border-bottom-right-radius: 0px !important;
        }
        .signup-info-section {
            border-top-left-radius: 0px !important; /* Agar menempel sempurna dengan bagian atas */
            border-top-right-radius: 0px !important;
            margin-top: -1px; /* Untuk mengatasi celah 1px karena border-radius */
        }

        .signup-info-section h2 {
            font-size: 1.8rem; /* Lebih kecil untuk judul */
            margin-bottom: 10px; /* Kurangi jarak bawah */
        }
        .signup-info-section p {
            font-size: 0.85rem; /* Lebih kecil untuk deskripsi */
            margin-bottom: 20px; /* Sesuaikan margin bawah */
        }
        .signup-info-section .btn {
            font-size: 0.9rem; /* Ukuran tombol lebih kecil */
            padding: 8px 15px !important;
        }

        .login-form-section h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .login-form-section p {
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .login-form-section .mb-3 {
            margin-bottom: 15px !important;
        }
        .login-form-section .btn {
            font-size: 0.9rem;
            padding: 8px 15px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .card-login {
            width: 90% !important;
        }
    }

</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card card-login"> {{-- Tambahkan kelas card-login --}}
        <div class="row g-0">
            <div class="col-md-6 bg-white p-5 login-form-section"> {{-- Tambahkan kelas login-form-section --}}
                <h2 class="fw-bold text-center">Sign in</h2>
                <p class="text-center">Masuk dengan akun yang telah Anda miliki</p>

                @if (session('login_error'))
                    <div class="alert alert-danger">
                        {{ session('login_error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Lupa kata sandi Anda?</a>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn text-white w-100 rounded-pill py-2"
                                style="background-color: #0E1F4D; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#70788F';"
                                onmouseout="this.style.backgroundColor='#0E1F4D';">
                                SIGN IN
                        </button>
                    </div>
                </form>

            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 signup-info-section"> {{-- Hapus text-white dan tambahkan kelas signup-info-section --}}
                <h2 class="fw-bold">
                    <span style="color: white;">Halo,</span>
                    <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                {{-- PERBAIKAN: Hapus kelas text-white di sini. Warna diatur via CSS .signup-info-section p --}}
                <p>Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <a href="{{ route('register') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN UP</a>
            </div>
        </div>
    </div>
</div>
@endsection
