<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Rule;

// Controller untuk menampilkan hasil rekomendasi kelas
class HasilRekomendasiController extends Controller
{
    // Menampilkan hasil rekomendasi berdasarkan ID kelas
    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        $students = $kelas->mahasiswa;
        $jalurList = ['SNBP', 'SNBT', 'MANDIRI'];

        // Jika tidak ada mahasiswa
        if ($students->isEmpty()) {
            return view('hasil_rekomendasi', [
                'kelas' => $kelas,
                'students' => $students,
                'KondisiDominan' => [
                    'kondisi' => '-',
                    'rekomendasi' => '-',
                    'persentase' => 0,
                ],
                'PersentaseRekomendasi' => 0,
                'chartData' => [],
                'jumlahPerJalur' => [],
                'persentaseKecocokanJalur' => [],
            ]);
        }

        // Konversi nilai ke kategori teks untuk setiap mahasiswa
        $students->each(function ($mhs) {
            $mhs->akademik_text = $this->getKategoriText('akademik', $mhs->akademik_total);
            $mhs->sekolah_text = $this->getKategoriText('sekolah', $mhs->sekolah_total);
            $mhs->ekonomi_text = $this->getKategoriText('ekonomi', $mhs->ekonomi_total);
            $mhs->perkuliahan_text = $this->getKategoriText('perkuliahan', $mhs->perkuliahan_total);
        });

        // Ambil kombinasi kategori tiap mahasiswa
        $kombinasiList = [];
        foreach ($students as $student) {
            $kombinasiList[] = json_encode([
                'akademik' => $student->akademik_text,
                'sekolah' => $student->sekolah_text,
                'ekonomi' => $student->ekonomi_text,
                'perkuliahan' => $student->perkuliahan_text,
            ]);
        }

        // Cari kombinasi dominan
        $kombinasiCount = array_count_values($kombinasiList);
        arsort($kombinasiCount);
        $dominantKombinasiJson = array_key_first($kombinasiCount);
        $dominantKombinasi = $dominantKombinasiJson ? json_decode($dominantKombinasiJson, true) : null;

        // Ambil rule dominan
        $ruleDominan = null;
        if ($dominantKombinasi) {
            $ruleDominan = Rule::where([
                'akademik' => $dominantKombinasi['akademik'],
                'sekolah' => $dominantKombinasi['sekolah'],
                'ekonomi' => $dominantKombinasi['ekonomi'],
                'perkuliahan' => $dominantKombinasi['perkuliahan'],
            ])->first();
        }

        // Siapkan kalimat kondisi & rekomendasi
        $kalimat = $this->generateKalimatRekomendasi($dominantKombinasi, $ruleDominan);

        // Hitung jumlah mahasiswa per jalur
        $jumlahPerJalur = [];
        foreach ($jalurList as $jalur) {
            $jumlahPerJalur[$jalur] = $students->where('jalur_masuk', $jalur)->count();
        }

        // Persentase kecocokan per jalur (kata kunci serupa)
        $persentaseKecocokanJalur = [];
        if ($ruleDominan) {
            $rekomDominanPendekatan = array_filter([
                $ruleDominan->rek_pendekatan_1,
                $ruleDominan->rek_pendekatan_2,
                $ruleDominan->rek_pendekatan_3,
            ]);
            $rekomDominanEvaluasi = array_filter([
                $ruleDominan->rek_evaluasi_1,
                $ruleDominan->rek_evaluasi_2,
                $ruleDominan->rek_evaluasi_3,
            ]);

            foreach ($jalurList as $jalur) {
                $filtered = $students->where('jalur_masuk', $jalur);
                $total = $filtered->count();

                // Persentase kecocokan pendekatan per kata kunci
                $persenPendekatan = [];
                foreach ($rekomDominanPendekatan as $kunci) {
                    $cocok = 0;
                    foreach ($filtered as $mhs) {
                        $ruleMhs = Rule::where([
                            'akademik' => $mhs->akademik_text,
                            'sekolah' => $mhs->sekolah_text,
                            'ekonomi' => $mhs->ekonomi_text,
                            'perkuliahan' => $mhs->perkuliahan_text,
                        ])->first();
                        if ($ruleMhs) {
                            $mhsPendekatan = array_filter([
                                $ruleMhs->rek_pendekatan_1,
                                $ruleMhs->rek_pendekatan_2,
                                $ruleMhs->rek_pendekatan_3,
                            ]);
                            foreach ($mhsPendekatan as $mhsKunci) {
                                if (
                                    !empty($kunci) && !empty($mhsKunci) &&
                                    stripos($mhsKunci, $kunci) !== false
                                ) {
                                    $cocok++;
                                    break;
                                }
                            }
                        }
                    }
                    $persenPendekatan[$kunci] = $total > 0 ? round(($cocok / $total) * 100, 2) : 0;
                }

                // Persentase kecocokan evaluasi per kata kunci
                $persenEvaluasi = [];
                foreach ($rekomDominanEvaluasi as $kunci) {
                    $cocok = 0;
                    foreach ($filtered as $mhs) {
                        $ruleMhs = Rule::where([
                            'akademik' => $mhs->akademik_text,
                            'sekolah' => $mhs->sekolah_text,
                            'ekonomi' => $mhs->ekonomi_text,
                            'perkuliahan' => $mhs->perkuliahan_text,
                        ])->first();
                        if ($ruleMhs) {
                            $mhsEvaluasi = array_filter([
                                $ruleMhs->rek_evaluasi_1,
                                $ruleMhs->rek_evaluasi_2,
                                $ruleMhs->rek_evaluasi_3,
                            ]);
                            foreach ($mhsEvaluasi as $mhsKunci) {
                                if (
                                    !empty($kunci) && !empty($mhsKunci) &&
                                    stripos($mhsKunci, $kunci) !== false
                                ) {
                                    $cocok++;
                                    break;
                                }
                            }
                        }
                    }
                    $persenEvaluasi[$kunci] = $total > 0 ? round(($cocok / $total) * 100, 2) : 0;
                }

                $persentaseKecocokanJalur[$jalur] = [
                    'pendekatan' => $persenPendekatan,
                    'evaluasi' => $persenEvaluasi,
                ];
            }
        }

        // Data untuk chart (rata-rata seluruh kelas)
        $chartData = [
            'akademik_total' => round($students->avg('akademik_total'), 2),
            'sekolah_total' => round($students->avg('sekolah_total'), 2),
            'ekonomi_total' => round($students->avg('ekonomi_total'), 2),
            'perkuliahan_total' => round($students->avg('perkuliahan_total'), 2),
        ];

        // Data untuk chart per jalur
        foreach ($jalurList as $jalur) {
            $filtered = $students->where('jalur_masuk', $jalur);
            $chartData[$jalur] = [
                'akademik_total' => round($filtered->avg('akademik_total'), 2),
                'sekolah_total' => round($filtered->avg('sekolah_total'), 2),
                'ekonomi_total' => round($filtered->avg('ekonomi_total'), 2),
                'perkuliahan_total' => round($filtered->avg('perkuliahan_total'), 2),
            ];
        }

        $hasilKolaborasi = $this->hasilKolaborasi($kalimat['rekomendasi']);

        // Hitung persentase kombinasi dominan
        $PersentaseRekomendasi = 0;
        if (!empty($kombinasiCount) && !empty($dominantKombinasiJson) && count($students) > 0) {
            $PersentaseRekomendasi = round(($kombinasiCount[$dominantKombinasiJson] / count($students)) * 100, 2);
        }

        return view('hasil_rekomendasi', [
            'kelas' => $kelas,
            'students' => $students,
            'KondisiDominan' => [
                'kondisi' => $kalimat['kondisi'],
                'rekomendasi' => $kalimat['rekomendasi'],
                'persentase' => $PersentaseRekomendasi,
            ],
            'PersentaseRekomendasi' => $PersentaseRekomendasi,
            'chartData' => $chartData,
            'jumlahPerJalur' => $jumlahPerJalur,
            'persentaseKecocokanJalur' => $persentaseKecocokanJalur,
            'hasilKolaborasi' => $hasilKolaborasi,
        ]);
    }

    // Fungsi generate kalimat kondisi & rekomendasi
    private function generateKalimatRekomendasi($kombinasi, $rule)
    {
        if (!$kombinasi || !$rule) {
            return [
                'kondisi' => '-',
                'rekomendasi' => '-'
            ];
        }

        $kondisi = "<ul>";
        if (!empty($kombinasi['akademik'])) {
            $kondisi .= "<li>Kondisi akademik: {$kombinasi['akademik']}.</li>";
        }
        if (!empty($kombinasi['sekolah'])) {
            $kondisi .= "<li>Kondisi sekolah: {$kombinasi['sekolah']}.</li>";
        }
        if (!empty($kombinasi['ekonomi'])) {
            $kondisi .= "<li>Kondisi ekonomi: {$kombinasi['ekonomi']}.</li>";
        }
        if (!empty($kombinasi['perkuliahan'])) {
            $kondisi .= "<li>Kondisi perkuliahan: {$kombinasi['perkuliahan']}.</li>";
        }
        $kondisi .= "</ul>";

        $rekomendasi = "<ul>";
            if (!empty($rule->rek_pendekatan_1) && strtolower($rule->rek_pendekatan_1) == 'materi ringkasan') { //REKOMENDASI PENDEKATAN MATERI RINGKASAN 1
                $rekomendasi .= "<li>Gunakan <b>Materi Ringkasan</b> untuk dapat memberikan gambaran yang jelas dan padat, sehingga siswa dapat lebih mudah memahami arah pembelajaran secara keseluruhan.</li>";
            } if (!empty($rule->rek_pendekatan_1) && strtolower($rule->rek_pendekatan_1) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Pembelajaran difokuskan pada <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong siswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_pendekatan_1) && strtolower($rule->rek_pendekatan_1) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li><b>Diskusi Kelompok Aktif</b> direkomendasikan sebagai pendekatan utama karena mampu membangun keterlibatan siswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>;";
            } if (!empty($rule->rek_pendekatan_2) && strtolower($rule->rek_pendekatan_2) == 'materi ringkasan') {
                $rekomendasi .= "<li>Selain itu, gunakan <b>Materi Ringkasan</b> untuk untuk dapat memberikan gambaran yang jelas dan padat, sehingga siswa dapat lebih mudah memahami arah pembelajaran secara keseluruhan.</li>";
            } if (!empty($rule->rek_pendekatan_2) && strtolower($rule->rek_pendekatan_2) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Selain itu, jelaskan materi dengan <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong siswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_pendekatan_2) && strtolower($rule->rek_pendekatan_2) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li>Selain itu, <b>Diskusi Kelompok Aktif</b> juga dapat dilakukan sebagai pendekatan yang mampu membangun keterlibatan siswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>";
            } if (!empty($rule->rek_pendekatan_3) && strtolower($rule->rek_pendekatan_3) == 'materi ringkasan') {
                $rekomendasi .= "<li>Sebagai pendekatan tambahan, gunakan <b>Materi Ringkasan dalam mendukung pembelajaran yang lebih padat dan mudah dipahami mahasiswa</li>";
            } if (!empty($rule->rek_pendekatan_3) && strtolower($rule->rek_pendekatan_3) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Sebagai pendekatan tambahan gunakan <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong siswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_pendekatan_3) && strtolower($rule->rek_pendekatan_3) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li>Untuk memperkuat keterampilan kolaborasi mahasiswa gunakan <b>Diskusi Kelompok Aktif</b> sebagai pendekatan yang mampu membangun keterlibatan mahasiswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana siswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman siswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>";
               } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'tugas ringan secara rutin') {
                $rekomendasi .= "<li>Selain itu, <b>Pemberian Tugas Ringan Secara Rutin</b> juga direkomendasikan sebagai bagian dari strategi evaluasi untuk membantu membentuk kebiasaan belajar yang konsisten dan memperkuat pemahaman secara bertahap.</li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana siswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman siswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>";
               } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'tugas ringan secara rutin') {
                $rekomendasi .= "<li>Selain itu, <b>Pemberian Tugas Ringan Secara Rutin</b> juga direkomendasikan sebagai bagian dari strategi evaluasi untuk membantu membentuk kebiasaan belajar yang konsisten dan memperkuat pemahaman secara bertahap.</li>";
            } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana siswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman siswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>;";
               } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>;";
            } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'tugas ringan secara rutin') {
                $rekomendasi .= "<li>Selain itu, <b>Pemberian Tugas Ringan Secara Rutin</b> juga direkomendasikan sebagai bagian dari strategi evaluasi untuk membantu membentuk kebiasaan belajar yang konsisten dan memperkuat pemahaman secara bertahap.</li>";
            }
        return [
            'kondisi' => $kondisi,
            'rekomendasi' => $rekomendasi
        ];
    }
    
    // Fungsi untuk mengkategorikan nilai ke dalam kategori teks
    private function getKategoriText($tipe, $nilai)
    {
        if ($tipe == 'akademik') {
            if ($nilai >= 1 && $nilai <= 2.5) return 'Perlu Penguatan';
            if ($nilai > 2.5 && $nilai <= 4) return 'Siap';
        } elseif ($tipe == 'sekolah') {
            if ($nilai >= 1 && $nilai <= 2.5) return 'Kurang Mendukung';
            if ($nilai > 2.5 && $nilai <= 4) return 'Mendukung';
        } elseif ($tipe == 'ekonomi') {
            if ($nilai >= 1 && $nilai <= 2.5) return 'Kurang Mencukupi';
            if ($nilai > 2.5 && $nilai <= 4) return 'Mencukupi';
        } elseif ($tipe == 'perkuliahan') {
            if ($nilai >= 1 && $nilai <= 2.5) return 'Kurang Baik';
            if ($nilai > 2.5 && $nilai <= 4) return 'Baik';
        }

        return '-';
    }

    private function hasilKolaborasi($rekomendasi)
    {
        $teks = strip_tags($rekomendasi);
        if (stripos($teks, 'diskusi kelompok aktif') !== false) {
            return '
                Pembelajaran yang telah mencakup aspek kolaborasi seperti partisipasi aktif dalam diskusi, berbagi ide, komunikasi terbuka, dan negosiasi ide perlu terus diperkuat dengan praktik yang lebih nyata. Misalnya, kegiatan kerja tim dapat difokuskan pada simulasi dunia kerja dengan pembagian peran yang jelas, penggunaan tools kolaboratif digital seperti Trello atau Miro, serta penerapan Project-Based Learning (PBL). Penguatan dilakukan melalui diskusi studi kasus nyata, pembuatan timeline proyek bersama, serta sesi evaluasi solusi terhadap hambatan yang muncul. Dengan demikian, kemampuan siswa dalam sharing ideas, maintaining communication, negotiating ideas, dan regulation problem solving akan semakin terasah secara kontekstual dan relevan dengan tuntutan kerja profesional.
            ';
        } else {
            return '
                Untuk mendukung pengembangan keterampilan kolaborasi, pembelajaran perlu didesain ulang dengan menambahkan metode Project-Based Learning (PBL), pembentukan kelompok yang dinamis, serta pemberian tugas berbasis proyek nyata yang menuntut kerja sama. Penggunaan tools kolaboratif digital dan penugasan yang mendorong diskusi, tukar pendapat, negosiasi ide, serta pemecahan masalah bersama harus diintegrasikan ke dalam proses belajar. Dosen sebaiknya berperan sebagai fasilitator kolaborasi, bukan hanya pemberi materi, sehingga siswa dapat terbiasa dengan pola komunikasi aktif, keterbukaan, dan konsistensi dalam bekerja tim. Dengan pendekatan ini, aspek penting seperti sharing ideas, maintaining communication, negotiating ideas, dan regulation problem solving dapat ditumbuhkan secara berkelanjutan.
            ';
        }
    }
}