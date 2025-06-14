@extends('layouts.app')

{{-- Bagian <head> khusus untuk halaman welcome jika diperlukan --}}
@section('head')
    {{-- Contoh: Jika ada CSS atau meta tag yang hanya spesifik untuk halaman welcome ini --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/welcome-specific.css') }}"> --}}
@endsection

{{-- Konten utama halaman welcome --}}
@section('content')

    {{-- KONSOLIDASI SEMUA CSS SPESIFIK HALAMAN WELCOME DI SINI --}}
    <style>
        /* ==================== GLOBAL DARK MODE SETTINGS UNTUK BODY ==================== */
        body {
            /* background-color: #f8f9fa; */
            /* transition: background-color 0.3s ease; Smooth transition */
        }

        body.dark-theme {
            background-color: #121212; /* Dark mode background for the entire body */
            color: #ffffff; /* Default text color for dark mode body */
        }

        /* ==================== STYLES DARI WELCOME.BLADE.PHP ASLI (HEADER "Kelebihan EdVise") ==================== */
        header {
            /* background-color: #ffffff; Default light mode background */
            height: auto;
            margin-bottom: 40px;
            padding-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

        }

        header h2 {
            margin: 0;
            color: #0E1F4D;
            font-size: 40px;
            font-weight: bold;
            line-height: 56px;
        }

        header p {
            font-size: 20px;
            font-weight: medium;
            max-width: 800px;
            margin: 20px auto 30px;
            color: #0E1F4D;
            line-height: 28px;
        }

        .overlay { /* overlay selamat datang */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Dark theme for Header */
        body.dark-theme header {
            background-color: #121212; /* Dark mode background for the header, consistent with body */
            color: #FFFFFF; /* Ensure all text inside header is white */
        }

        body.dark-theme header h1 {
            color: #FFFFFF;
        }

        body.dark-theme header h2 {
            color: #FFFFFF;
        }

        body.dark-theme header p {
            color: #FFFFFF;
        }

        /* ==================== STYLES DARI LAYOUTS/BANNER.BLADE.PHP ==================== */
        #banner {
            position: relative;
            padding-top: 70px;
        }

        .img-banner {
            max-width: 70%;
            height: auto;
            box-shadow: none !important;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .text-logo {
            width: 150px;
            height: auto;
            box-shadow: none !important;
            display: block;
            margin-left: 0;
            margin-right: auto;
        }

        .carousel-bg {
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        #backgroundCarousel {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .carousel-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-overlay .container {
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: var(--bs-gutter-x, .75rem);
            padding-right: var(--bs-gutter-x, .75rem);
        }

        .carousel-overlay .row {
            justify-content: center;
            width: 100%;
            margin-right: calc(var(--bs-gutter-x) * -.5);
            margin-left: calc(var(--bs-gutter-x) * -.5);
        }

        .carousel-overlay .col-lg-6 {
        }

        .carousel-overlay-color {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 1;
        }

        :root {
            --primary-color: #0E1F4D;
            --secondary-color: #84A7CF;
            --accent-color: #F37AB0;
            --secondary-accent-color: #E6CAD9;
            --text-color: #ffffff;
            --dark-text-color: #000000;
        }

        .banner-section {
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
        }

        #animatedText {
            font-family: 'Poppins', sans-serif;
            font-size: 50px;
            font-weight: bold;
            line-height: 60px;
            color: #0E1F4D;
            margin-bottom: 10px;
        }

        .carousel-overlay p.text-muted {
            font-size: 14px;
            line-height: 20px;
            color: #0E1F4D !important;
            font-family: 'Poppins', sans-serif;
            margin-top: 0px;
            margin-bottom: 15px;
            max-width: 500px;
            margin-left: 0;
            margin-right: auto;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: var(--text-color);
            font-size: 14px;
            line-height: 20px;
            font-family: 'Poppins', sans-serif;
            border: none;
        }

        .btn-primary:hover {
            background-color: #E2A6C1;
            color: var(--text-color);
            font-size: 14px;
            line-height: 20px;
            font-family: 'Poppins', sans-serif;
            border: none;
        }
        .btn.mt-3 {
            margin-top: 0px !important;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 2s linear infinite;
        }

        .divider-section {
            background: linear-gradient(135deg, #111F43 0%, #3F5694 30%, #000D30 100%);
            /* color: #ffffff; */
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            letter-spacing: 1px;
            margin: 0;
            padding: 50px 0;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s ease-in-out;
        }

        .divider-section.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .divider-section h2 {
            margin: 0;
            animation: fadeInUp 2s ease-in;
            font-size: 20px;
            font-weight: normal;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 2.0s ease-in-out;
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Dark Theme for Banner */
        body.dark-theme .carousel-overlay-color {
            background-color: rgba(27, 27, 27, 0.9);
        }

        body.dark-theme #animatedText {
            color: #FFFFFF;
        }

        body.dark-theme .carousel-overlay p {
            color: #FFFFFF;
        }

        body.dark-theme .text-muted {
            color: #FFFFFF !important;
        }

        body.dark-theme .btn-primary:hover {
            background-color: #E2A6C1;
            color: var(--text-color);
        }

        /* ==================== STYLES DARI LAYOUTS/INFO.BLADE.PHP ==================== */
        .section {
            padding-top: 0px;
            padding-bottom: 50px;
            text-align: center;
            max-width: 1000px;
            margin: 0 auto;
            /* background-color: #ffffff; */

        }

        body.dark-theme .section { /* TAMBAHKAN INI */
            background-color: #121212; /* Warna latar belakang yang sama dengan header dan body dark mode */
        }

        .section h2 {
            color: #0E1F4D;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        body.dark-theme .section h2 {
            color: #FFFFFF;
        }

        .section p {
            max-width: 800px;
            margin: 10px auto 40px;
            line-height: 1.6;
            font-size: 1rem;
            color: #0E1F4D;
        }

        body.dark-theme .section p {
            color: #FFFFFF;
        }

        .features {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            gap: 50px;
        }

        .feature-item {
            flex: 1 1 calc(33.333% - 34px);
            max-width: 300px;
            min-width: 280px;
            padding: 10px;
            box-sizing: border-box;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0E1F4D;
            color: white;
            margin: 0 auto 10px;
            font-size: 28px;
        }

        body.dark-theme .feature-item .icon-circle {
            background-color: #F37AB0;
            color: #FFFFFF;
        }

        .feature-item h4 {
            font-size: 20px;
            color: #0E1F4D;
            margin-bottom: 8px;
            font-weight: bold;
        }

        body.dark-theme .feature-item h4 {
            color: #FFFFFF;
        }

        .section .features .feature-item p {
            font-size: 15px;
            line-height: 28px;
            color: #0E1F4D;
        }

        body.dark-theme .section .features .feature-item p {
            color: #FFFFFF;
        }

        /* ==================== STYLES DARI LAYOUTS/ABOUT.BLADE.PHP ==================== */
        .about-section {
            background: linear-gradient(180deg, #111F43, #000D30);
            padding: 100px 0;
        }

        .about-section .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            gap: 100px;
        }

        .about-image img {
            width: 400%;
            height: 300%;
            max-width: 450px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .about-text {
            flex: 1;
            color: white;
        }

        .about-text h1 {
            margin: 0;
            color: #ffffff;
            font-size: 40px;
            font-weight: bold;
            line-height: 56px;
        }

        .about-text p {
            font-size: 20px;
            color: #ffffff;
            line-height: 28px;
            margin-top: 20px;
        }

        /* Dark Theme for About */
        body.dark-theme .about-section {
            background: linear-gradient(180deg, #162449, #0B1531);
        }

        body.dark-theme .about-section .btn-primary {
            background-color: #F481B4;
            color: #ffffff;
        }

        /* ==================== STYLES DARI LAYOUTS/METODE.BLADE.PHP ==================== */
        .container.metode-section {
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .container.metode-section h2 {
            margin: 20;
            color: #0E1F4D;
            font-size: 40px;
            font-weight: bold;
            line-height: 56px;
        }

        .metode-section .section-title {
            margin-top: 80px;
            margin-bottom: 20px;
            text-align: center;
            color: #0E1F4D;
            font-size: 3em;
        }
        .slider-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color:#ffff;
        }

        .slider-wrapper {
            overflow: hidden;
            width: 100%;
        }

        .slider {
            display: flex;
            transition: transform 0.6s ease-in-out;
            padding-bottom: 50px;
        }

        .card {
            flex: 0 0 33.3333%;
            padding: 10px;
            margin: 30px auto 30px;
            transition: transform 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-content {
            background: linear-gradient(180deg, #0E1F4D, #000D30);
            border-radius: 10px;
            padding: 20px;
            height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 8px;
            padding: 10px;
        }

        .card-desc {
            font-size: 14px;
            color: #ffffff;
            padding: 10px;
        }

        .nav-button {
            position: absolute;
            top: 45%;
            transform: translateY(-50%);
            background-color: #F37AB0;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nav-button:hover {
            background-color: #E2A6C1;
        }

        .nav-button:active {
            background-color: #0E1F4D;
        }

        .nav-left {
            left: -20px;
        }

        .nav-right {
            right: -20px;
        }

        /* Dark Theme for Metode */
        body.dark-theme .container.metode-section h2 {
            color: #FFFFFF;
        }

        body.dark-theme .metode-section .section-title {
            color: #FFFFFF;
        }

        body.dark-theme .card {
            background-color: #1B1B1B;
        }

        body.dark-theme .card-content {
            background: linear-gradient(180deg, #162449, #0B1531);
        }

        body.dark-theme .nav-button {
            background-color: #F481B4;
        }

        /* ==================== MOBILE MEDIA QUERIES UNTUK SEMUA SEKSI ==================== */

        /* Untuk Tablet dan Ponsel Besar (di bawah breakpoint Bootstrap lg: 991.98px) */
        @media (max-width: 991.98px) {
            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 15px;
                padding-right: 15px;
            }

            /* Kelebihan EdVise Header */
            header {
                margin-bottom: 20px;
                padding-top: 30px;
                padding-left: 15px;
                padding-right: 15px;
            }
            header h1 {
                font-size: 32px;
                line-height: 40px;
            }
            header p {
                font-size: 16px;
                line-height: 24px;
                margin: 15px auto 25px;
            }

            /* Banner Section (re-confirming previous adjustments) */
            .carousel-overlay {
                position: relative;
                z-index: 2;
                width: 100%;
                min-height: auto;
                padding-top: 50px;
                padding-bottom: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .carousel-bg {
                height: 80vh;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            #banner {
                height: auto;
                min-height: unset;
            }

            #animatedText {
                font-size: 36px;
                line-height: 45px;
                margin-bottom: 10px;
            }
            .carousel-overlay p.text-muted {
                font-size: 14px;
                line-height: 22px;
                margin-top: 5px;
                margin-bottom: 15px;
                padding: 0 20px;
                margin-left: auto;
                margin-right: auto;
            }
            .text-logo {
                width: 100px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom:10px;
            }
            .img-banner {
                max-width: 60%;
                display: block;
                margin-top: 20px;
                margin-bottom: 20px;
                margin-left: auto;
                margin-right: auto;
            }
            .btn-primary.mt-3 {
                margin-top: 15px !important;
            }

            .carousel-overlay .container {
                padding-left: 0 !important;
                padding-right: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .carousel-overlay .row {
                margin-left: 0 !important;
                margin-right: 0 !important;
                width: 100% !important;
                justify-content: center !important;
            }

            .carousel-overlay .col-lg-6 {
                padding-left: 0 !important;
                padding-right: 0 !important;
                width: 100% !important;
                text-align: center !important;
            }

            .divider-section h2 {
                margin: 0 20px;
                animation: fadeInUp 2s ease-in;
                font-size: 15px;
                font-weight: normal;
            }
            /* Info Section */
            .section {
                padding-top: 30px;
                padding-bottom: 30px;
            }
            .section h2 {
                font-size: 24px;
                margin-bottom: 15px;
            }
            .section p {
                font-size: 14px;
                line-height: 22px;
                margin: 10px auto 20px;
            }
            .features {
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }
            .feature-item {
                width: 90%;
                max-width: 350px;
                padding: 15px;
                flex: unset;
            }
            .feature-item h4 {
                font-size: 18px;
            }

            /* About Section */
            .about-section {
                padding: 50px 0;
            }
            .about-content {
                flex-direction: column;
                gap: 30px;
                text-align: center;
            }
            .about-image {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .about-image img {
                width: 100%;
                height: auto;
                max-width: 300px;
                margin: 0 auto;
            }
            .about-text {
                padding: 0 10px;
            }
            .about-text h1 {
                font-size: 32px;
                line-height: 40px;
            }
            .about-text p {
                font-size: 16px;
                line-height: 24px;
                margin-top: 15px;
                margin-bottom: 25px;
            }

            /* Metode Section */
            .container.metode-section {
                padding: 30px 15px;
            }
            .container.metode-section h2, .metode-section .section-title {
                font-size: 24px;
                line-height: 32px;
                margin-top: 30px;
                margin-bottom: 15px;
            }
            .slider {
                flex-direction: row;
                padding-bottom: 30px;
                overflow-x: scroll;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
            }
            .card {
                flex: 0 0 90%;
                max-width: 400px;
                margin: 15px 5%;
                padding: 0;
                scroll-snap-align: center;
            }
            .card-content {
                height: auto;
                min-height: 180px;
                padding: 15px;
            }
            .card-title {
                font-size: 18px;
                margin-bottom: 5px;
            }
            .card-desc {
                font-size: 13px;
                line-height: 18px;
                padding: 0;
            }
            .nav-button {
                display: block;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                background-color: rgba(243, 122, 176, 0.8);
            }
            .nav-left {
                left: 5px;
            }
            .nav-right {
                right: 5px;
            }
        }

        /* Untuk Ponsel Kecil (di bawah breakpoint Bootstrap sm: 767.98px) */
        @media (max-width: 767.98px) {
            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 10px;
                padding-right: 10px;
            }

            /* Kelebihan EdVise Header */
            header {
                padding-top: 20px;
                margin-bottom: 15px;
            }
            header h1 {
                font-size: 28px;
                line-height: 35px;
            }
            header p {
                font-size: 14px;
                line-height: 20px;
                margin: 10px auto 20px;
            }

            /* Banner Section */
            .carousel-overlay {
                min-height: auto;
                padding-top: 40px;
                padding-bottom: 40px;
            }
            .carousel-bg {
                height: 70vh;
            }
            #animatedText {
                font-size: 28px;
                line-height: 35px;
                padding: 0 20px;
            }
            .carousel-overlay p.text-muted {
                font-size: 13px;
                line-height: 20px;
                padding: 0 20px;
            }
            .text-logo {
                width: 80px;
            }
            .img-banner {
                max-width: 70%;
            }
            .btn-primary.mt-3 {
                margin-top: 0px !important;
            }

            /* --- ATURAN BARU / DIPERKUAT UNTUK PEMUSATAN BANNER DI PONSEL KECIL --- */
            .carousel-overlay .container,
            .carousel-overlay .row,
            .carousel-overlay .col-lg-6 {
                padding-left: 0 !important;
                padding-right: 0 !important;
                margin-left: auto !important;
                margin-right: auto !important;
                width: 100% !important;
                text-align: center !important;
            }
            /* --- AKHIR ATURAN BARU/DIPERKUAT --- */
        }

            /* Info Section */
            .section h2 {
                font-size: 20px;
            }
            .section p {
                font-size: 13px;
                line-height: 20px;
            }
            .feature-item {
                width: 95%;
                padding: 0px;
            }
            .feature-item h4 {
                font-size: 16px;
            }

            /* About Section */
            .about-section {
                padding: 40px 0;
            }
            .about-image img {
                max-width: 250px;
            }
            .about-text h1 {
                font-size: 28px;
                line-height: 35px;
            }
            .about-text p {
                font-size: 14px;
                line-height: 20px;
            }

            /* Metode Section */
            .container.metode-section h2, .metode-section .section-title {
                font-size: 20px;
                line-height: 28px;
                margin-top: 20px;
                margin-bottom: 10px;
            }
            .card {
                flex: 0 0 95%;
                margin: 10px 2.5%;
                padding: 0;
            }
            .card-content {
                min-height: 160px;
                padding: 10px;
            }
            .card-title {
                font-size: 16px;
            }
            .card-desc {
                font-size: 12px;
                line-height: 16px;
                padding: 0;
            }
            .nav-button {
                width: 35px;
                height: 35px;
                font-size: 18px;
            }
            .nav-left { left: 0px; }
            .nav-right { right: 0px; }
        }

        /* Untuk Ponsel Sangat Kecil (misalnya iPhone 5/SE, dll.) */
        @media (max-width: 575.98px) {
            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 5px;
                padding-right: 5px;
            }

            /* Header */
            header { padding-top: 15px; margin-bottom: 10px; }
            header h1 { font-size: 24px; line-height: 30px; }
            header p { font-size: 12px; line-height: 18px; padding: 0 5px; }

            /* Banner Section */
            #animatedText { font-size: 24px; line-height: 30px; }
            .carousel-overlay p.text-muted { font-size: 12px; line-height: 18px; padding: 0 5px; }

            .btn-primary.mt-3 {
                margin-top: 0px !important;
            }
            .carousel-overlay {
                min-height: auto;
                padding-top: 30px;
                padding-bottom: 30px;
            }
            .carousel-bg {
                height:100%;
            }

            /* Info Section */
            .section h2 { font-size: 18px; }
            .section p { font-size: 11px; }

            /* About Section */
            .about-section { padding: 30px 0; }
            .about-text h1 { font-size: 24px; line-height: 30px; }
            .about-text p { font-size: 12px; line-height: 18px; }

            /* Metode Section */
            .container.metode-section h2, .metode-section .section-title { font-size: 18px; line-height: 24px; }
            .card {
                flex: 0 0 98%;
                margin: 5px 1%;
            }
            .card-content { min-height: 140px; }
            .card-title { font-size: 14px; }
            .card-desc { font-size: 11px; }
        }
    </style>

    {{-- HTML Konten Halaman Welcome (tetap sama) --}}
    <section id="banner" class="position-relative">
        <div id="backgroundCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel1-raw.png') }}');"></div>
                    <div class="carousel-overlay-color"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel2-raw.png') }}');"></div>
                    <div class="carousel-overlay-color"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel3-raw.png') }}');"></div>
                    <div class="carousel-overlay-color"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel4-raw.png') }}');"></div>
                    <div class="carousel-overlay-color"></div>
                </div>
            </div>
        </div>
        <div class="carousel-overlay d-flex align-items-center py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <img id="eivLogoBanner" src="{{ asset('images/textlogo-navy.png') }}" alt="Gambar Baru" class="img-fluid text-logo">
                        <h1 id="animatedText" class="fw-bold"></h1>
                        <p class="text-muted">Sistem kami membantu mahasiswa menemukan gaya belajar terbaik berdasarkan analisis data.</p>
                        <a href="{{ route('pelajari') }}" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('images/logo-banner.png') }}" alt="Produk Web" class="img-fluid rounded shadow img-banner floating">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="divider" class="divider-section text-center py-5">
        <h2 class="text-white">"Optimalkan Gaya Belajar Mahasiswa dengan Teknologi Modern"</h2>
    </section>

    <header> {{-- Ini adalah header untuk "Kelebihan EdVise" --}}
        <div class="overlay"></div>
        <div class="content">
            <h2>Kelebihan EdVise</h2>
            <p>EdVise membantu dosen memahami kebutuhan belajar mahasiswa dengan cepat dan tepat, sehingga proses mengajar jadi lebih efektif dan terarah.</p>
        </div>
    </header>

    <section class="section">
        <div class="features">
            <div class="feature-item">
                <div class="icon-circle">💡</div>
                <h4>Personalisasi</h4>
                <p>Mendeteksi gaya belajar siswa dan memberikan saran yang sesuai.</p>
            </div>
            <div class="feature-item">
                <div class="icon-circle">📊</div>
                <h4>Analisis Cerdas</h4>
                <p>Algoritma pembelajaran untuk hasil rekomendasi yang akurat.</p>
            </div>
            <div class="feature-item">
                <div class="icon-circle">🤝</div>
                <h4>Dukungan Guru</h4>
                <p>Platform yang mudah digunakan dan terintegrasi dalam pengajaran.</p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="{{ asset('images/contoh-about.png') }}" alt="Tentang Kami" />
                </div>
                <div class="about-text">
                    <h1>Tentang Kami</h1>
                    <p>EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami gaya belajar siswa secara personal. Kami menggabungkan data, teknologi, dan insight pendidikan untuk memberikan rekomendasi pengajaran yang tepat sasaran.</p>
                    <a href="{{ route('pelajari') }}" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container metode-section">
        <h2 class="section-title">Macam-Macam Metode Pembelajaran</h2>
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slider" id="slider">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Problem Based Learning</div>
                            <div class="card-desc"> Pendekatan pembelajaran yang fokus pada penyelesaian masalah autentik kompleks
                                untuk mengembangkan berpikir kritis, analisis, dan pemecahan masalah secara mendalam. </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Project Based Learning</div>
                            <div class="card-desc">Pembelajaran berbasis proyek nyata yang memperkuat pemahaman konsep sekaligus melatih kerja tim, perencanaan, manajemen waktu, dan kreativitas.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Case-Based Learning</div>
                            <div class="card-desc">Pembelajaran berbasis kasus menggunakan situasi nyata atau simulasi yang dianalisis secara mendalam untuk melatih berpikir analitis dan pengambilan keputusan.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Collaborative Learning</div>
                            <div class="card-desc">Pembelajaran yang mengutamakan kerja kelompok untuk  mengembangkan keterampilan komunikasi, kepemimpinan, serta kemampuan sosial.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Flipped Classroom</div>
                            <div class="card-desc">Metode yang mengharuskan belajar mandiri sebelum kelas, sehingga waktu tatap muka digunakan untuk diskusi, praktik, dan tugas bersama.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Experiential Learning</div>
                            <div class="card-desc">Pembelajaran berbasis pengalaman langsung melalui praktik, simulasi, atau magang untuk mengembangkan kompetensi teknis dan sikap profesional.</div>
                        </div>
                    </div>
                </div>
                <button class="nav-button nav-left" onclick="scrollSlider(-1)">&#10094;</button>
                <button class="nav-button nav-right" onclick="scrollSlider(1)">&#10095;</button>
            </div>
        </div>
    </div>

@endsection

{{-- Skrip JavaScript khusus halaman welcome --}}
@section('scripts')
    <script>
        const texts = ["Rekomendasi Belajar Mahasiswa", "Gaya Belajar Adaptif", "Optimalkan Potensi Mahasiswa Anda"];
        let count = 0;
        let index = 0;
        let currentText = "";
        let letter = "";
        const speed = 150;

        function typeEffect() {
            if (count === texts.length) count = 0;
            currentText = texts[count];
            letter = currentText.slice(0, ++index);

            const animatedTextElement = document.getElementById("animatedText");
            if (animatedTextElement) {
                animatedTextElement.textContent = letter;
            }

            if (letter.length === currentText.length) {
                setTimeout(() => {
                    eraseEffect();
                }, 1000);
            } else {
                setTimeout(typeEffect, speed);
            }
        }

        function eraseEffect() {
            if (letter.length > 0) {
                letter = letter.slice(0, -1);
                const animatedTextElement = document.getElementById("animatedText");
                if (animatedTextElement) {
                    animatedTextElement.textContent = letter;
                }
                setTimeout(eraseEffect, speed / 2);
            } else {
                count++;
                index = 0;
                setTimeout(typeEffect, speed);
            }
        }

        // Jalankan typeEffect hanya jika elemen animatedText ada
        document.addEventListener("DOMContentLoaded", function() {
            if (document.getElementById("animatedText")) {
                typeEffect();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("animate");
                        }
                    });
                },
                { threshold: 0.5 }
            );

            const divider = document.querySelector("#divider");
            if (divider) {
                observer.observe(divider);
            }

            const animateOnScrollElements = document.querySelectorAll(".animate-on-scroll");
            animateOnScrollElements.forEach(el => {
                observer.observe(el);
            });
        });
    </script>

    <script>
        let currentSlide = 0;
        const slider = document.getElementById("slider");
        const totalCards = document.querySelectorAll(".card").length;
        const visibleCards = 3; // Default for desktop
        let currentVisibleCards = visibleCards; // Use a variable to adjust for mobile

        // Function to update visibleCards based on screen size
        function updateVisibleCards() {
            if (window.innerWidth <= 767.98) { // Small mobile
                currentVisibleCards = 1;
            } else if (window.innerWidth <= 991.98) { // Tablet and larger mobile
                currentVisibleCards = 1; // Still 1 for larger mobile view
            } else {
                currentVisibleCards = 3; // Desktop
            }
            // Recalculate maxSlide based on currentVisibleCards
            const maxSlide = totalCards - currentVisibleCards;
            // Ensure currentSlide doesn't exceed new maxSlide
            if (currentSlide > maxSlide) {
                currentSlide = maxSlide;
            }
            if (currentSlide < 0) { // Safety check
                currentSlide = 0;
            }
        }

        function scrollSlider(direction) {
            updateVisibleCards(); // Update visible cards before scrolling
            const maxSlide = totalCards - currentVisibleCards;

            currentSlide += direction;
            if (currentSlide < 0) currentSlide = 0;
            if (currentSlide > maxSlide) currentSlide = maxSlide;

            const translateX = -(100 / currentVisibleCards) * currentSlide; // Use currentVisibleCards
            if (slider) {
                slider.style.transform = `translateX(${translateX}%)`;
            }

            const navLeftButton = document.querySelector(".nav-left");
            const navRightButton = document.querySelector(".nav-right");

            // Only show buttons if there's more than one visible card or enough cards to scroll
            if (navLeftButton) {
                navLeftButton.style.display = (currentVisibleCards >= totalCards || currentSlide === 0) ? "none" : "block";
            }
            if (navRightButton) {
                navRightButton.style.display = (currentVisibleCards >= totalCards || currentSlide === maxSlide) ? "none" : "block";
            }
        }

        // Initialize button visibility and card positioning on load and resize
        document.addEventListener("DOMContentLoaded", function() {
            updateVisibleCards(); // Initial calculation
            scrollSlider(0); // Initial positioning and button visibility
            window.addEventListener('resize', function() {
                updateVisibleCards(); // Recalculate on resize
                scrollSlider(0); // Reposition to start of current section
            });
        });
    </script>
@endsection
