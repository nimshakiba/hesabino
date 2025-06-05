@extends('layouts.app')

@section('title', 'افزودن دسته‌بندی جدید')

@section('head')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/fonts/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/category-create.css') }}" rel="stylesheet">
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
                handleTab(newTab) { this.tab = newTab },
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
                    <img :src="imgPreview.person || imgDefault"
                         class="tab-img-circle"
                         alt="preview"
                         style="cursor:pointer"
                         @click="$refs.fileInputPerson.click()">
                </div>
                <div class="file-input-wrapper">
                    <input type="file"
                        name="image"
                        id="image-person"
                        accept="image/*"
                        class="file-input file-input-bordered w-full"
                        x-ref="fileInputPerson"
                        @change="handleImage($event, 'person')">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3 mt-2">
                    @csrf
                    <input type="hidden" name="type" value="person">
                    <input type="hidden" name="created_at" value="{{ now()->format('Y-m-d') }}">
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
                    <img :src="imgPreview.product || imgDefault"
                         class="tab-img-circle"
                         alt="preview"
                         style="cursor:pointer"
                         @click="$refs.fileInputProduct.click()">
                </div>
                <div class="file-input-wrapper">
                    <input type="file"
                        name="image"
                        id="image-product"
                        accept="image/*"
                        class="file-input file-input-bordered w-full"
                        x-ref="fileInputProduct"
                        @change="handleImage($event, 'product')">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3 mt-2">
                    @csrf
                    <input type="hidden" name="type" value="product">
                    <input type="hidden" name="created_at" value="{{ now()->format('Y-m-d') }}">
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
                    <img :src="imgPreview.service || imgDefault"
                         class="tab-img-circle"
                         alt="preview"
                         style="cursor:pointer"
                         @click="$refs.fileInputService.click()">
                </div>
                <div class="file-input-wrapper">
                    <input type="file"
                        name="image"
                        id="image-service"
                        accept="image/*"
                        class="file-input file-input-bordered w-full"
                        x-ref="fileInputService"
                        @change="handleImage($event, 'service')">
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="w-full max-w-md mx-auto space-y-3 mt-2">
                    @csrf
                    <input type="hidden" name="type" value="service">
                    <input type="hidden" name="created_at" value="{{ now()->format('Y-m-d') }}">
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
