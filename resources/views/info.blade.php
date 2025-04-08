<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Rekomendasi Gaya Belajar</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fff;
      color: #333;
    }

    /* HEADER SECTION */
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
      background-color: rgba(33, 145, 80, 0.7); /* #219150 dengan opacity */
      z-index: 1;
    }

    .header-wrapper h1 {
      position: relative;
      z-index: 2;
      font-size: 3rem;
      margin: 0;
    }

    /* MAIN CONTENT */
    .section {
      padding: 60px 20px;
      text-align: center;
      max-width: 1000px;
      margin: 0 auto;
    }

    .section h2 {
      color: #219150;
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
      background: #f9f9f9;
      padding: 20px;
      border-radius: 12px;
      width: 280px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      
    }

    .icon-circle {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #219150;
      color: white;
      margin: 0 auto 10px;
      font-size: 1.4rem;
    }

    .feature-item h4 {
      font-size: 1.1rem;
      color: #219150;
      margin-bottom: 8px;
    }

    .feature-item p {
      font-size: 0.95rem;
      color: #666;
    }

    .team-section {
            background-color: #fafafa;
            padding: 60px 20px;
            text-align: center;
        }
        .team-section h2 {
            color: #219150;
        }
        .team-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 20px;
            padding: 20px;
        }
        .team-member {
          width: 230px;
          text-align: center;
          background: #fff;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1);
          flex-shrink: 0;
          transition: transform 0.3s ease;
        }
        .team-member h4 {
            margin: 10px 0 5px;
        }
        .arrows {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .arrow-btn {
            padding: 10px 20px;
            background-color: #219150;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
</head>
<body>

  <!-- HEADER -->
  <header class="header-wrapper">
    <h1>About Us</h1>
  </header>

  <!-- CONTENT -->
  <section class="section">
    <h2>Selamat Datang di Website Rekomendasi Gaya Belajar</h2>
    <p>
      Website digunakan untuk membantu para guru dan tenaga pendidik memahami gaya belajar siswa secara personal. Dengan teknologi cerdas dan pendekatan berbasis data, kami memberikan rekomendasi metode pengajaran yang efektif sesuai karakteristik belajar siswa.
    </p>

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

</body>
</html>

<section class="team-section">
        <h2>Team Members</h2>
        <p>Tim pengembang platform kami yang berdedikasi dan berpengalaman.</p>

        <div class="team-container" id="teamContainer">
            <div class="team-member">
                <h4>Rina Andriani</h4>
                <p>UX Designer</p>
            </div>
            <div class="team-member">
                <h4>Fajar Prasetyo</h4>
                <p>Full Stack Developer</p>
            </div>
            <div class="team-member">
                <h4>Melati Sari</h4>
                <p>Education Specialist</p>
            </div>
            <div class="team-member">
                <h4>Andi Gunawan</h4>
                <p>Data Analyst</p>
            </div>
            <div class="team-member">
                <h4>Lestari Dwi</h4>
                <p>Frontend Developer</p>
            </div>
            <div class="team-member">
                <h4>Bima Setiawan</h4>
                <p>Project Manager</p>
            </div>
        </div>

        <div class="arrows">
            <button class="arrow-btn" onclick="scrollTeam(-1)">&larr;</button>
            <button class="arrow-btn" onclick="scrollTeam(1)">&rarr;</button>
        </div>
    </section>

    <script>
        function scrollTeam(direction) {
            const container = document.getElementById('teamContainer');
            container.scrollBy({ left: direction * 260, behavior: 'smooth' });
        }
    </script>


