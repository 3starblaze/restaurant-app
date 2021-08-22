<div class="flex-1">
    <x-h2>{{ __('Available reservations') }}</x-h2>
    <div class="flex gap-2">
        <p class="inline-block text-primary-800">{{ $date->format('Y-m-d') }}</p>
        <div class="my-auto inline-block bg-primary-300 h-px w-full"></div>
    </div>
    @foreach ($reservations as $reservation)
        <x-reservations.minimal-card :reservation="$reservation"
                                     class="p-2 mt-3 w-full"/>
    @endforeach
</div>
