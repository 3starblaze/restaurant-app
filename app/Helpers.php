<?php

use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Routing\UrlGenerator;

function getDefinedLocales() {
    return ['en', 'lv'];
}

function replaceUrlLocale($url, $locale) {
    $route = Route::getRoutes()->match(app('request')->create($url));

    if (!isset($route->parameters()['locale'])) return null;

    $req = app('request');
    $rug = new RouteUrlGenerator(
        new UrlGenerator(Route::getRoutes(), $req),
        $req);

    return $rug->to($route, array_merge(
        $route->parameters(),
        compact('locale'),
    ));
}

function thisWithLocale($locale) {
    return replaceUrlLocale(url()->current(), $locale);
}

function extractUrlLocale($url) {
    $route = Route::getRoutes()->match(app('request')->create($url));
    return $route->parameters()['locale'] ?? null;
}

function getBaseInputAttributes() {
    return implode(' ', [
        'shadow-sm',
        'border-gray-300',
        'border-2',
        'outline-none',
        'bg-white',
        'focus:border-primary-500',
        'focus:ring-primary-500',
    ]);
}

function getDefaultInputAttributes() {
    return implode(' ', [
        getBaseInputAttributes(),
        'px-2',
        'py-1',
        'rounded-md',
    ]);
}
