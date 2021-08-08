<x-app-layout>
    <x-slot name="header">{{ __('Booking') }}</x-slot>

    <x-h2 class="inline">{{ $booking->name }}</x-h2>
    <p class="inline">({{ $booking['phone_number'] }})</p>
    <p class="text-gray-500">{{ $booking->notes }}</p>
</x-app-layout>
