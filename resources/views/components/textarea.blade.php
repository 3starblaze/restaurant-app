<textarea {{ $attributes->merge(['class' => getDefaultInputAttributes()]) }}>
    {{ $slot }}
</textarea>
