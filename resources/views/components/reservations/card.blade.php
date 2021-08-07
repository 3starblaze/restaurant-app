<div class="ml-5 mt-5 max-w-xl">
    <h2 class="font-bold">
        <x-a href="{{ route('reservations.show', compact('reservation')) }}">
            {{ $reservation->start_time }} - {{ $reservation->end_time }}
        </x-a>
    </h2>
    <p>{{ __('Guest count') }}: {{ $reservation->max_person_count }}</p>
    <p>{{ __('Description') }}: {{ $reservation->description }}</p>
</div>
