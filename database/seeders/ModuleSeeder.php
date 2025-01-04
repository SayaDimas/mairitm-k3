<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Category;
use App\Models\User;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data kategori yang ada
        $categories = Category::all();

        // Ambil user pertama sebagai contoh
        $teacher = User::first();

        // Pastikan ada user untuk teacher_id
        if (!$teacher) {
            $this->command->error('Tidak ada user di database. Jalankan UsersSeeder terlebih dahulu.');
            return;
        }

        // Buat data modul
        $modules = [
            [
                'title' => 'Keselamatan di Laut',
                'description' => 'Tips penting untuk menjaga keselamatan selama berlayar atau bekerja di laut.',
                'teacher_id' => "2",
                'category_id' => $categories->random()->id,
            ],
            [
                'title' => 'Perawatan dan Pemeliharaan Kapal',
                'description' => 'Informasi cuaca dan kondisi laut untuk membantu perencanaan perjalanan atau aktivitas maritim.',
                'teacher_id' => "2",
                'category_id' => $categories->random()->id,
            ],
            [
                'title' => 'Perangkat dan Teknologi Keselamatan:',
                'description' => 'Review tentang teknologi terbaru yang dapat membantu keselamatan di laut, seperti sistem pelacak atau perangkat komunikasi.',
                'teacher_id' => "2",
                'category_id' => $categories->random()->id,
            ],
            [
                'title' => 'Pertolongan Pertama di Laut',
                'description' => 'Review tentang teknologi terbaru yang dapat membantu keselamatan di laut, seperti sistem pelacak atau perangkat komunikasi.',
                'teacher_id' => "2",
                'category_id' => $categories->random()->id,
            ],
        ];

        // Insert data ke tabel modules
        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
