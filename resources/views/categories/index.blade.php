@extends('layouts.app')

@section('title', 'لیست دسته‌بندی‌ها')

@section('content')
<div class="container mx-auto py-8 max-w-4xl">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @php
        $types = [
            'person' => ['title' => 'اشخاص', 'icon' => 'fa-users', 'color' => 'text-pink-500'],
            'product' => ['title' => 'کالا', 'icon' => 'fa-box', 'color' => 'text-blue-500'],
            'service' => ['title' => 'خدمات', 'icon' => 'fa-tools', 'color' => 'text-green-500'],
        ];
        $typeCounts = [];
        foreach ($types as $type => $meta) {
            $typeCounts[$type] = $categories->where('type', $type)->count();
        }
        $activeTab = request('tab') ?? array_key_first($types);
    @endphp

    <div x-data="{ tab: '{{ $activeTab }}', search: '' }">
        <div class="flex border-b mb-3">
            @foreach($types as $type => $meta)
                <button
                    x-on:click="tab = '{{ $type }}'; search='';"
                    :class="tab === '{{ $type }}' ? 'border-b-4 border-yellow-400 text-yellow-700 font-bold bg-yellow-50' : 'border-b-2 border-gray-200 text-gray-500 bg-white'"
                    class="px-6 py-2 focus:outline-none transition-all duration-200 flex items-center gap-2"
                >
                    <i class="fas {{ $meta['icon'] }} {{ $meta['color'] }}"></i>
                    {{ $meta['title'] }}
                    <span class="bg-gray-200 rounded-full px-2 text-xs font-bold ml-2">{{ $typeCounts[$type] }}</span>
                </button>
            @endforeach
            <a href="{{ route('categories.create') }}" class="ml-auto bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded transition text-sm font-bold flex items-center gap-1">
                <i class="fas fa-plus"></i> افزودن دسته‌بندی جدید
            </a>
        </div>

        @foreach($types as $type => $meta)
        <div x-show="tab === '{{ $type }}'" class="pt-4" x-cloak>
            <input type="text" x-model="search" placeholder="جستجو در {{ $meta['title'] }}..." class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-yellow-300 mb-4" autocomplete="off">
            @php
                $filtered = $categories->where('type', $type);
            @endphp
            @if($filtered->count())
                <ul>
                    @foreach($filtered as $cat)
                        <li class="mb-3" x-show="search === '' || '{{ $cat->name }}'.includes(search)">
                            <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg shadow-sm border">
                                <i class="fas {{ $meta['icon'] }} {{ $meta['color'] }} text-xl"></i>
                                <span class="font-bold text-base">{{ $cat->name }}</span>
                                @if($cat->parent)
                                    <span class="text-xs text-gray-500">والد: {{ $cat->parent->name }}</span>
                                @endif
                                <span class="text-xs bg-gray-200 rounded px-2 py-0.5">زیرمجموعه: {{ $cat->children->count() }}</span>
                                <div class="ml-auto flex gap-2">
                                    <a href="{{ route('categories.edit', $cat) }}" class="text-blue-500 hover:underline text-sm flex items-center"><i class="fas fa-edit ml-1"></i>ویرایش</a>
                                    <form method="POST" action="{{ route('categories.destroy', $cat) }}" onsubmit="return confirm('حذف شود؟');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:underline text-sm flex items-center"><i class="fas fa-trash ml-1"></i>حذف</button>
                                    </form>
                                </div>
                            </div>
                            @if($cat->children->count())
                                <ul class="ml-8 mt-2 border-r-2 border-gray-200 pr-3">
                                    @foreach($cat->children as $child)
                                        <li class="mb-2 flex items-center gap-2">
                                            <i class="fas fa-angle-left text-yellow-400"></i>
                                            <span>{{ $child->name }}</span>
                                            <span class="text-xs text-gray-400">(زیرمجموعه: {{ $child->children->count() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-gray-400">دسته‌بندی‌ای برای این نوع ثبت نشده است.</div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
