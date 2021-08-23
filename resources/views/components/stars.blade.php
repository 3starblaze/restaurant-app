<!-- Flex for removing implicit whitespace -->
<!-- Shift div for finer alignment -->
<div {{ $attributes->merge(['class' => 'flex relative -left-0.5']) }}>
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $starCount)
            <x-bare.star-icon
                class="h-5 inline-block text-yellow-500" />
        @else
            <x-bare.star-icon
                class="h-5 inline-block text-yellow-200" />
        @endif
    @endfor
</div>
