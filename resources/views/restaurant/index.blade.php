<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>

    <div id="map" class="h-80 w-full"></div>
    <script type="text/javascript">
     var mymap = L.map('map').setView([56.9566, 24.1315], 13);
     L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         maxZoom: 18,
         id: 'mapbox/streets-v11',
         tileSize: 512,
         zoomOffset: -1,
         accessToken: '{{ env('MAP_PUBLIC_TOKEN')  }}',
     }).addTo(mymap);

     @foreach ($restaurants as $restaurant)
     L.marker({
         lat: {{ $restaurant->latitude }},
         lng: {{ $restaurant->longitude }}
     }).addTo(mymap).bindPopup(
         '{{ __('Restaurant') }} <a href="{{ route('restaurant.show', $restaurant) }} ">{{ $restaurant->name }}</a>'
     );
     @endforeach
    </script>

    @forelse ($restaurants as $restaurant)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold text-blue-800">
                <a href="{{ route('restaurant.show', compact('restaurant')) }}">
                    {{ $restaurant->name }}
                </a>
            </h2>
            <p>{{ $restaurant->description }}</p>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-app-layout>
