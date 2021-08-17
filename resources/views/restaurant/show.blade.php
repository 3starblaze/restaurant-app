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
            <x-h2 class="mt-5">{{ __('Available reservations') }}</x-h2>
            <ul>
                @php
                $lastDay = null;
                @endphp
                @foreach ($restaurant->reservations->sortBy('start_time') as $reservation)
                    @if($lastDay === null || $lastDay !== $reservation['start_time']->format('Y-m-d'))
                        <div class="flex gap-2 mt-5">
                            <p class="inline-block text-primary-800">{{ $reservation['start_time']->format('Y-m-d') }}</p>
                            <div class="my-auto inline-block bg-primary-300 h-px w-full"></div>
                        </div>
                        @php
                        $lastDay = $reservation['start_time']->format('Y-m-d')
                        @endphp
                    @endif
                    <x-reservations.minimal-card :reservation="$reservation"
                                                 class="mt-3 w-full"/>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
