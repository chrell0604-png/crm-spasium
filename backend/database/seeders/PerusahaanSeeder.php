<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Spasium', 'kode' => 'SPA'],
            ['nama' => 'Artavia', 'kode' => 'ART'],
        ];

        foreach ($data as $item) {
            DB::table('perusahaans')->insert([
                'nama' => $item['nama'],
                'kode' => $item['kode'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}