@extends('layouts.app')

@section('title', 'افزودن دسته‌بندی جدید')

@section('head')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- دسته‌بندی اختصاصی -->
    <link href="{{ asset('assets/fonts/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/category-create.css') }}" rel="stylesheet">
    <!-- استایل تاریخ‌شمسی -->
    <link href="{{ asset('assets/css/mds.bs.datetimepicker.style.css') }}" rel="stylesheet">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="card bg-base-100 shadow-xl p-0 overflow-visible">
        <h2 class="text-lg font-bold px-8 pt-7 pb-0 flex items-center gap-2">
            <i class="fas fa-plus text-primary"></i>
            افزودن دسته‌بندی جدید
        </h2>
        <div
            x-data="{
                tab: 'person',
                imgPreview: { person: null, product: null, service: null },
                imgDefault: '{{ asset('assets/images/default-category.png') }}',
                tabColors: {person: '#6366f1', product: '#f59e42', service: '#22c55e'},
                handleTab(newTab) {
                    this.tab = newTab;
                    setTimeout(initPersianDatePickers, 100);
                },
                handleImage(e, which) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (ev) => this.imgPreview[which] = ev.target.result;
                        reader.readAsDataURL(file);
                    } else {
                        this.imgPreview[which] = null;
                    }
                }
            }"
        >
            <div class="category-tabs-custom mt-4 flex justify-center gap-2">
                <button type="button"
                    :class="tab === 'person' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="handleTab('person')"
                    id="tab-person"
                >
                    <i class="fas fa-users" :style="`color: ${tabColors.person}`"></i>
                    اشخاص
                </button>
                <button type="button"
                    :class="tab === 'product' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="handleTab('product')"
                    id="tab-product"
                >
                    <i class="fas fa-box" :style="`color: ${tabColors.product}`"></i>
                    کالا
                </button>
                <button type="button"
                    :class="tab === 'service' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="handleTab('service')"
                    id="tab-service"
                >
                    <i class="fas fa-tools" :style="`color: ${tabColors.service}`"></i>
                    خدمات
                </button>
            </div>

            {{-- تب اشخاص --}}
            <template x-if="tab === 'person'">
            <div>
                <div class="text-center mb-2 font-bold text-base mt-6">افزودن شخص</div>
                <div class="tab-img-preview" style="margin-top:10px">
                    <img :src="imgPreview.person || imgDefault" class="tab-img-circle" alt="preview">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3">
                    @csrf
                    <input type="hidden" name="type" value="person">

                    <div class="form-group">
                        <label class="label" for="name-person">
                            <span class="label-text text-sm">نام شخص <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="name" id="name-person" value="{{ old('name') }}" class="input input-bordered w-full" required>
                    </div>
                    <div class="form-group">
                        <label class="label" for="parent_id-person">
                            <span class="label-text text-sm">دسته والد</span>
                        </label>
                        <select name="parent_id" id="parent_id-person" class="select select-bordered w-full">
                            <option value="">بدون والد</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label" for="image-person">
                            <span class="label-text text-sm">تصویر شخص</span>
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" name="image" id="image-person" accept="image/*" class="file-input file-input-bordered w-full"
                            @change="handleImage($event, 'person')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label" for="description-person">
                            <span class="label-text text-sm">توضیحات کوتاه</span>
                        </label>
                        <input type="text" name="description" id="description-person" value="{{ old('description') }}" class="input input-bordered w-full" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="label" for="full_description-person">
                            <span class="label-text text-sm">توضیحات کامل</span>
                        </label>
                        <textarea name="full_description" id="full_description-person" rows="4" class="textarea textarea-bordered w-full">{{ old('full_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="label" for="created_at-person">
                            <span class="label-text text-sm">تاریخ افزودن</span>
                        </label>
                        <div class="relative">
                            <input type="text"
                                name="created_at_display"
                                id="created_at_display_person"
                                class="input input-bordered w-full"
                                readonly
                                placeholder="انتخاب تاریخ شمسی">
                            <input type="hidden"
                                name="created_at"
                                id="created_at_person"
                                value="{{ old('created_at', now()->format('Y-m-d')) }}">
                            <i class="fas fa-calendar input-icon"></i>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-6">
                        <button type="submit" class="btn btn-primary px-8 submit-btn">
                            <i class="fas fa-plus ml-2"></i>
                            افزودن شخص
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-error mt-4">
                        <ul class="list-disc ps-5">
                            @foreach($errors->all() as $error)
                                <li class="text-xs">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
            </template>

            {{-- تب کالا --}}
            <template x-if="tab === 'product'">
            <div>
                <div class="text-center mb-2 font-bold text-base mt-6">افزودن کالا</div>
                <div class="tab-img-preview" style="margin-top:10px">
                    <img :src="imgPreview.product || imgDefault" class="tab-img-circle" alt="preview">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3">
                    @csrf
                    <input type="hidden" name="type" value="product">
                    <div class="form-group">
                        <label class="label" for="name-product">
                            <span class="label-text text-sm">نام کالا <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="name" id="name-product" value="{{ old('name') }}" class="input input-bordered w-full" required>
                    </div>
                    <div class="form-group">
                        <label class="label" for="parent_id-product">
                            <span class="label-text text-sm">دسته والد</span>
                        </label>
                        <select name="parent_id" id="parent_id-product" class="select select-bordered w-full">
                            <option value="">بدون والد</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label" for="image-product">
                            <span class="label-text text-sm">تصویر کالا</span>
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" name="image" id="image-product" accept="image/*" class="file-input file-input-bordered w-full"
                            @change="handleImage($event, 'product')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label" for="description-product">
                            <span class="label-text text-sm">توضیحات کوتاه</span>
                        </label>
                        <input type="text" name="description" id="description-product" value="{{ old('description') }}" class="input input-bordered w-full" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="label" for="full_description-product">
                            <span class="label-text text-sm">توضیحات کامل</span>
                        </label>
                        <textarea name="full_description" id="full_description-product" rows="4" class="textarea textarea-bordered w-full">{{ old('full_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="label" for="created_at-product">
                            <span class="label-text text-sm">تاریخ افزودن</span>
                        </label>
                        <div class="relative">
                            <input type="text"
                                name="created_at_display"
                                id="created_at_display_product"
                                class="input input-bordered w-full"
                                readonly
                                placeholder="انتخاب تاریخ شمسی">
                            <input type="hidden"
                                name="created_at"
                                id="created_at_product"
                                value="{{ old('created_at', now()->format('Y-m-d')) }}">
                            <i class="fas fa-calendar input-icon"></i>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-6">
                        <button type="submit" class="btn btn-primary px-8 submit-btn">
                            <i class="fas fa-plus ml-2"></i>
                            افزودن کالا
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-error mt-4">
                        <ul class="list-disc ps-5">
                            @foreach($errors->all() as $error)
                                <li class="text-xs">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
            </template>

            {{-- تب خدمات --}}
            <template x-if="tab === 'service'">
            <div>
                <div class="text-center mb-2 font-bold text-base mt-6">افزودن خدمات</div>
                <div class="tab-img-preview" style="margin-top:10px">
                    <img :src="imgPreview.service || imgDefault" class="tab-img-circle" alt="preview">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3">
                    @csrf
                    <input type="hidden" name="type" value="service">
                    <div class="form-group">
                        <label class="label" for="name-service">
                            <span class="label-text text-sm">نام خدمات <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="name" id="name-service" value="{{ old('name') }}" class="input input-bordered w-full" required>
                    </div>
                    <div class="form-group">
                        <label class="label" for="parent_id-service">
                            <span class="label-text text-sm">دسته والد</span>
                        </label>
                        <select name="parent_id" id="parent_id-service" class="select select-bordered w-full">
                            <option value="">بدون والد</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label" for="image-service">
                            <span class="label-text text-sm">تصویر خدمات</span>
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" name="image" id="image-service" accept="image/*" class="file-input file-input-bordered w-full"
                            @change="handleImage($event, 'service')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label" for="description-service">
                            <span class="label-text text-sm">توضیحات کوتاه</span>
                        </label>
                        <input type="text" name="description" id="description-service" value="{{ old('description') }}" class="input input-bordered w-full" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="label" for="full_description-service">
                            <span class="label-text text-sm">توضیحات کامل</span>
                        </label>
                        <textarea name="full_description" id="full_description-service" rows="4" class="textarea textarea-bordered w-full">{{ old('full_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="label" for="created_at-service">
                            <span class="label-text text-sm">تاریخ افزودن</span>
                        </label>
                        <div class="relative">
                            <input type="text"
                                name="created_at_display"
                                id="created_at_display_service"
                                class="input input-bordered w-full"
                                readonly
                                placeholder="انتخاب تاریخ شمسی">
                            <input type="hidden"
                                name="created_at"
                                id="created_at_service"
                                value="{{ old('created_at', now()->format('Y-m-d')) }}">
                            <i class="fas fa-calendar input-icon"></i>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-6">
                        <button type="submit" class="btn btn-primary px-8 submit-btn">
                            <i class="fas fa-plus ml-2"></i>
                            افزودن خدمات
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-error mt-4">
                        <ul class="list-disc ps-5">
                            @foreach($errors->all() as $error)
                                <li class="text-xs">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
            </template>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <!-- moment-jalaali -->
    <script src="{{ asset('assets/js/moment-jalaali.js') }}"></script>
    <!-- Persian Date Picker -->
    <script src="{{ asset('assets/js/mds.bs.datetimepicker.js') }}"></script>
    <!-- اسکریپت فعالسازی انتخابگر تاریخ شمسی -->
    <script>
        function initPersianDatePickers() {
            // اشخاص
            if (document.getElementById('created_at_display_person') && !document.getElementById('created_at_display_person').dataset.pickerInit) {
                new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_person'), {
                    targetTextSelector: '#created_at_display_person',
                    targetDateSelector: '#created_at_person',
                    enableTimePicker: false,
                    englishNumber: true,
                    textFormat: 'yyyy/MM/dd',
                    dateFormat: 'yyyy-MM-dd',
                });
                document.getElementById('created_at_display_person').dataset.pickerInit = "1";
            }
            // کالا
            if (document.getElementById('created_at_display_product') && !document.getElementById('created_at_display_product').dataset.pickerInit) {
                new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_product'), {
                    targetTextSelector: '#created_at_display_product',
                    targetDateSelector: '#created_at_product',
                    enableTimePicker: false,
                    englishNumber: true,
                    textFormat: 'yyyy/MM/dd',
                    dateFormat: 'yyyy-MM-dd',
                });
                document.getElementById('created_at_display_product').dataset.pickerInit = "1";
            }
            // خدمات
            if (document.getElementById('created_at_display_service') && !document.getElementById('created_at_display_service').dataset.pickerInit) {
                new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_service'), {
                    targetTextSelector: '#created_at_display_service',
                    targetDateSelector: '#created_at_service',
                    enableTimePicker: false,
                    englishNumber: true,
                    textFormat: 'yyyy/MM/dd',
                    dateFormat: 'yyyy-MM-dd',
                });
                document.getElementById('created_at_display_service').dataset.pickerInit = "1";
            }
        }
        document.addEventListener('DOMContentLoaded', initPersianDatePickers);
    </script>
    <!-- سایر اسکریپت‌های اختصاصی (در صورت نیاز) -->
    <script src="{{ asset('assets/js/category-create.js') }}"></script>
@endsection
