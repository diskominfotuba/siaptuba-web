<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'webview'])->prefix('user')->group(function () {
    Route::get('/ragahtuah', function () {
        return view('services.ragahtuah.users.home.index');
    })->name('ragahtuah');

    Route::get('/ragahtuah/soal', function () {
        return view('services.ragahtuah.users.soal.index');
    })->name('ragahtuah.soal');

    Route::get('/ragahtuah/peringkat', function () {
        return view('services.ragahtuah.users.peringkat.index');
    })->name('ragahtuah.peringkat');

    Route::get('/ragahtuah/result', function () {
        return view('services.ragahtuah.users.result.index');
    })->name('ragahtuah.result');
});
