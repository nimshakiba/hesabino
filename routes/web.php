<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\SwitchTenantDatabase;
use App\Http\Controllers\BusinessController;

// پروفایل کاربر
Route::middleware('auth')->get('/profile', function () {
    return view('profile');
})->name('profile.edit');

// صفحه فرود
Route::get('/', [LandingController::class, 'index'])->name('landing');

require __DIR__.'/auth.php';

// گروه روت‌های نیازمند احراز هویت
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::post('/persons/{person}/toggle-active', [PersonController::class, 'toggleActive'])->name('persons.toggle-active');

    Route::get('/ajax/person-categories', [PersonCategoryController::class, 'listAjax'])->name('ajax.person_categories');

    // گروه ادمین
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});

// تنظیمات رنگ
Route::get('/settings/colors', function() {
    return view('settings.color');
})->name('color.settings');

// روت‌های مربوط به tenant (دسته‌بندی‌ها و سایر روت‌های tenant)

Route::middleware(['auth', SwitchTenantDatabase::class])->group(function () {
    Route::resource('categories', CategoryController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/business/create', [BusinessController::class, 'create'])->name('business.create');
    Route::post('/business', [BusinessController::class, 'store'])->name('business.store');
});

Route::middleware(['auth', 'check.business'])->group(function () {
    // همه routeهایی که کسب‌وکار نیاز دارند
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // سایر routeهای وابسته به کسب‌وکار
});
