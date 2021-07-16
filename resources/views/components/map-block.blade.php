<div>
    <x-map-utils.bare-map {{ $attributes }} />
    <div class="inline-block flex">
        <p class="mr-5">{{ __('Latitude') }}: <em id="map-latitude">none</em></p>
        <p>{{ __('Longitude') }}: <em id="map-longitude">none</em></p>
    </div>
    <input id="map-latitude-input" type="hidden" name="latitude" />
    <input id="map-longitude-input" type="hidden" name="longitude" />
</div>

<script type="text/javascript">
 (() => {
     <x-map-utils.map-setup {{ $attributes }} />

     // Marker selection funcionality
     class MarkerInfo {
         update(lat, lng) {
             if (this.markerObj) map.removeLayer(this.markerObj);
             this.markerObj = L.marker({ lat, lng }).addTo(map);
             document.getElementById('map-latitude').textContent = lat.toFixed(4);
             document.getElementById('map-longitude').textContent = lng.toFixed(4);
             document.getElementById('map-latitude-input').value = lat;
             document.getElementById('map-longitude-input').value = lng;
         }
     }

     const mainMarker = new MarkerInfo();

     map.on('click', (e) => mainMarker.update(e.latlng.lat, e.latlng.lng));

     {{ $slot }}
 })();
</script>
