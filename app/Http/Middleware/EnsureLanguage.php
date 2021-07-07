<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check()) {
            \App::setLocale(Auth::user()->locale);
        } else if ($request->route()->parameter('locale')) {
            $locale = $request->route()->parameter('locale');
            if (!in_array($locale, getDefinedLocales())) abort(400);
            \App::setLocale($locale);
        }

        // This is done here because authenticated user may visit guest routes
        if ($request->route()->parameter('locale')) {
            $request->route()->forgetParameter('locale');
        }

        URL::defaults(['locale' => \App::getLocale()]);

        // print("FOO>>");
        // print(\App::getLocale());
        // print("<<FOO");

        return $next($request);
    }
}
