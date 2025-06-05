@extends('layouts.app')

@section('title', 'افزودن دسته‌بندی جدید')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/category-create.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="card bg-base-100 shadow-xl p-0 overflow-visible">
        <h2 class="text-lg font-bold px-8 pt-7 pb-0 flex items-center gap-2">
            <i class="fas fa-plus text-primary"></i>
            افزودن دسته‌بندی جدید
        </h2>
        <div
            x-data="categoryForm"
            :style="`--tab-color: ${tabColors[tab]}; --tab-active-color: ${tabColors[tab]}; --tab-bg: ${tabBGs[tab]}; --tab-active-bg: #fff;`"
        >
            <div class="category-tabs-custom mt-4">
                <button type="button"
                    :class="tab === 'person' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="changeTab('person')"
                >
                    <i class="fas fa-users" :style="`color: ${tabColors.person}`"></i>
                    اشخاص
                </button>
                <button type="button"
                    :class="tab === 'product' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="changeTab('product')"
                >
                    <i class="fas fa-box" :style="`color: ${tabColors.product}`"></i>
                    کالا
                </button>
                <button type="button"
                    :class="tab === 'service' ? 'category-tab-btn active' : 'category-tab-btn'"
                    @click="changeTab('service')"
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

                <div class="form-group">
                    <label class="label" for="name">
                        <span class="label-text text-sm">نام دسته‌بندی <span class="text-error">*</span></span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="input input-bordered w-full" required>
                </div>

                <div class="form-group">
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

                <div class="form-group">
                    <label class="label" for="image">
                        <span class="label-text text-sm">تصویر دسته‌بندی</span>
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" id="image" accept="image/*" class="file-input file-input-bordered w-full"
                        @change="handleImage">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="description">
                        <span class="label-text text-sm">توضیحات کوتاه</span>
                    </label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="input input-bordered w-full" maxlength="255">
                </div>

                <div class="form-group">
                    <label class="label" for="full_description">
                        <span class="label-text text-sm">توضیحات کامل</span>
                    </label>
                    <textarea name="full_description" id="full_description" rows="4" class="textarea textarea-bordered w-full">{{ old('full_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="label" for="created_at">
                        <span class="label-text text-sm">تاریخ افزودن</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               name="created_at_display"
                               id="created_at_display"
                               class="input input-bordered w-full"
                               readonly>
                        <input type="hidden"
                               name="created_at"
                               id="created_at"
                               value="{{ old('created_at', now()->format('Y-m-d')) }}">
                        <i class="fas fa-calendar input-icon"></i>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit" class="btn btn-primary px-8 submit-btn">
                        <i class="fas fa-plus ml-2"></i>
                        افزودن
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
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@alireza-ab/jalali-moment/dist/jalali-moment.browser.js"></script>
    <script src="{{ asset('assets/js/category-create.js') }}"></script>
@endsection
