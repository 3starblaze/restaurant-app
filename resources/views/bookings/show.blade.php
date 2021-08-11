<x-app-layout>
    <x-slot name="header">{{ __('Booking') }}</x-slot>

    <x-h2 class="inline">{{ $booking->name }}</x-h2>
    <p class="inline">({{ $booking['phone_number'] }})</p>
    <p class="text-gray-500">{{ $booking->notes }}</p>

    <hr class="mt-5 mb-8" />

    <x-h2 class="mb-2">
        <x-a :href="route('restaurant.show', $booking->reservation->restaurant)">
            {{ $booking->reservation->restaurant->name }}
        </x-a>
    </x-h2>
    <x-reservations.card :reservation="$booking->reservation" />
</x-app-layout>
