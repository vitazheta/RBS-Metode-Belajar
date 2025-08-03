<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rule::truncate();

        $jalurMasukCategories = ['SNBP', 'SNBT', 'Mandiri'];
        $akademikCategories = ['Perlu Penguatan', 'Siap'];
        $sekolahCategories = ['Kurang Mendukung', 'Mendukung'];
        $ekonomiCategories = ['Kurang Mencukupi', 'Mencukupi'];
        $perkuliahanCategories = ['Kurang Baik', 'Baik'];

        $allRules = [];

        foreach ($jalurMasukCategories as $jalur) {
            foreach ($akademikCategories as $akademik) {
                foreach ($sekolahCategories as $sekolah) {
                    foreach ($ekonomiCategories as $ekonomi) {
                        foreach ($perkuliahanCategories as $perkuliahan) {
                            $rekomendasiStrategi1 = $rekomendasiStrategi2 = $rekomendasiStrategi3 = null;
                            $rekomendasiEvaluasi1 = $rekomendasiEvaluasi2 = $rekomendasiEvaluasi3 = null;

                            if (//1
                                $akademik === 'Siap' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = 'Penjelasan Mendalam';
                                $rekomendasiStrategi3 = 'Diskusi Kelompok Aktif';
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//2
                                $akademik === 'Siap' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = 'Tugas Ringan Secara Rutin';
                            } else if (//3
                                $akademik === 'Siap' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//4
                                $akademik === 'Siap' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStratgei2 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//5
                                $akademik === 'Siap' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;

                            } else if (//6
                                $akademik === 'Siap' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi2 = 'Penjelasan Mendalam';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//7
                                $akademik === 'Siap' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//8
                                $akademik === 'Siap' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//9
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi3 = NULL;
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//10
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//11
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//12
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi2 = 'Penjelasan Mendalam';
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Tugas Studi Kasus Terstruktur';
                                $rekomendasiEvaluasi2 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi3 = NULL; 
                            } else if (//13
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi2 = 'Penjelasan Mendalam';
                                $rekomendasiStrategi3 = 'Materi Ringkasan';
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi3 = NULL;
                            } else if (//14
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Mentoring dan Sesi Konsultasi';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL; 
                            } else if (//15
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Materi Ringkasan';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi2 = NULL;
                                $rekomendasiEvaluasi3 = NULL; 
                            } else if (//16
                                $akademik === 'Perlu Penguatan' &&
                                $sekolah === 'Kurang Mendukung' &&
                                $ekonomi === 'Kurang Mencukupi' &&
                                $perkuliahan === 'Kurang Baik'
                            ) {
                                $rekomendasiStrategi1 = 'Diskusi Kelompok Aktif';
                                $rekomendasiStrategi2 = NULL;
                                $rekomendasiStrategi3 = NULL; 
                                $rekomendasiEvaluasi1 = 'Penilaian Formatif Berupa Kuis';
                                $rekomendasiEvaluasi2 = 'Review Materi dan Tanya Jawab';
                                $rekomendasiEvaluasi3 = NULL;
                            }

                            $allRules[] = [
                                'jalur_masuk' => $jalur,
                                'akademik' => $akademik,
                                'sekolah' => $sekolah,
                                'ekonomi' => $ekonomi,
                                'perkuliahan' => $perkuliahan,
                                'rek_strategi_1' => $rekomendasiStrategi1,
                                'rek_strategi_2' => $rekomendasiStrategi2,
                                'rek_strategi_3' => $rekomendasiStrategi3,
                                'rek_evaluasi_1' => $rekomendasiEvaluasi1,
                                'rek_evaluasi_2' => $rekomendasiEvaluasi2,
                                'rek_evaluasi_3' => $rekomendasiEvaluasi3,
                            ];
                        }
                    }
                }
            }
        }
        Rule::insert($allRules);
    }
}