<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // GET /api/inquiries - Ambil semua inquiry (data dummy)
    public function index()
    {
        $dummyInquiries = [
            ['id' => 1, 'nama_pic' => 'Budi Santoso', 'sumber_lead' => 'Online Canvassing', 'nilai' => 5000000],
            ['id' => 2, 'nama_pic' => 'Citra Dewi', 'sumber_lead' => 'Website', 'nilai' => 12500000],
            ['id' => 3, 'nama_pic' => 'Ahmad Fauzi', 'sumber_lead' => 'IG Ads', 'nilai' => 3000000],
        ];

        return response()->json([
            'success' => true,
            'data' => $dummyInquiries
        ]);
    }

    // GET /api/inquiries/{id} - Ambil detail inquiry
    public function show($id)
    {
        $dummyDetail = [
            'id' => $id,
            'nama_pic' => 'Budi Santoso',
            'sumber_lead' => 'Online Canvassing',
            'jenis_lokasi' => 'Private Residence',
            'perusahaan' => 'Spasium',
            'nilai' => 5000000,
            'status' => 'inquiry'
        ];

        return response()->json([
            'success' => true,
            'data' => $dummyDetail
        ]);
    }

    // POST /api/inquiries - Simpan inquiry baru (response sukses)
    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Inquiry berhasil disimpan (dummy)',
            'data' => $request->all()
        ], 201);
    }
}