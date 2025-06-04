@extends('layouts.app')

@section('title', 'تنظیم رنگ‌بندی برنامه')

@section('content')
@include('layouts.partials.color-header')
<link rel="stylesheet" href="{{ asset('css/color-palette.css') }}">
<div class="container mx-auto max-w-xl py-10">
    <div class="bg-white p-7 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-6">انتخاب پالت رنگ برنامه</h2>
        <div class="flex flex-wrap gap-6 justify-center" id="color-theme-options">
            <button class="theme-btn" data-theme="light">
                <span class="theme-sample theme-light"></span>
                <span>روشن</span>
            </button>
            <button class="theme-btn" data-theme="green">
                <span class="theme-sample theme-green"></span>
                <span>سبز</span>
            </button>
            <button class="theme-btn" data-theme="dark">
                <span class="theme-sample theme-dark"></span>
                <span>تیره</span>
            </button>
        </div>
        <div class="mt-8 text-gray-500 text-sm text-center">
            می‌توانید رنگ کلی برنامه را مطابق سلیقه خود تغییر دهید. انتخاب شما تا پاک شدن کش مرورگر باقی می‌ماند.
        </div>
    </div>
</div>
<script src="{{ asset('js/color-palette.js') }}"></script>
@endsection
