<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrashScanController;

// Halaman Utama: Live & File Detector Dual-Mode (Public - tanpa login)
Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Protected Routes - harus login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Halaman Dashboard User (Jetstream default)
    Route::get('/dashboard-user', function () {
        return view('dashboard');
    })->name('dashboard-user');

    // Halaman Log Riwayat Scan
    Route::get('/history', function () {
        return view('history');
    })->name('history');

    // Halaman Metrik Statistik & Analytics
    Route::get('/analytics', function () {
        return view('analytics');
    })->name('analytics');

    // Database Scan Persistence Routes (scoped per-user)
    Route::prefix('api/scans')->group(function () {
        Route::get('/', [TrashScanController::class, 'index']);
        Route::post('/', [TrashScanController::class, 'store']);
        Route::post('/{uuid}/toggle-permanent', [TrashScanController::class, 'togglePermanent']);
        Route::delete('/{uuid}', [TrashScanController::class, 'destroy']);
        Route::post('/clear-all', [TrashScanController::class, 'clearAll']);
    });
});
