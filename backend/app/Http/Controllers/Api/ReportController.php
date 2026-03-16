<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryProduk;
use App\Models\AlasanCancel;
use App\Models\JenisLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * 1. LAPORAN PIPELINE PER SUMBER LEAD
     * GET /api/reports/pipeline-per-sumber
     */
    public function pipelinePerSumber(Request $request)
    {
        try {
            // Filter berdasarkan bulan (opsional)
            $bulan = $request->get('bulan', now()->month);
            $tahun = $request->get('tahun', now()->year);

            $data = Inquiry::select(
                    'sumber_lead_id',
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(CASE WHEN status = "deal" THEN 1 ELSE 0 END) as total_deal'),
                    DB::raw('SUM(CASE WHEN status = "cancel" THEN 1 ELSE 0 END) as total_cancel')
                )
                ->with('sumberLead:id,nama')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->groupBy('sumber_lead_id')
                ->get()
                ->map(function ($item) {
                    return [
                        'sumber' => $item->sumberLead->nama ?? 'Unknown',
                        'total' => $item->total,
                        'deal' => $item->total_deal,
                        'cancel' => $item->total_cancel,
                        'persentase_deal' => $item->total > 0 
                            ? round(($item->total_deal / $item->total) * 100, 2) 
                            : 0
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Laporan pipeline per sumber lead',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * 2. LAPORAN PRODUK TERLARIS
     * GET /api/reports/produk-terlaris
     */
    public function produkTerlaris(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);

            $data = InquiryProduk::select(
                    'jenis_produk_id',
                    DB::raw('SUM(jumlah) as total_terjual'),
                    DB::raw('SUM(harga * jumlah) as total_pendapatan')
                )
                ->with('jenisProduk:id,nama,kategori')
                ->groupBy('jenis_produk_id')
                ->orderBy('total_terjual', 'desc')
                ->limit($limit)
                ->get()
                ->map(function ($item) {
                    return [
                        'produk' => $item->jenisProduk->nama ?? 'Unknown',
                        'kategori' => $item->jenisProduk->kategori ?? '-',
                        'total_terjual' => $item->total_terjual,
                        'total_pendapatan' => (float) $item->total_pendapatan
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Laporan produk terlaris',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * 3. LAPORAN KINERJA SALES (PER PIC)
     * GET /api/reports/kinerja-sales
     */
    public function kinerjaSales(Request $request)
    {
        try {
            $bulan = $request->get('bulan', now()->month);
            $tahun = $request->get('tahun', now()->year);

            $data = Inquiry::select(
                    'nama_pic',
                    DB::raw('COUNT(*) as total_inquiry'),
                    DB::raw('SUM(CASE WHEN status = "deal" THEN 1 ELSE 0 END) as total_deal'),
                    DB::raw('SUM(CASE WHEN status = "cancel" THEN 1 ELSE 0 END) as total_cancel'),
                    DB::raw('SUM(nilai) as total_nilai_deal')
                )
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->where('status', 'deal')
                ->groupBy('nama_pic')
                ->orderBy('total_deal', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama_pic' => $item->nama_pic,
                        'total_inquiry' => $item->total_inquiry,
                        'total_deal' => $item->total_deal,
                        'total_cancel' => $item->total_cancel,
                        'persentase_sukses' => $item->total_inquiry > 0 
                            ? round(($item->total_deal / $item->total_inquiry) * 100, 2) 
                            : 0,
                        'total_nilai_deal' => (float) $item->total_nilai_deal
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Laporan kinerja sales',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * 4. LAPORAN ALASAN CANCEL
     * GET /api/reports/alasan-cancel
     */
    public function alasanCancel(Request $request)
    {
        try {
            $bulan = $request->get('bulan', now()->month);
            $tahun = $request->get('tahun', now()->year);

            // Hitung total cancel bulan ini
            $totalCancel = Inquiry::where('status', 'cancel')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->count();

            // Data per alasan cancel (kalau ada kolom alasan_cancel_id)
            // Untuk sementara, karena mungkin belum ada kolom alasan_cancel_id,
            // kita tampilkan data dummy atau kosong

            $data = AlasanCancel::withCount(['inquiries' => function($query) use ($bulan, $tahun) {
                    $query->whereYear('created_at', $tahun)
                          ->whereMonth('created_at', $bulan);
                }])
                ->get()
                ->map(function ($item) use ($totalCancel) {
                    return [
                        'alasan' => $item->nama,
                        'jumlah' => $item->inquiries_count,
                        'persentase' => $totalCancel > 0 
                            ? round(($item->inquiries_count / $totalCancel) * 100, 2) 
                            : 0
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Laporan alasan cancel',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * 5. LAPORAN LOKASI TERBANYAK
     * GET /api/reports/lokasi-terbanyak
     */
    public function lokasiTerbanyak(Request $request)
    {
        try {
            $bulan = $request->get('bulan', now()->month);
            $tahun = $request->get('tahun', now()->year);

            $data = Inquiry::select(
                    'jenis_lokasi_id',
                    DB::raw('COUNT(*) as total')
                )
                ->with('jenisLokasi:id,nama')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->groupBy('jenis_lokasi_id')
                ->orderBy('total', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'lokasi' => $item->jenisLokasi->nama ?? 'Unknown',
                        'total' => $item->total
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Laporan lokasi terbanyak',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}