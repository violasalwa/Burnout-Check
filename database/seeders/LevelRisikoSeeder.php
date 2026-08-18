<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LevelRisiko::create([
            'nama_level' => 'Rendah',
            'skor_min' => 1,
            'skor_max' => 40,
            'deskripsi' => 'Anda berada dalam kondisi yang baik. Tetap jaga keseimbangan antara studi dan waktu istirahat.',
        ]);

        \App\Models\LevelRisiko::create([
            'nama_level' => 'Sedang',
            'skor_min' => 41,
            'skor_max' => 70,
            'deskripsi' => 'Anda mulai merasakan gejala burnout. Disarankan untuk mengambil waktu istirahat sejenak dan melakukan hobi.',
        ]);

        \App\Models\LevelRisiko::create([
            'nama_level' => 'Tinggi',
            'skor_min' => 71,
            'skor_max' => 100,
            'deskripsi' => 'Anda berada pada risiko tinggi burnout. Segera konsultasikan dengan dosen pembimbing atau layanan konseling mahasiswa.',
        ]);
    }
}
