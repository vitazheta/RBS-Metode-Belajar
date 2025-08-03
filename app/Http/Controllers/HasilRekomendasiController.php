<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

// Controller untuk menampilkan hasil rekomendasi kelas
class HasilRekomendasiController extends Controller
{
    // Menampilkan hasil rekomendasi berdasarkan ID kelas
    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);

        // Cek apakah dosen yang login adalah pemilik kelas ini
        if ($kelas->dosen_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        $students = $kelas->mahasiswa;
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
            $rekomDominanStrategi = array_filter([
                $ruleDominan->rek_strategi_1,
                $ruleDominan->rek_strategi_2,
                $ruleDominan->rek_strategi_3,
            ]);
            $rekomDominanEvaluasi = array_filter([
                $ruleDominan->rek_evaluasi_1,
                $ruleDominan->rek_evaluasi_2,
                $ruleDominan->rek_evaluasi_3,
            ]);

            foreach ($jalurList as $jalur) {
                $filtered = $students->where('jalur_masuk', $jalur);
                $total = $filtered->count();

                // Persentase kecocokan strategi per kata kunci
                $persenStrategi = [];
                foreach ($rekomDominanStrategi as $kunci) {
                    $cocok = 0;
                    foreach ($filtered as $mhs) {
                        $ruleMhs = Rule::where([
                            'akademik' => $mhs->akademik_text,
                            'sekolah' => $mhs->sekolah_text,
                            'ekonomi' => $mhs->ekonomi_text,
                            'perkuliahan' => $mhs->perkuliahan_text,
                        ])->first();
                        if ($ruleMhs) {
                            $mhsStrategi = array_filter([
                                $ruleMhs->rek_strategi_1,
                                $ruleMhs->rek_strategi_2,
                                $ruleMhs->rek_strategi_3,
                            ]);
                            foreach ($mhsStrategi as $mhsKunci) {
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
                    $persenStrategi[$kunci] = $total > 0 ? round(($cocok / $total) * 100, 2) : 0;
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
                    'strategi' => $persenStrategi,
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

        // Panggil fungsi rekomendasiBelajar
        $rekomendasi = $this->rekomendasiBelajar($chartData);

        // Tampilkan view hasil rekomendasi
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
            'rekomendasi' => $rekomendasi['rekomendasi'], // Rekomendasi untuk setiap aspek
            'alasan' => $rekomendasi['alasan'], // Alasan untuk setiap aspek
        ]);
    }

    // MEMBUAT RULE REKOMENDASI BELAJAR
    public function rekomendasiBelajar($data)
    {
        if (!$kombinasi || !$rule) {
            return [
                'kondisi' => '-',
                'rekomendasi' => '-'
            ];
        }

        $kondisi = "<ul style='list-style-type: disc;'>";
        if (!empty($kombinasi['akademik'])) {
            $kondisi .= "<li style='margin-bottom:5px;'>Kondisi akademik: {$kombinasi['akademik']}.</li>";
        }
        if (!empty($kombinasi['sekolah'])) {
            $kondisi .= "<li style='margin-bottom:5px;'>Kondisi sekolah: {$kombinasi['sekolah']}.</li>";
        }
        if (!empty($kombinasi['ekonomi'])) {
            $kondisi .= "<li style='margin-bottom:5px;'>Kondisi ekonomi: {$kombinasi['ekonomi']}.</li>";
        }
        if (!empty($kombinasi['perkuliahan'])) {
            $kondisi .= "<li style='margin-bottom:5px;'>Kondisi perkuliahan: {$kombinasi['perkuliahan']}.</li>";
        }
        $kondisi .= "</ul>";

        $rekomendasi = "<ul>";
            if (!empty($rule->rek_strategi_1) && strtolower($rule->rek_strategi_1) == 'materi ringkasan') { //REKOMENDASI STRATEGI MATERI RINGKASAN 1
                $rekomendasi .= "<li>Gunakan <b>Materi Ringkasan</b> untuk dapat memberikan gambaran yang jelas dan padat, sehingga mahasiswa dapat lebih mudah memahami arah pembelajaran secara keseluruhan.</li>";
            } if (!empty($rule->rek_strategi_1) && strtolower($rule->rek_strategi_1) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Pembelajaran difokuskan pada <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong mahasiswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_strategi_1) && strtolower($rule->rek_strategi_1) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li><b>Diskusi Kelompok Aktif</b> direkomendasikan sebagai strategi utama karena mampu membangun keterlibatan mahasiswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>";
            } if (!empty($rule->rek_strategi_2) && strtolower($rule->rek_strategi_2) == 'materi ringkasan') {
                $rekomendasi .= "<li>Selain itu, gunakan <b>Materi Ringkasan</b> untuk untuk dapat memberikan gambaran yang jelas dan padat, sehingga mahasiswa dapat lebih mudah memahami arah pembelajaran secara keseluruhan.</li>";
            } if (!empty($rule->rek_strategi_2) && strtolower($rule->rek_strategi_2) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Selain itu, jelaskan materi dengan <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong mahasiswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_strategi_2) && strtolower($rule->rek_strategi_2) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li>Selain itu, <b>Diskusi Kelompok Aktif</b> juga dapat dilakukan sebagai strategi yang mampu membangun keterlibatan mahasiswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>";
            } if (!empty($rule->rek_strategi_3) && strtolower($rule->rek_strategi_3) == 'materi ringkasan') {
                $rekomendasi .= "<li>Sebagai strategi tambahan, gunakan <b>Materi Ringkasan dalam mendukung pembelajaran yang lebih padat dan mudah dipahami mahasiswa</li>";
            } if (!empty($rule->rek_strategi_3) && strtolower($rule->rek_strategi_3) == 'penjelasan mendalam') {
                $rekomendasi .= "<li>Sebagai strategi tambahan gunakan <b>Penjelasan Mendalam</b> untuk memberikan pemahaman komprehensif terhadap konsep, serta mendorong mahasiswa untuk berpikir analitis dan kritis terhadap materi yang dipelajari.</li>";
            } if (!empty($rule->rek_strategi_3) && strtolower($rule->rek_strategi_3) == 'diskusi kelompok aktif') {
                $rekomendasi .= "<li>Untuk memperkuat keterampilan kolaborasi mahasiswa gunakan <b>Diskusi Kelompok Aktif</b> sebagai strategi yang mampu membangun keterlibatan mahasiswa, meningkatkan interaksi, dan memperkuat pemahaman melalui pertukaran gagasan secara langsung.</li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana mahasiswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman mahasiswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>";
               } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>";
            } if (!empty($rule->rek_evaluasi_1) && strtolower($rule->rek_evaluasi_1) == 'tugas ringan secara rutin') {
                $rekomendasi .= "<li>Selain itu, <b>Pemberian Tugas Ringan Secara Rutin</b> juga direkomendasikan sebagai bagian dari strategi evaluasi untuk membantu membentuk kebiasaan belajar yang konsisten dan memperkuat pemahaman secara bertahap.</li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana mahasiswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman mahasiswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>";
               } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>";
            } if (!empty($rule->rek_evaluasi_2) && strtolower($rule->rek_evaluasi_2) == 'tugas ringan secara rutin') {
                $rekomendasi .= "<li>Selain itu, <b>Pemberian Tugas Ringan Secara Rutin</b> juga direkomendasikan sebagai bagian dari strategi evaluasi untuk membantu membentuk kebiasaan belajar yang konsisten dan memperkuat pemahaman secara bertahap.</li>";
            } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'review materi dan tanya jawab') {
                $rekomendasi .= "<li>Selain itu, <b>Review Materi dan Sesi Tanya Jawab</b> direkomendasikan sebagai strategi dalam melakukan evaluasi karena mampu secara langsung mengukur sejauh mana mahasiswa memahami materi sekaligus memberikan ruang klarifikasi atas hal-hal yang belum dipahami. </li>";
            } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'penilaian formatif berupa kuis') {
                $rekomendasi .= "<li>Selain itu, <b>Penilaian Formatif</b> melalui kuis menjadi strategi evaluasi utama karena dapat mengukur pemahaman mahasiswa secara cepat dan memberi umpan balik instan untuk perbaikan pembelajaran.</li>";
               } if (!empty($rule->rek_evaluasi_3) && strtolower($rule->rek_evaluasi_3) == 'tugas studi kasus terstruktur') {
                $rekomendasi .= "<li><b>Tugas Studi Kasus Terstruktur</b> direkomendasikan sebagai metode evaluasi untuk mengasah kemampuan berpikir kritis dan penerapan konsep dalam konteks nyata.</li>";
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
                <ul>
                    <li>Minta setiap kelompok menetapkan aturan tim, dan peran masing-masing anggota dalam kelompok sendiri</li>
                    <li>Berikan pertanyaan pemantik yang mendorong anggota kelompok untuk berbagi dan membandingkan ide mereka sebelum membuat keputusan bersama</li>
                    <li>Berikan waktu refleksi kelompok selama 5 menit di akhir sesi diskusi untuk membicarakan bagaimana mereka bekerja sama dan menyelesaikan perbedaan pendapat</li>
                    <li>Rotasi moderator kelompok tiap pertemuan untuk melatih kepemimpinan dan komunikasi antar anggota</li>
                    <li>Dosen sesekali menilai proses diskusi dengan observasi ringan atau pertanyaan cepat, bukan hanya hasil tugas</li>
                </ul>
            ';
        } else {
            return '
                <ul>
                    <li>Mulailah memperkenalkan pembelajaran kolaboratif melalui pembentukan kelompok kecil dengan peran yang jelas untuk setiap anggota</li>
                    <li>Rancang penugasan berbasis masalah yang mendorong interaksi tim: saling bertukar pendapat, negosiasi ide, dan mencari solusi bersama</li>
                    <li>Latih mahasiswa untuk menyampaikan hasil kerjanya secara terbuka, dan dorong rekan satu kelompok untuk memberi tanggapan atau pertanyaan</li>
                    <li>Dosen dapat membimbing dengan mengamati proses diskusi, memberikan arahan saat diperlukan, dan membantu mahasiswa membangun komunikasi yang sehat</li>
                    <li>Bila diskusi dilakukan di luar kelas, minta laporan proses atau jurnal sebagai alat monitoring keterlibatan anggota, atau melakukan review atas pekerjaan yang dikerjakan anggota lain</li>
                    <li>Peran dosen sangat penting sebagai fasilitator awal untuk membentuk budaya kolaborasi, dengan memberi ruang terbuka bagi komunikasi, kesepakatan kerja, dan penyelesaian konflik sederhana</li>
                </ul>
            ';
        }
    }

    public function exportPdf($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        $students = $kelas->mahasiswa;
        $jalurList = ['SNBP', 'SNBT', 'MANDIRI'];

        // Cek otorisasi
        if ((int)$kelas->dosen_id !== auth()->id()) { // <<< Tambahkan (int) di sini
        abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        $students = $kelas->mahasiswa;
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
            $rekomDominanStrategi = array_filter([
                $ruleDominan->rek_strategi_1,
                $ruleDominan->rek_strategi_2,
                $ruleDominan->rek_strategi_3,
            ]);
            $rekomDominanEvaluasi = array_filter([
                $ruleDominan->rek_evaluasi_1,
                $ruleDominan->rek_evaluasi_2,
                $ruleDominan->rek_evaluasi_3,
            ]);

            foreach ($jalurList as $jalur) {
                $filtered = $students->where('jalur_masuk', $jalur);
                $total = $filtered->count();

                // Persentase kecocokan strategi per kata kunci
                $persenStrategi = [];
                foreach ($rekomDominanStrategi as $kunci) {
                    $cocok = 0;
                    foreach ($filtered as $mhs) {
                        $ruleMhs = Rule::where([
                            'akademik' => $mhs->akademik_text,
                            'sekolah' => $mhs->sekolah_text,
                            'ekonomi' => $mhs->ekonomi_text,
                            'perkuliahan' => $mhs->perkuliahan_text,
                        ])->first();
                        if ($ruleMhs) {
                            $mhsStrategi = array_filter([
                                $ruleMhs->rek_strategi_1,
                                $ruleMhs->rek_strategi_2,
                                $ruleMhs->rek_strategi_3,
                            ]);
                            foreach ($mhsStrategi as $mhsKunci) {
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
                    $persenStrategi[$kunci] = $total > 0 ? round(($cocok / $total) * 100, 2) : 0;
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
                    'strategi' => $persenStrategi,
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

        return \Barryvdh\DomPDF\Facade\Pdf::loadView('hasil_rekomendasi_pdf', [
            'students' => $students,
            'kelas' => $kelas,
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
        ])->download('hasilrekomendasi.pdf');
    }

}
