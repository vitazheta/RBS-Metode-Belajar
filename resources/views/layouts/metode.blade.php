<!-- <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metode Pembelajaran</title> -->
  <style>

    .container {
      padding: 40px;
      max-width: 1200px;
      margin: auto;
    }

    .container h2 {
    margin: 20;
    color: #0E1F4D;
    font-size: 40px;
    font-weight: bold;
    line-height: 56px;
    }

    .section-title {
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
    /* .slider-wrapper {
      position: relative;
      overflow: hidden;
    } */

    .slider {
      display: flex;
      transition: transform 0.6s ease-in-out;
      padding-bottom: 50px;
    }


    .card {
      flex: 0 0 33.3333%;
      /* box-sizing: border-box; */
      padding: 10px;
      margin: 30px auto 30px;
      transition: transform 0.3s ease;
      border: none;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card-content {
      background: linear-gradient(180deg, #0E1F4D, #000D30); /* Gradasi dari atas ke bawah */
      border-radius: 10px;
      padding: 20px;
      height: 250px;
      /* box-shadow: 0 4px 12px rgba(0,0,0,0.1); */
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .card-title {
      font-size: 20px;
      font-weight: bold;
      color: #ffff;
      margin-bottom: 8px;
      padding: 10px;
    }

    .card-desc {
      font-size: 14px;
      color: #ffff;
      padding: 10px;
      /* text-align: center; */
    }

    .nav-button {
      position: absolute;
      top: 45%;
      transform: translateY(-50%);
      background-color:#F37AB0;
      color: white;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      /* opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease; */
    }

    .nav-button:hover {
      background-color:  #84A7CF;
    }

    .nav-button:active {
      background-color:  #0E1F4D;
    }

    .nav-left {
      left: -20px;
    }

    .nav-right {
      right: -20px;
    }

  </style>

  <div class="container">
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

  <script>
    let currentSlide = 0;
    const slider = document.getElementById("slider");
    const totalCards = document.querySelectorAll(".card").length;
    const visibleCards = 3;
    const maxSlide = 6;

    function scrollSlider(direction) {
      const maxSlide = totalCards - visibleCards;
      currentSlide += direction;
      if (currentSlide < 0) currentSlide = 0;
      if (currentSlide > maxSlide) currentSlide = maxSlide;

      const translateX = -(100 / visibleCards) * currentSlide;
      slider.style.transform = `translateX(${translateX}%)`;
      document.querySelector(".nav-left").style.display = currentSlide === 0 ? "none" : "block";
      document.querySelector(".nav-right").style.display = currentSlide === maxSlide ? "none" : "block";
    }
  </script>
  

<!-- </body>
</html> -->
