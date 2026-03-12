<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumberLeadSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // AKTIF
            ['nama' => 'Online Canvassing', 'kategori' => 'Aktif', 'tipe' => 'Aktif'],
            ['nama' => 'Door to Door', 'kategori' => 'Aktif', 'tipe' => 'Aktif'],
            ['nama' => 'Event', 'kategori' => 'Aktif', 'tipe' => 'Aktif'],
            ['nama' => 'Referral dari Aktif', 'kategori' => 'Aktif', 'tipe' => 'Aktif'],
            
            // PASIF
            ['nama' => 'Website', 'kategori' => 'Pasif', 'tipe' => 'Pasif'],
            ['nama' => 'IG', 'kategori' => 'Pasif', 'tipe' => 'Pasif'],
            ['nama' => 'Referral dari Pasif', 'kategori' => 'Pasif', 'tipe' => 'Pasif'],
            
            // IKLAN
            ['nama' => 'IG Ads', 'kategori' => 'Iklan', 'tipe' => 'Iklan'],
            ['nama' => 'Google Ads', 'kategori' => 'Iklan', 'tipe' => 'Iklan'],
        ];

        foreach ($data as $item) {
            DB::table('sumber_leads')->insert([
                'nama' => $item['nama'],
                'kategori' => $item['kategori'],
                'tipe' => $item['tipe'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}