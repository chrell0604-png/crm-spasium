<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        // Data contoh inquiry
        $inquiries = [
            [
                'nama_pic' => 'Budi Santoso',
                'sumber_lead_id' => 1,
                'jenis_lokasi_id' => 1,
                'perusahaan_id' => 1,
                'nilai' => 5000000,
                'status' => 'deal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pic' => 'Citra Dewi',
                'sumber_lead_id' => 2,
                'jenis_lokasi_id' => 2,
                'perusahaan_id' => 2,
                'nilai' => 12500000,
                'status' => 'inquiry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pic' => 'Ahmad Fauzi',
                'sumber_lead_id' => 3,
                'jenis_lokasi_id' => 3,
                'perusahaan_id' => 1,
                'nilai' => 3000000,
                'status' => 'cancel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pic' => 'Siti Aminah',
                'sumber_lead_id' => 1,
                'jenis_lokasi_id' => 4,
                'perusahaan_id' => 2,
                'nilai' => 8000000,
                'status' => 'inquiry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pic' => 'Dedi Kurniawan',
                'sumber_lead_id' => 4,
                'jenis_lokasi_id' => 1,
                'perusahaan_id' => 1,
                'nilai' => 15000000,
                'status' => 'deal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            DB::table('inquiries')->insert($inquiry);
        }
    }
}