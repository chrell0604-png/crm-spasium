<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $data = [
            ['id' => 1, 'nama' => 'Spasium', 'kode' => 'SPA'],
            ['id' => 2, 'nama' => 'Artavia', 'kode' => 'ART'],
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}