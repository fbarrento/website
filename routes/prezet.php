<?php

use App\Http\Controllers\Prezet\ImageController;
use App\Http\Controllers\Prezet\IndexController;
use App\Http\Controllers\Prezet\OgimageController;
use App\Http\Controllers\Prezet\PageController;
use App\Http\Controllers\Prezet\SearchController;
use App\Http\Controllers\Prezet\ShowController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// Image and OG image routes don't need session/CSRF
Route::withoutMiddleware([
    ShareErrorsFromSession::class,
    StartSession::class,
    VerifyCsrfToken::class,
])
    ->group(function () {
        Route::get('/img/{path}', ImageController::class)
            ->name('prezet.image')
            ->where('path', '.*');

        Route::get('/ogimage/{slug}', OgimageController::class)
            ->name('prezet.ogimage')
            ->where('slug', '.*');
    });

// These routes need session/CSRF for Livewire components
Route::group(function () {
    Route::get('search', SearchController::class)->name('prezet.search');

    Route::get('blog/', IndexController::class)
        ->name('prezet.index');

    Route::get('blog/{slug}', ShowController::class)
        ->name('prezet.show')
        ->where('slug', '.*');

    Route::get('{slug}', PageController::class)
        ->name('prezet.page')
        ->where('slug', '.*');
});
