<li class="mb-2 ps-{{ $level * 5 }}">
    <div class="flex items-center gap-2">
        <span class="font-medium">{{ $category->name }}</span>
        <span class="text-xs text-gray-500">({{ __("types.$category->type") }})</span>
        <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-bold px-2 py-1">
            ویرایش
        </a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('حذف این دسته‌بندی مطمئن هستید؟')" class="text-red-600 hover:text-red-800 text-sm font-bold px-2 py-1">
                حذف
            </button>
        </form>
    </div>
    @if($category->childrenRecursive->count())
        <ul>
            @foreach($category->childrenRecursive as $child)
                @include('categories.partials.category_tree', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
