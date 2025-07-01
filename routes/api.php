<?php

use App\Http\Controllers\Api\SuggestionController;
use App\Http\Controllers\Api\DashboardApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/suggestions', [SuggestionController::class, 'search']);

/*
|--------------------------------------------------------------------------
| Dashboard API Routes
|--------------------------------------------------------------------------
|
| API routes for Teras Data/Dashboard Pimpinan
|
*/

Route::prefix('dashboard')->group(function () {
    // Dashboard Overview
    Route::get('/overview', [DashboardApiController::class, 'overview']);
    
    // Statistik per Kategori
    Route::get('/kategori-stats', [DashboardApiController::class, 'kategoriStats']);
    
    // Trend Bulanan
    Route::get('/trend-bulanan', [DashboardApiController::class, 'trendBulanan']);
    
    // Perbandingan Tahun
    Route::get('/perbandingan-tahun', [DashboardApiController::class, 'perbandinganTahun']);
    
    // Top Peraturan Terpopuler
    Route::get('/top-peraturan', [DashboardApiController::class, 'topPeraturan']);
    
    // Statistik per Jenis Peraturan
    Route::get('/jenis-peraturan', [DashboardApiController::class, 'jenisPeraturan']);
    
    // Status Publikasi
    Route::get('/status-publikasi', [DashboardApiController::class, 'statusPublikasi']);
    
    // Konten per Instansi
    Route::get('/konten-instansi', [DashboardApiController::class, 'kontenInstansi']);
    
    // Pencarian Lanjutan
    Route::get('/search', [DashboardApiController::class, 'search']);
    
    // Activity Logs
    Route::get('/activity-logs', [DashboardApiController::class, 'activityLogs']);
    
    // File Upload Stats
    Route::get('/file-stats', [DashboardApiController::class, 'fileStats']);
});

// Mobile Dashboard API
Route::prefix('mobile/dashboard')->group(function () {
    Route::get('/quick-stats', [DashboardApiController::class, 'quickStats']);
});
