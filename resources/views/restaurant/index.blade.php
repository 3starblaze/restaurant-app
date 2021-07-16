<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>

    <x-map>
        @foreach ($restaurants as $restaurant)
            L.marker({
                lat: {{ $restaurant->latitude }},
                lng: {{ $restaurant->longitude }}
            }).addTo(map).bindPopup(
                '{{ __('Restaurant') }} <a href="{{ route('restaurant.show', $restaurant) }} ">{{ $restaurant->name }}</a>'
            );
        @endforeach
    </x-map>


    @forelse ($restaurants as $restaurant)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold">
                <x-a href="{{ route('restaurant.show', compact('restaurant')) }}">
                    {{ $restaurant->name }}
                </x-a>
            </h2>
            <p>{{ $restaurant->description }}</p>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-app-layout>
