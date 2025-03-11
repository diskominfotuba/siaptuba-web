<?php

namespace App\Http\Controllers\Services\Baznas;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'webview'])->prefix('user/baznas')->group(function () {
    Route::get('/', HomeController::class)->name('baznas.home');
});
