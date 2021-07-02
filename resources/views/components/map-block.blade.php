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

 let currentMarker = null;
 let latitude = null;
 let longitude = null;

 function onMapClick(e) {
     if (currentMarker) mymap.removeLayer(currentMarker);
     currentMarker = L.marker(e.latlng).addTo(mymap);
     latitude = e.latlng.lat;
     longitude = e.latlng.lng;

     document.getElementById('map-latitude').textContent = latitude.toFixed(4);
     document.getElementById('map-longitude').textContent = longitude.toFixed(4);
     document.getElementById('map-latitude-input').value = latitude;
     document.getElementById('map-longitude-input').value = longitude;
 }

 mymap.on('click', onMapClick);
</script>
