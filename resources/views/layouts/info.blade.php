<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Rekomendasi Gaya Belajar</title> -->
  <style>
    * {
      box-sizing: border-box;
    }
    /* body {
      margin: 0;
      font-family: 'Segoe UI' sans-serif;
      background-color: #fff;
      color: #333;
    } */

    /* HEADER SECTION 
    .header-wrapper {
      position: relative;
      background: url('{{ asset('images/header.jpg') }}') center/cover no-repeat;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
      overflow: hidden;
    }

    .header-wrapper::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(33, 145, 80, 0.7); 
      z-index: 1;
    }
    
    .header-wrapper h1 {
      position: relative;
      z-index: 2;
      font-size: 3rem;
      margin: 0;
    }
     */

    /* MAIN CONTENT */
    .section {
      /* padding: 60px 20px; */
      padding-top: 0px;
      padding-bottom: 50px;
      text-align: center;
      max-width: 1000px;
      margin: 0 auto;
      
    }

    .section h2 {
      color: #fafafa;
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .section p {
      max-width: 800px;
      margin: 10px auto 40px;
      line-height: 1.6;
      font-size: 1rem;
    }

    .features {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .feature-item {
      background: #0E1F4D;
      padding: 20px;
      border-radius: 12px;
      width: 280px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.5);
      
    }

    .icon-circle {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #F37AB0;
      color: white;
      margin: 0 auto 10px;
      font-size: 1.4rem;
    }

    .feature-item h4 {
      font-size: 1.1rem;
      color: #fafafa;
      margin-bottom: 8px;
    }

    .feature-item p {
      font-size: 0.95rem;
      color: #fafafa;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .header-wrapper h1 {
        font-size: 2rem;
        padding: 0 10px;
      }

      .feature-item {
        width: 90%;
      }
    }
    
  </style>
<!-- </head>
<body> -->

  <!-- HEADER 
  <header class="header-wrapper">
    <h1>About Us</h1>
  </header> -->

  <!-- CONTENT -->
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





