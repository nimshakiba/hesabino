<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حسابینو | نرم‌افزار حسابداری آنلاین</title>
    <meta name="description" content="حسابینو، نرم‌افزار حسابداری ابری و آنلاین برای مدیریت مالی کسب‌وکارها. ساده، سریع، ایمن و یکپارچه.">

    <!-- Tailwind CSS -->
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
    <style>
        body { background: #f7fafc; }
        .hero-bg { background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%); }
        .shadow-xl { box-shadow: 0 10px 40px rgba(37,99,235,0.08); }
    </style>
</head>
<body class="font-sans leading-normal text-gray-800 selection:bg-blue-200">
    <!-- Header/Navbar -->
    <header class="bg-white shadow py-4 sticky top-0 z-40">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="/" class="flex items-center">
                <img src="https://cdn.hesabfa.com/images/logo.svg" alt="حسابینو" class="h-10 ml-3" />
                <span class="font-bold text-2xl text-blue-700">حسابینو</span>
            </a>
            <nav class="space-x-6 space-x-reverse hidden md:flex">
                <a href="#features" class="hover:text-blue-700">امکانات</a>
                <a href="#pricing" class="hover:text-blue-700">تعرفه‌ها</a>
                <a href="#faq" class="hover:text-blue-700">سوالات متداول</a>
                <a href="#contact" class="hover:text-blue-700">تماس با ما</a>
            </nav>
            <div class="space-x-4 space-x-reverse flex items-center">
                <a href="{{ route('login') }}" class="text-blue-700 hover:underline">ورود</a>
                <a href="{{ route('register') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-800 transition">ثبت‌نام رایگان</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">حسابینو<br>نرم‌افزار حسابداری آنلاین کسب‌وکار شما</h1>
                <p class="mb-8 text-lg md:text-xl">مدیریت مالی کسب‌وکار، فاکتور، انبار، مشتری و گزارشات حرفه‌ای به ساده‌ترین شکل ممکن فقط با چند کلیک. همیشه، همه‌جا و از هر دستگاهی.</p>
                <a href="{{ route('register') }}" class="bg-white text-blue-700 font-bold py-3 px-8 rounded-lg shadow-xl hover:bg-blue-100 transition text-lg">شروع رایگان</a>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="https://cdn.hesabfa.com/images/landing/hero-dashboard.png" alt="دمو نرم‌افزار حسابداری" class="rounded-xl shadow-xl w-full max-w-md">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-700">امکانات حسابینو</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/invoice.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">صدور فاکتور حرفه‌ای</h3>
                    <p>ثبت، ارسال و چاپ فاکتور فروش و خرید، پیش‌فاکتور و رسید دریافت و پرداخت به صورت آنلاین و آنی.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/report.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">گزارشات مالی پیشرفته</h3>
                    <p>نمایش سود و زیان، ترازنامه، گردش حساب‌ها و گزارش‌های قابل چاپ برای تصمیم‌گیری بهتر.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/warehouse.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">مدیریت انبار و کالا</h3>
                    <p>تعریف کالا و خدمات، مدیریت موجودی، هشدار کمبود موجودی و گزارشات انبارداری.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/customers.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">مدیریت مشتریان و بدهکاران</h3>
                    <p>ثبت اطلاعات مشتریان، پیگیری بدهی و بستانکاری و ارسال یادآوری پیامکی.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/bank.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">مدیریت بانک و صندوق</h3>
                    <p>ثبت تراکنش‌های بانکی، انتقال وجه، مدیریت چک و صندوق با دسترسی سریع و آسان.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://cdn.hesabfa.com/images/features/cloud.svg" class="h-12 mx-auto mb-4" alt="">
                    <h3 class="font-bold text-xl mb-2 text-blue-700">دسترسی ابری و امنیت بالا</h3>
                    <p>دسترسی به اطلاعات از هر جا، تهیه نسخه پشتیبان خودکار و امنیت داده‌ها در سرورهای ابری.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-10 bg-blue-700 text-white text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-4">همین الان ثبت‌نام کن و ۱۴ روز رایگان استفاده کن!</h2>
        <a href="{{ route('register') }}" class="bg-white text-blue-700 font-bold py-3 px-8 rounded-lg shadow hover:bg-blue-100 transition text-lg">ثبت‌نام رایگان</a>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-center py-6 border-t text-gray-600 text-sm" id="contact">
        <div>
            <span>تمامی حقوق برای حسابینو محفوظ است. ۱۴۰۴ ©</span>
            <span class="block mt-2">تماس: <a href="tel:02112345678" class="text-blue-700">۰۲۱-۱۲۳۴۵۶۷۸</a> | ایمیل: <a href="mailto:info@hesabino.com" class="text-blue-700">info@hesabino.com</a></span>
        </div>
    </footer>
</body>
</html>
