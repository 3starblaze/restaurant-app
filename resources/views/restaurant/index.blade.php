<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>

    <x-map class="rounded-md shadow-md">
        @foreach ($restaurants as $restaurant)
            L.marker({
            lat: {{ $restaurant->latitude }},
            lng: {{ $restaurant->longitude }}
            }).addTo(map).bindPopup(
            '{{ __('Restaurant') }} <a href="{{ route('restaurant.show', $restaurant) }} ">{{ $restaurant->name }}</a>'
            );
        @endforeach
    </x-map>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 mt-5">
        @forelse ($restaurants as $restaurant)
            <x-card class="">
                <h2 class="font-bold">
                    <x-a href="{{ route('restaurant.show', compact('restaurant')) }}">
                        {{ $restaurant->name }}
                    </x-a>
                </h2>
                <p>{{ $restaurant->description }}</p>
            </x-card>
        @empty
            <p>No restaurants yet.</p>
        @endforelse
    </div>
</x-app-layout>
