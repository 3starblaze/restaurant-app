<?php

function getDefinedLocales() {
    return ['en', 'lv'];
}

function thisWithLocale($locale) {
    return route(Route::getCurrentRoute()->action['as'], array_merge(
        Route::getCurrentRoute()->parameters,
        compact('locale'),
    ));
}

function extractUrlLocale($url) {
    $matches = [];
    $url = str_replace(url('/'), '', $url);
    $regexes = [
        '/\/home\/([a-zA-Z]+)\/?/',
        '/\/business\/([a-zA-Z]+)\/?/',
    ];

    $results = array_map(function($re) use ($url) {
        $match = [];
        preg_match($re, $url, $match);
        return $match[1] ?? null;
    }, $regexes);

    // Return first non-null result (or null if there's no non-null)
    return array_reduce($results, function ($lhs, $rhs) {
        return ($lhs != null) ? $lhs : $rhs;
    });
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
