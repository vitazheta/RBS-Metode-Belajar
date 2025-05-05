<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;

class HasilRekomendasiController extends Controller
{
    public function show($id)
    {
        // Ambil data kelas berdasarkan id
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
    
        // Cek apakah dosen yang login adalah pemilik kelas ini
        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }
    
        // Ambil semua data mahasiswa di kelas tersebut
        $mahasiswa = DataMahasiswa::where('kelas_id', $kelas->id)->get();
    
        // Persiapkan data untuk chart berdasarkan jalur masuk
        $jalurMasuk = ['SNBP', 'SNBT', 'Mandiri'];
        $chartData = [];
    
        foreach ($jalurMasuk as $jalur) {
            $data = $mahasiswa->where('jalur_masuk', $jalur);
    
            $chartData[$jalur] = [
                'akademik_endurance' => $data->avg('akademik_endurance') ?? 0,
                'latar_belakang' => $data->avg('latar_belakang') ?? 0,
                'pola_belajar' => $data->avg('pola_belajar') ?? 0,
                'perkuliahan' => $data->avg('perkuliahan') ?? 0,
            ];
        }

        // Panggil fungsi rekomendasiBelajar
        $rekomendasi = $this->rekomendasiBelajar($chartData);

        // Tampilkan view hasil rekomendasi
        return view('hasil_rekomendasi', [
            'kelas' => $kelas,
            'chartData' => $chartData,
            'rekomendasi' => $rekomendasi['rekomendasi'], // Rekomendasi untuk setiap aspek
            'alasan' => $rekomendasi['alasan'], // Alasan untuk setiap aspek
        ]);
    }
    
    // MEMBUAT RULE REKOMENDASI BELAJAR
    public function rekomendasiBelajar($data)
    {
        $rekomendasi = [];
        $alasan = [];

        $aspekList = ['akademik_endurance', 'latar_belakang', 'pola_belajar', 'perkuliahan'];

        foreach ($aspekList as $aspek) {
            $snbp = $data['SNBP'][$aspek] ?? 0;
            $snbt = $data['SNBT'][$aspek] ?? 0;
            $mandiri = $data['Mandiri'][$aspek] ?? 0;

            $kategori = function ($nilai) {
                if ($nilai <= 2) return 'rendah';
                if ($nilai <= 3) return 'sedang';
                return 'tinggi';
            };

            $kat_snbp = $kategori($snbp);
            $kat_snbt = $kategori($snbt);
            $kat_mandiri = $kategori($mandiri);

            $key = "$kat_snbp-$kat_snbt-$kat_mandiri";

            // Pilih rule set dan alasan berdasarkan aspek
            switch ($aspek) {
                case 'akademik_endurance':
                    $ruleSet = $this->getRuleSetAkademik();
                    $alasanSet = $this->getAlasanAkademik();
                    break;
                case 'latar_belakang':
                    $ruleSet = $this->getRuleSetLatarBelakang();
                    $alasanSet = $this->getAlasanLatarBelakang();
                    break;
                case 'pola_belajar':
                    $ruleSet = $this->getRuleSetPolaBelajar();
                    $alasanSet = $this->getAlasanPolaBelajar();
                    break;
                case 'perkuliahan':
                    $ruleSet = $this->getRuleSetProsesKuliah();
                    $alasanSet = $this->getAlasanProsesKuliah();
                    break;
                default:
                    $ruleSet = [];
                    $alasanSet = [];
                    break;
            }

            // Ambil rekomendasi dan alasan berdasarkan key
            $rekomendasi[$aspek] = $ruleSet[$key] ?? 'Gunakan pendekatan adaptif sesuai kondisi kelas.';
            $alasan[$aspek] = $alasanSet[$key] ?? 'Alasan belum tersedia untuk kategori ini.';
        }

        // Tampilkan rekomendasi dan alasan
        return ['rekomendasi' => $rekomendasi, 'alasan' => $alasan];
    }

    // ini rule nya masih ngaco sih sebenernya, harus diperbaiki lagi euy
    // Fungsi untuk mendapatkan rule set akademik
    private function getRuleSetAkademik()
    {
        return [
            'rendah-rendah-rendah' => 'strategi penguatan konsep dasar secara perlahan dan intensif',
            'rendah-rendah-sedang' => 'penggunaan modul sederhana dan penjelasan lebih visual',
            'rendah-rendah-tinggi' => 'metode campuran dengan mentor dari jalur mandiri',
            'rendah-sedang-rendah' => 'bimbingan kelompok dan penilaian formatif berkala',
            'rendah-sedang-sedang' => 'pembelajaran kooperatif untuk meningkatkan daya serap',
            'rendah-sedang-tinggi' => 'model pembelajaran berbasis masalah untuk mengaktifkan kelas',
            'rendah-tinggi-rendah' => 'aktivitas kolaboratif lintas kemampuan akademik',
            'rendah-tinggi-sedang' => 'diskusi terstruktur dan studi kasus',
            'rendah-tinggi-tinggi' => 'model flipped classroom dan refleksi individu',
            'sedang-rendah-rendah' => 'penyesuaian tempo belajar dan pendampingan untuk jalur rendah',
            'sedang-rendah-sedang' => 'pembelajaran aktif berbasis praktik langsung',
            'sedang-rendah-tinggi' => 'penugasan kelompok dan presentasi',
            'sedang-sedang-rendah' => 'kuis harian dan refleksi kelompok',
            'sedang-sedang-sedang' => 'pembelajaran berbasis proyek kecil',
            'sedang-sedang-tinggi' => 'tantangan bertingkat untuk meningkatkan motivasi',
            'sedang-tinggi-rendah' => 'mentor sebaya untuk pendampingan akademik',
            'sedang-tinggi-sedang' => 'simulasi dan diskusi aktif',
            'sedang-tinggi-tinggi' => 'eksplorasi topik melalui mini riset',
            'tinggi-rendah-rendah' => 'peran aktif jalur SNBP untuk mendampingi',
            'tinggi-rendah-sedang' => 'penguatan jalur rendah dengan modul adaptif',
            'tinggi-rendah-tinggi' => 'integrasi peer-learning',
            'tinggi-sedang-rendah' => 'proyek kolaboratif antar jalur',
            'tinggi-sedang-sedang' => 'eksplorasi materi dan diskusi terbuka',
            'tinggi-sedang-tinggi' => 'riset mini dan presentasi terbuka',
            'tinggi-tinggi-rendah' => 'penguatan belajar mandiri untuk jalur Mandiri',
            'tinggi-tinggi-sedang' => 'simulasi nyata dan tantangan belajar',
            'tinggi-tinggi-tinggi' => 'pembelajaran berbasis proyek dan eksploratif sepenuhnya'
        ];
    }

    private function getAlasanAkademik()
    {
        return [
            'rendah-rendah-rendah' => 'rata-rata mahasiswa SNBP, SNBT, dan Mandiri masih memerlukan bimbingan akademik yang lebih dalam',
            'rendah-rendah-sedang' => 'mahasiswa SNBP dan SNBT memerlukan penguatan akademik, sementara mahasiswa Mandiri cukup stabil',
            'rendah-rendah-tinggi' => 'mahasiswa SNBP dan SNBT memerlukan bimbingan, sementara mahasiswa Mandiri sudah memiliki kemampuan akademik yang baik',
            'rendah-sedang-rendah' => 'mahasiswa SNBP dan Mandiri memerlukan bimbingan, sementara mahasiswa SNBT cukup stabil',
            'rendah-sedang-sedang' => 'mahasiswa SNBP memerlukan bimbingan, sementara mahasiswa SNBT dan Mandiri cukup stabil',
            'rendah-sedang-tinggi' => 'mahasiswa SNBP memerlukan bimbingan, sementara mahasiswa SNBT cukup stabil dan mahasiswa Mandiri sudah baik',
            'rendah-tinggi-rendah' => 'mahasiswa SNBP dan Mandiri memerlukan bimbingan, sementara mahasiswa SNBT sudah baik',
            'rendah-tinggi-sedang' => 'mahasiswa SNBP memerlukan bimbingan, sementara mahasiswa SNBT sudah baik dan mahasiswa Mandiri cukup stabil',
            'rendah-tinggi-tinggi' => 'mahasiswa SNBP memerlukan bimbingan, sementara mahasiswa SNBT dan Mandiri sudah baik',
            'sedang-rendah-rendah' => 'mahasiswa SNBT dan Mandiri memerlukan bimbingan, sementara mahasiswa SNBP cukup stabil',
            'sedang-rendah-sedang' => 'mahasiswa SNBT memerlukan bimbingan, sementara mahasiswa SNBP cukup stabil dan mahasiswa Mandiri sudah baik',
            'sedang-rendah-tinggi' => 'mahasiswa SNBT memerlukan bimbingan, sementara mahasiswa SNBP dan Mandiri sudah baik',
            'sedang-sedang-rendah' => 'mahasiswa Mandiri memerlukan bimbingan, sementara mahasiswa SNBP dan SNBT cukup stabil',
            'sedang-sedang-sedang' => 'mahasiswa SNBP, SNBT, dan Mandiri cukup stabil dalam kemampuan akademik',
            'sedang-sedang-tinggi' => 'mahasiswa SNBP dan SNBT cukup stabil, sementara mahasiswa Mandiri sudah baik',
            'sedang-tinggi-rendah' => 'mahasiswa Mandiri memerlukan bimbingan, sementara mahasiswa SNBP dan SNBT sudah baik',
            'sedang-tinggi-sedang' => 'mahasiswa SNBP cukup stabil, sementara mahasiswa SNBT dan Mandiri sudah baik',
            'sedang-tinggi-tinggi' => 'mahasiswa SNBP, SNBT, dan Mandiri sudah baik dalam kemampuan akademik',
            'tinggi-rendah-rendah' => 'mahasiswa SNBT dan Mandiri memerlukan bimbingan, sementara mahasiswa SNBP sudah baik',
            'tinggi-rendah-sedang' => 'mahasiswa SNBT memerlukan bimbingan, sementara mahasiswa SNBP sudah baik dan mahasiswa Mandiri cukup stabil',
            'tinggi-rendah-tinggi' => 'mahasiswa SNBT memerlukan bimbingan, sementara mahasiswa SNBP dan Mandiri sudah baik',
            'tinggi-sedang-rendah' => 'mahasiswa Mandiri memerlukan bimbingan, sementara mahasiswa SNBP sudah baik dan mahasiswa SNBT cukup stabil',
            'tinggi-sedang-sedang' => 'mahasiswa SNBP sudah baik, sementara mahasiswa SNBT dan Mandiri cukup stabil',
            'tinggi-sedang-tinggi' => 'mahasiswa SNBP dan Mandiri sudah baik, sementara mahasiswa SNBT cukup stabil',
            'tinggi-tinggi-rendah' => 'mahasiswa Mandiri memerlukan bimbingan, sementara mahasiswa SNBP dan SNBT sudah baik',
            'tinggi-tinggi-sedang' => 'mahasiswa SNBP dan SNBT sudah baik, sementara mahasiswa Mandiri cukup stabil',
            'tinggi-tinggi-tinggi' => 'mahasiswa SNBP, SNBT, dan Mandiri sudah sangat baik dalam kemampuan akademik'
        ];
    }

    // Fungsi untuk mendapatkan rule set latar belakang
    private function getRuleSetLatarBelakang()
    {
        return [
            'rendah-rendah-rendah' => 'penggunaan media pembelajaran gratis dan fleksibel',
            'rendah-rendah-sedang' => 'akses ke materi offline dan jadwal belajar fleksibel',
            'rendah-rendah-tinggi' => 'kombinasi pembelajaran daring-luring yang hemat biaya',
            'rendah-sedang-rendah' => 'penguatan melalui media sederhana seperti papan tulis',
            'rendah-sedang-sedang' => 'pembelajaran berbasis proyek dengan bahan seadanya',
            'rendah-sedang-tinggi' => 'daring ringan, gunakan WA group atau PDF interaktif',
            'rendah-tinggi-rendah' => 'kerjasama sosial antar mahasiswa',
            'rendah-tinggi-sedang' => 'pemanfaatan teknologi low-cost',
            'rendah-tinggi-tinggi' => 'gunakan LMS yang ramah kuota',
            'sedang-rendah-rendah' => 'pengumpulan tugas fleksibel dan bahan cetak',
            'sedang-rendah-sedang' => 'akses materi berbasis komunitas kelas',
            'sedang-rendah-tinggi' => 'sumber belajar digital minimalis',
            'sedang-sedang-rendah' => 'video pembelajaran ringan dan interaktif',
            'sedang-sedang-sedang' => 'kombinasi daring ringan dan diskusi langsung',
            'sedang-sedang-tinggi' => 'akses terbuka ke platform edukasi daring',
            'sedang-tinggi-rendah' => 'model bimbingan kelompok kecil',
            'sedang-tinggi-sedang' => 'pembelajaran campuran (hybrid)',
            'sedang-tinggi-tinggi' => 'pembelajaran aktif dengan dukungan digital',
            'tinggi-rendah-rendah' => 'penguatan moral support dan peralatan bersama',
            'tinggi-rendah-sedang' => 'akses bahan ajar mandiri',
            'tinggi-rendah-tinggi' => 'penguatan kepercayaan diri jalur bawah',
            'tinggi-sedang-rendah' => 'fasilitasi akses belajar untuk yang ekonominya lemah',
            'tinggi-sedang-sedang' => 'pengembangan kreativitas dengan anggaran terbatas',
            'tinggi-sedang-tinggi' => 'eksplorasi tools digital premium',
            'tinggi-tinggi-rendah' => 'bantuan subsidi kuota untuk mahasiswa jalur bawah',
            'tinggi-tinggi-sedang' => 'model belajar fleksibel dan mandiri',
            'tinggi-tinggi-tinggi' => 'eksperimen pembelajaran inovatif'
        ];
    }

    private function getAlasanLatarBelakang()
    {
        return [
            'rendah-rendah-rendah' => 'Mahasiswa dari jalur SNBP, SNBT, dan Mandiri memiliki latar belakang yang kurang mendukung: berasal dari sekolah dengan fasilitas terbatas, orang tua berpendidikan rendah, dan kondisi ekonomi lemah.',
            'rendah-rendah-sedang' => 'Mahasiswa SNBP dan SNBT memiliki latar belakang kurang mendukung, sedangkan mahasiswa Mandiri berasal dari keluarga dengan ekonomi cukup dan pendidikan orang tua yang lebih baik.',
            'rendah-rendah-tinggi' => 'Mahasiswa SNBP dan SNBT berasal dari latar belakang yang terbatas, namun mahasiswa Mandiri berasal dari sekolah yang baik, orang tua berpendidikan tinggi, dan ekonomi kuat.',
            'rendah-sedang-rendah' => 'Mahasiswa SNBP berasal dari latar belakang terbatas, mahasiswa SNBT memiliki latar belakang sedang, dan mahasiswa Mandiri berasal dari kondisi ekonomi lemah.',
            'rendah-sedang-sedang' => 'Mahasiswa SNBP memiliki latar belakang terbatas, mahasiswa SNBT dan Mandiri memiliki latar belakang yang cukup baik secara pendidikan dan ekonomi.',
            'rendah-sedang-tinggi' => 'Mahasiswa SNBP memiliki latar belakang terbatas, mahasiswa SNBT cukup baik, dan mahasiswa Mandiri sangat kuat dalam hal sekolah asal, dukungan orang tua, dan ekonomi.',
            'rendah-tinggi-rendah' => 'Mahasiswa SNBP berasal dari latar belakang terbatas, mahasiswa SNBT sangat baik, sedangkan mahasiswa Mandiri kurang mendukung secara ekonomi dan pendidikan.',
            'rendah-tinggi-sedang' => 'Mahasiswa SNBP berasal dari latar belakang terbatas, SNBT sangat baik, dan Mandiri cukup stabil secara ekonomi dan pendidikan.',
            'rendah-tinggi-tinggi' => 'Mahasiswa SNBP berasal dari latar belakang kurang mendukung, SNBT dan Mandiri berasal dari latar belakang yang kuat dan mapan.',
            'sedang-rendah-rendah' => 'Mahasiswa SNBP memiliki latar belakang sedang, SNBT dan Mandiri berasal dari sekolah, keluarga, dan kondisi ekonomi yang kurang mendukung.',
            'sedang-rendah-sedang' => 'Mahasiswa SNBP cukup baik, SNBT terbatas, dan Mandiri cukup stabil secara latar belakang.',
            'sedang-rendah-tinggi' => 'Mahasiswa SNBP cukup kuat secara latar belakang, SNBT terbatas, dan Mandiri sangat mendukung secara ekonomi dan pendidikan.',
            'sedang-sedang-rendah' => 'Semua jalur memiliki latar belakang sedang, kecuali mahasiswa Mandiri yang berasal dari kondisi kurang mendukung.',
            'sedang-sedang-sedang' => 'Mahasiswa dari ketiga jalur masuk memiliki latar belakang yang cukup baik namun belum maksimal.',
            'sedang-sedang-tinggi' => 'Mahasiswa SNBP dan SNBT memiliki latar belakang yang cukup, sedangkan mahasiswa Mandiri berasal dari latar belakang yang sangat kuat.',
            'sedang-tinggi-rendah' => 'Mahasiswa SNBP cukup baik, SNBT sangat baik, namun mahasiswa Mandiri berasal dari latar belakang yang kurang mendukung.',
            'sedang-tinggi-sedang' => 'Mahasiswa SNBP cukup baik, SNBT sangat kuat, dan Mandiri cukup stabil.',
            'sedang-tinggi-tinggi' => 'Mahasiswa SNBP cukup baik, SNBT dan Mandiri berasal dari latar belakang yang sangat kuat.',
            'tinggi-rendah-rendah' => 'Mahasiswa SNBP berasal dari latar belakang yang kuat, namun SNBT dan Mandiri dari latar belakang yang terbatas.',
            'tinggi-rendah-sedang' => 'Mahasiswa SNBP sangat baik, SNBT terbatas, dan Mandiri cukup baik.',
            'tinggi-rendah-tinggi' => 'SNBP dan Mandiri sangat kuat secara latar belakang, SNBT masih terbatas.',
            'tinggi-sedang-rendah' => 'Mahasiswa SNBP sangat baik, SNBT cukup baik, dan Mandiri masih menghadapi keterbatasan.',
            'tinggi-sedang-sedang' => 'SNBP sangat kuat, SNBT dan Mandiri cukup baik.',
            'tinggi-sedang-tinggi' => 'Mahasiswa SNBP dan Mandiri sangat kuat, SNBT cukup baik.',
            'tinggi-tinggi-rendah' => 'Mahasiswa SNBP dan SNBT sangat kuat secara latar belakang, Mandiri masih terbatas.',
            'tinggi-tinggi-sedang' => 'Mahasiswa SNBP dan SNBT sangat kuat, Mandiri cukup baik.',
            'tinggi-tinggi-tinggi' => 'Mahasiswa dari semua jalur memiliki latar belakang yang sangat kuat dari segi sekolah, pendidikan orang tua, dan ekonomi.',

        ];
    }

    // Fungsi untuk mendapatkan rule set pola belajar
    private function getRuleSetPolaBelajar()
    {
        return [
            'rendah-rendah-rendah' => 'buat rutinitas belajar dengan penjadwalan',
            'rendah-rendah-sedang' => 'gunakan reminder belajar dan evaluasi harian',
            'rendah-rendah-tinggi' => 'fasilitasi forum belajar bersama',
            'rendah-sedang-rendah' => 'buat kelompok belajar dengan tutor teman',
            'rendah-sedang-sedang' => 'latihan berulang dan target belajar mingguan',
            'rendah-sedang-tinggi' => 'integrasi belajar sambil praktik',
            'rendah-tinggi-rendah' => 'penjadwalan belajar harian wajib',
            'rendah-tinggi-sedang' => 'penggunaan aplikasi belajar',
            'rendah-tinggi-tinggi' => 'flipped classroom dengan tugas refleksi',
            'sedang-rendah-rendah' => 'pelatihan kebiasaan belajar rutin',
            'sedang-rendah-sedang' => 'video pembelajaran dan refleksi',
            'sedang-rendah-tinggi' => 'mentor teman dan sharing sesi',
            'sedang-sedang-rendah' => 'tugas portofolio dan jurnal belajar',
            'sedang-sedang-sedang' => 'pembelajaran mandiri dan sistem kuis',
            'sedang-sedang-tinggi' => 'project-based learning dengan kelompok kecil',
            'sedang-tinggi-rendah' => 'aktivitas aktif dan refleksi personal',
            'sedang-tinggi-sedang' => 'diskusi kelompok dan studi kasus',
            'sedang-tinggi-tinggi' => 'eksplorasi topik sesuai minat',
            'tinggi-rendah-rendah' => 'pemanfaatan minat SNBP untuk mendukung jalur lain',
            'tinggi-rendah-sedang' => 'jalur SNBP mengarahkan ritme belajar',
            'tinggi-rendah-tinggi' => 'sinkronisasi dan diskusi lintas jalur',
            'tinggi-sedang-rendah' => 'bimbingan kelompok adaptif',
            'tinggi-sedang-sedang' => 'pengembangan topik dengan eksplorasi bebas',
            'tinggi-sedang-tinggi' => 'mini project berdurasi pendek',
            'tinggi-tinggi-rendah' => 'penugasan belajar individual jalur Mandiri',
            'tinggi-tinggi-sedang' => 'riset kecil dan refleksi',
            'tinggi-tinggi-tinggi' => 'penelitian mini, proyek kreatif, dan kolaboratif'
        ];
    }

    private function getAlasanPolaBelajar()
    {
        return [
            'rendah-rendah-rendah' => 'Mahasiswa SNBP, SNBT, dan Mandiri cenderung punya gaya belajar yang santai dan tidak terlalu terikat jadwal. Belajar dilakukan saat dibutuhkan saja.',
            'rendah-rendah-sedang' => 'Mahasiswa SNBP dan SNBT cenderung santai dalam belajar, sementara mahasiswa Mandiri mulai membentuk kebiasaan belajar yang cukup konsisten.',
            'rendah-rendah-tinggi' => 'SNBP dan SNBT belajar dengan gaya fleksibel, sedangkan mahasiswa Mandiri sangat terstruktur dan ambisius dalam belajar.',
            'rendah-sedang-rendah' => 'Mahasiswa SNBP dan Mandiri cenderung santai, sementara SNBT cukup konsisten dengan gaya belajar yang seimbang.',
            'rendah-sedang-sedang' => 'SNBP lebih fleksibel, SNBT dan Mandiri memiliki pola belajar yang lumayan teratur dan berimbang.',
            'rendah-sedang-tinggi' => 'SNBP cenderung santai, SNBT cukup terstruktur, dan mahasiswa Mandiri menunjukkan gaya belajar yang sangat ambisius.',
            'rendah-tinggi-rendah' => 'Mahasiswa SNBP dan Mandiri lebih santai, sementara SNBT sangat aktif, penuh target dan ambisius.',
            'rendah-tinggi-sedang' => 'Mahasiswa SNBP santai, SNBT sangat terstruktur dan ambisius, Mandiri cukup seimbang dalam belajar.',
            'rendah-tinggi-tinggi' => 'Mahasiswa SNBP santai, namun SNBT dan Mandiri menunjukkan gaya belajar yang ambisius dan penuh motivasi.',
            'sedang-rendah-rendah' => 'SNBP cukup teratur, SNBT dan Mandiri lebih santai dan belajar hanya saat dibutuhkan.',
            'sedang-rendah-sedang' => 'Mahasiswa SNBP dan Mandiri cukup seimbang dalam belajar, SNBT cenderung santai.',
            'sedang-rendah-tinggi' => 'SNBP seimbang, SNBT santai, dan Mandiri sangat ambisius dengan gaya belajar yang intens.',
            'sedang-sedang-rendah' => 'Mahasiswa dari SNBP dan SNBT cukup terstruktur, namun Mandiri lebih santai dan fleksibel.',
            'sedang-sedang-sedang' => 'Ketiga jalur memiliki pola belajar yang seimbang, tidak terlalu santai tapi juga tidak terlalu ambisius.',
            'sedang-sedang-tinggi' => 'SNBP dan SNBT cukup terstruktur, Mandiri sangat fokus dan penuh semangat dalam belajar.',
            'sedang-tinggi-rendah' => 'Mahasiswa SNBP cukup teratur, SNBT sangat ambisius, dan Mandiri lebih santai.',
            'sedang-tinggi-sedang' => 'Mahasiswa SNBP dan Mandiri cukup konsisten, SNBT sangat aktif dan punya target belajar yang tinggi.',
            'sedang-tinggi-tinggi' => 'SNBP cukup teratur, SNBT dan Mandiri sangat ambisius dan fokus pada pencapaian.',
            'tinggi-rendah-rendah' => 'Mahasiswa SNBP sangat ambisius, sementara SNBT dan Mandiri lebih santai dalam belajar.',
            'tinggi-rendah-sedang' => 'SNBP sangat aktif, SNBT santai, Mandiri cukup seimbang dalam gaya belajar.',
            'tinggi-rendah-tinggi' => 'Mahasiswa SNBP dan Mandiri sangat terstruktur, SNBT lebih fleksibel dan santai.',
            'tinggi-sedang-rendah' => 'SNBP sangat ambisius, SNBT cukup konsisten, dan Mandiri cenderung santai.',
            'tinggi-sedang-sedang' => 'SNBP sangat fokus, SNBT dan Mandiri cukup terstruktur dan seimbang.',
            'tinggi-sedang-tinggi' => 'SNBP dan Mandiri sangat aktif dan ambisius, SNBT cukup teratur.',
            'tinggi-tinggi-rendah' => 'SNBP dan SNBT sangat ambisius dan punya target, Mandiri lebih fleksibel dan santai.',
            'tinggi-tinggi-sedang' => 'SNBP dan SNBT sangat ambisius, Mandiri cukup terstruktur.',
            'tinggi-tinggi-tinggi' => 'Ketiga jalur mahasiswa memiliki pola belajar yang ambisius, penuh motivasi, dan sangat terencana.',

        ];
    }

    // Fungsi untuk mendapatkan rule set proses kuliah
    private function getRuleSetProsesKuliah()
    {
        return [
            'rendah-rendah-rendah' => 'berikan struktur kuliah yang jelas dan runtut',
            'rendah-rendah-sedang' => 'gunakan LMS dengan panduan jelas',
            'rendah-rendah-tinggi' => 'sediakan bahan ajar sebelum perkuliahan',
            'rendah-sedang-rendah' => 'ulangi materi penting secara berkala',
            'rendah-sedang-sedang' => 'gunakan forum tanya jawab',
            'rendah-sedang-tinggi' => 'kombinasi kuliah & diskusi kelompok',
            'rendah-tinggi-rendah' => 'latih pengambilan keputusan selama kelas',
            'rendah-tinggi-sedang' => 'skenario perkuliahan berbasis studi kasus',
            'rendah-tinggi-tinggi' => 'penggunaan video pembelajaran dan kuis interaktif',
            'sedang-rendah-rendah' => 'buat instruksi kegiatan tertulis',
            'sedang-rendah-sedang' => 'kombinasi sinkron dan asinkron',
            'sedang-rendah-tinggi' => 'diskusi daring dan refleksi pribadi',
            'sedang-sedang-rendah' => 'berikan waktu refleksi dalam sesi kuliah',
            'sedang-sedang-sedang' => 'struktur kelas fleksibel dengan breakout rooms',
            'sedang-sedang-tinggi' => 'model perkuliahan campuran dan debat',
            'sedang-tinggi-rendah' => 'pemahaman konsep lewat proyek individu',
            'sedang-tinggi-sedang' => 'perkuliahan interaktif dengan polling',
            'sedang-tinggi-tinggi' => 'perkuliahan berbasis pengalaman',
            'tinggi-rendah-rendah' => 'SNBP memandu aktivitas kelompok',
            'tinggi-rendah-sedang' => 'penguatan partisipasi jalur bawah',
            'tinggi-rendah-tinggi' => 'penggabungan sesi peer feedback',
            'tinggi-sedang-rendah' => 'pemberian tanggung jawab belajar per kelompok',
            'tinggi-sedang-sedang' => 'simulasi mini perkuliahan',
            'tinggi-sedang-tinggi' => 'kelas interaktif berbasis proyek',
            'tinggi-tinggi-rendah' => 'jalur tinggi membimbing refleksi jalur bawah',
            'tinggi-tinggi-sedang' => 'kegiatan kolaboratif',
            'tinggi-tinggi-tinggi' => 'perkuliahan mandiri, terbuka, dan eksploratif'
        ];
    }

    private function getAlasanProsesKuliah()
    {
        return [
            'rendah-rendah-rendah' => 'Mahasiswa SNBP, SNBT, dan Mandiri cenderung kurang aktif di kelas maupun organisasi, adaptasi masih terbatas, dan UKT menjadi beban yang cukup berat.',
            'rendah-rendah-sedang' => 'Mahasiswa SNBP dan SNBT cenderung kurang aktif, namun mahasiswa Mandiri mulai bisa beradaptasi dan UKT relatif bisa dikelola.',
            'rendah-rendah-tinggi' => 'SNBP dan SNBT masih pasif, namun mahasiswa Mandiri sangat aktif di kampus dan cepat beradaptasi dengan baik.',
            'rendah-sedang-rendah' => 'Mahasiswa SNBP dan Mandiri belum terlalu aktif, SNBT mulai menunjukkan inisiatif dalam perkuliahan dan kegiatan kampus.',
            'rendah-sedang-sedang' => 'SNBP cenderung pasif, SNBT dan Mandiri cukup aktif dan mulai membangun relasi kampus.',
            'rendah-sedang-tinggi' => 'SNBP cenderung pasif, SNBT cukup aktif, dan Mandiri sangat adaptif serta dominan di organisasi.',
            'rendah-tinggi-rendah' => 'SNBP dan Mandiri pasif, SNBT sangat aktif baik di kelas maupun organisasi, cepat membaur.',
            'rendah-tinggi-sedang' => 'SNBP kurang aktif, SNBT sangat aktif, Mandiri mulai aktif dan membangun interaksi sosial kampus.',
            'rendah-tinggi-tinggi' => 'SNBP pasif, namun SNBT dan Mandiri sangat aktif, adaptif, dan tidak terbebani secara ekonomi.',
            'sedang-rendah-rendah' => 'SNBP cukup aktif, SNBT dan Mandiri masih kesulitan adaptasi dan belum terlibat banyak di kampus.',
            'sedang-rendah-sedang' => 'SNBP cukup aktif, SNBT agak pasif, Mandiri cukup baik dalam adaptasi dan partisipasi.',
            'sedang-rendah-tinggi' => 'SNBP cukup aktif, SNBT belum maksimal, dan Mandiri sudah aktif dan tidak terganggu oleh beban ekonomi.',
            'sedang-sedang-rendah' => 'SNBP dan SNBT cukup aktif, Mandiri masih belum banyak terlibat dan UKT menjadi tantangan.',
            'sedang-sedang-sedang' => 'Ketiga jalur menunjukkan tingkat keterlibatan yang cukup dalam pembelajaran dan adaptasi di kampus.',
            'sedang-sedang-tinggi' => 'SNBP dan SNBT cukup aktif, mahasiswa Mandiri sangat adaptif dan aktif di berbagai lini kampus.',
            'sedang-tinggi-rendah' => 'SNBP cukup aktif, SNBT sangat aktif dan adaptif, Mandiri belum terlalu aktif karena faktor ekonomi.',
            'sedang-tinggi-sedang' => 'SNBP cukup aktif, SNBT sangat aktif dan adaptif, Mandiri juga cukup baik meski masih terbatas.',
            'sedang-tinggi-tinggi' => 'SNBP cukup aktif, SNBT dan Mandiri sangat menonjol di kelas dan organisasi kampus.',
            'tinggi-rendah-rendah' => 'SNBP sangat aktif dan adaptif, SNBT dan Mandiri belum terlalu terlibat dan menghadapi kendala adaptasi.',
            'tinggi-rendah-sedang' => 'SNBP sangat adaptif, SNBT belum aktif, Mandiri cukup mampu menyesuaikan diri.',
            'tinggi-rendah-tinggi' => 'SNBP dan Mandiri sangat aktif dan percaya diri, SNBT masih menghadapi tantangan adaptasi.',
            'tinggi-sedang-rendah' => 'SNBP sangat aktif, SNBT cukup baik, Mandiri belum aktif karena terkendala ekonomi atau lingkungan.',
            'tinggi-sedang-sedang' => 'SNBP sangat aktif, SNBT dan Mandiri cukup terlibat dan mulai membangun adaptasi baik.',
            'tinggi-sedang-tinggi' => 'SNBP dan Mandiri sangat aktif, SNBT cukup terlibat, semua mulai menunjukkan performa tinggi.',
            'tinggi-tinggi-rendah' => 'SNBP dan SNBT sangat aktif, Mandiri masih tertinggal dalam keterlibatan kampus.',
            'tinggi-tinggi-sedang' => 'SNBP dan SNBT sangat adaptif dan aktif, Mandiri cukup mengikuti meski belum terlalu menonjol.',
            'tinggi-tinggi-tinggi' => 'Mahasiswa dari ketiga jalur sangat aktif di kelas, organisasi, cepat beradaptasi, dan UKT tidak menghambat pengalaman kuliah mereka.',

        ];
    }

}
