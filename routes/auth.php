<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// نمایش فرم ثبت‌نام
Route::get('register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

// ثبت اطلاعات ثبت‌نام
Route::post('register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

// نمایش فرم ورود
Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

// پردازش ورود
Route::post('login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

// خروج از حساب
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
