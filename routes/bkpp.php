<?php

namespace App\Http\Controllers\BKPP;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('bkpp')->group(function () {
    //dashboard
    Route::get('/', DashboardController::class)->name('bkpp.dashboard');
    Route::get('/layanan/{layanan_id}', [LayananController::class, 'index'])->name('bkpp.layanan');
    Route::get('/layanan/{layanan_id}/show/{pengajuan_id}', [LayananController::class, 'show'])->name('bkpp.layanan.show');

    Route::post('/layanan/{layanan_id}/show/{pengajuan_id}/diproses', [LayananController::class, 'updateDiproses'])->name('bkpp.layanan.update-proses');
    Route::post('/layanan/{layanan_id}/show/{pengajuan_id}/ditolak', [LayananController::class, 'updateDitolak'])->name('bkpp.layanan.update-tolak');
    Route::post('/layanan/{layanan_id}/show/{pengajuan_id}/selesai', [LayananController::class, 'updateSelesai'])->name('bkpp.layanan.update-selesai');

    Route::controller(Master\KategoriController::class)->prefix('kepegawaian')->group(function () {
        Route::get('/', 'index')->name('bkpp.master.kategori');
        Route::post('/store', 'store')->name('bkpp.master.kategori.store');
        Route::post('/update/{id}', 'update')->name('bkpp.master.kategori.update');
        Route::post('/destroy/{id}', 'destroy')->name('bkpp.master.kategori.destroy');
    });

    // Daftar Layanan Kepegawaian
    Route::controller(Master\LayananController::class)->prefix('kepegawaian/show/{kategori_id}')->group(function () {
        Route::get('/', 'index')->name('bkpp.master.layanan');
        Route::post('/store', 'store')->name('bkpp.master.layanan.store');
        Route::post('/update/{id}', 'update')->name('bkpp.master.layanan.update');
        Route::post('/destroy/{id}', 'destroy')->name('bkpp.master.layanan.destroy');
    });

    // Daftar Berkas Layanan Kepegawaian
    Route::controller(Master\InputLayananController::class)->prefix('kepegawaian/show/{kategori_id}/layanan/{layanan_id}')->group(function () {
        Route::get('/', 'index')->name('bkpp.master.inputlayanan');
        Route::post('/store', 'store')->name('bkpp.master.inputlayanan.store');
        Route::post('/update/{id}', 'update')->name('bkpp.master.inputlayanan.update');
        Route::post('/destroy/{id}', 'destroy')->name('bkpp.master.inputlayanan.destroy');
    });
    Route::post('/kepegawaian/update_status/{input_id}', [Master\InputLayananController::class, 'updateStatus'])->name('bkpp.master.inputlayanan.update_status');

    // Periode
    Route::controller(Master\PeriodeController::class)->prefix('kepegawaian/show/{kategori_id}/layanan/{layanan_id}/periode')->group(function () {
        Route::get('/', 'index')->name('bkpp.master.periode');
        Route::post('/store', 'store')->name('bkpp.master.periode.store');
        Route::post('/update/{id}', 'update')->name('bkpp.master.periode.update');
        Route::post('/destroy/{id}', 'destroy')->name('bkpp.master.periode.destroy');
    });

    // //route untuk komentar pengajuan
    Route::post('/komentar', UserKomentarController::class)->name('bkpp.komentar');

    //route untuk menampilkan list profile
    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'index');
        Route::get('/user/profile', 'profile');
    });

    //route untuk upload dokumen berkala
    Route::controller(BerkalaController::class)->group(function () {
        Route::get('/berkala', 'index')->name('berkala.bkpp');
        Route::post('/berkala/store', 'store')->name('berkala.store');
        Route::post('/berkala/delete/{id}', 'delete')->name('berkala.delete');
    });
});
