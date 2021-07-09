@props(['lat' => 56.9566, 'lng' => 24.1315, 'zoom' => 13])

@php
switch ($zoom) {
    case 'close':
        $zoom = 17;
        break;
}
@endphp

<div id="map" class="h-80 w-full" {{ $attributes }}></div>

<script type="text/javascript">
 (() => {
     const map = L.map('map').setView([{{ $lat }}, {{ $lng }}], {{ $zoom }});
     L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         maxZoom: 18,
         id: 'mapbox/streets-v11',
         tileSize: 512,
         zoomOffset: -1,
         accessToken: '{{ env('MAP_PUBLIC_TOKEN')  }}',
     }).addTo(map);

     {{ $slot }}
 })();
</script>
