<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use App\Models\Business;

class SwitchTenantDatabase
{
    public function handle($request, Closure $next)
    {
        $businessId = session('current_business_id');
        if (!$businessId) {
            abort(403, 'هیچ کسب‌وکاری انتخاب نشده است');
        }

        $business = Business::findOrFail($businessId);

        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'database' => $business->database_name,
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);
        \DB::setDefaultConnection('tenant');

        return $next($request);
    }
}
