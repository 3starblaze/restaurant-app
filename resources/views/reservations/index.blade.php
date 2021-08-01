<x-app-layout>
    <x-slot name="header">
        {{ __('Reservations') }}
    </x-slot>

    <div class="flex justify-start">
        <x-a href="{{ route('reservations.create', compact('restaurant')) }}" class="mt-5 mb-10">Create new</x-a> <!-- , compact('restaurant') -->
    </div>

    @forelse ($reservations as $reservation)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold">
                <x-a href="{{ route('reservations.show', compact('reservation')) }}">
                    {{ $reservation->start_time }} - {{ $reservation->end_time }}
                </x-a>
            </h2>
            <p>{{ __('Guest count') }}: {{ $reservation->max_person_count }}</p>
            <p>{{ __('Description') }}: {{ $reservation->description }}</p>
        </div>
    @empty
        <p> {{ __('No reservations yet.') }} </p>
    @endforelse
</x-app-layout>
