<x-app-layout>
    <x-slot name="header">{{ __('Edit restaurant') }}</x-slot>
    <form method="POST" class="m-5"
          action="{{ route('restaurant.update', compact('restaurant')) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col sm:flex-row sm:gap-3">
            <x-map-block :lat="$restaurant->latitude"
                         :lng="$restaurant->longitude"
                         zoom="close"
                         class="sm:flex-1"
                         style="height:0;width:100%;padding-bottom:100%;">
                <!-- Old location marker -->
                L.marker({
                lat: {{ $restaurant->latitude }},
                lng: {{ $restaurant->longitude }},
                }, { opacity: 0.5 }).addTo(map);

                <!-- Put the current marker in the old location -->
                mainMarker.update({{ $restaurant->latitude }}, {{ $restaurant->longitude }});
            </x-map-block>
            <div class="w-full sm:flex-1 sm:min-h-full sm:flex sm:flex-col">
                <x-label name="name">{{ __('Name') }}</x-label>
                <x-input name="name" value="{{ $restaurant->name }}"
                         class="w-full"></x-input>
                <x-label name="description" class="mt-3">
                    {{  __('Description')}}
                </x-label>
                <x-textarea name="description"
                            class="block w-full sm:flex-1">
                    {{  $restaurant->description }}
                </x-textarea>
                <div class="flex justify-end">
                    <x-button class="mt-5">{{ __('Submit') }}</x-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
