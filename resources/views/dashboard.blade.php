@php
$restaurant = Auth::user()->restaurant
@endphp

<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-h2 class="mb-5">{{ __('Your reservations') }}</x-h2>
                <x-side-scroller>
                    @foreach($restaurant->reservations as $reservation)
                        <x-reservations.card :reservation="$reservation"
                                             class="flex-shrink-0 max-w-md inline-block"/>
                    @endforeach
                </x-side-scroller>

                <x-h2 class="mt-5 mb-3">{{ __('Your bookings') }}</x-h2>
                <x-side-scroller>
                    @foreach($restaurant->bookings as $booking)
                        <div>
                            <p class="">{{ $booking->name }}</p>
                            <p cl1ass="mb-1">{{ $booking['phone_number'] }}</p>
                            <p class="text-gray-500">{{ $booking->notes }}</p>
                        </div>
                    @endforeach
                </x-side-scroller>

                <x-h2 class="mt-5">{{ __('Billing information') }}</x-h2>
                <p class="mb-3 text-primary-700">August 2021</p>
                <p>You have 2 bookings and your total bill is
                    <em class="text-primary-700">2$</em>
                </p>

                <x-h2 class="mt-5 mb-3">
                    {{ __('Your restaurant') }}
                    <span class="text-gray-800">{{ $restaurant->name }}</span>
                </x-h2>
                <x-a :href="route('restaurant.edit', $restaurant)">
                    {{ __('Edit restaurant') }}
                </x-a>
                <x-a :href="route('restaurant.show', $restaurant)">
                    {{ __('Restaurant page') }}
                </x-a>
                <p>{{ $restaurant->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
