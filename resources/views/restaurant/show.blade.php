<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurant') }} {{ $restaurant->name }}
        @can('update', $restaurant)
        <a href="{{ route('restaurant.edit', compact('restaurant')) }}"
           class="text-gray-400">
            ({{ __('Edit')  }})
        </a>
        @endcan
    </x-slot>
    <div class="flex flex-col sm:flex-row">
        <p class="max-w-xl w-full sm:flex-1">{{ $restaurant->description }}</p>

        <div class="sm:flex-1">
            <!-- Style attribute makes the map a perfect square -->
            <x-map style="height:0;width:100%;padding-bottom:100%;"
                   :lat="$restaurant->latitude" :lng="$restaurant->longitude">
                L.marker({
                    lat: {{ $restaurant->latitude }},
                    lng: {{ $restaurant->longitude }},
                }).addTo(map);
            </x-map>
        </div>
    </div>
</x-app-layout>
