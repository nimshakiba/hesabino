<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// سایر روت‌ها و auth
require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('dashboard');
})->name('home');
