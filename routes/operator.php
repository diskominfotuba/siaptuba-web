<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'oprator'])->prefix('oprator')->group(function () {
    Route::get('/dashboard', [Oprator\DashboardController::class, 'index']);
    Route::get('/pegawai', [Oprator\PegawaiController::class, 'index']);
    Route::post('/pegawai/store', [Oprator\PegawaiController::class, 'store']);
    Route::get('/pegawai/show/{id}', [Oprator\PegawaiController::class, 'show']);
    Route::put('/pegawai/update/{id}', [Oprator\PegawaiController::class, 'update']);

    Route::get('/statuspegawai', [Oprator\StatuspegawaiController::class, 'index']);
    Route::post('/statuspegawai/store', [Oprator\StatuspegawaiController::class, 'store']);
    Route::get('/statuspegawai/show/{id}', [Oprator\StatuspegawaiController::class, 'show']);
    Route::post('/statuspegawai/update', [Oprator\StatuspegawaiController::class, 'update']);

    Route::get('/cuti', [Oprator\CutiController::class, 'index']);
    Route::get('/cuti/show/{id}', [Oprator\CutiController::class, 'show']);

    //mster presensi
    Route::get('/presensi', [Oprator\PresensiController::class, 'index']);

    //import pegawai
    Route::post('/importuser', ImportuserController::class);

    //export presensi
    Route::get('/presensi/export', Oprator\ExportpresensiController::class);

    //export presensi pegawai
    Route::get('/presensi/pegawai/export', Oprator\ExportpresensipegawaiController::class);
    Route::get('/export/cuti', Oprator\ExportcutiController::class);

    Route::get('profile', Oprator\ProfileController::class);

    // rekap presensi
    Route::get('/rekap_presensi', [Oprator\RekappresensiController::class, 'index'])->name('oprator.rekap_presensi');
    Route::get('/rekap_presensi/export', [Oprator\RekappresensiController::class, 'export'])->name('oprator.rekap_presensi.export');

    //route for kegiatan
    Route::controller(Oprator\KegiatanController::class)->group(function () {
        Route::get('/kegiatan', 'index')->name('oprator.kegiatan');
        Route::get('/kegiatan/create', 'create')->name('oprator.kegiatan.create');
        Route::post('/kegiatan/store', 'store')->name('oprator.kegiatan.store');
        Route::get('/kegiatan/show/{id}', 'show')->name('oprator.kegiatan.show');
        Route::put('/kegiatan/update/{id}', 'update')->name('oprator.kegiatan.update');
        Route::get('/kegiatan/tamu-undangan/{id}', 'list')->name('oprator.kegiatan.tamu-undangan');
        Route::get('/kegiatan/print/page/{id}', 'print')->name('oprator.kegiatan.print');
        Route::get('/kegiatan/print/qrcode/{id}', 'printQr')->name('oprator.kegiatan.print.qrcode');
    });

    //route for approval
    Route::controller(Oprator\ApprovalController::class)->group(function () {
        Route::get('/approval', 'index')->name('oprator.approval');
        Route::get('/approval/create', 'create')->name('oprator.approval.create');
        Route::post('/approval/store', 'store')->name('oprator.approvals.store');
        Route::post('/approval/update', 'update')->name('oprator.approvals.update');
    });
    //end route for approval

    Route::get('/riwayattpp', [Oprator\RiwayatTppController::class, 'index'])->name('riwayattpp');
    Route::get('/riwayattpp/show/{user_id}', [Oprator\RiwayatTppController::class, 'show'])->name('operator.riwayattpp.show');
    Route::get('/riwayattpp/print', [Oprator\RiwayatTppController::class, 'print'])->name('operator.riwayattpp.print');
    Route::get('/riwayattpp/print/all', [Oprator\RiwayatTppController::class, 'printAll'])->name('operator.riwayattpp.print.all');

    //lhkpn
    Route::controller(Oprator\LhkpnController::class)->group(function () {
        Route::get('/lhkpn', 'index')->name('operator.lhkpn');
        Route::post('/lhkpn/import_data', 'import')->name('operator.lhkpn.import');
        Route::post('/lhkpn/update/{id}', 'update')->name('operator.lhkpn.update');
        Route::post('/lhkpn/delete/{id}', 'delete')->name('operator.lhkpn.delete');
        Route::post('/lhkpn/delete_all_data', 'deleteAllData')->name('operator.lhkpn.delete.bulk');
    });

    //route tugas harian
    Route::controller(Oprator\TugasharianController::class)->group(function () {
        Route::get('/tugas_harian', 'index')->name('operator.tugas_harian');
        Route::get('/tugas_harian/print_all', 'printAll')->name('operator.tugas_harian.printAll');
        Route::get('/tugas_harian/show/{id}', 'show')->name('operator.tugas_harian.show');
        Route::post('/tugas_harian/destroy/{id}', 'destroy')->name('operator.tugas_harian.destroy');
    });

    //route verifikasi berkas
    Route::controller(Oprator\VerifikasiBerkasController::class)->group(function () {
        Route::get('/verifikasi_berkas', 'index')->name('operator.verifikasi_berkas');
        Route::get('/verifikasi_berkas/show/{pengajuan_id}', 'show')->name('operator.verifikasi_berkas.show');

        Route::post('/verifikasi_berkas/show/{pengajuan_id}/diverifikasi', 'updateDiverifikasi')->name('operator.verifikasi_berkas.verifikasi');
        Route::post('/verifikasi_berkas/show/{pengajuan_id}/ditolak', 'updateDitolak')->name('operator.verifikasi_berkas.ditolak');
    });
});
