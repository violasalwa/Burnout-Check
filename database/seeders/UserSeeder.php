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
        $kaprodiUser = User::create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@campus.com',
            'password' => Hash::make('12345678'),
            'role' => null,
        ]);
        \App\Models\DosenKaprodi::create([
            'user_id' => $kaprodiUser->id,
            'nama' => 'Kaprodi',
            'jabatan' => 'kaprodi',
        ]);

        // =========================
        // 🔥 DOSEN A - H
        // =========================
        $dosen = ['A','B','C','D','E','F','G','H'];
        $dosenKaprodiIds = [];

        foreach ($dosen as $d) {
            $user = User::create([
                'name' => "Dosen $d",
                'email' => "dosen$d@campus.com",
                'password' => Hash::make('12345678'),
                'role' => null,
            ]);
            $dk = \App\Models\DosenKaprodi::create([
                'user_id' => $user->id,
                'nama' => "Dosen $d",
                'jabatan' => 'dosen',
            ]);
            $dosenKaprodiIds[] = $dk->id;
        }

        // =========================
        // 🔥 MAHASISWA (CONTOH 5 ORANG)
        // kelas 5 - 8
        // =========================
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Mahasiswa $i",
                'email' => "mhs$i@campus.com",
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
                'nim' => '1000' . $i,
                'ipk' => rand(250, 400) / 100,
                'kelas' => rand(5, 8),
                'dosen_id' => $dosenKaprodiIds[array_rand($dosenKaprodiIds)]
            ]);
        }
    }
}
