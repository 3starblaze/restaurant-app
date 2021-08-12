<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>

    <script type="text/javascript">
     let markers = [];
     let restaurantUuids = [];
    </script>


    <x-map>
        var m;
        @foreach ($restaurants as $restaurant)
            m = L.marker({
            lat: {{ $restaurant->latitude }},
            lng: {{ $restaurant->longitude }}
            }).addTo(map).bindPopup(
            '{{ __('Restaurant') }} <a href="{{ route('restaurant.show', $restaurant) }} ">{{ $restaurant->name }}</a>'
            );

            markers.push(m);
            restaurantUuids.push('{{ $restaurant->uuid }}');
        @endforeach
    </x-map>

    <livewire:restaurant-popup />

    <hr class="mt-5 mb-8" />

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
