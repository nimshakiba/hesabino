<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\SwitchTenantDatabase;
use App\Http\Controllers\BusinessController;

// صفحه فرود و auth
Route::get('/', [LandingController::class, 'index'])->name('landing');
require __DIR__.'/auth.php';

// ثبت کسب‌وکار
Route::middleware(['auth'])->group(function () {
    Route::get('/business/create', [BusinessController::class, 'create'])->name('business.create');
    Route::post('/business', [BusinessController::class, 'store'])->name('business.store');
});

// فقط یک گروه برای همه routeهای نیازمند کسب‌وکار
Route::middleware(['auth', 'check.business'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // سایر routeها
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

    Route::middleware([SwitchTenantDatabase::class])->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    Route::get('/settings/colors', function() {
        return view('settings.color');
    })->name('color.settings');
});
