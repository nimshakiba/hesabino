@extends('layouts.app')

@section('title', 'افزودن دسته‌بندی جدید')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        body, h1, h2, h3, h4, h5, h6, input, button, label, textarea, select {
            font-family: 'AnjomanMax', Arial, Tahoma, sans-serif !important;
        }
        .category-tabs-custom {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 1rem;
            margin-bottom: 0;
            background: transparent;
        }
        .category-tab-btn {
            padding: 0.7rem 2.1rem 0.9rem 2.1rem;
            background: var(--tab-bg, #f6f6f8);
            color: var(--tab-color, #7b7b7b);
            font-weight: 700;
            font-size: 1.08rem;
            border: none;
            outline: none;
            border-radius: 1.3rem 1.3rem 0 0;
            position: relative;
            top: 0;
            transition: background 0.16s, color 0.16s, box-shadow 0.14s;
            box-shadow: 0 2px 8px #0000000e;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            border-bottom: none;
        }
        .category-tab-btn.active {
            background: var(--tab-active-bg, #fff);
            color: var(--tab-active-color, #222);
            box-shadow: 0 5px 20px #0001;
            z-index: 3;
        }
        .category-tab-btn i {
            font-size: 1.25rem;
        }
        .tab-img-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -36px;
            margin-bottom: 1.2rem;
            position: relative;
            z-index: 1;
        }
        .tab-img-circle {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            border: 3px solid var(--tab-color, #6366f1);
            background: #fff;
            box-shadow: 0 4px 18px #0002;
            object-fit: cover;
        }
        .card.bg-base-100 {
            font-family: 'AnjomanMax', Arial, Tahoma, sans-serif;
        }
        .input, .textarea, .select, .file-input {
            font-family: 'AnjomanMax', Arial, Tahoma, sans-serif;
        }
        @media (max-width:600px) {
            .tab-img-circle { width: 64px; height: 64px; }
            .category-tab-btn { font-size: 0.97rem; padding: 0.4rem 0.7rem 0.6rem 0.7rem;}
        }
    </style>
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
                tab: '{{ old('type', 'person') }}',
                tabColors: {
                    person: '#6366f1',
                    product: '#06b6d4',
                    service: '#10b981'
                },
                tabBGs: {
                    person: '#f6f6f8',
                    product: '#f0fcfd',
                    service: '#f3fcf7'
                },
                imgDefault: (
                    '{{ old('type', 'person') }}' === 'person'
                    ? '/assets/img/default-person.png'
                    : ( '{{ old('type', 'person') }}' === 'product'
                        ? '/assets/img/default-product.png'
                        : '/assets/img/default-service.png')
                ),
                imgPreview: '',
                tabLabel: '{{ old('type', 'person') === 'person' ? 'اشخاص' : (old('type') === 'product' ? 'کالا' : 'خدمات') }}',
                handleImage(e) {
                    const file = e.target.files[0];
                    if(file) {
                        const reader = new FileReader();
                        reader.onload = evt => { this.imgPreview = evt.target.result; };
                        reader.readAsDataURL(file);
                    } else {
                        this.imgPreview = '';
                    }
                }
            }"
            :style="`--tab-color: ${tabColors[tab]}; --tab-active-color: ${tabColors[tab]}; --tab-bg: ${tabBGs[tab]}; --tab-active-bg: #fff;`"
        >
            <div class="category-tabs-custom mt-4">
                <button type="button"
                    :class="tab === 'person' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="tab = 'person'; imgDefault = '/assets/img/default-person.png'; tabLabel = 'اشخاص';"
                >
                    <i class="fas fa-users" :style="`color: ${tabColors.person}`"></i>
                    اشخاص
                </button>
                <button type="button"
                    :class="tab === 'product' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="tab = 'product'; imgDefault = '/assets/img/default-product.png'; tabLabel = 'کالا';"
                >
                    <i class="fas fa-box" :style="`color: ${tabColors.product}`"></i>
                    کالا
                </button>
                <button type="button"
                    :class="tab === 'service' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="tab = 'service'; imgDefault = '/assets/img/default-service.png'; tabLabel = 'خدمات';"
                >
                    <i class="fas fa-tools" :style="`color: ${tabColors.service}`"></i>
                    خدمات
                </button>
            </div>
            <div class="tab-img-preview">
                <img :src="imgPreview || imgDefault" class="tab-img-circle" alt="preview">
            </div>
            <div class="text-center mb-2 font-bold text-base" x-text="'دسته‌بندی ' + tabLabel"></div>
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3">
                @csrf
                <input type="hidden" name="type" x-model="tab">
                <div>
                    <label class="label" for="name">
                        <span class="label-text text-sm">نام دسته‌بندی <span class="text-error">*</span></span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="input input-bordered w-full" required>
                </div>
                <div>
                    <label class="label" for="parent_id">
                        <span class="label-text text-sm">دسته والد</span>
                    </label>
                    <select name="parent_id" id="parent_id" class="select select-bordered w-full">
                        <option value="">بدون والد</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label" for="image">
                        <span class="label-text text-sm">تصویر دسته‌بندی</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" class="file-input file-input-bordered w-full"
                    @change="handleImage">
                </div>
                <div>
                    <label class="label" for="description">
                        <span class="label-text text-sm">توضیحات کوتاه</span>
                    </label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="input input-bordered w-full" maxlength="255">
                </div>
                <div>
                    <label class="label" for="full_description">
                        <span class="label-text text-sm">توضیحات کامل</span>
                    </label>
                    <textarea name="full_description" id="full_description" rows="4" class="textarea textarea-bordered w-full">{{ old('full_description') }}</textarea>
                </div>
                <div>
                    <label class="label" for="created_at">
                        <span class="label-text text-sm">تاریخ افزودن</span>
                    </label>
                    <input type="date" name="created_at" id="created_at"
                           value="{{ old('created_at', now()->format('Y-m-d')) }}"
                           class="input input-bordered w-full">
                </div>
                <div class="flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary px-8">افزودن</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-ghost">بازگشت</a>
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
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@alireza-ab/jalali-moment/dist/jalali-moment.browser.js"></script>
@endsection
