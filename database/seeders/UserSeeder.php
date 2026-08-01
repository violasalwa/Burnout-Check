<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // 🔥 ADMIN
        // =========================
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@campus.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // =========================
        // 🔥 KAPRODI
        // =========================
        User::create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@campus.com',
            'password' => Hash::make('12345678'),
            'role' => 'kaprodi',
        ]);

        // =========================
        // 🔥 DOSEN A - H
        // =========================
        $dosen = ['A','B','C','D','E','F','G','H'];

        foreach ($dosen as $d) {
            User::create([
                'name' => "Dosen $d",
                'email' => "dosen$d@campus.com",
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
            ]);
        }

        // =========================
        // 🔥 MAHASISWA (CONTOH 5 ORANG)
        // kelas 5 - 8
        // =========================
        $dosenIds = User::where('role', 'dosen')->pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Mahasiswa $i",
                'email' => "mhs$i@campus.com",
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
                'kelas' => rand(5, 8),
                'dosen_id' => $dosenIds[array_rand($dosenIds)]
            ]);
        }
    }
}
