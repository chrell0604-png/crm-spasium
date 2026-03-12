<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SumberLeadController extends Controller
{
    /**
     * Ambil semua data sumber leads.
     */
    public function index()
    {
        // Data dummy (sementara)
        $sumberLeads = [
            ['id' => 1, 'nama' => 'Online Canvassing', 'kategori' => 'Aktif'],
            ['id' => 2, 'nama' => 'Door to Door', 'kategori' => 'Aktif'],
            ['id' => 3, 'nama' => 'Event', 'kategori' => 'Aktif'],
            ['id' => 4, 'nama' => 'Website', 'kategori' => 'Pasif'],
            ['id' => 5, 'nama' => 'IG Ads', 'kategori' => 'Iklan'],
        ];

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar sumber leads berhasil diambil',
            'data'    => $sumberLeads
        ]);
    }
}