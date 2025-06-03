<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::with('category');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }
        $persons = $query->orderByDesc('id')->paginate(20);
        return view('persons.index', compact('persons'));
    }

    public function create()
    {
        // فقط view را نمایش می‌دهیم. دسته‌بندی با ajax لود می‌شود.
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'nullable|email|unique:persons,email',
            'mobile' => 'nullable|max:20',
            'person_category_id' => 'required|exists:person_categories,id',
        ]);
        Person::create($request->only('name', 'email', 'mobile', 'person_category_id'));
        return redirect()->route('persons.index')->with('success', 'شخص جدید با موفقیت افزوده شد.');
    }

    public function toggleActive(Person $person)
    {
        $person->active = !$person->active;
        $person->save();
        return redirect()->back()->with('success', 'وضعیت شخص بروزرسانی شد.');
    }
}
