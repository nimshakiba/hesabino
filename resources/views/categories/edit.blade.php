@extends('layouts.app')

@section('title', 'ویرایش دسته‌بندی')

@section('content')
<div class="container mx-auto py-8 max-w-lg">
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
            <i class="fas fa-edit text-blue-500"></i>
            ویرایش دسته‌بندی
        </h2>
        <form method="POST" action="{{ route('categories.update', $category) }}" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1 font-medium" for="name">نام دسته‌بندی</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-yellow-300" required>
            </div>
            <div>
                <label class="block mb-1 font-medium" for="type">نوع</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                    <option value="">انتخاب کنید</option>
                    <option value="person" @selected(old('type', $category->type) == 'person')>اشخاص</option>
                    <option value="product" @selected(old('type', $category->type) == 'product')>کالا</option>
                    <option value="service" @selected(old('type', $category->type) == 'service')>خدمات</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium" for="parent_id">دسته والد</label>
                <select name="parent_id" id="parent_id" class="w-full border rounded px-3 py-2">
                    <option value="">بدون والد</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('parent_id', $category->parent_id) == $cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2 mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded">
                    ذخیره ویرایش
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
@endsection
