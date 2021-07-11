<?php

function getDefinedLocales() {
    return ['en', 'lv'];
}

function getDefaultInputAttributes() {
    return implode(' ', [
        'rounded-md',
        'shadow-sm',
        'border-gray-300',
        'border-2',
        'outline-none',
        'bg-white',
        'px-2',
        'py-1',
        'focus:border-primary-500',
        'focus:ring-primary-500',
    ]);
}
