<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EdVise</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                <img src="{{ asset('images/contoh-about.png') }}" alt="Tentang Kami" />
                </div>
                <div class="about-text">
                    <h1>Tentang Kami</h1>
                    <p>EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami gaya belajar siswa secara personal. Kami menggabungkan data, teknologi, dan insight pendidikan untuk memberikan rekomendasi pengajaran yang tepat sasaran.</p>
                    <a href="{{ route('pelajari') }}" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.about-section {
    background: linear-gradient(180deg, #111F43, #000D30); /* Gradasi dari atas ke bawah */
    padding: 100px 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

.about-content {
    display: flex;
    flex-direction: row; /* Ini bikin gambar dan teks berdampingan */
    flex-wrap: wrap;
    align-items: center;
    gap: 100px;
}

.about-image img {
    width: 400%;
    height: 300%;
    max-width: 450px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.about-text {
    flex: 1; /* Biar teks fleksibel lebarnya */
    color: white;
    gap: 30px;
}

.about-text h1 {
    margin: 0;
    color: #ffffff;
    font-size: 40px;
    font-weight: bold;
    line-height: 56px;
}

.about-text p {
    font-size: 20px;
    color: #ffffff;
    line-height: 28px;
    margin-top: 20px;
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

/* Dark Theme */

body.dark-theme {
    background-color: #1B1B1B;
}

body.dark-theme .about-section {
    background: linear-gradient(180deg, #162449, #0B1531); /* Gradasi dari atas ke bawah */
}

body.dark-theme .btn-primary {
    background-color: #F481B4;
    color: #ffffff;
}

/*biar responsif*/
@media (max-width: 768px) { 
.about-content { 
    flex-direction: column;
    text-align: center;
}

.about-text h1 {
    font-size: 40px;
    line-height: 54px;
}
}
</style>

