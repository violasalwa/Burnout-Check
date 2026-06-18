<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SoalSeeder;
use Database\Seeders\LevelRisikoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SoalSeeder::class,
            LevelRisikoSeeder::class,
        ]);
    }
}