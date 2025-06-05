<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BusinessService;
use App\Models\User;

class BusinessController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);
        $business = BusinessService::createBusiness($user, $request->name);

        return redirect()->back()->with('success', 'کسب‌وکار جدید با دیتابیس مجزا ایجاد شد.');
    }
}
