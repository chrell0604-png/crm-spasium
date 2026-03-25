<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SumberLead;
use Illuminate\Http\Request;

class SumberLeadController extends Controller
{
    /**
     * GET /api/sumber-leads - Menampilkan semua data
     */
    public function index()
    {
        try {
            $data = SumberLead::all();

            return response()->json([
                'success' => true,
                'message' => 'Data sumber lead berhasil diambil',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/sumber-leads - Menyimpan data baru
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'kategori' => 'nullable|string|max:255',
                'tipe' => 'nullable|string|max:255',
            ]);

            $data = SumberLead::create([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'tipe' => $request->tipe,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data sumber lead berhasil ditambahkan',
                'data' => $data
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/sumber-leads/{id} - Menampilkan detail data
     */
    public function show($id)
    {
        try {
            $data = SumberLead::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/sumber-leads/{id} - Mengupdate data
     */
    public function update(Request $request, $id)
    {
        try {
            $data = SumberLead::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $request->validate([
                'nama' => 'sometimes|string|max:255',
                'kategori' => 'nullable|string|max:255',
                'tipe' => 'nullable|string|max:255',
            ]);

            $data->update($request->only(['nama', 'kategori', 'tipe']));

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/sumber-leads/{id} - Menghapus data
     */
    public function destroy($id)
    {
        try {
            $data = SumberLead::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}