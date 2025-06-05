<?php

namespace App\Services;

use App\Models\Business;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class BusinessService
{
    public static function createBusiness($user, $name)
    {
        // ساخت نام دیتابیس یکتا
        $dbName = 'business_' . strtolower($user->id) . '_' . time();

        // ایجاد دیتابیس جدید
        DB::statement("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        // ثبت کسب‌وکار در دیتابیس اصلی
        $business = Business::create([
            'user_id' => $user->id,
            'name' => $name,
            'database_name' => $dbName,
        ]);

        // ساخت کانکشن موقت tenant
        config([
            "database.connections.tenant" => [
                'driver' => 'mysql',
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => $dbName,
                'username' => config('database.connections.mysql.username'),
                'password' => config('database.connections.mysql.password'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
            ]
        ]);

        // اجرای مایگریشن جداول tenant
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);

        return $business;
    }
}
