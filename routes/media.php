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

        //route untuk profile
        Route::get('/profile', [Media\ProfileController::class, 'index'])->name('media.profile');
        Route::put('/profile', [Media\ProfileController::class, 'update'])->name('media.profile.update');
        Route::get('/profile/logout', [Media\ProfileController::class, 'logout'])->name('media.profile.logout');

        //rote untuk update password
        Route::put('/password', Media\PasswordController::class)->name('media.password.update');
    });
});