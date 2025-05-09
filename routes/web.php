<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('/url', UrlController::class);
    Route::get('/url/{id}/analytics', [UrlController::class, 'analytics'])->name('url.analytics');
});

Route::get('/{shortUrl}', [UrlController::class, 'redirect'])->name('shortlink.redirect');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
