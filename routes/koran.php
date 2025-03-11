<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('koran')->group(function() {
    Route::controller(Koran\KoranController::class)->group(function() {
        Route::get('/', 'index')->name('koran');
    });
});