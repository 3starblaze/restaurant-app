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
            if (!in_array($locale, getDefinedLocales())) {
                \App::setLocale(config('app.locale'));
                return redirect(thisWithLocale(config('app.locale')))->with(
                    'status',
                    // The language of the flash might be a problem if the
                    // default language is not English
                    sprintf('Language %s does not exist!', $locale)
                );
            } else {
                \App::setLocale($locale);
            }
        } else {
            // Check the previous URL as a last resort
            $locale = extractUrlLocale(url()->previous());
            ($locale != null) ? \App::setLocale($locale) : null;
        }

        // This is done here because authenticated user may visit guest routes
        if ($request->route()->parameter('locale')) {
            $request->route()->forgetParameter('locale');
        }

        URL::defaults(['locale' => \App::getLocale()]);

        return $next($request);
    }
}
