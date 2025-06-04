<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonCategoryController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/
// صفحه پروفایل
Route::middleware('auth')->get('/profile', function () {
    return view('profile');
})->name('profile.edit');

// صفحه فرود
Route::get('/', [LandingController::class, 'index'])->name('landing');

// احراز هویت لاراول
require __DIR__.'/auth.php';

// داشبورد (صفحه خانه برای کاربران عادی)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // اشخاص
    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::post('/persons/{person}/toggle-active', [PersonController::class, 'toggleActive'])->name('persons.toggle-active');

    // AJAX: دریافت دسته‌بندی‌های اشخاص
    Route::get('/ajax/person-categories', [PersonCategoryController::class, 'listAjax'])->name('ajax.person_categories');

    // روت‌های ادمین فقط برای مدیرکل
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // داشبورد مدیرکل
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // مدیریت کاربران (نمونه)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // سایر روت‌های مدیریتی...
    });

    // دسته بندی
});

Route::middleware(['auth'])->group(function () {
    Route::view('/categories', 'categories.index')->name('categories.index');
});
