@props(['disabled' => false, 'type' => 'text'])

<input {{ $disabled ? 'disabled' : '' }}
type="{{ $type }}"
{!! $attributes->merge([
    'class' => ($type == 'checkbox')
    ? implode(' ', [
        getBaseInputAttributes(),
        'text-primary-500',
        'rounded',
    ]) : getDefaultInputAttributes()])
!!}>
