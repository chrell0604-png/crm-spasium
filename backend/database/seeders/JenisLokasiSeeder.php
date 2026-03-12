<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLokasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Private Residence'],
            ['nama' => 'Show Unit'],
            ['nama' => 'Office'],
            ['nama' => 'Public Area (Indoor & Outdoor)'],
            ['nama' => 'Hotel'],
            ['nama' => 'Show Room'],
            ['nama' => 'F&B'],
            ['nama' => 'Hospital'],
            ['nama' => 'Others'],
        ];

        foreach ($data as $item) {
            DB::table('jenis_lokasis')->insert([
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}