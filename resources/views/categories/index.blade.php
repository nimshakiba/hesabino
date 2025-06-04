@extends('layouts.app')

@section('title', 'مدیریت دسته‌بندی‌ها')

@section('content')
<div class="container mx-auto py-8 max-w-2xl">
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h2 class="text-xl font-bold mb-4">افزودن دسته‌بندی جدید</h2>
        <form method="POST" action="{{ isset($editCategory) ? route('categories.update', $editCategory) : route('categories.store') }}" class="flex flex-col gap-4">
            @csrf
            @if(isset($editCategory))
                @method('PUT')
            @endif
            <div>
                <label class="block mb-1 font-medium" for="name">نام دسته‌بندی</label>
                <input type="text" name="name" id="name" value="{{ old('name', $editCategory->name ?? '') }}" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-yellow-300" required>
            </div>
            <div>
                <label class="block mb-1 font-medium" for="type">نوع</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                    <option value="">انتخاب کنید</option>
                    <option value="person" @selected(old('type', $editCategory->type ?? '') == 'person')>اشخاص</option>
                    <option value="product" @selected(old('type', $editCategory->type ?? '') == 'product')>کالا</option>
                    <option value="service" @selected(old('type', $editCategory->type ?? '') == 'service')>خدمات</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium" for="parent_id">دسته والد</label>
                <select name="parent_id" id="parent_id" class="w-full border rounded px-3 py-2">
                    <option value="">بدون والد</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('parent_id', $editCategory->parent_id ?? '') == $cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2 mt-2">
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-6 rounded">
                    {{ isset($editCategory) ? 'ذخیره ویرایش' : 'افزودن' }}
                </button>
                @if(isset($editCategory))
                    <a href="{{ route('categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-5 rounded">انصراف</a>
                @endif
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

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-4">لیست دسته‌بندی‌ها</h2>
        @if($categories->count())
            <ul>
                @foreach($categories as $cat)
                    @include('categories.partials.category_tree', ['category' => $cat, 'level' => 0])
                @endforeach
            </ul>
        @else
            <div class="text-gray-400">دسته‌بندی‌ای ثبت نشده است.</div>
        @endif
    </div>
</div>
@endsection
