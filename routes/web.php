<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('{slug?}', ContentController::class)
    ->where('slug', '.*');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
