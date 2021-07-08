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
            <div id="map" style="height:0;width:100%;padding-bottom:100%;"></div>
        </div>
    </div>

    <script type="text/javascript">
     const lat = {{ $restaurant->latitude }};
     const lng = {{ $restaurant->longitude }};
     const mymap = L.map('map').setView([lat, lng], 13);

     L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         maxZoom: 18,
         id: 'mapbox/streets-v11',
         tileSize: 512,
         zoomOffset: -1,
         accessToken: '{{ env('MAP_PUBLIC_TOKEN')  }}',
     }).addTo(mymap);

     L.marker({lat, lng}).addTo(mymap);
    </script>
</x-app-layout>
