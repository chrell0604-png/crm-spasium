<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Artprints', 'kategori' => 'Artwork'],
            ['nama' => 'Patung Dinding', 'kategori' => 'Patung'],
            ['nama' => 'Patung Meja', 'kategori' => 'Patung'],
            ['nama' => 'Patung Lantai', 'kategori' => 'Patung'],
            ['nama' => 'Patung Gantung', 'kategori' => 'Patung'],
            ['nama' => 'Lampu', 'kategori' => 'Lampu'],
            ['nama' => 'Cermin', 'kategori' => 'Cermin'],
            ['nama' => 'Partisi', 'kategori' => 'Partisi'],
            ['nama' => 'Gagang Pintu', 'kategori' => 'Aksesoris'],
            ['nama' => 'Lainnya', 'kategori' => 'Lainnya'],
        ];

        foreach ($data as $item) {
            DB::table('jenis_produks')->insert([
                'nama' => $item['nama'],
                'kategori' => $item['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}