@extends('layouts.app')

@section('title', 'Meet The Team')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif; 
            padding-top: 100px;
            background-color: #f0f2f5;
        }

        /* --- Dark Mode & Light Mode consistency --- */
        .card-info h2,
        .card-info p,
        .card-details p {
            color: #ffffff;
        }

        body.dark-theme .card-info h2,
        body.dark-theme .card-info p,
        body.dark-theme .card-details p {
            color: #ffffff; 
        }
        
        .container {
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }

        .header {
            margin-bottom: 50px;
        }
        .header h3 {
            color: #724e91;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            font-size: 16px;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 48px;
            font-weight: 700;
            color: #0E1F4D;
        }

        /* --- Team Grid and Card --- */
        .team-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .developer-card {
            position: relative;
            width: 350px;
            height: 450px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .developer-card:hover {
            transform: translateY(-10px);
        }
        .developer-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: filter 0.3s ease;
        }
        .developer-card:hover img {
            filter: brightness(60%);
        }

        /* --- Card Content --- */
        .card-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, #F37AB0, transparent);
            color: white;
            text-align: center; 
        }
        .card-info h2 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .card-info p {
            font-size: 16px;
            font-weight: 400;
            margin: 5px 0 0;
        }

        /* --- Hover Details --- */
        .card-details {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .developer-card:hover .card-details {
            opacity: 1;
            visibility: visible;
        }
        .card-details p {
            font-size: 18px;
            line-height: 1.6;
            text-align: justify;
        }
    </style>
    <div class="container">
        <div class="header">
            <h1>Tentang Kami</h1>
        </div>

        <div class="team-grid">
            @foreach ($developers as $developer)
                <div class="developer-card">
                    <img src="{{ asset($developer['image']) }}" alt="{{ $developer['name'] }}">
                    <div class="card-info">
                        <h2>{{ $developer['name'] }}</h2>
                        <p>{{ $developer['title'] }}</p>
                    </div>
                    <div class="card-details">
                        <p>{{ $developer['details'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection