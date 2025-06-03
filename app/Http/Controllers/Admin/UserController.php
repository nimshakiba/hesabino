<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // کسب‌وکارها، دیتابیس‌ها و غیره را می‌توانید به اینجا اضافه کنید.
        return view('admin.users.show', compact('user'));
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->save();
        return redirect()->back()->with('success', 'کاربر مدیر شد.');
    }

    public function removeAdmin(User $user)
    {
        $user->is_admin = false;
        $user->save();
        return redirect()->back()->with('success', 'دسترسی مدیر از کاربر گرفته شد.');
    }
}
