<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ExportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index']);

    // Route::resource('user', UserController::class);
    Route::get('/opd', [Admin\OpdController::class, 'index']);
    Route::get('/opd/create', [Admin\OpdController::class, 'create']);
    Route::post('/opd/store', [Admin\OpdController::class, 'store']);
    Route::get('/opd/show/{id}', [Admin\OpdController::class, 'show']);
    Route::put('/opd/update/{id}', [Admin\OpdController::class, 'update']);
    Route::get('/opd/delete/{id}', [Admin\OpdController::class, 'destroy']);

    Route::get('/subopd', [Admin\SubOpdController::class, 'index']);
    Route::get('/subopd/create', [Admin\SubOpdController::class, 'create']);
    Route::post('/subopd/store', [Admin\SubOpdController::class, 'store']);
    Route::get('/subopd/show/{id}', [Admin\SubOpdController::class, 'show']);
    Route::put('/subopd/update/{id}', [Admin\SubOpdController::class, 'update']);
    Route::get('/subopd/delete/{id}', [Admin\SubOpdController::class, 'destroy']);

    Route::get('/presensi/opd/show/{id}', [Admin\PresensiopdController::class, 'show']);

    Route::get('/rekap_presensi', [Admin\RekappresensiController::class, 'index']);
    Route::get('/rekap_presensi/export', [Admin\RekappresensiController::class, 'export']);

    Route::get('/pegawai', [Admin\UserController::class, 'index']);
    Route::post('/pegawai/store', [Admin\UserController::class, 'store']);
    Route::get('/pegawai/show/{id}', [Admin\UserController::class, 'show']);
    Route::put('/pegawai/update/{id}', [Admin\UserController::class, 'update']);
    Route::post('/user/destroy/{id}', [Admin\UserController::class, 'destroy']);

    Route::get('/profile', [Admin\ProfileController::class, 'index']);
    Route::post('/profile/import', [Admin\ProfileController::class, 'import']);
    Route::get('/profile/show/{id}', [Admin\ProfileController::class, 'show']);

    Route::get('/oprator', [Admin\OpratorController::class, 'index']);
    Route::post('/oprator/store', [Admin\OpratorController::class, 'store']);

    //route for titik kumpul
    Route::get('/titik_kumpul', [Admin\TitikkumpulController::class, 'index']);
    Route::get('/titik_kumpul/create', [Admin\TitikkumpulController::class, 'create']);
    Route::post('/titik_kumpul/store', [Admin\TitikkumpulController::class, 'store']);
    Route::get('/titik_kumpul/show/{id}', [Admin\TitikkumpulController::class, 'show']);
    Route::put('/titik_kumpul/update/{id}', [Admin\TitikkumpulController::class, 'update']);
    Route::put('/titik_kumpul/update_status/{id}', [Admin\TitikkumpulController::class, 'updateStatus']);

    //set role
    Route::get('/oprator/role/{id}', [Admin\RoleController::class, 'index']);
    Route::post('/oprator/set-role', [Admin\RoleController::class, 'setRole']);

    //import pegawai
    Route::post('/importuser', ImportuserController::class);
    Route::get('/export/user', ExportController::class);


    //report
    Route::get('/presensi', [Admin\PresensiController::class, 'index']);

    //log
    Route::get('/log', Admin\LogController::class);

    //logout
    Route::post('/admin/logout', Auth\LogoutController::class);

    //log face check
    Route::get('/logfacecheck', [Admin\LogfacecheckController::class, 'index']);
    Route::get('/logfacecheck/show/{id}', [Admin\LogfacecheckController::class, 'show']);
});
