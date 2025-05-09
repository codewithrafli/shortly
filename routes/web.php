<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('/url', UrlController::class);
});

Route::get('/{shortUrl}', [UrlController::class, 'redirect'])->name('shortlink.redirect');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
