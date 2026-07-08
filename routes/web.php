<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrashScanController;
use App\Http\Controllers\PredictController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::post('/detect', [PredictController::class, 'detect']);
Route::post('/api/detect', [PredictController::class, 'detect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard-user', function () {
        return view('dashboard');
    })->name('dashboard-user');

    Route::get('/history', function () {
        return view('history');
    })->name('history');

    Route::get('/analytics', function () {
        return view('analytics');
    })->name('analytics');

    Route::prefix('api/scans')->group(function () {
        Route::get('/', [TrashScanController::class, 'index']);
        Route::post('/', [TrashScanController::class, 'store']);
        Route::post('/{uuid}/toggle-permanent', [TrashScanController::class, 'togglePermanent']);
        Route::delete('/{uuid}', [TrashScanController::class, 'destroy']);
        Route::post('/clear-all', [TrashScanController::class, 'clearAll']);
    });
});