<div x-data="{ visible: {{ $currentRestaurant ? 'true' : 'false' }} }"
     x-show="visible"
    class="bg-white w-full m-2 p-2 md:order-first md:absolute md:z-50 md:bottom-5 md:top-0 md:right-0 md:w-1/3 md:rounded-lg md:shadow-lg"
     style="z-index:9999">
    <x-h2 class="text-primary-500">
        <x-a :href="$showRoute">
            {{ $currentRestaurant?->name }}
        </x-a>
    </x-h2>
    <p>{{ $currentRestaurant?->description }}</p>

    <script>
     document.addEventListener('livewire:load', function () {
         for (let i = 0; i < markers.length; i++) {
             const marker = markers[i];
             marker.addEventListener('click', () => {
                @this.setRestaurant(restaurantUuids[i]);
             });
         }
     })
    </script>
</div>
