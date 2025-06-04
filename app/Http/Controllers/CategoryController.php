<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderByDesc('id')
            ->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'type' => ['required','in:person,product,service'],
            'parent_id' => ['nullable','exists:categories,id'],
        ]);
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت افزوده شد.');
    }

    public function edit(Category $category)
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderByDesc('id')
            ->get();
        return view('categories.index', ['categories' => $categories, 'editCategory' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'type' => ['required','in:person,product,service'],
            'parent_id' => ['nullable','exists:categories,id'],
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی ویرایش شد.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی حذف شد.');
    }
}
