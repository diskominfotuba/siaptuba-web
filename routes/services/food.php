<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'webview'])->prefix('user')->group(function () {
    // route for pesan makan service
    Route::get('/food', function () {
        return view('services.food.users.home.index');
    })->name('food');

    Route::get('/food/list', function () {
        return view('services.food.users.list.index');
    })->name('food.list');
    // end route for pesan makan service
});