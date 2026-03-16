<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * GET /api/inquiries - Menampilkan semua inquiry dengan filter, search, sorting, pagination
     */
    public function index(Request $request)
    {
        try {
            // Mulai query builder dengan relasi
            $query = Inquiry::with([
                'sumberLead',
                'jenisLokasi',
                'perusahaan',
                'firstContactBy',
                'keputusanDesainBy',
                'pengaruhDesainBy',
                'inquiryProduks'
            ]);

            // 1. FILTER BERDASARKAN STATUS (inquiry/deal/cancel)
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

            // 2. FILTER BERDASARKAN SUMBER LEAD
            if ($request->has('sumber_lead_id') && !empty($request->sumber_lead_id)) {
                $query->where('sumber_lead_id', $request->sumber_lead_id);
            }

            // 3. FILTER BERDASARKAN JENIS LOKASI
            if ($request->has('jenis_lokasi_id') && !empty($request->jenis_lokasi_id)) {
                $query->where('jenis_lokasi_id', $request->jenis_lokasi_id);
            }

            // 4. FILTER BERDASARKAN PERUSAHAAN
            if ($request->has('perusahaan_id') && !empty($request->perusahaan_id)) {
                $query->where('perusahaan_id', $request->perusahaan_id);
            }

            // 5. FILTER BERDASARKAN RENTANG TANGGAL
            if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
                $query->whereBetween('created_at', [
                    $request->tanggal_mulai . ' 00:00:00',
                    $request->tanggal_selesai . ' 23:59:59'
                ]);
            }

            // 6. PENCARIAN BERDASARKAN NAMA PIC
            if ($request->has('search') && !empty($request->search)) {
                $query->where('nama_pic', 'like', '%' . $request->search . '%');
            }

            // 7. PENGURUTAN (SORTING)
            $sortField = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortField, $sortOrder);

            // 8. PAGINATION (membagi data per halaman)
            $perPage = $request->get('per_page', 15); // default 15 data per halaman
            $inquiries = $query->paginate($perPage);

            // Kembalikan response JSON
            return response()->json([
                'success' => true,
                'message' => 'Data inquiry berhasil diambil',
                'data' => $inquiries
            ], 200);

        } catch (\Exception $e) {
            // Jika terjadi error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data inquiry',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/inquiries - Menyimpan inquiry baru
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_pic' => 'required|string|max:255',
                'sumber_lead_id' => 'required|exists:sumber_leads,id',
                'jenis_lokasi_id' => 'required|exists:jenis_lokasis,id',
                'perusahaan_id' => 'required|exists:perusahaans,id',
                'nilai' => 'nullable|numeric',
                'status' => 'sometimes|in:inquiry,deal,cancel',
                'first_contact_by_id' => 'nullable|exists:role_contacts,id',
                'keputusan_desain_by_id' => 'nullable|exists:role_contacts,id',
                'pengaruh_desain_by_id' => 'nullable|exists:role_contacts,id',
            ]);

            // Simpan ke database
            $inquiry = Inquiry::create($validated);

            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Inquiry berhasil disimpan',
                'data' => $inquiry->load([
                    'sumberLead',
                    'jenisLokasi',
                    'perusahaan',
                    'firstContactBy',
                    'keputusanDesainBy',
                    'pengaruhDesainBy'
                ])
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan inquiry',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/inquiries/{id} - Menampilkan detail inquiry
     */
    public function show($id)
    {
        try {
            // Cari data berdasarkan ID dengan relasi
            $inquiry = Inquiry::with([
                'sumberLead',
                'jenisLokasi',
                'perusahaan',
                'firstContactBy',
                'keputusanDesainBy',
                'pengaruhDesainBy',
                'inquiryProduks.jenisProduk'
            ])->find($id);

            // Jika data tidak ditemukan
            if (!$inquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data inquiry tidak ditemukan'
                ], 404);
            }

            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Detail inquiry berhasil diambil',
                'data' => $inquiry
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail inquiry',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT/PATCH /api/inquiries/{id} - Mengupdate inquiry
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari data berdasarkan ID
            $inquiry = Inquiry::find($id);

            // Jika data tidak ditemukan
            if (!$inquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data inquiry tidak ditemukan'
                ], 404);
            }

            // Validasi input
            $validated = $request->validate([
                'nama_pic' => 'sometimes|string|max:255',
                'sumber_lead_id' => 'sometimes|exists:sumber_leads,id',
                'jenis_lokasi_id' => 'sometimes|exists:jenis_lokasis,id',
                'perusahaan_id' => 'sometimes|exists:perusahaans,id',
                'nilai' => 'nullable|numeric',
                'status' => 'sometimes|in:inquiry,deal,cancel',
                'first_contact_by_id' => 'nullable|exists:role_contacts,id',
                'keputusan_desain_by_id' => 'nullable|exists:role_contacts,id',
                'pengaruh_desain_by_id' => 'nullable|exists:role_contacts,id',
            ]);

            // Update data
            $inquiry->update($validated);

            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Inquiry berhasil diupdate',
                'data' => $inquiry->load([
                    'sumberLead',
                    'jenisLokasi',
                    'perusahaan',
                    'firstContactBy',
                    'keputusanDesainBy',
                    'pengaruhDesainBy'
                ])
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate inquiry',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/inquiries/{id} - Menghapus inquiry
     */
    public function destroy($id)
    {
        try {
            // Cari data berdasarkan ID
            $inquiry = Inquiry::find($id);

            // Jika data tidak ditemukan
            if (!$inquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data inquiry tidak ditemukan'
                ], 404);
            }

            // Hapus data (inquiry_produks akan ikut terhapus karena onDelete cascade)
            $inquiry->delete();

            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Inquiry berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus inquiry',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}