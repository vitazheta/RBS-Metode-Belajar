<!-- filepath: c:\Users\ASUS\RekomendasiBelajar\resources\views\layouts\footer.blade.php -->
<footer class="outer-container">
    <div class="container-footer">
        <div class="row">
            <!-- Kolom 1: Tentang -->
            <div class="col-md-6">
                <img src="{{ asset('images/logo kecil.png') }}" alt="Logo" style="height: 20px; margin-bottom: 10px;">
                <h5>Tentang kami</h5>
                <p>EdVise adalah platform pembelajaran cerdas yang membantu pendidik memahami gaya belajar siswa secara personal.</p>
            </div>

            <!-- Kolom 2: Navigasi -->
            <div class="col-md-2">
                <h5>Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('pelajari') }}" class="text-white text-decoration-none">Info</a></li>
                    <li><a href="{{ route('kelas.index') }}" class="text-white text-decoration-none">Daftar Kelas</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak -->
            <div class="col-md-4">
                <h5>Kontak</h5>
                <p>Email: pddiktilayananpmb@gmail.com</p>
                <p>Telepon: +62 812 2040 1530</p>
                <div>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center mt-4">
            <p class="mb-0">&copy; 2025 EdVise. All rights reserved.</p>
    </div>
</footer>

<style>
footer {
    background-color: #111F43; /* Warna latar belakang footer */
    color: #ffffff; /* Warna teks */
    font-family: Poppins, sans-serif;
    padding-top: 15px;
}

footer a {
    color: #84A7CF; /* Warna tautan */
    transition: color 0.3s ease;
    font-size: 14px;;
}

footer a:hover {
    color: #F37AB0; /* Warna tautan saat hover */
}

.container-footer {
    padding-left: 50px; /* Tambahkan ruang di sisi kiri */
    padding-right: 20px; /* Tambahkan ruang di sisi kanan */
    margin-top: 50px;
}

.container-footer h5 {
    font-weight: bold; /* Tebalkan judul */
}
.container-footer p {
    font-size: 14px; /* Ukuran font untuk teks */
}

footer .col-md-4 {
    padding-left: 15px; /* Tambahkan ruang di sisi kiri */
    padding-right: 25px; /* Tambahkan ruang di sisi kanan */
}

.copyright {
    background-color: #F37AB0;
    color: #FFFFFF;
    padding: 10px;
    max-width: 100%;
    max-height: max-content;
}
</style>