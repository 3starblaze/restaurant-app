<x-app-layout>
    <x-slot name="header">{{ __('Edit restaurant') }}</x-slot>
    <form method="POST" class="m-5"
          action="{{ route('restaurant.edit', compact('restaurant')) }}">
        @csrf
        @method('PUT')

        <div>
            <div id="map" class="h-80 w-full"></div>
            <div class="inline-block flex">
                <p class="mr-5">{{ __('Latitude') }}: <em id="map-latitude">none</em></p>
                <p>{{ __('Longitude') }}: <em id="map-longitude">none</em></p>
            </div>
            <input id="map-latitude-input" type="hidden" name="latitude" />
            <input id="map-longitude-input" type="hidden" name="longitude" />
        </div>

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

         let latitude = {{ $restaurant->latitude }};
         let longitude = {{ $restaurant->longitude }};
         let currentMarker = L.marker({ lat: latitude, lng: longitude }).addTo(mymap);

         function updateLocation() {
             const lat = latitude;
             const lng = longitude;
             if (currentMarker) mymap.removeLayer(currentMarker);
             currentMarker = L.marker({ lat, lng }).addTo(mymap);
             document.getElementById('map-latitude').textContent = lat.toFixed(4);
             document.getElementById('map-longitude').textContent = lng.toFixed(4);
             document.getElementById('map-latitude-input').value = lat;
             document.getElementById('map-longitude-input').value = lng;
         }

         updateLocation();

         // Old location marker
         L.marker({
             lat: latitude,
             lng: longitude,
         }, { opacity: 0.5 }).addTo(mymap);

         function onMapClick(e) {
             latitude = e.latlng.lat;
             longitude = e.latlng.lng;
             updateLocation();
         }

         mymap.on('click', onMapClick);
        </script>


        <x-label name="name">Name</x-label>
        <x-input name="name" value="{{ $restaurant->name }}"></x-input>
        <x-label name="description">Description</x-label>
        <textarea name="description" class="block">
            {{  $restaurant->description }}
        </textarea>
        <x-button class="mt-5">Submit</x-button>
    </form>
</x-app-layout>
