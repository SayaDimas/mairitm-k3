<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // Pastikan UsersSeeder ada
            CategorySeeder::class,
            ModuleSeeder::class,
        ]);
    }
}
