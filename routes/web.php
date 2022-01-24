<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\ListingController::class, 'index'])
    ->name("listing.index");

Route::get('/create', [Controllers\ListingController::class, 'create'])
    ->name('listings.create');

Route::post('/create', [Controllers\ListingController::class, 'store'])
    ->name('listings.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/{listing}', [Controllers\ListingController::class, 'show'])
    ->name('listings.show');

Route::get('/{listing}/apply', [Controllers\ListingController::class, 'apply'])
    ->name('listings.apply');
