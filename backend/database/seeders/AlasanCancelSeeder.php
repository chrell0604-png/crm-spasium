<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlasanCancelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Budget'],
            ['nama' => 'Taste'],
            ['nama' => 'Kurang Jelas & Tidak Dapat Dihubungi'],
            ['nama' => 'Klien berubah pikiran'],
            ['nama' => 'Baru wacana saja (belum jelas)'],
            ['nama' => 'Tidak relevan dengan Spasium'],
            ['nama' => 'Timeline'],
            ['nama' => 'Lainnya'],
        ];

        foreach ($data as $item) {
            DB::table('alasan_cancels')->insert([
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}