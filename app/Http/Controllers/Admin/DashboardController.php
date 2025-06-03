<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $admins_count = User::where('is_admin', true)->count();
        // اینجا می‌توانید آمار دیتابیس و کسب‌وکار را نیز اضافه کنید.

        return view('admin.dashboard', compact('users_count', 'admins_count'));
    }
}
