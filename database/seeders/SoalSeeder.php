<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soals = [
            // Exhaustion
            ['pertanyaan' => 'Di akhir hari kuliah, saya merasa terkuras secara mental.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa lelah bahkan sebelum saya mulai kuliah di pagi hari.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa sangat lelah sehingga saya tidak bisa melakukan hal lain setelah kuliah.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Setelah kuliah, saya merasa sulit untuk memulihkan energi saya.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa lelah secara fisik setelah seharian kuliah.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa benar-benar habis tenaga.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa cepat lelah saat belajar.', 'kategori' => 'Exhaustion'],
            ['pertanyaan' => 'Saya merasa lelah karena beban tugas yang menumpuk.', 'kategori' => 'Exhaustion'],
            // Mental Distance
            ['pertanyaan' => 'Saya merasa sulit untuk menemukan makna dalam studi saya.', 'kategori' => 'Mental Distance'],
            ['pertanyaan' => 'Saya merasa kurang antusias dengan apa yang saya pelajari.', 'kategori' => 'Mental Distance'],
            ['pertanyaan' => 'Saya merasa studi saya tidak memberikan kontribusi apa pun bagi masa depan saya.', 'kategori' => 'Mental Distance'],
            ['pertanyaan' => 'Saya merasa sinis terhadap manfaat dari kuliah saya.', 'kategori' => 'Mental Distance'],
            ['pertanyaan' => 'Saya merasa menjauh dari teman-teman kuliah saya.', 'kategori' => 'Mental Distance'],
            // Cognitive Impairment
            ['pertanyaan' => 'Saya merasa sulit untuk berkonsentrasi saat belajar.', 'kategori' => 'Cognitive Impairment'],
            ['pertanyaan' => 'Saya sering membuat kesalahan dalam tugas-tugas saya.', 'kategori' => 'Cognitive Impairment'],
            ['pertanyaan' => 'Saya merasa sulit untuk memikirkan ide-ide baru.', 'kategori' => 'Cognitive Impairment'],
            ['pertanyaan' => 'Saya merasa daya ingat saya menurun.', 'kategori' => 'Cognitive Impairment'],
            ['pertanyaan' => 'Saya merasa sulit untuk mengambil keputusan terkait studi saya.', 'kategori' => 'Cognitive Impairment'],
            // Emotional Impairment
            ['pertanyaan' => 'Saya merasa mudah marah tanpa alasan yang jelas.', 'kategori' => 'Emotional Impairment'],
            ['pertanyaan' => 'Saya merasa sedih atau tertekan karena beban kuliah.', 'kategori' => 'Emotional Impairment'],
            ['pertanyaan' => 'Saya merasa sulit untuk mengendalikan emosi saya.', 'kategori' => 'Emotional Impairment'],
            ['pertanyaan' => 'Saya merasa kurang sabar dalam menghadapi tantangan kuliah.', 'kategori' => 'Emotional Impairment'],
            ['pertanyaan' => 'Saya merasa sering merasa cemas tentang hasil studi saya.', 'kategori' => 'Emotional Impairment'],
            // Psychological Distress
            ['pertanyaan' => 'Saya merasa sulit untuk tidur karena memikirkan tugas.', 'kategori' => 'Psychological Distress'],
            ['pertanyaan' => 'Saya merasa tegang atau gelisah.', 'kategori' => 'Psychological Distress'],
            ['pertanyaan' => 'Saya merasa sulit untuk rileks setelah belajar.', 'kategori' => 'Psychological Distress'],
            ['pertanyaan' => 'Saya merasa kewalahan dengan tuntutan akademik.', 'kategori' => 'Psychological Distress'],
            ['pertanyaan' => 'Saya merasa kurang percaya diri dengan kemampuan akademik saya.', 'kategori' => 'Psychological Distress'],
            // Psychosomatic Complaints
            ['pertanyaan' => 'Saya sering mengalami sakit kepala setelah belajar lama.', 'kategori' => 'Psychosomatic Complaints'],
            ['pertanyaan' => 'Saya sering merasa sakit perut atau gangguan pencernaan.', 'kategori' => 'Psychosomatic Complaints'],
            ['pertanyaan' => 'Saya sering merasa nyeri otot atau ketegangan di leher/bahu.', 'kategori' => 'Psychosomatic Complaints'],
            ['pertanyaan' => 'Saya merasa kesehatan fisik saya menurun sejak kuliah semester akhir.', 'kategori' => 'Psychosomatic Complaints'],
            ['pertanyaan' => 'Saya merasa jantung saya berdebar kencang saat memikirkan ujian/sidang.', 'kategori' => 'Psychosomatic Complaints'],
        ];

        foreach ($soals as $soal) {
            \App\Models\Soal::create($soal);
        }
    }
}
