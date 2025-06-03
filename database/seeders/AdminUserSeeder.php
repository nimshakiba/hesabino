<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = 'admin@hesabino.ir';
        $admin = User::where('email', $adminEmail)->first();

        if (!$admin) {
            User::create([
                'name' => 'مدیر کل',
                'email' => $adminEmail,
                'password' => Hash::make('Admin@123456'), // رمز عبور پیش‌فرض، بعداً تغییر بده
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
            $this->command->info('✅ مدیر با ایمیل '.$adminEmail.' و رمز عبور Admin@123456 ساخته شد.');
        } else {
            if (!$admin->is_admin) {
                $admin->is_admin = true;
                $admin->save();
            }
            $this->command->info('ℹ️ کاربر با ایمیل '.$adminEmail.' قبلاً وجود داشته است و نقش مدیر به او داده شد.');
        }
    }
}
