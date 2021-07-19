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
