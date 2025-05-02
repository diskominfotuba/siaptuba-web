<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/dashboard', Users\DashboardController::class)->name('user.dashboard');

    Route::get('/izin', [Users\IzinController::class, 'index']);
    Route::post('/izin/store', [Users\IzinController::class, 'store']);
    Route::put('/izin/update', [Users\IzinController::class, 'update']);
    Route::get('/izin/print', [Users\IzinController::class, 'print']);

    Route::get('/histories', [Users\HistoryController::class, 'index']);
    Route::get('/history/print', [Users\HistoryController::class, 'print']);

    Route::get('/profile', [Users\ProfileController::class, 'index']);
    Route::post('/profile/sinkronisasi', [Users\ProfileController::class, 'sinkronisasi'])->name('user.profile.sinkronisasi');

    //route for scanner
    Route::get('/scan', Users\ScanController::class);

    //sub opd
    Route::get('subopd', [Users\SubopdController::class, 'index']);

    //route for shift
    Route::get('/shift', [Users\ShiftController::class, 'index']);

    //route for persetujuan / approval dl dinas luar
    Route::controller(Users\ApprovalController::class)->group(function () {
        Route::get('approval/dl/', 'index')->name('user.approval.dl');
        Route::get('approval/dl/show/{id}', 'show')->name('user.approval.dl.show');
        Route::post('approval/dl/update/{id}', 'update')->name('user.approval.dl.update');
    });

    //route for persetujuan / approval cuti/izin
    Route::controller(Users\ApprovalCutiController::class)->group(function () {
        Route::get('approval/cuti/', 'index')->name('user.approval.cuti');
        Route::get('approval/cuti/show/{id}', 'show')->name('user.approval.cuti.show');
        Route::post('approval/cuti/update/{id}', 'update')->name('user.approval.cuti.update');
    });

    //route untuk TPP pegawai
    Route::controller(Users\TppController::class)->group(function () {
        Route::get('/tpp', 'index')->name('user.tpp');
        Route::get('/tpp/riwayat', 'riwayat');
    });

    //web push notification
    Route::post('sent_token_to_server', Users\WebpushController::class);

    //route untuk otp
    Route::get('otp', Users\OTPController::class)->name('user.otp');

    //register face
    Route::post('/register-face', Users\RagisterfaceController::class);

    //route for face check
    Route::post('/presensi/face_check', Users\FacecheckController::class);

    //route for kegiatan
    Route::controller(Users\KegiatanController::class)->group(function () {
        Route::get('/kegiatan', 'index')->name('user.kegiatan');
        Route::get('/scan/kegiatan/result/{id}', 'show')->name('scan.kegiatan.result');
        Route::post('/kegiatan/hadir/{kegiatan_id}', 'store')->name('scan.kegiatan.store');
    });

    //route for dokumen
    Route::controller(Users\DokumenController::class)->group(function () {
        Route::get('/dokumen', 'index')->name('user.dokumen');
        Route::post('/dokumen/store', 'store')->name('user.dokumen.store');
    });

    //route untuk komentar pengguna pada pengajuan
    Route::post('/komentar', \App\Http\Controllers\BKPP\UserKomentarController::class)->name('bkpp.user.komentar');

    //route for ekin
    Route::controller(Users\EkinController::class)->group(function () {
        Route::get('/ekin', 'index')->name('user.ekin');
        Route::post('/ekin/store', 'store')->name('user.ekin.store');
        Route::get('/ekin/show/{id}', 'show')->name('user.ekin.show');
        Route::get('/ekin/riwayat', 'riwayat')->name('user.ekin.riwayat');
        Route::post('/ekin/destroy/{id}', 'destroy')->name('user.ekin.destroy');
    });

    //route untuk menampilkan PDF dalam iframe
    Route::get('/pdfviewer/{year}/{filename}', Users\PDFViewerController::class)->name('user.pdfviewer');

    //route lhkpn list
    Route::get('/lhkpn', [Users\LhkpnController::class, 'index'])->name('user.lhkpn');

    //route hapus akun
    Route::get('/hapus-akun', [Users\HapusAkunController::class, 'index']);
    Route::post('/hapus-akun', [Users\HapusAkunController::class, 'store']);

    //route untuk sinkronisasi-data-pegawai di services sso
    Route::post('/sso/login', [API\SinkrondataController::class, 'login']);
    Route::post('/sinkronisasi-data-pegawai', [API\SinkrondataController::class, 'sinkronisasi']);
});
