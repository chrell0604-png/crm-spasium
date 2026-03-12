<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleContactSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'End User'],
            ['nama' => 'Konsultan'],
            ['nama' => 'Kontraktor'],
        ];

        foreach ($data as $item) {
            DB::table('role_contacts')->insert([
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}