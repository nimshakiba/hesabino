<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت | حسابینو</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: Vazirmatn, Tahoma, Arial, sans-serif; background: #f4f6f8; }
        .sidebar { width: 260px; background: #23395d; color: #fff; min-height: 100vh; float: right; padding: 30px 10px 10px 10px; position: fixed; right: 0; top: 0; z-index: 50; transition: width 0.2s; }
        .sidebar-collapsed { width: 68px; }
        .sidebar-header { text-align: center; margin: 0 0 18px 0; }
        .sidebar-profile { display: flex; flex-direction: column; align-items: center; margin-bottom: 14px; }
        .sidebar-profile-img { width: 60px; height: 60px; border-radius: 50%; border: 2px solid #ffd600; margin-bottom: 8px; object-fit: cover; }
        .sidebar-profile-name { font-weight: bold; font-size: 1.08rem; }
        .sidebar-profile-email { font-size: 0.96rem; color: #ffd600; }
        .sidebar-toggler { position: absolute; left: 100%; top: 20px; background: #fff; color: #23395d; border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px #0002; cursor: pointer; border: none; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0 10px 0 0; }
        .sidebar-menu-item { margin-bottom: 6px; }
        .sidebar-link { display: flex; align-items: center; cursor: pointer; border-radius: 8px; padding: 10px 15px; transition: background 0.2s; color: #fff; font-weight: 500; }
        .sidebar-link:hover, .sidebar-link.active { background: #183059; }
        .sidebar-icon { width: 22px; height: 22px; margin-left: 12px; display: flex; align-items: center; justify-content: center; }
        .sidebar-chevron { margin-right: auto; transition: transform 0.2s; }
        .sidebar-chevron.rotate { transform: rotate(-90deg); }
        .sidebar-submenu { padding-right: 32px; background: #2d3950; border-radius: 0 0 8px 8px; margin-bottom: 6px; }
        .sidebar-submenu a { display: block; padding: 8px 0; color: #fff; font-size: 0.99rem; border-bottom: 1px solid #2e4059; text-decoration: none; }
        .sidebar-submenu a:last-child { border-bottom: none; }
        @media (max-width: 950px) { .sidebar { position: absolute; height: 100%; } }
        .sidebar-collapsed .sidebar-profile-name,
        .sidebar-collapsed .sidebar-profile-email,
        .sidebar-collapsed .sidebar-link span,
        .sidebar-collapsed .sidebar-chevron { display: none !important; }
        .sidebar-collapsed .sidebar-header { margin-bottom: 0; }
        .admin-content { margin-right: 260px; padding: 35px 25px; min-height: 100vh; }
        .sidebar-collapsed ~ .admin-content { margin-right: 68px; }
    </style>
</head>
<body>
    <div x-data="{ openMenu: '', collapsed: false }">
        <nav :class="{'sidebar': true, 'sidebar-collapsed': collapsed }">
            <button class="sidebar-toggler" @click="collapsed = !collapsed">
                <i class="fas fa-bars"></i>
            </button>
            <div class="sidebar-header">
                <div class="sidebar-profile">
                    <img src="{{ asset('assets/img/user.png') }}" alt="پروفایل" class="sidebar-profile-img">
                    <span class="sidebar-profile-name">{{ auth()->user()->name ?? 'مدیر' }}</span>
                    <span class="sidebar-profile-email">{{ auth()->user()->email ?? '' }}</span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="sidebar-icon" style="color:#ffd600;"><i class="fas fa-tachometer-alt"></i></span>
                        <span>داشبورد مدیر</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span class="sidebar-icon" style="color:#4caf50;"><i class="fas fa-users"></i></span>
                        <span>مدیریت کاربران</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-link">
                        <span class="sidebar-icon" style="color:#2196f3;"><i class="fas fa-database"></i></span>
                        <span>مدیریت دیتابیس‌ها</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-link">
                        <span class="sidebar-icon" style="color:#ff9800;"><i class="fas fa-clipboard-list"></i></span>
                        <span>گزارشات سیستمی</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <span class="sidebar-icon" style="color:#607d8b;"><i class="fas fa-home"></i></span>
                        <span>برگشت به پنل کاربر</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="sidebar-link" style="background:none;border:none;width:100%;text-align:right;">
                            <span class="sidebar-icon" style="color:#b71c1c;"><i class="fas fa-sign-out-alt"></i></span>
                            <span>خروج</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <div :class="{'admin-content': true, 'sidebar-collapsed': collapsed}">
            @yield('content')
        </div>
    </div>
</body>
</html>
