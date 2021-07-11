<?php

function getDefinedLocales() {
    return ['en', 'lv'];
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
