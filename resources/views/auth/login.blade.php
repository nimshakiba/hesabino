<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود | حسابینو</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div class="container mt-6">
        <a href="/" style="text-align:center;display:block;"><img src="{{ asset('assets/img/logo.svg') }}" alt="حسابینو" style="height:56px; margin:0 auto 1.5rem auto;"></a>
        <h1 class="form-title">ورود به حساب کاربری</h1>
        @if(session('status'))
            <div class="error-message">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}" required autofocus>
            <input type="password" name="password" placeholder="رمز عبور" required>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <label style="display: flex; align-items: center; font-size: 1rem;">
                    <input type="checkbox" name="remember" style="margin-left: 0.5rem;" {{ old('remember') ? 'checked' : '' }}>
                    مرا به خاطر بسپار
                </label>
                <a href="{{ route('password.request') }}" class="form-link">فراموشی رمز عبور؟</a>
            </div>
            <button type="submit" class="btn w-full">ورود</button>
        </form>
        <div class="form-note mt-4">
            هنوز ثبت‌نام نکرده‌اید؟ <a href="{{ route('register') }}" class="form-link">ایجاد حساب کاربری</a>
        </div>
        <div style="margin-top:2rem;text-align:center;">
            <a href="/" class="form-link">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</body>
</html>
