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
            <div class="col-md-6 bg-white p-5" style="
            border-radius: 20px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;">
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
                        <button type="submit" class="btn text-white w-100 rounded-pill py-2"
                                style="background-color: #0E1F4D; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#70788F';"
                                onmouseout="this.style.backgroundColor='#0E1F4D';">
                                {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white text-center p-5"
            style="
            background-color: #0E1F4D;
            border-radius: 20px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                <h2 class="fw-bold">
                <span style="color: white;">Halo,</span>
                <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                <p>Silakan buat kata sandi baru yang mudah Anda ingat.</p>
                {{-- Bisa tambahkan gambar atau teks lain di sini --}}
            </div>
        </div>
    </div>
</div>
@endsection
