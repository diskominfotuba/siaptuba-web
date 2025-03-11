<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Services;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('kepegawaian')->group(function () {
    //route untuk list layanan kepegawaian
    Route::get('/', HomeController::class)->name('user.kepegawaian');

    //route otp
    Route::get('/otp', [OTPController::class, 'index'])->name('kepegawaian.otp');
    Route::post('/otp/verifikasi', [OTPController::class, 'verifOtp'])->name('kepegawaian.otp.verifikasi');

    // Route::middleware('kepegawaian')->group(function() {
    //route upload dokumen
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('kepgawaian.dokumen');
    Route::post('/upload_file/store', [DokumenController::class, 'store'])->name('kepgawaian.upload.file.store');
    Route::post('/file/delete/{id}', [DokumenController::class, 'delete'])->name('kepgawaian.file.delete');

    //route akses file
    Route::get('/file/{filename}', FileController::class)->name('kepegawaian.dokumen');
    Route::get('/pdf/{filename}', PDFController::class)->name('kepegawaian.pdf');

    //route daftar pengajuan
    Route::prefix('layanan')->group(function () {
        // route untuk kategori pengajuan
        Route::get('/', Services\Kepegawaian\Pengajuan\HomeController::class)->name('services.kepegawaian');
        Route::get('/show/{id}/create', [Services\Kepegawaian\Pengajuan\LayananController::class, 'create'])->name('services.kepegawaian.layanan.create');
        Route::post('/show/{id}/create', [Services\Kepegawaian\Pengajuan\LayananController::class, 'store'])->name('services.kepegawaian.layanan.store');

        // detail pengajuan
        Route::get('/pengajuan/{id}', [Services\Kepegawaian\Pengajuan\LayananController::class, 'show'])->name('services.kepegawaian.pengajuan');
        Route::post('/pengajuan/{id}', [Services\Kepegawaian\Pengajuan\LayananController::class, 'update'])->name('services.kepegawaian.pengajuan.update');

        // menampilkan list dokumen berdasarkan user
        Route::get('/dokumen', [PengajuanController::class, 'dokumen'])->name('services.kepegawaian.dokumen');
    });
    // });
});
