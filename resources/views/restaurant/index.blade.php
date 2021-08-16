<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>

    <script type="text/javascript">
     let markers = [];
     let restaurantUuids = [];
     let currentMarker = null;

     const onMarkerChange = (e) => {
         marker = e.sourceTarget;
         // Dim all markers on marker selection
         if (currentMarker == null) {
             for (const marker of markers) {
                 marker.setOpacity(0.5);
             }

             marker.setOpacity(1.0);
             currentMarker = marker;
         } else {
             currentMarker.setOpacity(0.5);
             marker.setOpacity(1.0);
             currentMarker = marker;
         }

     }
    </script>


    <div class="flex flex-col relative">
        <x-map>
            var m;
            @foreach ($restaurants as $restaurant)
                m = L.marker({
                lat: {{ $restaurant->latitude }},
                lng: {{ $restaurant->longitude }}
                }).addTo(map).bindPopup(
                '{{ __('Restaurant') }} <a href="{{ route('restaurant.show', $restaurant) }} ">{{ $restaurant->name }}</a>'
                );
                m.addEventListener('click', onMarkerChange);

                markers.push(m);
                restaurantUuids.push('{{ $restaurant->uuid }}');
            @endforeach
        </x-map>
        <livewire:restaurant-popup />
    </div>


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
