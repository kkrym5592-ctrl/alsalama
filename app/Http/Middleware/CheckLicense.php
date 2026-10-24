<?php

namespace App\Http\Middleware;

use App\Models\License;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicense
{
    public function handle(Request $request, Closure $next): Response
    {
        // لا توقف أوامر Artisan أو طلبات الصيانة.
        if (app()->runningInConsole() || app()->isDownForMaintenance()) {
            return $next($request);
        }

        // إنشاء الترخيص مرة واحدة عند أول طلب للموقع.
        $license = License::query()->first();

        if (!$license) {
            $now = now();

            $license = License::create([
                'activated_at' => $now,
                'expires_at' => $now->copy()->addYear(),
            ]);
        }

        // حماية من وجود ترخيص غير مكتمل.
        if (!$license->activated_at || !$license->expires_at) {
            abort(503, 'Website license is not configured.');
        }

        // إيقاف الموقع بالكامل بعد انتهاء المدة.
        if (now()->greaterThanOrEqualTo($license->expires_at)) {
            return response()->view('errors.license-expired', [], 503);
        }

        return $next($request);
    }
}
