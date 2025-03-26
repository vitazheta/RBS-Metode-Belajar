<!-- Banner Section -->
<section class="banner d-flex align-items-center py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Teks Animasi -->
            <div class="col-lg-6 text-center text-lg-start">
                <h1 id="animatedText" class="fw-bold"></h1>
                <p class="text-muted">Sistem kami membantu mahasiswa menemukan gaya belajar terbaik berdasarkan analisis data.</p>
                <a href="#" class="btn btn-danger mt-3">Pelajari Lebih Lanjut</a>
            </div>
            <!-- Gambar Produk -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/img-banner.gif') }}" alt="Produk Web" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

<!-- Tambahkan CSS -->
<style>
    .banner {
        background: #f8f9fa;
        min-height: 60vh;
    }

    /* Gaya untuk teks animasi */
    #animatedText {
        font-family: 'Poppins', sans-serif;
        font-size: 42px; /* Ukuran lebih besar */
        font-weight: bold;
        color: #C70039; /* Warna merah gelap */
    }
</style>

<!-- Tambahkan Animasi JS -->
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

        document.getElementById("animatedText").textContent = letter;

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
            document.getElementById("animatedText").textContent = letter;
            setTimeout(eraseEffect, speed / 2);
        } else {
            count++;
            index = 0;
            setTimeout(typeEffect, speed);
        }
    }

    document.addEventListener("DOMContentLoaded", typeEffect);
</script>
