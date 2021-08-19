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
    </x-slot>

    <div class="flex flex-col lg:flex-row lg:gap-10">
        <div class="flex flex-col sm:flex-row lg:flex-col">
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
        </div>
        <div class="flex-1">
            <script type="text/javascript">
             const calendarCallback = (info) => {
                 console.log('calendar callback');
                 console.log('date', info.start);
             }
            </script>
            <x-calendar class="border-t-8 mt-5" />
            <livewire:calendar-reservation :restaurant="$restaurant" />
        </div>
    </div>
</x-app-layout>
