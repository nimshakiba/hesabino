<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // لیست دسته‌بندی‌ها
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // نمایش فرم ساخت دسته‌بندی
    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    // ذخیره دسته‌بندی جدید
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:person,product,service',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'full_description' => 'nullable|string',
            'created_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $request->validate(['name'=>'required']);
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت افزوده شد.');
    }

    // نمایش فرم ویرایش دسته‌بندی
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('categories.edit', compact('category', 'categories'));
    }

    // ذخیره ویرایش دسته‌بندی
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:person,product,service',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    // حذف دسته‌بندی
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی حذف شد.');
    }
}
