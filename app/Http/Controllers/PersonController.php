<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::query();
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
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'nullable|email|unique:persons,email',
            'mobile' => 'nullable|max:20',
        ]);
        Person::create($request->only('name', 'email', 'mobile'));
        return redirect()->route('persons.index')->with('success', 'شخص جدید با موفقیت افزوده شد.');
    }

    public function toggleActive(Person $person)
    {
        $person->active = !$person->active;
        $person->save();
        return redirect()->back()->with('success', 'وضعیت شخص بروزرسانی شد.');
    }
}
