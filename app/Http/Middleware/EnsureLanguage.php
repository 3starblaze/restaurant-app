<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route()->parameter('locale');
        if (!in_array($locale, ['en', 'lv'])) abort(400);
        \App::setLocale($locale);
        $request->route()->forgetParameter('locale');

        return $next($request);
    }
}
