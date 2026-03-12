<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPemesananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Aset'],
            ['nama' => 'Aset+'],
            ['nama' => 'Full Custom'],
            ['nama' => 'S-ATM'],
            ['nama' => 'Fungsional'],
            ['nama' => 'Artavia'],
        ];

        foreach ($data as $item) {
            DB::table('jenis_pemesanans')->insert([
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}