<x-card>
    <div class="p-2">
        <div class="flex justify-between">
            <div>
                <h2 class="font-bold text-lg">
                    {{ $restaurant->name }}
                </h2>
                <!-- Flex for removing implicit whitespace -->
                <!-- Shift div for finer alignment -->
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
            </div>
            <x-arrow-button :href="route('restaurant.show', compact('restaurant'))"
                            :text="__('View')" />
        </div>
    </div>
    <p class="px-2 mb-2">{{ $restaurant->description }}</p>
    <img src="/test-images/restaurants/00{{ rand(0, 5) }}.jpg"
         alt="restaurant"
         class="rounded-b" />
</x-card>
