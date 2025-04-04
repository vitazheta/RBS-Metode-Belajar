<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">

<!-- Banner Section -->
<section class="banner d-flex align-items-center py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Teks Animasi -->
            <div class="col-lg-6 text-center text-lg-start">
                <img src="{{ asset('images/textlogo.png') }}" alt="Gambar Baru" class="img-fluid text-logo">
                <h1 id="animatedText" class="fw-bold"></h1>
                <p class="text-muted">Sistem kami membantu mahasiswa menemukan gaya belajar terbaik berdasarkan analisis data.</p>
                <a href="#" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
            </div>
            <!-- Gambar Produk -->
            <div class="col-lg-6 text-center">
            <img src="{{ asset('images/logo-banner.png') }}" alt="Produk Web" class="img-fluid rounded shadow img-banner">
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan CSS -->
<style>
    .img-banner {
    max-width: 80%; /* Ubah ukuran sesuai kebutuhan, misal 80% dari parent */
    height: auto; /* Menjaga proporsi gambar */
    box-shadow: none !important; /* Menghilangkan shadow */
    }

    .text-logo {
    width: 150px; /* Sesuaikan ukuran lebar */
    height: auto; /* Biarkan tinggi menyesuaikan proporsi */
    box-shadow: none !important; /* Menghilangkan shadow */
    }



    /* Warna sesuai color palette */
    :root {
        --primary-color: #0E1F4D; /* Navy */
        --secondary-color: #84A7CF; /* Light Blue */
        --accent-color: #F37AB0; /* Pink */
        --secondary-accent-color: #E6CAD9; /* Light Pink */
        --text-color: #ffffff; /* White */
        --dark-text-color: #000000; /* Black */
    }

    .banner {
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color)); 
        min-height: 100vh;
    }

    /* Gaya untuk teks animasi */
    #animatedText {
        font-family: 'Montserrat', sans-serif;
        font-size: 64px;
        font-weight: bold;
        color: var(--text-color); /* Navy */
    }

    .text-muted {
        color: var(--text-color) !important;
    }

    .btn-primary {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        color: var(--text-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-accent-color);
        border-color: var(--secondary-accent-color);
        color: var(--primary-color);
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
