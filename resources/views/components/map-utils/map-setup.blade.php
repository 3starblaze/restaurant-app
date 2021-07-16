@props(['lat' => 56.9566, 'lng' => 24.1315, 'zoom' => 13])

@php
switch ($zoom) {
    case 'close':
        $zoom = 17;
        break;
}
@endphp

const map = L.map('map').setView([{{ $lat }}, {{ $lng }}], {{ $zoom }});

// Hijack L.marker to enable default markers (L.Icon.Default does not seem to work)
const oldMarkerFunction = L.marker;
L.marker = function(latlng, options) {
    return oldMarkerFunction(latlng, {
        icon: new L.Icon({
            iconUrl: '/map-icon.svg',
            shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        }),
        ...options,
    });
};

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: '{{ env('MAP_PUBLIC_TOKEN')  }}',
}).addTo(map);
