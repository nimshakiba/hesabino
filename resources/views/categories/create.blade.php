@extends('layouts.app')

@section('title', 'افزودن دسته‌بندی جدید')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/category-create.css') }}">
@endsection

@section('content')
<div class="container mx-auto py-8 max-w-2xl">
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
            <i class="fas fa-plus text-yellow-500"></i>
            افزودن دسته‌بندی جدید
        </h2>

        <div x-data="{ tab: '{{ old('type', 'person') }}' }">
            <div class="tabs flex gap-2 mb-6">
                <button type="button"
                    :class="tab === 'person' ? 'tab-active' : 'tab-inactive'"
                    @click="tab = 'person'; $refs.type.value='person';"
                    class="tab-btn">
                    <i class="fas fa-users text-pink-500"></i> اشخاص
                </button>
                <button type="button"
                    :class="tab === 'product' ? 'tab-active' : 'tab-inactive'"
                    @click="tab = 'product'; $refs.type.value='product';"
                    class="tab-btn">
                    <i class="fas fa-box text-blue-500"></i> کالا
                </button>
                <button type="button"
                    :class="tab === 'service' ? 'tab-active' : 'tab-inactive'"
                    @click="tab = 'service'; $refs.type.value='service';"
                    class="tab-btn">
                    <i class="fas fa-tools text-green-500"></i> خدمات
                </button>
            </div>

            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="flex flex-col gap-5" id="categoryForm">
                @csrf
                <input type="hidden" name="type" x-ref="type" :value="tab">

                <div>
                    <label class="block mb-1 font-medium" for="name">نام دسته‌بندی <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-yellow-300" required>
                </div>

                <div>
                    <label class="block mb-1 font-medium" for="parent_id">دسته والد</label>
                    <select name="parent_id" id="parent_id" class="w-full border rounded px-3 py-2">
                        <option value="">بدون والد</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium" for="image">تصویر دسته‌بندی</label>
                    <input type="file" name="image" id="image" accept="image/*" class="block w-full border rounded px-3 py-2 file:bg-yellow-50 file:border-0 file:rounded file:px-5 file:py-1">
                    <div id="preview-image" class="mt-2"></div>
                </div>

                <div>
                    <label class="block mb-1 font-medium" for="description">توضیحات کوتاه</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="w-full border rounded px-3 py-2" maxlength="255">
                </div>

                <div>
                    <label class="block mb-1 font-medium" for="full_description">توضیحات کامل</label>
                    <textarea name="full_description" id="full_description" rows="4" class="w-full border rounded px-3 py-2">{{ old('full_description') }}</textarea>
                </div>

                <div>
                    <label class="block mb-1 font-medium" for="created_at">تاریخ افزودن</label>
                    <input type="date" name="created_at" id="created_at"
                        value="{{ old('created_at', now()->format('Y-m-d')) }}"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex gap-2 mt-2">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-6 rounded">
                        افزودن
                    </button>
                    <a href="{{ route('categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-5 rounded">بازگشت</a>
                </div>
            </form>

            @if($errors->any())
                <div class="mt-4 text-red-600">
                    <ul class="list-disc ps-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/category-create.js') }}"></script>
@endsection
