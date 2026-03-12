<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeEndUserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'First Timer'],
            ['nama' => 'Repeat 1x'],
            ['nama' => 'Repeat 2x+'],
        ];

        foreach ($data as $item) {
            DB::table('tipe_end_users')->insert([
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}