<div class="mt-5">
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
