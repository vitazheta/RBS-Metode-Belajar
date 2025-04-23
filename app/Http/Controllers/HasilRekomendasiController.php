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
        return view('hasil_rekomendasi', compact('kelas', 'mahasiswa', 'chartData', 'rekomendasi'));
    }
    
    // MEMBUAT RULE REKOMENDASI BELAJAR
    public function rekomendasiBelajar($data)
    {
        $rekomendasi = [];
    
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
    
            // Pilih rule set berdasarkan aspek
            switch ($aspek) {
                case 'akademik_endurance':
                    $ruleSet = $this->getRuleSetAkademik();
                    break;
                case 'latar_belakang':
                    $ruleSet = $this->getRuleSetLatarBelakang();
                    break;
                case 'pola_belajar':
                    $ruleSet = $this->getRuleSetPolaBelajar();
                    break;
                case 'perkuliahan':
                    $ruleSet = $this->getRuleSetProsesKuliah();
                    break;
                default:
                    $ruleSet = [];
                    break;
            }

            // Ambil rekomendasi berdasarkan key atau gunakan default
            $rekomendasi[$aspek] = $ruleSet[$key] ?? 'Gunakan pendekatan adaptif sesuai kondisi kelas.';
        }

        // Tampilkan rekomendasi
        return $rekomendasi;
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
}
