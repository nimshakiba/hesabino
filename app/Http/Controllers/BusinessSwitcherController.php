<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class BusinessSwitcherController extends Controller
{
    public function switch(Request $request)
    {
        $business = Business::where('id', $request->business_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        session(['current_business_id' => $business->id]);
        return redirect()->route('dashboard')->with('success', 'کسب‌وکار فعال تغییر کرد.');
    }
}
