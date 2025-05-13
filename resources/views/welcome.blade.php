<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">


        <!--<title>Sistem Rekomendasi Gaya Belajar Adaptif</title>

        <--Styles -->
        <style>
        body.dark-theme {
            background-color: #1F1F20;
            color: #BCCAD7;
        }
        
        header {
            background-color: #ffffff
            height: auto;
            margin-top: 80px;
            margin-bottom: 40px;
            padding-top: 50px;
            padding-top: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* position: relative; */
        }

        header h1 {
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

        .overlay { /*overlay selamat datang */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            /* background-image: url('images/divider.png');
            background-size: cover;       supaya gambar menutupi seluruh area 
            background-position: center; /* supaya gambar tetap terpusat 
            background-repeat: no-repeat; /* agar gambar tidak diulang 
            height: 60vh; */
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            /* padding-right: 10px;
            max-width: 600px; 
            margin-left: 500px; */
        }

        /* Dark theme */
        body.dark-theme header h1 {
            color: #FFFFFF;
        }

        body.dark-theme header p {
            color: #FFFFFF;
        }

        </style>
    </head>

    <body>
    @include('layouts.navbar')
    @include('layouts.banner')
    


    <header>
        <div class="overlay"></div>
            <div class="content">
                <h1>Kelebihan EdVise</h1>
                <p>EdVise membantu guru memahami kebutuhan belajar siswa dengan cepat dan tepat, sehingga proses mengajar jadi lebih efektif dan terarah.</p>
            </div>
        </div>
        
    </header>

    @include('layouts.info')
    @include('layouts.about')
    @include('layouts.metode')
    </body>
</html>

@include('layouts.footer')
