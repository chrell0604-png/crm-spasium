<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisLokasiController extends Controller
{
    public function index()
    {
        $data = [
            ['id' => 1, 'nama' => 'Private Residence'],
            ['id' => 2, 'nama' => 'Show Unit'],
            ['id' => 3, 'nama' => 'Office'],
            ['id' => 4, 'nama' => 'Public Area(Indor & Outdoor)'],
            ['id' => 5, 'nama' => 'Hotel'],
            ['id' => 6, 'nama' => 'Show Room'],
            ['id' => 7, 'nama' => 'F & B'],
            ['id' => 8, 'nama' => 'Hospital'],
            ['id' => 8, 'nama' => 'Others'],
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}