<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisPemesanan;
use Illuminate\Http\Request;

class JenisPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Ambil semua data jenis pemesanan
            $data = JenisPemesanan::all();

            // Jika data kosong
            if ($data->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Belum ada data jenis pemesanan',
                    'data' => []
                ], 200);
            }

            // Jika data ada
            return response()->json([
                'success' => true,
                'message' => 'Data jenis pemesanan berhasil diambil',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            // Jika terjadi error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data jenis pemesanan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        try {
            // Simpan data baru
            $jenisPemesanan = JenisPemesanan::create([
                'nama' => $request->nama,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data jenis pemesanan berhasil ditambahkan',
                'data' => $jenisPemesanan
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
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $jenisPemesanan = JenisPemesanan::find($id);

            if (!$jenisPemesanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $jenisPemesanan
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
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'sometimes|string|max:255',
        ]);

        try {
            $jenisPemesanan = JenisPemesanan::find($id);

            if (!$jenisPemesanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Update data
            $jenisPemesanan->update($request->only(['nama']));

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $jenisPemesanan
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
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $jenisPemesanan = JenisPemesanan::find($id);

            if (!$jenisPemesanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $jenisPemesanan->delete();

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