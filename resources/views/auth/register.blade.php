<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام | حسابینو</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div class="container mt-6">
        <a href="/" style="text-align:center;display:block;"><img src="{{ asset('assets/img/logo.svg') }}" alt="حسابینو" style="height:56px; margin:0 auto 1.5rem auto;"></a>
        <h1 class="form-title">ایجاد حساب کاربری جدید</h1>
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="نام کامل" value="{{ old('name') }}" required autocomplete="name">
            <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email">
            <input type="password" name="password" placeholder="رمز عبور" required autocomplete="new-password">
            <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required autocomplete="new-password">
            <button type="submit" class="btn w-full">ثبت‌نام</button>
        </form>
        <div class="form-note mt-4">
            قبلاً ثبت‌نام کرده‌اید؟ <a href="{{ route('login') }}" class="form-link">ورود به حساب کاربری</a>
        </div>
        <div style="margin-top:2rem;text-align:center;">
            <a href="/" class="form-link">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</body>
</html>
