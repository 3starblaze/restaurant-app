<x-card>
    <div class="p-2">
        <div class="flex justify-between">
            <div>
                <h2 class="font-bold text-lg">
                    {{ $restaurant->name }}
                </h2>
                <x-stars :starCount="rand(1, 5)" />
            </div>
            <x-arrow-button :href="route('restaurant.show', compact('restaurant'))"
                            :text="__('View')" />
        </div>
    </div>
    <p class="px-2 mb-2">{{ $restaurant->description }}</p>

    <x-fake.restaurant-img class="rounded-b" />
</x-card>
