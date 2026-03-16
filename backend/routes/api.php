<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SumberLeadController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\JenisLokasiController;
use App\Http\Controllers\Api\JenisProdukController;
use App\Http\Controllers\Api\InquiryController; // <-- Tambahkan ini
use App\Http\Controllers\Api\ExportController;



Route::get('/sumber-leads', [SumberLeadController::class, 'index']);
Route::get('/perusahaans', [PerusahaanController::class, 'index']);
Route::get('/jenis-lokasis', [JenisLokasiController::class, 'index']);
Route::get('/jenis-produks', [JenisProdukController::class, 'index']);
Route::get('/jenis-produks', [App\Http\Controllers\Api\JenisProdukController::class, 'index']);
Route::get('/alasan-cancels', [App\Http\Controllers\Api\AlasanCancelController::class, 'index']);
Route::get('/role-contacts', [App\Http\Controllers\Api\RoleContactController::class, 'index']);
Route::get('/tipe-end-users', [App\Http\Controllers\Api\TipeEndUserController::class, 'index']);
Route::get('/jenis-pemesanans', [App\Http\Controllers\Api\JenisPemesananController::class, 'index']);
Route::get('/dashboard/summary', [App\Http\Controllers\Api\DashboardController::class, 'summary']);

Route::get('/export/inquiries', [ExportController::class, 'exportInquiries']);

// Report endpoints
Route::prefix('reports')->group(function () {
    Route::get('/pipeline-per-sumber', [App\Http\Controllers\Api\ReportController::class, 'pipelinePerSumber']);
    Route::get('/produk-terlaris', [App\Http\Controllers\Api\ReportController::class, 'produkTerlaris']);
    Route::get('/kinerja-sales', [App\Http\Controllers\Api\ReportController::class, 'kinerjaSales']);
    Route::get('/alasan-cancel', [App\Http\Controllers\Api\ReportController::class, 'alasanCancel']);
    Route::get('/lokasi-terbanyak', [App\Http\Controllers\Api\ReportController::class, 'lokasiTerbanyak']);
});
// Route untuk Inquiry
Route::apiResource('inquiries', InquiryController::class); // <- GAMPANG! Ini bikin 5 endpoint sekaligus [citation:1][citation:10]