<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Ambil semua data jenis produk
            $data = JenisProduk::all();

            // Jika data kosong
            if ($data->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Belum ada data jenis produk',
                    'data' => []
                ], 200);
            }

            // Jika data ada
            return response()->json([
                'success' => true,
                'message' => 'Data jenis produk berhasil diambil',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            // Jika terjadi error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data jenis produk',
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
            'kategori' => 'nullable|string|max:255',
        ]);

        try {
            // Simpan data baru
            $jenisProduk = JenisProduk::create([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data jenis produk berhasil ditambahkan',
                'data' => $jenisProduk
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
            $jenisProduk = JenisProduk::find($id);

            if (!$jenisProduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $jenisProduk
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
            'kategori' => 'nullable|string|max:255',
        ]);

        try {
            $jenisProduk = JenisProduk::find($id);

            if (!$jenisProduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Update data
            $jenisProduk->update($request->only(['nama', 'kategori']));

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $jenisProduk
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
            $jenisProduk = JenisProduk::find($id);

            if (!$jenisProduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $jenisProduk->delete();

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