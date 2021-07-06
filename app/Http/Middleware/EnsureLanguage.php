<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        if (!in_array($locale, getDefinedLocales())) abort(400);
        \App::setLocale($locale);
        $request->route()->forgetParameter('locale');

        // Pass locale automatically to route helper
        URL::defaults(['locale' => \App::getLocale()]);

        return $next($request);
    }
}
