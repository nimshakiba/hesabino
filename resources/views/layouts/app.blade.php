<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'حسابینو' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.1/css/bulma.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/color-palette.css') }}">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('assets/js/color-palette.js') }}"></script>
    <style>
        body { font-family: Vazirmatn, Tahoma, Arial, sans-serif; background: var(--main-bg, #f4f6f8); }
        .sidebar { width: 265px; background: var(--sidebar-bg, #2d3a4b); color: var(--sidebar-text, #fff); height: 100vh; position: fixed; right: 0; top: 0; z-index: 50; transition: width 0.2s, background 0.3s, color 0.3s; }
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
        .sidebar-link { display: flex; align-items: center; cursor: pointer; border-radius: 8px; padding: 10px 15px; transition: background 0.2s; color: var(--sidebar-text, #fff); font-weight: 500; }
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
        .main-content { margin-right: 265px; padding: 35px 25px; min-height: 100vh; background: var(--main-bg, #f4f6f8); color: var(--main-text, #222);}
        .sidebar-collapsed ~ .main-content { margin-right: 64px; }
        /* --- Header theme switcher styles --- */
        .color-header-bar {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 18px;
            background: transparent;
            padding: 10px 28px 4px 0;
            margin-bottom: 4px;
            position: relative;
            z-index: 21;
        }
        .theme-switcher-btn {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 0;
            margin: 0 3px;
            transition: transform .16s;
        }
        .theme-switcher-btn:active { transform: scale(1.17);}
        .theme-switcher-btn.selected svg { filter: drop-shadow(0 0 7px #ffd600cc);}
        .theme-switcher-btn[data-theme="dark"].selected svg { filter: drop-shadow(0 0 8px #4582ec);}
        .theme-switcher-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }
    </style>
    @yield('head')
</head>
<body>
    <div class="color-header-bar">
        <button class="theme-switcher-btn" data-theme="light" title="تم روشن">
            <span class="theme-switcher-icon">
                <!-- Sun Icon (colorful) -->
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
            </span>
        </button>
        <button class="theme-switcher-btn" data-theme="dark" title="تم شب">
            <span class="theme-switcher-icon">
                <!-- Moon Icon (github dark style) -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M28 23.5C25.5 26.9 21 29 16 29C8.82 29 3 23.18 3 16C3 11 5.1 6.5 8.5 4C8.5 4 12.5 15 28 23.5Z" fill="#24292f" stroke="#4582ec" stroke-width="2"/>
                </svg>
            </span>
        </button>
    </div>
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
