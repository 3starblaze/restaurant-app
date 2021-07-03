<x-app-layout>
    <x-slot name="header">{{ __('Edit restaurant') }}</x-slot>
    <form method="POST" class="m-5"
          action="{{ route('restaurant.edit', compact('restaurant')) }}">
        @csrf
        @method('PUT')

        <x-map-block>
            L.marker({
              lat: {{ $restaurant->latitude }},
              lng: {{ $restaurant->longitude }},
            }, { opacity: 0.5 }).addTo(mymap);

            mainMarker.update({{ $restaurant->latitude }}, {{  $restaurant->longitude }});
        </x-map-block>
        <x-label name="name">Name</x-label>
        <x-input name="name" value="{{ $restaurant->name }}"></x-input>
        <x-label name="description">Description</x-label>
        <textarea name="description" class="block">
            {{  $restaurant->description }}
        </textarea>
        <x-button class="mt-5">Submit</x-button>
    </form>
</x-app-layout>
