<select {{ $attributes->merge(['class' => getDefaultInputAttributes()]) }}>
    {{ $slot }}
</select>
