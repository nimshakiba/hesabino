@extends('layouts.app')

@section('title', 'قالب رنگ‌بندی برنامه')

@section('content')
<div class="container mx-auto max-w-2xl py-10">
    <div class="bg-white card p-7 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-6">انتخاب قالب رنگ‌بندی برنامه</h2>
        <div class="flex gap-4 mb-7">
            <button class="theme-switcher-btn @if((request()->cookie('color-theme') ?? (session('color-theme') ?? 'light'))=='light') selected @endif" data-theme="light">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <circle cx="16" cy="16" r="8" fill="#FFD600" stroke="#FFD600" stroke-width="2"/>
                    <g stroke="#FFD600" stroke-width="2">
                        <line x1="16" y1="3" x2="16" y2="7"/>
                        <line x1="16" y1="25" x2="16" y2="29"/>
                        <line x1="3" y1="16" x2="7" y2="16"/>
                        <line x1="25" y1="16" x2="29" y2="16"/>
                        <line x1="6.2" y1="6.2" x2="10" y2="10"/>
                        <line x1="21.8" y1="6.2" x2="18" y2="10"/>
                        <line x1="6.2" y1="25.8" x2="10" y2="22"/>
                        <line x1="21.8" y1="25.8" x2="18" y2="22"/>
                    </g>
                </svg>
                <span class="ml-2">روز (روشن)</span>
            </button>
            <button class="theme-switcher-btn @if((request()->cookie('color-theme') ?? (session('color-theme') ?? 'light'))=='dark') selected @endif" data-theme="dark">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M28 23.5C25.5 26.9 21 29 16 29C8.82 29 3 23.18 3 16C3 11 5.1 6.5 8.5 4C8.5 4 12.5 15 28 23.5Z" fill="#24292f" stroke="#4582ec" stroke-width="2"/>
                </svg>
                <span class="ml-2">شب (تیره)</span>
            </button>
        </div>
        <div class="theme-palette-preview">
            <div class="theme-palette-box">
                <div class="theme-palette-title">نمونه کارت</div>
                <div style="margin-bottom:12px;">متن تستی روی کارت</div>
                <button class="theme-palette-sample-btn">دکمه نمونه</button>
            </div>
            <div class="theme-palette-box">
                <div class="theme-palette-title">سایدبار</div>
                <div style="background: var(--sidebar-bg); color: var(--sidebar-text); border-radius: 8px; padding: 7px 0; margin-bottom: 10px; text-align:center;">
                    رنگ پس‌زمینه سایدبار
                </div>
                <div style="color: var(--sidebar-text);">رنگ متن سایدبار</div>
            </div>
            <div class="theme-palette-box">
                <div class="theme-palette-title">ورودی فرم</div>
                <input type="text" placeholder="متن تستی" style="width:100%;margin-bottom:8px;">
                <select style="width:100%;"><option>انتخاب گزینه</option></select>
            </div>
        </div>
        <div class="mt-8 text-gray-500 text-sm text-center">
            انتخاب رنگ تم، تمام اجزای برنامه (سایدبار، دکمه، کارت، فرم و ...) را تغییر می‌دهد.<br>
            انتخاب شما تا زمانی که کش مرورگر را پاک نکنید باقی می‌ماند.
        </div>
    </div>
    <script>
        document.querySelectorAll('.theme-switcher-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                setTheme(this.dataset.theme);
            });
        });
    </script>
</div>
@endsection
