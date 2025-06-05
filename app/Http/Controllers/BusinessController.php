<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function create()
    {
        return view('business.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $business = new Business();
        $business->name = $request->name;
        $business->user_id = Auth::id();
        $business->save();

        // بعد از ثبت کسب‌وکار، آی‌دی را در سشن بگذار (یا هر روشی که داری)
        session(['current_business_id' => $business->id]);

        return redirect()->route('dashboard')->with('success', 'کسب‌وکار با موفقیت ثبت شد!');
    }
}
