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
                <h2>
                    <x-a href="{{ route('restaurant.show', $restaurant) }}">
                        {{ __('Your restaurant') }}
                    </x-a>
                    @if ($restaurant->approved_at == null)
                        <x-warning-icon :title="__('Your restaurant is not approved')" />
                    @endif
                </h2>

                @if ($restaurant->approved_at !== null)
                    <h2>
                        <x-a href="{{ route('reservations.index') }}">
                            {{ __('Your reservations') }}
                        </x-a>
                    </h2>
                @endif
            </div>
        </div>
    </div>

    <div class="py-12">
        <h2>
            @if ($restaurant->approved_at == null)
                <x-a href="{{ route('reservations.index', compact('restaurant')) }}">
                    {{ __('Your reservations') }}
                </x-a>
            @endif
        </h2>
    </div>
</x-app-layout>
