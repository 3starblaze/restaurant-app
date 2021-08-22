<x-app-layout>
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

    <x-base full-width class="flex flex-col relative">
        <x-map class="border-primary-200 border-2">
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
    </x-base>

    <x-base>
        <x-h2>{{ __('Restaurants') }}</x-h2>
    </x-base>

    <x-base class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
        @forelse ($restaurants as $restaurant)
            <x-restaurant.index-card :restaurant="$restaurant" />
        @empty
            <p>No restaurants yet.</p>
        @endforelse
    </x-base>
</x-app-layout>
