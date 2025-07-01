<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;

class HasilRekomendasiController extends Controller
{
    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);

        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        $mahasiswa = DataMahasiswa::where('kelas_id', $kelas->id)->get();

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

        $rekomendasi = $this->rekomendasiBelajar($chartData);

        return view('hasil_rekomendasi', [
            'kelas' => $kelas,
            'chartData' => $chartData,
            'rekomendasi' => $rekomendasi['rekomendasi'],
            'alasan' => $rekomendasi['alasan'],
        ]);
    }

    public function rekomendasiBelajar($data)
    {
        $rekomendasi = [];
        $alasan = [];

        $aspekList = ['akademik_endurance', 'latar_belakang', 'pola_belajar', 'perkuliahan'];

        foreach ($aspekList as $aspek) {
            $snbp = $data['SNBP'][$aspek] ?? 0;
            $snbt = $data['SNBT'][$aspek] ?? 0;
            $mandiri = $data['Mandiri'][$aspek] ?? 0;

            $kategori = fn($nilai) => $nilai <= 2 ? 'rendah' : ($nilai <= 3.5 ? 'sedang' : 'tinggi');
            $key = $kategori($snbp) . '-' . $kategori($snbt) . '-' . $kategori($mandiri);

            [$ruleSet, $alasanSet] = match($aspek) {
                'akademik_endurance' => [$this->getRuleSetAkademik(), $this->getAlasanAkademik()],
                'latar_belakang'     => [$this->getRuleSetLatarBelakang(), $this->getAlasanLatarBelakang()],
                'pola_belajar'       => [$this->getRuleSetPolaBelajar(), $this->getAlasanPolaBelajar()],
                'perkuliahan'        => [$this->getRuleSetProsesKuliah(), $this->getAlasanProsesKuliah()],
            };

            $rekomendasi[$aspek] = $ruleSet[$key] ?? 'Gunakan pendekatan adaptif sesuai kondisi kelas.';
            $alasan[$aspek] = $alasanSet[$key] ?? 'Belum tersedia alasan spesifik.';
        }

        return ['rekomendasi' => $rekomendasi, 'alasan' => $alasan];
    }

    private function getRuleSetAkademik()
    {
        return [
            'rendah-rendah-rendah' => 'Perlahan dan intensif, fokus dasar.',
            'sedang-sedang-sedang' => 'Proyek kecil dan refleksi rutin.',
            'tinggi-tinggi-tinggi' => 'Eksplorasi mandiri dan riset lanjut.',
        ];
    }

    private function getAlasanAkademik()
    {
        return [
            'rendah-rendah-rendah' => 'Semua jalur menunjukkan rendahnya daya serap akademik dan ketahanan.',
            'sedang-sedang-sedang' => 'Kelas cukup stabil secara akademik dan endurance.',
            'tinggi-tinggi-tinggi' => 'Mahasiswa sangat siap akademik dan gigih secara mental.',
        ];
    }

    private function getRuleSetLatarBelakang()
    {
        return [
            'rendah-rendah-rendah' => 'Gunakan media belajar hemat biaya dan dukungan moral.',
            'sedang-sedang-sedang' => 'Fasilitasi kolaborasi antar latar ekonomi/pendidikan.',
            'tinggi-tinggi-tinggi' => 'Dorong kreativitas dan penggunaan teknologi lanjutan.',
        ];
    }

    private function getAlasanLatarBelakang()
    {
        return [
            'rendah-rendah-rendah' => 'Mayoritas mahasiswa berasal dari latar pendidikan dan ekonomi lemah.',
            'sedang-sedang-sedang' => 'Latar belakang mahasiswa cenderung cukup baik dan beragam.',
            'tinggi-tinggi-tinggi' => 'Mahasiswa berasal dari sekolah dan keluarga dengan dukungan penuh.',
        ];
    }

    private function getRuleSetPolaBelajar()
    {
        return [
            'rendah-rendah-rendah' => 'Latih kebiasaan belajar dan penjadwalan belajar rutin.',
            'sedang-sedang-sedang' => 'Gunakan kuis dan proyek kecil untuk membentuk kebiasaan.',
            'tinggi-tinggi-tinggi' => 'Berikan proyek eksploratif dan diskusi terbuka.',
        ];
    }

    private function getAlasanPolaBelajar()
    {
        return [
            'rendah-rendah-rendah' => 'Mahasiswa belajar hanya saat dibutuhkan, belum terbiasa dengan pola belajar teratur.',
            'sedang-sedang-sedang' => 'Pola belajar cukup seimbang antar jalur.',
            'tinggi-tinggi-tinggi' => 'Ketiga jalur menunjukkan pola belajar terencana dan konsisten.',
        ];
    }

    private function getRuleSetProsesKuliah()
    {
        return [
            'rendah-rendah-rendah' => 'Beri struktur kuliah yang jelas dan dukungan tambahan.',
            'sedang-sedang-sedang' => 'Gunakan pendekatan campuran (sinkron dan asinkron).',
            'tinggi-tinggi-tinggi' => 'Dorong diskusi eksploratif dan mini riset.',
        ];
    }

    private function getAlasanProsesKuliah()
    {
        return [
            'rendah-rendah-rendah' => 'Semua jalur masih kesulitan adaptasi dan keterlibatan kuliah.',
            'sedang-sedang-sedang' => 'Partisipasi kelas cukup baik di semua jalur.',
            'tinggi-tinggi-tinggi' => 'Mahasiswa aktif, adaptif, dan antusias dalam perkuliahan.',
        ];
    }
}
