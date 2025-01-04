<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MateriSeeder extends Seeder
{
    public function run()
    {
        DB::table('materis')->insert([
            [
                'id' => 1,
                'module_id' => 2,
                'type' => 'text',
                'title' => 'Penyebab kapal tenggelam',
                'content' => 'bocor nabrak hiu',
                'image' => null,
                'video' => null,
                'created_at' => Carbon::parse('2024-12-25 03:29:40'),
                'updated_at' => Carbon::parse('2024-12-25 03:29:40'),
            ],
            [
                'id' => 2,
                'module_id' => 2,
                'type' => 'text',
                'title' => 'gambar kapal',
                'content' => '',
                'image' => 'materi_images/DMWq3NiKFqdxbWFgipMQnaQbxM7U4JDXbmtqzKmP.jpg',
                'video' => null,
                'created_at' => Carbon::parse('2024-12-25 03:29:41'),
                'updated_at' => Carbon::parse('2024-12-25 03:29:41'),
            ],
            [
                'id' => 4,
                'module_id' => 1,
                'type' => 'text',
                'title' => 'Tips bertahan hidup jika terdampar di laut',
                'content' => '',
                'image' => 'materi_images/RlheV17Gs1FU1xkYkEKkPIthjeuVHZqeBxuMSwca.png',
                'video' => null,
                'created_at' => Carbon::parse('2024-12-29 06:03:33'),
                'updated_at' => Carbon::parse('2024-12-29 06:03:33'),
            ],
            [
                'id' => 5,
                'module_id' => 1,
                'type' => 'text',
                'title' => '1. Tetap tenang.',
                'content' => 'Kunci utama untuk bertahan hidup saat terdampar di laut ...',
                'image' => null,
                'video' => null,
                'created_at' => Carbon::parse('2024-12-29 06:03:33'),
                'updated_at' => Carbon::parse('2024-12-29 06:03:33'),
            ]

        ]);
    }
}
