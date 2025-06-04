<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // لیست دسته‌بندی‌ها با همه زیرشاخه‌ها
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Category::query();
        if ($type) {
            $query->where('type', $type);
        }
        $categories = $query->whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($categories);
    }

    // ساخت دسته‌بندی جدید
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:person,product,service',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = Category::create($data);
        return response()->json($category, 201);
    }

    // ویرایش دسته‌بندی
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category->update($data);
        return response()->json($category);
    }

    // حذف دسته‌بندی
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true]);
    }
}
