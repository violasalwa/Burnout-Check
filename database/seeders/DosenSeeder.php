<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosenList = ['A','B','C','D','E','F','G','H'];

        foreach ($dosenList as $d) {
            User::create([
                'name' => "Dosen $d",
                'email' => "dosen$d@kampus.com",
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);
        }
    }
}