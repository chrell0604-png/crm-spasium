<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exports\InquiriesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportInquiries(Request $request)
    {
        try {
            $status = $request->get('status');
            $tanggal_mulai = $request->get('tanggal_mulai');
            $tanggal_selesai = $request->get('tanggal_selesai');

            $fileName = 'inquiries_export_' . date('Ymd_His') . '.xlsx';

            return Excel::download(
                new InquiriesExport($status, $tanggal_mulai, $tanggal_selesai),
                $fileName
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal export data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}