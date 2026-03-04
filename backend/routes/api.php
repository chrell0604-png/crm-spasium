<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\VisitorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProjectLocationController;
use App\Http\Controllers\Api\CancelReasonController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\VisitProductController;
use App\Http\Controllers\Api\VisitLocationController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\VisitCancelController;

Route::get('/test', function() {
    return response()->json(['message' => 'okaiii']);
});

Route::get('/companies', function() {
    return response()->json(['message' => 'API HIDUP!']);
});


Route::apiResource('companies', CompanyController::class);
Route::apiResource('visitors', VisitorController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('project-locations', ProjectLocationController::class);
Route::apiResource('cancel-reasons', CancelReasonController::class);
Route::apiResource('visits', VisitController::class);
Route::apiResource('visit-products', VisitProductController::class);
Route::apiResource('visit-locations', VisitLocationController::class);
Route::apiResource('activities', ActivityController::class);
Route::apiResource('visit-cancels', VisitCancelController::class);