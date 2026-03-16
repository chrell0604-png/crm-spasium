<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\SumberLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function summary()
    {
        try {
            // Tanggal hari ini
            $hariIni = now()->format('Y-m-d');
            $bulanIni = now()->format('Y-m');
            $tahunIni = now()->format('Y');

            // 1. Total inquiry hari ini
            $totalInquiryHariIni = Inquiry::whereDate('created_at', $hariIni)->count();

            // 2. Total inquiry bulan ini
            $totalInquiryBulanIni = Inquiry::whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();

            // 3. Total deal bulan ini
            $totalDealBulanIni = Inquiry::where('status', 'deal')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();

            // 4. Total cancel bulan ini
            $totalCancelBulanIni = Inquiry::where('status', 'cancel')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();

            // 5. Persentase konversi (deal dari total inquiry bulan ini)
            $persentaseKonversi = $totalInquiryBulanIni > 0 
                ? round(($totalDealBulanIni / $totalInquiryBulanIni) * 100, 2)
                : 0;

            // 6. Sumber lead teratas (top 5)
            $sumberLeadTeratas = Inquiry::select('sumber_lead_id', DB::raw('count(*) as total'))
                ->with('sumberLead:id,nama')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->groupBy('sumber_lead_id')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'sumber' => $item->sumberLead->nama ?? 'Unknown',
                        'total' => $item->total
                    ];
                });

            // 7. Aktivitas terbaru (5 data terakhir)
            $aktivitasTerbaru = Inquiry::with(['sumberLead', 'perusahaan'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_pic' => $item->nama_pic,
                        'status' => $item->status,
                        'nilai' => $item->nilai,
                        'sumber' => $item->sumberLead->nama ?? '-',
                        'perusahaan' => $item->perusahaan->nama ?? '-',
                        'waktu' => $item->created_at->diffForHumans()
                    ];
                });

            // 8. Statistik per status (untuk pie chart)
            $statistikStatus = [
                'inquiry' => Inquiry::where('status', 'inquiry')->count(),
                'deal' => $totalDealBulanIni,
                'cancel' => $totalCancelBulanIni,
            ];

            // Kembalikan response JSON
            return response()->json([
                'success' => true,
                'message' => 'Data dashboard berhasil diambil',
                'data' => [
                    'total_inquiry_hari_ini' => $totalInquiryHariIni,
                    'total_inquiry_bulan_ini' => $totalInquiryBulanIni,
                    'total_deal_bulan_ini' => $totalDealBulanIni,
                    'total_cancel_bulan_ini' => $totalCancelBulanIni,
                    'persentase_konversi' => $persentaseKonversi,
                    'sumber_lead_teratas' => $sumberLeadTeratas,
                    'aktivitas_terbaru' => $aktivitasTerbaru,
                    'statistik_status' => $statistikStatus
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dashboard',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}