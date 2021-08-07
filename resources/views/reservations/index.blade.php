<x-app-layout>
    <x-slot name="header">
        {{ __('Reservations') }}
    </x-slot>

    <div class="flex justify-start">
        <x-a href="{{ route('reservations.create') }}" class="mt-5 mb-10">Create new</x-a>
    </div>

    @forelse ($reservations as $reservation)
        <x-reservations.card :reservation="$reservation" />
    @empty
        <p> {{ __('No reservations yet.') }} </p>
    @endforelse
</x-app-layout>
