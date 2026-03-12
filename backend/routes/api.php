<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SumberLeadController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\JenisLokasiController;
use App\Http\Controllers\Api\JenisProdukController;
use App\Http\Controllers\Api\InquiryController; // <-- Tambahkan ini

Route::get('/sumber-leads', [SumberLeadController::class, 'index']);
Route::get('/perusahaans', [PerusahaanController::class, 'index']);
Route::get('/jenis-lokasis', [JenisLokasiController::class, 'index']);
Route::get('/jenis-produks', [JenisProdukController::class, 'index']);

// Route untuk Inquiry
Route::apiResource('inquiries', InquiryController::class); // <- GAMPANG! Ini bikin 5 endpoint sekaligus [citation:1][citation:10]