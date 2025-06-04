<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'حسابینو')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <nav class="bg-yellow-400 py-3 mb-8">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="/" class="text-2xl font-bold text-gray-900">حسابینو</a>
            <div>
                <a href="{{ route('categories.index') }}" class="font-bold text-gray-900 hover:text-yellow-800 px-4">دسته‌بندی‌ها</a>
            </div>
        </div>
    </nav>
    @if(session('success'))
        <div class="container mx-auto max-w-2xl mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @yield('content')
</body>
</html>
