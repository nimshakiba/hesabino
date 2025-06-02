<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود | حسابینو</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <style>
        body { font-family: 'Vazirmatn', Tahoma, Arial, sans-serif; background: #f6f8fa; }
        .container { max-width: 350px; margin: 4rem auto; background: #fff; border-radius: 18px; padding: 2.5rem 2rem 2rem; box-shadow: 0 0 24px #0001; }
        .form-title { font-size: 1.4rem; font-weight: bold; color: #222; margin-bottom: 1.5rem; text-align: center; }
        .error-message { background: #ffeaea; color: #d32f2f; border-radius: 8px; padding: 0.5rem 0.75rem; margin-bottom: 1rem; font-size: 0.98rem; }
        input[type="email"], input[type="password"] { width: 100%; margin-bottom: 1rem; padding: 0.7rem 0.9rem; border: 1px solid #e0e0e0; border-radius: 8px; background: #fafbfc; font-size: 1rem; }
        button.btn { background: #0d99ff; color: #fff; border: none; padding: 0.75rem 0; border-radius: 8px; font-size: 1.1rem; font-weight: bold; cursor: pointer; width: 100%; margin-top: 0.5rem; transition: background 0.2s; }
        button.btn:hover { background: #0b7dd6; }
        .form-link { color: #0d99ff; text-decoration: none; font-size: 1rem; margin-right: 0.25rem; }
        .form-link:hover { text-decoration: underline; }
        .form-note { color: #666; text-align: center; font-size: 1rem; margin-top: 1.5rem; }
        ::placeholder { color: #bbb; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" style="text-align:center;display:block;">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="حسابینو" style="height:56px; margin:0 auto 2rem auto;">
        </a>
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
            <button type="submit" class="btn">ورود</button>
        </form>
        <div class="form-note">
            هنوز ثبت‌نام نکرده‌اید؟
            <a href="{{ route('register') }}" class="form-link">ایجاد حساب کاربری</a>
        </div>
        <div style="margin-top:2rem;text-align:center;">
            <a href="/" class="form-link">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</body>
</html>
