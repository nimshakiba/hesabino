<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth')->get('/profile', function () {
    return view('profile');
})->name('profile.edit');

Route::get('/', [LandingController::class, 'index'])->name('landing');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::post('/persons/{person}/toggle-active', [PersonController::class, 'toggleActive'])->name('persons.toggle-active');

    Route::get('/ajax/person-categories', [PersonCategoryController::class, 'listAjax'])->name('ajax.person_categories');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});

Route::get('/settings/colors', function() {
    return view('settings.color');
})->name('color.settings');

// فقط اینجا تعریف resource دسته‌بندی را داری
Route::middleware(['auth', 'tenant.db'])->group(function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
});
Route::middleware(['auth', 'switchTenantDatabase'])->group(function () {
    Route::resource('categories', CategoryController::class);
    // سایر routeهای tenant
});
