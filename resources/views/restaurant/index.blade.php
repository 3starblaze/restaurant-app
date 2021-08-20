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
        <x-h2 class="app mt-5 mb-3">{{ __('Restaurants') }}</x-h2>
    </x-base>

    <x-base class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
        @forelse ($restaurants as $restaurant)
            <x-card>
                <div class="p-2">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="font-bold text-lg">
                                {{ $restaurant->name }}
                            </h2>
                            <!-- Flex for removing implicit whitespace -->
                            <!-- Shift div for finer alignment -->
                            <div class="flex relative -left-0.5">
                                @php
                                $starCount = rand(1, 5);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $starCount)
                                        <x-bare.star-icon
                                            class="h-5 inline-block text-yellow-500" />
                                    @else
                                        <x-bare.star-icon
                                            class="h-5 inline-block text-yellow-200" />
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="flex align-center">
                            <a href="{{ route('restaurant.show', compact('restaurant')) }}"
                                 class="flex items-center text-primary-500">
                                <p class="inline-block text-lg">View</p>
                                <x-bare.chevron-right class="h-10 w-10" />
                            </a>
                        </div>
                    </div>
                </div>
                <p class="px-2 mb-2">{{ $restaurant->description }}</p>
                <img src="/test-images/restaurants/00{{ rand(0, 5) }}.jpg"
                     alt="restaurant"
                     class="rounded-b" />
            </x-card>
        @empty
            <p>No restaurants yet.</p>
        @endforelse
    </x-base>
</x-app-layout>
