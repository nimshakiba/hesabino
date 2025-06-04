<nav x-data="{ openMenu: '', collapsed: false }" :class="{'sidebar': true, 'sidebar-collapsed': collapsed }">
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
    <!-- Main Menu -->
    <ul class="sidebar-menu">
        <!-- داشبورد -->
        <li class="sidebar-menu-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon" style="color:#ffd600;"><i class="fas fa-tachometer-alt"></i></span>
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
                <a href="#">شخص جدید</a>
                <a href="#">اشخاص</a>
                <a href="#">دریافت</a>
                <a href="#">لیست دریافت‌ها</a>
                <a href="#">پرداخت</a>
                <a href="#">لیست پرداخت‌ها</a>
                <a href="#">سهامداران</a>
                <a href="#">فروشندگان</a>
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
                <a href="#">کالای جدید</a>
                <a href="#">خدمات جدید</a>
                <a href="#">کالاها و خدمات</a>
                <a href="#">به‌روزرسانی لیست قیمت</a>
                <a href="#">چاپ بارکد</a>
                <a href="#">چاپ بارکد تعدادی</a>
                <a href="#">صفحه لیست قیمت کالا</a>
                <a href="{{ route('categories.index') }}">دسته‌بندی جدید</a>
                <a href="{{ route('categories.index') }}">لیست دسته‌بندی‌ها</a>
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
                <a href="#">بانک‌ها</a>
                <a href="#">صندوق‌ها</a>
                <a href="#">تنخواه‌گردان‌ها</a>
                <a href="#">انتقال</a>
                <a href="#">لیست انتقال‌ها</a>
                <a href="#">لیست چک‌های دریافتی</a>
                <a href="#">لیست چک‌های پرداختی</a>
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
                <a href="#">فروش جدید</a>
                <a href="#">فاکتور سریع</a>
                <a href="#">برگشت از فروش</a>
                <a href="#">فاکتورهای فروش</a>
                <a href="#">فاکتورهای برگشت از فروش</a>
                <a href="#">درآمد</a>
                <a href="#">لیست درآمدها</a>
                <a href="#">قرارداد فروش اقساطی</a>
                <a href="#">لیست فروش اقساطی</a>
                <a href="#">اقلام تخفیف‌دار</a>
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
                <a href="#">خرید جدید</a>
                <a href="#">برگشت از خرید</a>
                <a href="#">فاکتورهای خرید</a>
                <a href="#">فاکتورهای برگشت از خرید</a>
                <a href="#">هزینه</a>
                <a href="#">لیست هزینه‌ها</a>
                <a href="#">ضایعات</a>
                <a href="#">لیست ضایعات</a>
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
                <a href="#">انبارها</a>
                <a href="#">حواله جدید</a>
                <a href="#">رسید و حواله‌های انبار</a>
                <a href="#">موجودی کالا</a>
                <a href="#">موجودی تمامی انبارها</a>
                <a href="#">انبارگردانی</a>
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
                <a href="#">سند جدید</a>
                <a href="#">لیست اسناد</a>
                <a href="#">تراز افتتاحیه</a>
                <a href="#">بستن سال مالی</a>
                <a href="#">جدول حساب‌ها</a>
                <a href="#">تجمیع اسناد</a>
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
                <a href="#">آرشیو</a>
                <a href="#">پنل پیامک</a>
                <a href="#">استعلام</a>
                <a href="#">دریافت سایر</a>
                <a href="#">لیست دریافت‌ها</a>
                <a href="#">پرداخت سایر</a>
                <a href="#">لیست پرداخت‌ها</a>
                <a href="#">سند تسعیر ارز</a>
                <a href="#">سند توازن اشخاص</a>
                <a href="#">سند توازن کالاها</a>
                <a href="#">سند حقوق</a>
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
                <a href="#">تمام گزارش‌ها</a>
                <a href="#">ترازنامه</a>
                <a href="#">صورت سود و زیان</a>
                <a href="#">صورتحساب سرمایه</a>
                <a href="#">دفتر روزنامه</a>
                <a href="#">دفتر حساب‌ها</a>
                <a href="#">دفتر کل</a>
                <a href="#">تراز آزمایشی</a>
                <a href="#">مرور حساب‌ها</a>
                <a href="#">مرور حساب‌های تفصیل</a>
                <a href="#">دفتر روزنامه (تجمیعی)</a>
                <a href="#">دفتر کل (تجمیعی)</a>
                <a href="#">بدهکاران و بستانکاران</a>
                <a href="#">کارت حساب اشخاص</a>
                <a href="#">فروش به تفکیک کالا</a>
                <a href="#">خرید به تفکیک کالا</a>
                <a href="#">فروش به تفکیک فاکتور</a>
                <a href="#">خرید به تفکیک فاکتور</a>
                <a href="#">گزارش مالیات</a>
                <a href="#">سود فاکتور</a>
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
                <a href="#">پروژه‌ها</a>
                <a href="#">اطلاعات کسب و کار</a>
                <a href="#">تنظیمات مالی</a>
                <a href="#">جدول تبدیل نرخ ارز</a>
                <a href="#">مدیریت کاربران</a>
                <a href="#">تنظیمات چاپ</a>
                <a href="#">فرم ساز</a>
                <a href="#">اعلانات</a>
            </div>
        </li>
    </ul>
</nav>
