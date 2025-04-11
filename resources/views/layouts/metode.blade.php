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

    .section-title {
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
      background: #0E1F4D;
      border-radius: 10px;
      padding: 20px;
      height: 250px;
      /* box-shadow: 0 4px 12px rgba(0,0,0,0.1); */
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .card-title {
      font-size: 1.1rem;
      color: #ffff;
      margin-bottom: 8px;
    }

    .card-desc {
      font-size: 0.95rem;
      color: #ffff;
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
            <div class="card-desc">Siswa memecahkan masalah sebagai inti pembelajaran, mendorong pemikiran analitis dan kolaboratif.</div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-title">Project Based Learning</div>
            <div class="card-desc">Pembelajaran berbasis proyek nyata, membangun kreativitas dan kerja tim secara mendalam.</div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-title">Ceramah</div>
            <div class="card-desc">Metode penyampaian materi oleh guru secara langsung, cocok untuk materi teoretis.</div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-title">Diskusi</div>
            <div class="card-desc">Melibatkan siswa dalam bertukar pendapat, meningkatkan keterampilan berpikir kritis dan komunikasi.</div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-title">Tanya Jawab</div>
            <div class="card-desc">Guru memberikan pertanyaan dan siswa merespons, atau sebaliknya, meningkatkan partisipasi.</div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-title">Demonstrasi</div>
            <div class="card-desc">Guru menunjukkan proses atau eksperimen secara langsung, cocok untuk pembelajaran praktis.</div>
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
