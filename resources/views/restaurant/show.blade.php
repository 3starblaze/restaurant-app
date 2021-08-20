<x-app-layout>
    <x-slot name="header">
        <span class="text-primary-600 text-md">{{ __('Restaurant') }}</span> {{ $restaurant->name }}
        @if ($restaurant->approved_at == null)
            <x-warning-icon :title="__('Your restaurant is not approved')" />
        @endif

        @can('update', $restaurant)
        <a href="{{ route('restaurant.edit', compact('restaurant')) }}"
           class="text-gray-400 text-sm">
            ({{ __('Edit')  }})
        </a>
        @endcan

        <div class="flex relative -left-0.5">
            @php
            $starCount = rand(1, 5);
            @endphp
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $starCount)
                    <x-bare.star-icon
                        class="h-5 inline-block text-yellow-500" />
                @else
                    <x-bare.star-icon
                        class="h-5 inline-block text-yellow-200" />
                @endif
            @endfor
        </div>
    </x-slot>

    <div class="flex flex-col lg:flex-row lg:gap-10">
        <div class="flex flex-col sm:flex-row lg:flex-col">
            <img src="/test-images/restaurants/00{{ rand(0, 5) }}.jpg"
                 alt="restaurant"
                 class="w-screen"/>

            <p class="max-w-xl w-full sm:flex-1 lg:flex-none">{{ $restaurant->description }}</p>

            <div class="sm:flex-1">
                <!-- Style attribute makes the map a perfect square -->
                <x-map style="height:0;width:100%;padding-bottom:100%;"
                       :lat="$restaurant->latitude"
                       :lng="$restaurant->longitude"
                       zoom="close">
                    L.marker({
                    lat: {{ $restaurant->latitude }},
                    lng: {{ $restaurant->longitude }},
                    }).addTo(map);
                </x-map>
            </div>

            <div>
                <x-h2 class="mt-5 mb-3">{{ __('Gallery')}}</x-h2>
                <div class="grid grid-rows-2 grid-cols-2 gap-2">
                    @for ($i = 0; $i < 4; $i++)
                        <img src="/test-images/restaurants/00{{ rand(0, 5) }}.jpg"
                             alt="restaurant"
                             class="rounded-md object-cover w-full h-full" />
                    @endfor
                </div>
            </div>
        </div>
        <div class="flex-1">
            <script type="text/javascript">
             const calendarCallback = (info) => {
                 console.log('calendar callback');
                 console.log('date', info.start);
             }
            </script>
            <x-h2 class="mt-5 mb-3">{{ __('Reservations') }}</x-h2>
            <x-calendar class="border-t-8" />
            <livewire:calendar-reservation :restaurant="$restaurant" />
        </div>
    </div>
</x-app-layout>
