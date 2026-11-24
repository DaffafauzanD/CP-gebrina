<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Header keamanan yang diperiksa Lighthouse (Best Practices).
 *
 * CSP sengaja hanya membatasi frame-ancestors, base-uri, dan object-src.
 * Membatasi script-src akan memblokir tag yang ditambahkan lewat Google Tag
 * Manager (Ads, Analytics, pixel lain) tanpa sepengetahuan developer.
 *
 * HSTS hanya dikirim di produksi supaya browser developer tidak "terkunci"
 * ke HTTPS saat membuka localhost.
 */
class SecurityHeaders
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->add([
            'X-Frame-Options' => 'SAMEORIGIN',
            'Content-Security-Policy' => "frame-ancestors 'self'; base-uri 'self'; object-src 'none'",
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Cross-Origin-Opener-Policy' => 'same-origin-allow-popups',
            'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()',
        ]);

        if (app()->isProduction()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
