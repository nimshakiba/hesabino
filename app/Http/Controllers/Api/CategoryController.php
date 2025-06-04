<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    #[\Illuminate\Routing\Attributes\Get('api/categories')]
    public function index(Request $request)
    {
        $type = $request->query('type');
        $categories = Category::with('childrenRecursive')
            ->where('type', $type)
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();

        return CategoryResource::collection($categories);
    }

    #[\Illuminate\Routing\Attributes\Post('api/categories')]
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return new CategoryResource($category->load('childrenRecursive'));
    }

    #[\Illuminate\Routing\Attributes\Put('api/categories/{category}')]
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category->load('childrenRecursive'));
    }

    #[\Illuminate\Routing\Attributes\Delete('api/categories/{category}')]
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['status' => true]);
    }
}
