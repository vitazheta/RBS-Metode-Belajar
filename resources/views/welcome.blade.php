@extends('layouts.app')

{{-- Bagian <head> khusus untuk halaman welcome jika diperlukan --}}
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
@endsection

{{-- Konten utama halaman welcome --}}
@section('content')

    {{-- KONSOLIDASI SEMUA CSS SPESIFIK HALAMAN WELCOME DI SINI --}}
    <style>
        /* ==================== GLOBAL FONT AND BASE SETTINGS ==================== */
        html {
            font-size: 16px; /* Base font size, 1rem = 16px on desktop */
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* background-color: #f8f9fa; */
            color: #0E1F4D; /* Default light mode text color */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
        }

        body.dark-theme {
            background-color: #121212; /* Dark mode background */
            color: #ffffff; /* Dark mode text color */
        }

        /* Reusable font sizes with REM for better scalability */
        h1, h2, h3, h4, h5, h6 {
            color: #0E1F4D;
        }

        body.dark-theme h1,
        body.dark-theme h2,
        body.dark-theme h3,
        body.dark-theme h4,
        body.dark-theme h5,
        body.dark-theme h6 {
            color: #FFFFFF;
        }

        /* Global text colors for light/dark mode */
        .text-primary-color {
            color: #0E1F4D;
        }

        .dark-theme .text-primary-color {
            color: #FFFFFF;
        }

        .text-muted {
            color: #0E1F4D !important; /* Override Bootstrap's text-muted */
        }

        .dark-theme .text-muted {
            color: #FFFFFF !important;
        }

        /* ==================== GLOBAL DARK MODE SETTINGS ==================== */
        body.dark-theme {
            background-color: #121212;
            color: #ffffff;
        }

        /* ==================== STYLES DARI WELCOME.BLADE.PHP ASLI (HEADER "Kelebihan EdVise") ==================== */
        header {
            height: auto;
            margin-bottom: 2.5rem; /* ~40px */
            padding-top: 3.125rem; /* ~50px */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        header h2 {
            margin: 0;
            font-size: 2.5rem; /* ~40px */
            font-weight: bold;
            line-height: 3.5rem; /* ~56px */
            text-shadow: 0.125rem 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        }

        header p {
            font-size: 1.25rem; /* ~20px */
            font-weight: 500; /* medium */
            max-width: 50rem; /* ~800px */
            margin: 1.25rem auto 1.875rem; /* ~20px auto 30px */
            line-height: 1.75rem; /* ~28px */
            opacity: 0.9;
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
            background-color: #121212;
            color: #FFFFFF;
        }

        body.dark-theme header h2 {
            color: #FFFFFF;
            text-shadow: none;
        }

        body.dark-theme header p {
            color: #FFFFFF;
            opacity: 1;
        }

        /* ==================== STYLES DARI LAYOUTS/BANNER.BLADE.PHP ==================== */
        #banner {
            position: relative;
            padding-top: 4.375rem; /* ~70px */
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
            width: 9.375rem; /* ~150px */
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
            min-height: calc(100vh - 4.375rem); /* ~70px */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-overlay .container {
            width: 100%;
            max-width: 75rem; /* ~1200px */
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
            font-size: 3.125rem; /* ~50px */
            font-weight: bold;
            line-height: 3.75rem; /* ~60px */
            color: #0E1F4D;
            margin-bottom: 0.625rem; /* ~10px */
            text-shadow: 0.125rem 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        }

        .carousel-overlay p.text-muted {
            font-size: 0.875rem; /* ~14px */
            line-height: 1.25rem; /* ~20px */
            margin-top: 0;
            margin-bottom: 0.9375rem; /* ~15px */
            max-width: 31.25rem; /* ~500px */
            margin-left: 0;
            margin-right: auto;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: var(--text-color);
            font-size: 0.875rem; /* ~14px */
            line-height: 1.25rem; /* ~20px */
            font-family: 'Poppins', sans-serif;
            border: none;
            padding: 0.75rem 1.5625rem; /* ~12px 25px */
            border-radius: 0.625rem; /* ~10px */
            transition: all 0.3s ease;
            box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.1); /* ~0 4px 6px */
        }

        .btn-primary:hover {
            background-color: #E2A6C1;
            color: var(--text-color);
            transform: translateY(-0.1875rem); /* ~-3px */
            box-shadow: 0 0.375rem 0.625rem rgba(0, 0, 0, 0.15); /* ~0 6px 10px */
        }

        .btn.mt-3 {
            margin-top: 0 !important;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-1.25rem); /* ~-20px */ }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 2s linear infinite;
        }

        .divider-section {
            background: linear-gradient(135deg, #111F43 0%, #3F5694 30%, #000D30 100%);
            font-family: 'Poppins', sans-serif;
            font-size: 0.875rem; /* ~14px */
            line-height: 1.5;
            letter-spacing: 0.0625rem; /* ~1px */
            margin: 0;
            padding: 3.125rem 0; /* ~50px */
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(3.125rem); /* ~50px */
            transition: all 1s ease-in-out;
        }

        .divider-section.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .divider-section h2 {
            margin: 0;
            animation: fadeInUp 2s ease-in;
            font-size: 1.25rem; /* ~20px */
            font-weight: normal;
            text-shadow: 0.125rem 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(1.25rem); /* ~20px */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(1.25rem); /* ~20px */
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
            padding-top: 0;
            padding-bottom: 3.125rem; /* ~50px */
            text-align: center;
            max-width: 62.5rem; /* ~1000px */
            margin: 0 auto;
        }

        body.dark-theme .section {
            background-color: #121212;
        }

        .section h2 {
            font-size: 2rem; /* ~32px */
            margin-bottom: 1.25rem; /* ~20px */
        }

        body.dark-theme .section h2 {
            color: #FFFFFF;
        }

        .section p {
            max-width: 50rem; /* ~800px */
            margin: 0.625rem auto 2.5rem; /* ~10px auto 40px */
            line-height: 1.6;
            font-size: 1rem; /* ~16px */
        }

        body.dark-theme .section p {
            color: #FFFFFF;
        }

        .features {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            gap: 3.125rem; /* ~50px */
        }

        .feature-item {
            flex: 1 1 calc(33.333% - 2.125rem); /* ~34px */
            max-width: 18.75rem; /* ~300px */
            min-width: 17.5rem; /* ~280px */
            padding: 1.875rem 1.25rem; /* ~30px 20px */
            box-sizing: border-box;
            background-color: #f0f8ff;
            border-radius: 0.9375rem; /* ~15px */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* ~0 8px 16px */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: 0.0625rem solid #e0e0e0; /* ~1px */
        }

        .feature-item:hover {
            transform: translateY(-0.625rem); /* ~-10px */
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.2); /* ~0 12px 24px */
        }

        .feature-item:hover .icon-circle {
            transform: scale(1.1);
        }

        .icon-circle {
            width: 5rem; /* ~80px */
            height: 5rem; /* ~80px */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #0E1F4D, #84A7CF);
            color: white;
            margin: 0 auto 1.25rem; /* ~20px */
            font-size: 2rem; /* ~32px */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.2); /* ~0 4px 8px */
            transition: transform 0.3s ease-in-out;
        }

        body.dark-theme .feature-item .icon-circle {
            background: linear-gradient(45deg, #F37AB0, #E2A6C1);
            color: #FFFFFF;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.3);
        }

        .feature-item h4 {
            font-size: 1.375rem; /* ~22px */
            margin-bottom: 0.625rem; /* ~10px */
            font-weight: bold;
        }

        body.dark-theme .feature-item h4 {
            color: #FFFFFF;
        }

        body.dark-theme .feature-item {
            background-color: #1B1B1B;
            border: 0.0625rem solid #333; /* ~1px */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3); /* ~0 8px 16px */
        }

        body.dark-theme .feature-item:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.4); /* ~0 12px 24px */
        }

        .section .features .feature-item p {
            font-size: 1rem; /* ~16px */
            line-height: 1.75rem; /* ~28px */
            max-width: none;
            margin: 0;
        }

        body.dark-theme .section .features .feature-item p {
            color: #FFFFFF;
        }

        /* ==================== STYLES DARI LAYOUTS/ABOUT.BLADE.PHP ==================== */
        .about-section {
            background: linear-gradient(180deg, #111F43, #000D30);
            padding: 6.25rem 0; /* ~100px */
        }

        .about-section .container {
            width: 90%;
            max-width: 75rem; /* ~1200px */
            margin: 0 auto;
        }

        .about-content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            gap: 6.25rem; /* ~100px */
        }

        .about-image img {
            width: 100%; /* Changed from 400% to prevent overflow */
            height: auto; /* Changed from 300% for proper scaling */
            max-width: 28.125rem; /* ~450px */
            border-radius: 0.75rem; /* ~12px */
            box-shadow: 0 0.25rem 0.625rem rgba(0, 0, 0, 0.1); /* ~0 4px 10px */
        }

        .about-text {
            flex: 1;
            color: white;
        }

        .about-text h1 {
            margin: 0;
            color: #ffffff;
            font-size: 2.5rem; /* ~40px */
            font-weight: bold;
            line-height: 3.5rem; /* ~56px */
        }

        .about-text p {
            font-size: 1.25rem; /* ~20px */
            color: #ffffff;
            line-height: 1.75rem; /* ~28px */
            margin-top: 1.25rem; /* ~20px */
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
            padding: 2.5rem; /* ~40px */
            max-width: 75rem; /* ~1200px */
            margin: auto;
        }

        .container.metode-section h2 {
            margin: 1.25rem; /* ~20px */
            font-size: 2.5rem; /* ~40px */
            font-weight: bold;
            line-height: 3.5rem; /* ~56px */
        }

        .metode-section .section-title {
            margin-top: 5rem; /* ~80px */
            margin-bottom: 1.25rem; /* ~20px */
            text-align: center;
            font-size: 3rem; /* ~48px */
        }

        .slider-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffff;
        }

        .slider-wrapper {
            overflow: hidden;
            width: 100%;
        }

        .slider {
            display: flex;
            transition: transform 0.6s ease-in-out;
            padding-bottom: 3.125rem; /* ~50px */
        }

        .card {
            flex: 0 0 33.3333%;
            padding: 0.625rem; /* ~10px */
            margin: 1.875rem auto; /* ~30px */
            transition: transform 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-content {
            background: linear-gradient(180deg, #0E1F4D, #000D30);
            border-radius: 0.625rem; /* ~10px */
            padding: 1.25rem; /* ~20px */
            height: 15.625rem; /* ~250px */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-title {
            font-size: 1.25rem; /* ~20px */
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 0.5rem; /* ~8px */
            padding: 0.625rem; /* ~10px */
        }

        .card-desc {
            font-size: 0.875rem; /* ~14px */
            color: #ffffff;
            padding: 0.625rem; /* ~10px */
        }

        .nav-button {
            position: absolute;
            top: 45%;
            transform: translateY(-50%);
            background-color: #F37AB0;
            color: white;
            border: none;
            border-radius: 50%;
            width: 2.5rem; /* ~40px */
            height: 2.5rem; /* ~40px */
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex; /* Added for centering icon */
            align-items: center; /* Added for centering icon */
            justify-content: center; /* Added for centering icon */
            font-size: 1.25rem; /* Icon size */
            display: block;
        }

        .nav-button:hover {
            background-color: #E2A6C1;
        }

        .nav-button:active {
            background-color: #0E1F4D;
        }

        .nav-left {
            left: -1.25rem; /* ~-20px */
        }

        .nav-right {
            right: -1.25rem; /* ~-20px */
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

        /* ==================== MEDIA QUERIES FOR RESPONSIVENESS ==================== */

        /* Untuk Tablet dan Ponsel Besar (di bawah breakpoint Bootstrap lg: 991.98px) */
        @media (max-width: 991.98px) {
            html {
                font-size: 15px; /* Adjust base font size for tablets */
            }

            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 0.9375rem; /* ~15px */
                padding-right: 0.9375rem; /* ~15px */
            }

            /* Kelebihan EdVise Header */
            header {
                margin-bottom: 1.25rem; /* ~20px */
                padding-top: 1.875rem; /* ~30px */
                padding-left: 0.9375rem; /* ~15px */
                padding-right: 0.9375rem; /* ~15px */
            }
            header h2 {
                font-size: 2rem; /* ~32px */
                line-height: 2.5rem; /* ~40px */
            }
            header p {
                font-size: 1rem; /* ~16px */
                line-height: 1.5rem; /* ~24px */
                margin: 0.9375rem auto 1.5625rem; /* ~15px auto 25px */
            }

            /* Banner Section */
            .carousel-overlay {
                min-height: auto;
                padding-top: 3.125rem; /* ~50px */
                padding-bottom: 3.125rem; /* ~50px */
            }
            .carousel-bg {
                height: auto; /* Disesuaikan untuk mobile agar gambar tidak tersembunyi */
                min-height: 50vh; /* Minimum tinggi agar gambar tetap terlihat */
            }
            #banner {
                height: auto;
                min-height: unset;
            }
            #animatedText {
                font-size: 2.25rem; /* ~36px */
                line-height: 2.8125rem; /* ~45px */
            }
            .carousel-overlay p.text-muted {
                font-size: 0.875rem; /* ~14px */
                line-height: 1.375rem; /* ~22px */
                margin-top: 0.3125rem; /* ~5px */
                margin-bottom: 0.9375rem; /* ~15px */
                padding: 0 1.25rem; /* ~20px */
                margin-left: auto;
                margin-right: auto;
            }
            .text-logo {
                width: 6.25rem; /* ~100px */
                margin-bottom: 0.625rem; /* ~10px */
                margin-left: auto; /* Pusatkan logo di mobile */
                margin-right: auto;
            }
            .img-banner {
                max-width: 60%;
                margin-top: 1.25rem; /* ~20px */
                margin-bottom: 1.25rem; /* ~20px */
                margin-left: auto; /* Pastikan gambar banner terpusat */
                margin-right: auto;
            }
            .carousel-overlay .container,
            .carousel-overlay .row,
            .carousel-overlay .col-lg-6 {
                padding-left: 0 !important;
                padding-right: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
                margin-left: auto !important;
                margin-right: auto !important;
                text-align: center !important;
            }

            .divider-section h2 {
                margin: 0 1.25rem; /* ~20px */
                font-size: 0.9375rem; /* ~15px */
            }

            /* Info Section */
            .section {
                padding-top: 1.875rem; /* ~30px */
                padding-bottom: 1.875rem; /* ~30px */
            }
            .section h2 {
                font-size: 1.5rem; /* ~24px */
                margin-bottom: 0.9375rem; /* ~15px */
            }
            .section p {
                font-size: 0.875rem; /* ~14px */
                line-height: 1.375rem; /* ~22px */
                margin: 0.625rem auto 1.25rem; /* ~10px auto 20px */
            }
            .features {
                flex-direction: column;
                gap: 1.25rem; /* ~20px */
                align-items: center;
            }
            .feature-item {
                width: 90%;
                max-width: 21.875rem; /* ~350px */
                padding: 1.875rem 1.25rem; /* ~30px 20px */
                flex: unset;
            }
            .feature-item h4 {
                font-size: 1.125rem; /* ~18px */
            }

            /* About Section */
            .about-section {
                padding: 3.125rem 0; /* ~50px */
            }
            .about-content {
                flex-direction: column;
                gap: 1.875rem; /* ~30px */
                text-align: center;
            }
            .about-image {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .about-image img {
                max-width: 18.75rem; /* ~300px */
                margin: 0 auto;
            }
            .about-text {
                padding: 0 0.625rem; /* ~10px */
            }
            .about-text h1 {
                font-size: 2rem; /* ~32px */
                line-height: 2.5rem; /* ~40px */
            }
            .about-text p {
                font-size: 1rem; /* ~16px */
                line-height: 1.5rem; /* ~24px */
                margin-top: 0.9375rem; /* ~15px */
                margin-bottom: 1.5625rem; /* ~25px */
            }

            /* Metode Section */
            .container.metode-section {
                padding: 1.875rem 0.9375rem; /* ~30px 15px */
            }
            .container.metode-section h2, .metode-section .section-title {
                font-size: 1.5rem; /* ~24px */
                line-height: 2rem; /* ~32px */
                margin-top: 1.875rem; /* ~30px */
                margin-bottom: 0.9375rem; /* ~15px */
            }
            .slider {
                flex-direction: row;
                padding-bottom: 1.875rem; /* ~30px */
                overflow-x: scroll;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
            }
            .card {
                flex: 0 0 90%;
                max-width: 25rem; /* ~400px */
                margin: 0.9375rem 5%; /* ~15px */
                padding: 0;
                scroll-snap-align: center;
            }
            .card-content {
                height: auto;
                min-height: 11.25rem; /* ~180px */
                padding: 0.9375rem; /* ~15px */
            }
            .card-title {
                font-size: 1.125rem; /* ~18px */
                margin-bottom: 0.3125rem; /* ~5px */
            }
            .card-desc {
                font-size: 0.8125rem; /* ~13px */
                line-height: 1.125rem; /* ~18px */
                padding: 0;
            }
            .nav-button {
                display: none;
                /* display: block;
                top: 50%;
                background-color: rgba(243, 122, 176, 0.8); */
            }
            .nav-left {
                left: 0.3125rem; /* ~5px */
            }
            .nav-right {
                right: 0.3125rem; /* ~5px */
            }
        }

        /* Untuk Ponsel Kecil (di bawah breakpoint Bootstrap sm: 767.98px) */
        @media (max-width: 767.98px) {
            html {
                font-size: 14px; /* Adjust base font size for smaller phones */
            }

            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 0.625rem; /* ~10px */
                padding-right: 0.625rem; /* ~10px */
            }

            /* Kelebihan EdVise Header */
            header {
                padding-top: 1.25rem; /* ~20px */
                margin-bottom: 0.9375rem; /* ~15px */
            }
            header h2 {
                font-size: 1.75rem; /* ~28px */
                line-height: 2.1875rem; /* ~35px */
            }
            header p {
                font-size: 0.875rem; /* ~14px */
                line-height: 1.25rem; /* ~20px */
                margin: 0.625rem auto 1.25rem; /* ~10px auto 20px */
            }

            /* Banner Section */
            .carousel-overlay {
                min-height: auto;
                padding-top: 2.5rem; /* ~40px */
                padding-bottom: 2.5rem; /* ~40px */
            }
            .carousel-bg {
                height: auto; /* Disesuaikan untuk mobile agar gambar tidak tersembunyi */
                min-height: 70vh; /* Minimum tinggi agar gambar tetap terlihat */
            }
            #animatedText {
                font-size: 1.75rem; /* ~28px */
                line-height: 2.1875rem; /* ~35px */
                padding: 0 1.25rem; /* ~20px */
            }
            .carousel-overlay p.text-muted {
                font-size: 0.8125rem; /* ~13px */
                line-height: 1.25rem; /* ~20px */
                padding: 0 1.25rem; /* ~20px */
            }
            .text-logo {
                width: 5rem; /* ~80px */
                margin-left: auto; /* Pusatkan logo di mobile */
                margin-right: auto;
            }
            .img-banner {
                max-width: 70%;
                margin-left: auto; /* Pastikan gambar banner terpusat */
                margin-right: auto;
            }
            .btn-primary.mt-3 {
                margin-top: 0 !important;
            }

            /* Info Section */
            .section h2 {
                font-size: 1.25rem; /* ~20px */
            }
            .section p {
                font-size: 0.8125rem; /* ~13px */
                line-height: 1.25rem; /* ~20px */
            }
            .feature-item {
                width: 95%;
                padding: 0;
            }
            .feature-item h4 {
                font-size: 1rem; /* ~16px */
            }
            .icon-circle {
                width: 3.75rem; /* ~60px */
                height: 3.75rem; /* ~60px */
                font-size: 1.75rem; /* ~28px */
                margin: 0 auto 0.9375rem; /* ~15px */
            }


            /* About Section */
            .about-section {
                padding: 2.5rem 0; /* ~40px */
            }
            .about-image img {
                max-width: 15.625rem; /* ~250px */
            }
            .about-text h1 {
                font-size: 1.75rem; /* ~28px */
                line-height: 2.1875rem; /* ~35px */
            }
            .about-text p {
                font-size: 0.875rem; /* ~14px */
                line-height: 1.25rem; /* ~20px */
            }

            /* Metode Section */
            .container.metode-section h2, .metode-section .section-title {
                font-size: 1.25rem; /* ~20px */
                line-height: 1.75rem; /* ~28px */
                margin-top: 1.25rem; /* ~20px */
                margin-bottom: 0.625rem; /* ~10px */
            }
            .card {
                flex: 0 0 95%;
                margin: 0.625rem 2.5%; /* ~10px */
                padding: 0;
            }
            .card-content {
                min-height: 10rem; /* ~160px */
                padding: 0.625rem; /* ~10px */
            }
            .card-title {
                font-size: 1rem; /* ~16px */
            }
            .card-desc {
                font-size: 0.75rem; /* ~12px */
                line-height: 1rem; /* ~16px */
                padding: 0;
            }
            .nav-button {
                /* width: 2.1875rem;
                height: 2.1875rem;
                font-size: 1.125rem; */
                display: none;
            }
            .nav-left { left: 0; }
            .nav-right { right: 0; }
        }

        /* Untuk Ponsel Sangat Kecil (misalnya iPhone 5/SE, dll.) */
        @media (max-width: 575.98px) {
            html {
                font-size: 13px; /* Further adjust base font size for very small screens */
            }

            /* GLOBAL SECTION SETTINGS */
            .section, .about-section, .container.metode-section {
                padding-left: 0.3125rem; /* ~5px */
                padding-right: 0.3125rem; /* ~5px */
            }

            /* Header */
            header { padding-top: 0.9375rem; /* ~15px */ margin-bottom: 0.625rem; /* ~10px */ }
            header h2 { font-size: 1.5rem; /* ~24px */ line-height: 1.875rem; /* ~30px */ }
            header p { font-size: 0.75rem; /* ~12px */ line-height: 1.125rem; /* ~18px */ padding: 0 0.3125rem; /* ~5px */ margin: 0.3125rem auto 0.625rem; /* ~5px auto 10px */ }

            .feature-item {
                padding: 0.5rem; /* ~8px */
            }
            .feature-item h4 {
                font-size: 0.875rem; /* ~14px */
                margin-bottom: 0.3125rem; /* ~5px */
            }
            .section .features .feature-item p {
                font-size: 0.6875rem; /* ~11px */
                line-height: 1rem; /* ~16px */
                margin-top: 0.125rem; /* ~2px */
            }
            .icon-circle {
                width: 2.8125rem; /* ~45px */
                height: 2.8125rem; /* ~45px */
                font-size: 1.125rem; /* ~18px */
                margin: 0 auto 0.5rem; /* ~8px */
            }

            /* Banner Section */
            #animatedText { font-size: 1.5rem; /* ~24px */ line-height: 1.875rem; /* ~30px */ }
            .carousel-overlay p.text-muted { font-size: 0.75rem; /* ~12px */ line-height: 1.125rem; /* ~18px */ padding: 0 0.3125rem; /* ~5px */ }

            .btn-primary.mt-3 {
                margin-top: 0 !important;
            }
            .carousel-overlay {
                min-height: auto;
                padding-top: 1.875rem; /* ~30px */
                padding-bottom: 1.875rem; /* ~30px */
            }
            .carousel-bg {
                height: 100%;
            }

            /* Info Section */
            .section h2 { font-size: 1.125rem; /* ~18px */ }
            .section p { font-size: 0.6875rem; /* ~11px */ }

            /* About Section */
            .about-section { padding: 1.875rem 0; /* ~30px */ }
            .about-image img {
                max-width: 12.5rem; /* ~200px */
            }
            .about-text h1 { font-size: 1.5rem; /* ~24px */ line-height: 1.875rem; /* ~30px */ }
            .about-text p { font-size: 0.75rem; /* ~12px */ line-height: 1.125rem; /* ~18px */ }

            /* Metode Section */
            .container.metode-section h2, .metode-section .section-title { font-size: 1.125rem; /* ~18px */ line-height: 1.5rem; /* ~24px */ }
            .card {
                flex: 0 0 98%;
                margin: 0.3125rem 1%; /* ~5px */
            }
            .card-content { min-height: 8.75rem; /* ~140px */ }
            .card-title { font-size: 0.875rem; /* ~14px */ }
            .card-desc { font-size: 0.6875rem; /* ~11px */ }
            .nav-button {
                /* Sembunyikan tombol di layar ponsel sangat kecil */
                display: none;
            }
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
                        <p class="text-muted">Sistem kami membantu dosen menemukan gaya belajar terbaik untuk mahasiswa berdasarkan analisis data.</p>
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
        <h2 class="text-white">"Optimalkan Pembelajaran Mahasiswa dengan Teknologi Modern"</h2>
    </section>

    <header> {{-- Ini adalah header untuk "Kelebihan EdVise" --}}
        <!-- <div class="overlay"></div> -->
        <div class="content">
            <h2>Kelebihan EdVise</h2>
            <p>EdVise membantu dosen memahami kebutuhan belajar mahasiswa dengan cepat dan tepat, sehingga proses mengajar jadi lebih efektif dan terarah.</p>
        </div>
    </header>

    <section class="section">
        <div class="features">
            <div class="feature-item animate-on-scroll"> {{-- Tambahkan class animate-on-scroll --}}
            <div class="icon-circle"><i class="fas fa-lightbulb"></i></div>
                <h4>Personalisasi</h4>
                <p>Mendeteksi pembelajaran mahasiswa dan memberikan saran yang sesuai.</p>
            </div>
            <div class="feature-item animate-on-scroll">
            <div class="icon-circle"><i class="fas fa-chart-line"></i></div>
                <h4>Analisis Cerdas</h4>
                <p>Algoritma pembelajaran untuk hasil rekomendasi yang akurat.</p>
            </div>
            <div class="feature-item animate-on-scroll">
            <div class="icon-circle"><i class="fas fa-handshake"></i></div>
                <h4>Dukungan Dosen</h4>
                <p>Platform yang mudah digunakan dalam pengajaran.</p>
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
                    <p>EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami pembelajaran mahasiswa secara personal. Kami menggabungkan data, teknologi, dan insight pendidikan untuk memberikan rekomendasi pengajaran yang tepat sasaran.</p>
                    <a href="{{ route('developer.page') }}" class="btn btn-primary mt-3">Kenali Kami</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container metode-section">
        <h2 class="section-title">Collaborative Performance Skills</h2>
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slider" id="slider">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Sharing Ideas</div>
                            <div class="card-desc"> Kemampuan untuk mengemukakan pendapat, gagasan, atau solusi kepada anggota tim secara terbuka dan jelas. Skill ini mencerminkan keberanian dalam berkontribusi dan membantu memperkaya diskusi kelompok dengan berbagai sudut pandang. </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Negotiating Ideas</div>
                            <div class="card-desc">Keterampilan dalam mendiskusikan dan menyesuaikan berbagai ide yang muncul untuk mencapai kesepakatan bersama. Ini melibatkan kemampuan berargumen secara logis, mendengarkan pendapat orang lain, dan mencari jalan tengah demi tujuan tim.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Maintaining Communication</div>
                            <div class="card-desc">Kemampuan menjaga komunikasi tetap terbuka, jelas, dan terarah selama proses kolaborasi. Ini mencakup mendengarkan secara aktif, memberi umpan balik yang konstruktif, serta menjaga suasana diskusi agar tetap positif dan produktif.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Regulating Problem Solving</div>
                            <div class="card-desc">Keterampilan mengatur proses pemecahan masalah secara bersama-sama, termasuk membagi tugas, memantau kemajuan, dan menyesuaikan strategi saat menghadapi hambatan. Ini menunjukkan kemampuan tim dalam bekerja secara terorganisir dan adaptif.</div>
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
        let currentVisibleCards;

        // Function to update visibleCards based on screen size
        function updateVisibleCards() {
            // Updated breakpoints for visible cards
            if (window.innerWidth <= 991.98) { // For tablets and all phones
                currentVisibleCards = 1;
            } else { // Desktop
                currentVisibleCards = 3;
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

            // Only attempt to scroll if on desktop (where buttons are visible)
            if (currentVisibleCards > 1) { // Only allow scrolling with buttons if more than 1 card is visible (i.e., desktop view)
                const maxSlide = totalCards - currentVisibleCards;

                currentSlide += direction;
                if (currentSlide < 0) currentSlide = 0;
                if (currentSlide > maxSlide) currentSlide = maxSlide;

                const translateX = -(100 / currentVisibleCards) * currentSlide;
                if (slider) {
                    slider.style.transform = `translateX(${translateX}%)`;
                }
            }


            const navLeftButton = document.querySelector(".nav-left");
            const navRightButton = document.querySelector(".nav-right");

            // Only show buttons if there are more cards than visible cards AND it's a desktop view
            if (navLeftButton) {
                navLeftButton.style.display = (totalCards <= currentVisibleCards || currentSlide === 0 || currentVisibleCards === 1) ? "none" : "block";
            }
            if (navRightButton) {
                navRightButton.style.display = (totalCards <= currentVisibleCards || currentSlide === maxSlide || currentVisibleCards === 1) ? "none" : "block";
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
