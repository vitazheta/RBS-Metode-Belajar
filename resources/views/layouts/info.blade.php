<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Rekomendasi Gaya Belajar</title> -->

<body>
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

    .section.dark-theme h2 {
      color: #000000;
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .section p {
      max-width: 800px;
      margin: 10px auto 40px;
      line-height: 1.6;
      font-size: 1rem;
    }

    .section.dark-theme p {
      max-width: 800px;
      margin: 10px auto 40px;
      line-height: 1.6;
      font-size: 1rem;
      color: #ffffff;
    }

    .features {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 50px;
    }

    .feature-item {
      width: 300px;
      padding: 10px;
      gap: 50px;
      /*background: #0E1F4D;
      border-radius: 12px;
      width: 280px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;*/
    }

    /*.feature-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.5);

    }*/

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

    .feature-item h4 {
      font-size: 20px;
      color: #0E1F4D;
      margin-bottom: 8px;
      font-weight: bold;
    }

    .feature-item p {
      font-size: 14px;
      line-height: 20px;
      color: #0E1F4D;
    }

    .feature-item.dark-theme p {
      color: #ffffff;
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

    /* Dark Theme */
    body.dark-theme {
        background-color: #1B1B1B;
        color: #BCCAD7;
    }

    body.dark-theme .icon-circle {
        background-color: #162449;
        color: black;
    }

    body.dark-theme .feature-item h4 {
        color: #ffffff;
    }

    body.dark-theme .feature-item p {
        color: #ffffff;
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
</body>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("darkModeToggle");
        const body = document.body;

        // Cek jika dark mode sudah diaktifkan sebelumnya
        if (localStorage.getItem("dark-theme") === "enabled") {
            body.classList.add("dark-theme");
            toggle.checked = true;
        }

        toggle.addEventListener("change", function () {
            if (this.checked) {
                body.classList.add("dark-theme");
                localStorage.setItem("dark-theme", "enabled");
            } else {
                body.classList.remove("dark-theme");
                localStorage.setItem("dark-theme", "disabled");
            }
        });
    });
</script>


