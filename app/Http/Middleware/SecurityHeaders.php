<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $viteOrigin = app()->isLocal() ? ' http://localhost:5173 http://127.0.0.1:5173' : '';

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Content-Security-Policy', "default-src 'self' https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net{$viteOrigin}; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com{$viteOrigin}; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self' ws://localhost:5173 ws://127.0.0.1:5173{$viteOrigin};");

        return $response;
    }
}
