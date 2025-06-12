
<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Login EdVise</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
    </style>
</head>

<body style="background-color: #EBEDF4;">

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="
    position: relative;
    z-index: 10;
    width: 800px;
    border: none; /* Menghilangkan border */
    border-radius: 30px;
    overflow: visible;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow halus */">
        <div class="row g-0">
            <!-- Bagian Form Login -->
            <div class="col-md-6 bg-white p-5" style="
            border-radius: 20px;
            border-top-right-radius: 0px;  /* Sudut kanan atas melengkung */
            border-bottom-right-radius: 0px; /* Sudut kanan bawah melengkung */">
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

            <!-- Bagian Info dan Sign Up -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white text-center p-5"
            style="
            background-color: #0E1F4D;
            border-radius: 20px;
            border-top-left-radius: 0;  /* Sudut kiri atas tetap tajam */
            border-bottom-left-radius: 0;  /* Sudut kiri bawah tetap tajam */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow halus */">
                <h2 class="fw-bold">
                <span style="color: white;">Halo,</span>
                <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                <p>Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <a href="{{ route('register') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN UP</a>
            </div>
        </div>
    </div>
</div>
@endsection

</body>
