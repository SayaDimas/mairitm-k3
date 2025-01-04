<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data kategori
        $categories = [
            ['name' => 'Keselamatan di Laut'],
            ['name' => 'Kondisi Laut dan Cuaca'],
            ['name' => 'Pertolongan Pertama di Laut'],
            ['name' => 'Ship Maintenance'],
        ];

        // Insert data ke tabel categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
