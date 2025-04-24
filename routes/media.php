<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('media.auth')->group(function() {
    Route::prefix('media')->group(function() {
        Route::get('/dashboard', [Media\DashboardController::class, 'index'])->name('media.dashboard');

        //route for scanner
        Route::get('/scanner', [Media\ScannerController::class, 'index'])->name('media.scanner');
        Route::get('/scanner/redirect-link/{id}', [Media\ScannerController::class, 'show'])->name('media.scanner.show');

        //route untuk kunjungan media
        Route::post('/kunjungan/store/{id}', [Media\KunjunganController::class, 'store'])->name('media.kunjungan.store');

        Route::get('/instagram', [InstagramController::class, 'index'])->name('media.instagram');
        Route::get('/instagram/{id}', [InstagramController::class, 'show'])->name('media.instagram.show');
    });
});