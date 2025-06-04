<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'حسابینو' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: Vazirmatn, Tahoma, Arial, sans-serif; background: #f4f6f8; }
        .sidebar { width: 265px; background: #2d3a4b; color: #fff; height: 100vh; position: fixed; right: 0; top: 0; z-index: 50; transition: width 0.2s; }
        .sidebar-collapsed { width: 64px; }
        .sidebar-header { text-align: center; margin: 18px 0 20px 0; }
        .sidebar-profile { display: flex; flex-direction: column; align-items: center; margin-bottom: 28px; position: relative; cursor: pointer; }
        .sidebar-profile-img { width: 62px; height: 62px; border-radius: 50%; border: 2px solid #ffd600; margin-bottom: 8px; object-fit: cover; }
        .sidebar-profile-name { font-weight: bold; font-size: 1.02rem; }
        .sidebar-profile-email { font-size: 0.95rem; color: #ffd600; }
        .sidebar-profile-chevron { margin-top: 2px; font-size: 1.2rem; color: #fff; transition: transform 0.2s; }
        .sidebar-profile-menu {
            position: absolute;
            top: 82px;
            right: 0;
            background: #fff;
            color: #222;
            border-radius: 12px;
            box-shadow: 0 8px 24px #0002;
            min-width: 140px;
            padding: 8px 0;
            z-index: 100;
            text-align: right;
        }
        .sidebar-profile-menu a, .sidebar-profile-menu form button {
            display: block;
            width: 100%;
            padding: 9px 22px;
            color: #222;
            background: none;
            border: none;
            text-align: right;
            font-size: 1rem;
            cursor: pointer;
            border-bottom: 1px solid #f2f2f2;
            transition: background 0.18s;
        }
        .sidebar-profile-menu a:last-child, .sidebar-profile-menu form button:last-child {
            border-bottom: none;
        }
        .sidebar-profile-menu a:hover, .sidebar-profile-menu form button:hover {
            background: #f5f5f5;
        }
        .sidebar-toggler { position: absolute; left: 100%; top: 24px; background: #fff; color: #2d3a4b; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px #0002; cursor: pointer; border: none; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0 10px 0 0; }
        .sidebar-menu-item { margin-bottom: 5px; }
        .sidebar-link { display: flex; align-items: center; cursor: pointer; border-radius: 8px; padding: 10px 15px; transition: background 0.2s; color: #fff; font-weight: 500; }
        .sidebar-link:hover, .sidebar-link.active { background: #21304a; }
        .sidebar-icon { width: 22px; height: 22px; margin-left: 12px; display: flex; align-items: center; justify-content: center; }
        .sidebar-chevron { margin-right: auto; transition: transform 0.2s; }
        .sidebar-chevron.rotate { transform: rotate(-90deg); }
        .sidebar-submenu { padding-right: 35px; background: #243046; border-radius: 0 0 8px 8px; margin-bottom: 5px; }
        .sidebar-submenu a { display: block; padding: 8px 0; color: #fff; font-size: 0.97rem; border-bottom: 1px solid #283655; text-decoration: none; transition: color 0.2s; }
        .sidebar-submenu a:last-child { border-bottom: none; }
        .sidebar-submenu a:hover { color: #ffd600; }
        @media (max-width: 950px) { .sidebar { position: absolute; height: 100%; } }
        .sidebar-collapsed .sidebar-profile-name,
        .sidebar-collapsed .sidebar-profile-email,
        .sidebar-collapsed .sidebar-link span,
        .sidebar-collapsed .sidebar-chevron { display: none !important; }
        .sidebar-collapsed .sidebar-header { margin-bottom: 0; }
        .main-content { margin-right: 265px; padding: 35px 25px; min-height: 100vh; }
        .sidebar-collapsed ~ .main-content { margin-right: 64px; }
    </style>
    @yield('head')
</head>
<body>
    <div x-data="{ openMenu: '', collapsed: false }">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
        <!-- Main content -->
        <div :class="{'main-content': true, 'sidebar-collapsed': collapsed}">
            @yield('content')
        </div>
    </div>
</body>
</html>
