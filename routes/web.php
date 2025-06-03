<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// سایر روت‌ها و auth
require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('dashboard');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // اشخاص
    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::post('/persons/{person}/toggle-active', [PersonController::class, 'toggleActive'])->name('persons.toggle-active');
});

Route::middleware(['auth'])->group(function () {
    // روت داشبورد کاربر عادی
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // روت‌های اشخاص
    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::post('/persons/{person}/toggle-active', [PersonController::class, 'toggleActive'])->name('persons.toggle-active');

    // --- روت‌های ادمین ---
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // روت‌های دیگر مدیریتی...
    });
});
