<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Banner Section -->
<section id="banner" class="position-relative">
    <!-- Carousel Background -->
    <div id="backgroundCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel1-raw.png') }}');"></div>
                <!-- Overlay putih -->
                <div class="carousel-overlay-color"></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel2-raw.png') }}');"></div>
                <!-- Overlay putih -->
                <div class="carousel-overlay-color"></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel3-raw.png') }}');"></div>
                <!-- Overlay putih -->
                <div class="carousel-overlay-color"></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/carousel4-raw.png') }}');"></div>
                <!-- Overlay putih -->
                <div class="carousel-overlay-color"></div>
            </div>
        </div>
    </div>
    <!-- Overlay konten di atas carousel -->
    <div class="carousel-overlay d-flex align-items-center py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Teks Animasi -->
                <div class="col-lg-6 text-center text-lg-start">
                    <img src="{{ asset('images/textlogo-navy.png') }}" alt="Gambar Baru" class="img-fluid text-logo">
                    <h1 id="animatedText" class="fw-bold"></h1>
                    <p class="text-muted">Sistem kami membantu mahasiswa menemukan gaya belajar terbaik berdasarkan analisis data.</p>
                    <a href="{{ route('pelajari') }}" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
                </div>
                <!-- Gambar Produk -->
                <div class="col-lg-6 text-center">
                <img src="{{ asset('images/logo-banner.png') }}" alt="Produk Web" class="img-fluid rounded shadow img-banner floating">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider Section -->
<section id="divider" class="divider-section text-center py-5">
    <h2 class="text-white">"Optimalkan Gaya Belajar Mahasiswa dengan Teknologi Modern"</h2>
</section>

<!-- Tambahkan CSS -->
<style>
.banner {
    margin-top: none;
}

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

    /* Image Carousel */
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
    height: 100vh;
    /*background: rgba(14, 31, 77, 0.7); /* semi-transparent navy overlay */
    }

    .carousel-overlay-color {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8); /* Warna putih dengan transparansi 70% */
        z-index: 1; /* Pastikan overlay berada di atas gambar */
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
        font-family: 'Poppins', sans-serif;
        font-size: 56px;
        font-weight: bold;
        line-height: 72px;
        color: #0E1F4D;
    }

    .carousel-overlay p {
        font-size: 14px;
        line-height: 20px;
        color: #0E1F4D;
        font-family: 'Poppins', sans-serif;
    }

    .text-muted {
        color: #0E1F4D !important;
    }

    .btn-primary {
        background-color: var(--accent-color);
        color: var(--text-color);
        font-size: 14px;
        line-height: 20px;
        font-family: 'Poppins', sans-serif;
        border: none;
    }

    .btn-primary:hover {
        background-color: #E2A6C1;
        color: var(--text-color);
        font-size: 14px;
        line-height: 20px;
        font-family: 'Poppins', sans-serif;
        border: none;
    }

    /* Animasi Logo */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    .floating {
        /* animation: float 3s ease-in-out infinite; */
        animation: float 2s linear infinite;
    }

    .divider-section {
        background: linear-gradient(135deg, #0E1F4D 0%, #3F5694 30%, #000D30 100%); /* Gradasi dengan efek pantulan */
        color: #ffffff; /* Warna teks */
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        line-height: 1.5;
        letter-spacing: 1px;
        margin: 0;
        padding: 50px 0;
        position: relative;
        overflow: hidden;
        opacity: 0; /* Awalnya tidak terlihat */
        transform: translateY(50px); /* Awalnya bergeser ke bawah */
        transition: all 1s ease-in-out; /* Animasi transisi */
    }

    .divider-section.animate {
        opacity: 1; /* Muncul */
        transform: translateY(0); /* Kembali ke posisi semula */
    }

    .divider-section h2 {
        margin: 0;
        animation: fadeInUp 4s ease-in; /* Animasi saat muncul */
        font-size: 20px;
    }

    /* Animasi Fade In Up */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 2.0s ease-in-out;
    }

    .animate-on-scroll.animate {
        opacity: 1;
        transform: translateY(0);
    }

    /* Dark Theme */
    body.dark-theme {
        color: #FFFFFF;
    }

    body.dark-theme .carousel-overlay-color {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(27, 27, 27, 0.9); /* Warna putih dengan transparansi 70% */
        z-index: 1; /* Pastikan overlay berada di atas gambar */
    }

    body.dark-theme #animatedText {
        font-family: 'Poppins', sans-serif;
        font-size: 56px;
        font-weight: bold;
        line-height: 72px;
        color: #FFFFFF;
    }

    body.dark-theme .carousel-overlay p {
        font-size: 14px;
        line-height: 20px;
        color: #FFFFFF;
        font-family: 'Poppins', sans-serif;
    }

    body.dark-theme .text-muted {
        color: #FFFFFF !important;
    }

    body.dark-theme .btn-primary:hover {
        background-color: #E2A6C1;
        color: var(--text-color);
        font-size: 14px;
        line-height: 20px;
        font-family: 'Poppins', sans-serif;
        border: none;
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
            { threshold: 0.5 } // Elemen terlihat 50% sebelum animasi dimulai
        );

        const divider = document.querySelector("#divider");
        if (divider) {
            observer.observe(divider);
        }
    });
</script>
