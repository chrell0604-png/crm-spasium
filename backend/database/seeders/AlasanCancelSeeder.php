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
            ['nama' => 'Timeline'],
            ['nama' => 'Berubah Pikiran'],
            ['nama' => 'Tidak relevan dengan Spasium'],
            ['nama' => 'Baru wacana saja (belum jelas)'],
            ['nama' => 'Kurang Jelas & Tidak Dapat Dihubungi'],
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