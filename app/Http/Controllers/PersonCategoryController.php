<?php

namespace App\Http\Controllers;

use App\Models\PersonCategory;
use Illuminate\Http\Request;

class PersonCategoryController extends Controller
{
    public function listAjax(Request $request)
    {
        $q = $request->input('q');
        $query = PersonCategory::query();
        if($q) $query->where('title', 'like', "%$q%");
        $categories = $query->limit(20)->get(['id', 'title as text']);
        return response()->json(['results' => $categories]);
    }
}
