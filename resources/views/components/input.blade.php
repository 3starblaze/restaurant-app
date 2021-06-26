@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge(['class' =>
    'rounded-md shadow-sm border-gray-300 border-2 outline-none focus:ring-2 focus:ring-blue-300 bg-white px-2 py-1']) !!}>
