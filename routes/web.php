<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialImagePreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');


require __DIR__.'/prezet.php';
