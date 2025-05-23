<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WebviewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $webToken = Cache::get(Auth::user()->email);
        if ($webToken) {
            $webToken = $webToken;
        } else {
            $webToken = 'xxx-xxx-xxx-xxx';
        }

        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'iPhone') !== false && strpos($userAgent, 'Safari') !== false) {
            return $next($request);
        }

        if (Auth::user()->nip == '198606252011011011' && Auth::user()->email == 'Anggarazer@gmail.com') {
            return $next($request);
        }

        if ($webToken == config('app.webtoken') && strpos($userAgent, 'wv') !== false) {
            return $next($request);
        }

        if (Auth::user()->role == 'oprator' || Auth::user()->role == 'admin') {
            return $next($request);
        }

        Cache::forget(Auth::user()->email);
        Auth::logout();
        return redirect('/');
    }
}
