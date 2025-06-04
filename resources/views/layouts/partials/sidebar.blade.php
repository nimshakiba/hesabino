<nav x-data="{ openMenu: '', collapsed: false }" :class="{'sidebar': true, 'sidebar-collapsed': collapsed }" style="background:#fff;color:#222;">
    <!-- Sidebar toggler -->
    <button class="sidebar-toggler" @click="collapsed = !collapsed">
        <i class="fas fa-bars"></i>
    </button>
    <!-- User Profile with dropdown -->
    <div class="sidebar-header">
        <div x-data="{ open: false }" class="sidebar-profile" @click.outside="open = false">
            <img src="{{ asset('assets/img/user.png') }}" alt="پروفایل" class="sidebar-profile-img" @click="open = !open">
            <span class="sidebar-profile-name" @click="open = !open">{{ auth()->user()->name ?? 'کاربر' }}</span>
            <span class="sidebar-profile-email" @click="open = !open">{{ auth()->user()->email ?? '' }}</span>
            <span class="sidebar-profile-chevron" @click="open = !open" :class="{ 'rotate': open }">
                <i class="fas fa-chevron-down"></i>
            </span>
            <div x-show="open" x-transition class="sidebar-profile-menu" @click.away="open = false">
                <a href="{{ route('profile.edit', [], false) }}">
                    <i class="fa fa-user" style="margin-left:8px;"></i> پروفایل
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="fa fa-sign-out-alt" style="margin-left:8px;color:#b71c1c;"></i> خروج
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Menu: Scrollable -->
    <div style="overflow-y:auto;max-height:calc(100vh - 120px);padding-bottom:10px;">
    <ul class="sidebar-menu">
        <!-- داشبورد -->
        <li class="sidebar-menu-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#FFD600"/><path d="M12 7V17M7 12H17" stroke="#222" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <span>داشبورد</span>
            </a>
        </li>
        <!-- اشخاص -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'persons' ? '' : 'persons')">
                <span class="sidebar-icon" style="color:#f44336;"><i class="fas fa-users"></i></span>
                <span>اشخاص</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'persons'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'persons'" x-transition>
                <a href="#"><i class="fas fa-user-plus" style="color:#43a047;margin-left:6px;"></i>شخص جدید</a>
                <a href="#"><i class="fas fa-users" style="color:#1976d2;margin-left:6px;"></i>اشخاص</a>
                <a href="#"><i class="fas fa-money-bill-wave" style="color:#ff9800;margin-left:6px;"></i>دریافت</a>
                <a href="#"><i class="fas fa-list" style="color:#607d8b;margin-left:6px;"></i>لیست دریافت‌ها</a>
                <a href="#"><i class="fas fa-credit-card" style="color:#e91e63;margin-left:6px;"></i>پرداخت</a>
                <a href="#"><i class="fas fa-list-alt" style="color:#00bcd4;margin-left:6px;"></i>لیست پرداخت‌ها</a>
                <a href="#"><i class="fas fa-users-cog" style="color:#8e24aa;margin-left:6px;"></i>سهامداران</a>
                <a href="#"><i class="fas fa-truck" style="color:#ff5722;margin-left:6px;"></i>فروشندگان</a>
            </div>
        </li>
        <!-- کالاها و خدمات -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'products' ? '' : 'products')">
                <span class="sidebar-icon" style="color:#2196f3;"><i class="fas fa-cubes"></i></span>
                <span>کالاها و خدمات</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'products'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'products'" x-transition>
                <a href="#"><i class="fas fa-cube" style="color:#43a047;margin-left:6px;"></i>کالای جدید</a>
                <a href="#"><i class="fas fa-tools" style="color:#ff9800;margin-left:6px;"></i>خدمات جدید</a>
                <a href="#"><i class="fas fa-cubes" style="color:#3f51b5;margin-left:6px;"></i>کالاها و خدمات</a>
                <a href="#"><i class="fas fa-sync" style="color:#00bcd4;margin-left:6px;"></i>به‌روزرسانی لیست قیمت</a>
                <a href="#"><i class="fas fa-barcode" style="color:#8d6e63;margin-left:6px;"></i>چاپ بارکد</a>
                <a href="#"><i class="fas fa-th-list" style="color:#1976d2;margin-left:6px;"></i>چاپ بارکد تعدادی</a>
                <a href="#"><i class="fas fa-list" style="color:#009688;margin-left:6px;"></i>صفحه لیست قیمت کالا</a>
                <a href="{{ route('categories.create') }}"><i class="fas fa-plus" style="color:#43a047;margin-left:6px;"></i>دسته‌بندی جدید</a>
                <a href="{{ route('categories.index') }}"><i class="fas fa-list-alt" style="color:#ff5722;margin-left:6px;"></i>لیست دسته‌بندی‌ها</a>
            </div>
        </li>
        <!-- بانکداری -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'banking' ? '' : 'banking')">
                <span class="sidebar-icon" style="color:#9c27b0;"><i class="fas fa-university"></i></span>
                <span>بانکداری</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'banking'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'banking'" x-transition>
                <a href="#"><i class="fas fa-university" style="color:#00b894;margin-left:6px;"></i>بانک‌ها</a>
                <a href="#"><i class="fas fa-piggy-bank" style="color:#ff9800;margin-left:6px;"></i>صندوق‌ها</a>
                <a href="#"><i class="fas fa-people-carry" style="color:#43a047;margin-left:6px;"></i>تنخواه‌گردان‌ها</a>
                <a href="#"><i class="fas fa-random" style="color:#e91e63;margin-left:6px;"></i>انتقال</a>
                <a href="#"><i class="fas fa-list" style="color:#1976d2;margin-left:6px;"></i>لیست انتقال‌ها</a>
                <a href="#"><i class="fas fa-money-check" style="color:#607d8b;margin-left:6px;"></i>لیست چک‌های دریافتی</a>
                <a href="#"><i class="fas fa-credit-card" style="color:#ff5722;margin-left:6px;"></i>لیست چک‌های پرداختی</a>
            </div>
        </li>
        <!-- فروش و درآمد -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'sales' ? '' : 'sales')">
                <span class="sidebar-icon" style="color:#4caf50;"><i class="fas fa-cash-register"></i></span>
                <span>فروش و درآمد</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'sales'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'sales'" x-transition>
                <a href="#"><i class="fas fa-plus" style="color:#43a047;margin-left:6px;"></i>فروش جدید</a>
                <a href="#"><i class="fas fa-bolt" style="color:#ff9800;margin-left:6px;"></i>فاکتور سریع</a>
                <a href="#"><i class="fas fa-undo" style="color:#f44336;margin-left:6px;"></i>برگشت از فروش</a>
                <a href="#"><i class="fas fa-file-invoice-dollar" style="color:#3f51b5;margin-left:6px;"></i>فاکتورهای فروش</a>
                <a href="#"><i class="fas fa-file-invoice" style="color:#607d8b;margin-left:6px;"></i>فاکتورهای برگشت از فروش</a>
                <a href="#"><i class="fas fa-coins" style="color:#ffd600;margin-left:6px;"></i>درآمد</a>
                <a href="#"><i class="fas fa-list" style="color:#00bcd4;margin-left:6px;"></i>لیست درآمدها</a>
                <a href="#"><i class="fas fa-handshake" style="color:#8e24aa;margin-left:6px;"></i>قرارداد فروش اقساطی</a>
                <a href="#"><i class="fas fa-list-alt" style="color:#1976d2;margin-left:6px;"></i>لیست فروش اقساطی</a>
                <a href="#"><i class="fas fa-percent" style="color:#ff5722;margin-left:6px;"></i>اقلام تخفیف‌دار</a>
            </div>
        </li>
        <!-- خرید و هزینه -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'purchase' ? '' : 'purchase')">
                <span class="sidebar-icon" style="color:#ff9800;"><i class="fas fa-shopping-cart"></i></span>
                <span>خرید و هزینه</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'purchase'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'purchase'" x-transition>
                <a href="#"><i class="fas fa-plus" style="color:#43a047;margin-left:6px;"></i>خرید جدید</a>
                <a href="#"><i class="fas fa-undo" style="color:#f44336;margin-left:6px;"></i>برگشت از خرید</a>
                <a href="#"><i class="fas fa-file-invoice" style="color:#3f51b5;margin-left:6px;"></i>فاکتورهای خرید</a>
                <a href="#"><i class="fas fa-file-invoice-dollar" style="color:#607d8b;margin-left:6px;"></i>فاکتورهای برگشت از خرید</a>
                <a href="#"><i class="fas fa-money-bill-wave" style="color:#ffd600;margin-left:6px;"></i>هزینه</a>
                <a href="#"><i class="fas fa-list" style="color:#00bcd4;margin-left:6px;"></i>لیست هزینه‌ها</a>
                <a href="#"><i class="fas fa-trash" style="color:#8d6e63;margin-left:6px;"></i>ضایعات</a>
                <a href="#"><i class="fas fa-list-alt" style="color:#ff5722;margin-left:6px;"></i>لیست ضایعات</a>
            </div>
        </li>
        <!-- انبارداری -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'stock' ? '' : 'stock')">
                <span class="sidebar-icon" style="color:#00bcd4;"><i class="fas fa-warehouse"></i></span>
                <span>انبارداری</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'stock'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'stock'" x-transition>
                <a href="#"><i class="fas fa-warehouse" style="color:#00b894;margin-left:6px;"></i>انبارها</a>
                <a href="#"><i class="fas fa-arrow-right" style="color:#ff9800;margin-left:6px;"></i>حواله جدید</a>
                <a href="#"><i class="fas fa-file-alt" style="color:#43a047;margin-left:6px;"></i>رسید و حواله‌های انبار</a>
                <a href="#"><i class="fas fa-box-open" style="color:#e91e63;margin-left:6px;"></i>موجودی کالا</a>
                <a href="#"><i class="fas fa-list" style="color:#1976d2;margin-left:6px;"></i>موجودی تمامی انبارها</a>
                <a href="#"><i class="fas fa-balance-scale" style="color:#607d8b;margin-left:6px;"></i>انبارگردانی</a>
            </div>
        </li>
        <!-- حسابداری -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'accounting' ? '' : 'accounting')">
                <span class="sidebar-icon" style="color:#607d8b;"><i class="fas fa-calculator"></i></span>
                <span>حسابداری</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'accounting'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'accounting'" x-transition>
                <a href="#"><i class="fas fa-plus" style="color:#43a047;margin-left:6px;"></i>سند جدید</a>
                <a href="#"><i class="fas fa-file-alt" style="color:#ff9800;margin-left:6px;"></i>لیست اسناد</a>
                <a href="#"><i class="fas fa-flag" style="color:#3f51b5;margin-left:6px;"></i>تراز افتتاحیه</a>
                <a href="#"><i class="fas fa-times-circle" style="color:#e91e63;margin-left:6px;"></i>بستن سال مالی</a>
                <a href="#"><i class="fas fa-table" style="color:#607d8b;margin-left:6px;"></i>جدول حساب‌ها</a>
                <a href="#"><i class="fas fa-layer-group" style="color:#00bcd4;margin-left:6px;"></i>تجمیع اسناد</a>
            </div>
        </li>
        <!-- سایر -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'other' ? '' : 'other')">
                <span class="sidebar-icon" style="color:#e91e63;"><i class="fas fa-ellipsis-h"></i></span>
                <span>سایر</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'other'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'other'" x-transition>
                <a href="#"><i class="fas fa-archive" style="color:#607d8b;margin-left:6px;"></i>آرشیو</a>
                <a href="#"><i class="fas fa-sms" style="color:#43a047;margin-left:6px;"></i>پنل پیامک</a>
                <a href="#"><i class="fas fa-search" style="color:#1976d2;margin-left:6px;"></i>استعلام</a>
                <a href="#"><i class="fas fa-coins" style="color:#ffd600;margin-left:6px;"></i>دریافت سایر</a>
                <a href="#"><i class="fas fa-list" style="color:#00bcd4;margin-left:6px;"></i>لیست دریافت‌ها</a>
                <a href="#"><i class="fas fa-credit-card" style="color:#e91e63;margin-left:6px;"></i>پرداخت سایر</a>
                <a href="#"><i class="fas fa-list-alt" style="color:#ff5722;margin-left:6px;"></i>لیست پرداخت‌ها</a>
                <a href="#"><i class="fas fa-dollar-sign" style="color:#43a047;margin-left:6px;"></i>سند تسعیر ارز</a>
                <a href="#"><i class="fas fa-user-friends" style="color:#1976d2;margin-left:6px;"></i>سند توازن اشخاص</a>
                <a href="#"><i class="fas fa-cube" style="color:#3f51b5;margin-left:6px;"></i>سند توازن کالاها</a>
                <a href="#"><i class="fas fa-money-check-alt" style="color:#607d8b;margin-left:6px;"></i>سند حقوق</a>
            </div>
        </li>
        <!-- گزارش‌ها -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'reports' ? '' : 'reports')">
                <span class="sidebar-icon" style="color:#3f51b5;"><i class="fas fa-chart-bar"></i></span>
                <span>گزارش‌ها</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'reports'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'reports'" x-transition>
                <a href="#"><i class="fas fa-list" style="color:#1976d2;margin-left:6px;"></i>تمام گزارش‌ها</a>
                <a href="#"><i class="fas fa-balance-scale" style="color:#607d8b;margin-left:6px;"></i>ترازنامه</a>
                <a href="#"><i class="fas fa-chart-line" style="color:#43a047;margin-left:6px;"></i>صورت سود و زیان</a>
                <a href="#"><i class="fas fa-receipt" style="color:#ff9800;margin-left:6px;"></i>صورتحساب سرمایه</a>
                <a href="#"><i class="fas fa-book" style="color:#9c27b0;margin-left:6px;"></i>دفتر روزنامه</a>
                <a href="#"><i class="fas fa-book-open" style="color:#00bcd4;margin-left:6px;"></i>دفتر حساب‌ها</a>
                <a href="#"><i class="fas fa-book" style="color:#3f51b5;margin-left:6px;"></i>دفتر کل</a>
                <a href="#"><i class="fas fa-balance-scale" style="color:#607d8b;margin-left:6px;"></i>تراز آزمایشی</a>
                <a href="#"><i class="fas fa-search-dollar" style="color:#ffd600;margin-left:6px;"></i>مرور حساب‌ها</a>
                <a href="#"><i class="fas fa-user-friends" style="color:#8e24aa;margin-left:6px;"></i>مرور حساب‌های تفصیل</a>
                <a href="#"><i class="fas fa-book" style="color:#00bcd4;margin-left:6px;"></i>دفتر روزنامه (تجمیعی)</a>
                <a href="#"><i class="fas fa-book-open" style="color:#43a047;margin-left:6px;"></i>دفتر کل (تجمیعی)</a>
                <a href="#"><i class="fas fa-user-tie" style="color:#1976d2;margin-left:6px;"></i>بدهکاران و بستانکاران</a>
                <a href="#"><i class="fas fa-id-card" style="color:#ff5722;margin-left:6px;"></i>کارت حساب اشخاص</a>
                <a href="#"><i class="fas fa-boxes" style="color:#43a047;margin-left:6px;"></i>فروش به تفکیک کالا</a>
                <a href="#"><i class="fas fa-box" style="color:#607d8b;margin-left:6px;"></i>خرید به تفکیک کالا</a>
                <a href="#"><i class="fas fa-file-invoice-dollar" style="color:#ffd600;margin-left:6px;"></i>فروش به تفکیک فاکتور</a>
                <a href="#"><i class="fas fa-file-invoice" style="color:#3f51b5;margin-left:6px;"></i>خرید به تفکیک فاکتور</a>
                <a href="#"><i class="fas fa-percent" style="color:#e91e63;margin-left:6px;"></i>گزارش مالیات</a>
                <a href="#"><i class="fas fa-money-bill" style="color:#43a047;margin-left:6px;"></i>سود فاکتور</a>
            </div>
        </li>
        <!-- تنظیمات -->
        <li class="sidebar-menu-item">
            <div class="sidebar-link" @click="openMenu = (openMenu === 'settings' ? '' : 'settings')">
                <span class="sidebar-icon" style="color:#00b894;"><i class="fas fa-cog"></i></span>
                <span>تنظیمات</span>
                <span class="sidebar-chevron" :class="{'rotate': openMenu !== 'settings'}"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="sidebar-submenu" x-show="openMenu === 'settings'" x-transition>
                <a href="#"><i class="fas fa-briefcase" style="color:#fbc02d;margin-left:6px;"></i>پروژه‌ها</a>
                <a href="#"><i class="fas fa-building" style="color:#0288d1;margin-left:6px;"></i>اطلاعات کسب و کار</a>
                <a href="#"><i class="fas fa-money-check-alt" style="color:#43a047;margin-left:6px;"></i>تنظیمات مالی</a>
                <a href="#"><i class="fas fa-dollar-sign" style="color:#ffd600;margin-left:6px;"></i>جدول تبدیل نرخ ارز</a>
                <a href="#"><i class="fas fa-users-cog" style="color:#00bcd4;margin-left:6px;"></i>مدیریت کاربران</a>
                <a href="#"><i class="fas fa-print" style="color:#607d8b;margin-left:6px;"></i>تنظیمات چاپ</a>
                <a href="{{ route('color.settings') }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" style="vertical-align:middle;margin-left:8px;">
                        <circle cx="10" cy="10" r="9" fill="#00e676" stroke="#00c853" stroke-width="2"/>
                        <circle cx="10" cy="10" r="5" fill="#FFD600"/>
                    </svg> تنظیمات ظاهری
                </a>
                <a href="#"><i class="fas fa-wpforms" style="color:#ff7043;margin-left:6px;"></i>فرم ساز</a>
                <a href="#"><i class="fas fa-bell" style="color:#c62828;margin-left:6px;"></i>اعلانات</a>
            </div>
        </li>
    </ul>
    </div>
</nav>
