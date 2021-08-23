<x-dashboard-layout>
    <x-h2>{{ __('Status information') }}</x-h2>
    <div class="grid gap-2 items-center"
         style="grid-template-columns: auto 1fr">
        <p class="text-lg">Rating</p>
        <x-stars :starCount="rand(1, 5)" />
        <p class="text-lg">Place</p>
        <p>
            <span class="text-primary-500">{{ $currentPlace }}</span>/{{ $totalPlaces }}
        </p>
    </div>

    <x-h2>Main information</x-h2>
    <form method="POST" class=""
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

    <x-h2>{{ __('Gallery')}}</x-h2>
    <div class="flex gap-2">
        <div class="flex-1 relative">
            <x-bare.cog class="absolute right-2 top-2 h-10 w-10 bg-black bg-opacity-20 text-primary-500 rounded-md cursor-pointer" />
            <x-fake.restaurant-img class="h-full rounded-md" />
        </div>
        <div class="flex-1 grid grid-rows-2 grid-cols-2 gap-2">
            @for ($i = 0; $i < 4; $i++)
                <div class="relative">
                    <x-bare.cog class="absolute right-2 top-2 h-5 w-5 bg-black bg-opacity-20 text-primary-500 rounded-md cursor-pointer" />
                    <x-fake.restaurant-img class="rounded-md object-cover w-full h-full" />
                </div>
            @endfor
        </div>
    </div>
</x-dashboard-layout>
