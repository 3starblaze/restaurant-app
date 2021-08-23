<x-app-layout>
    <x-base class="my-3">
        <p class="text-2xl">
            <span class="text-primary-600">{{ __('Restaurant') }}</span> {{ $restaurant->name }}
        </p>
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
    </x-base>

    <x-base full-width>
        <x-fake.restaurant-img class="w-screen" />
    </x-base>

    <x-base>
        <p class="max-w-xl w-full my-3">{{ $restaurant->description }}</p>
    </x-base>

    <x-base full-width>
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
    </x-base>

    <x-base>
        <x-h2>{{ __('Gallery')}}</x-h2>
        <div class="grid grid-rows-2 grid-cols-2 gap-2">
            @for ($i = 0; $i < 4; $i++)
                <x-fake.restaurant-img class="rounded-md object-cover w-full h-full" />
            @endfor
        </div>
    </x-base>
    <x-base class="">
        <script type="text/javascript">
         const calendarCallback = (info) => {
             console.log('calendar callback');
             console.log('date', info.start);
         }
        </script>
        <x-h2>{{ __('Reservations') }}</x-h2>
        <x-calendar class="border-t-8" />
        <livewire:calendar-reservation :restaurant="$restaurant" />
    </x-base>
</x-app-layout>
