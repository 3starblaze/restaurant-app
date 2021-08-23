<div class="flex-1">
    <x-h2>{{ __('Available reservations') }}</x-h2>
    <x-text-divider>
        {{ $date->format('Y-m-d') }}
    </x-text-divider>
    @foreach ($reservations as $reservation)
        <x-reservations.minimal-card :reservation="$reservation"
                                     class="p-2 mt-3 w-full"/>
    @endforeach
</div>
