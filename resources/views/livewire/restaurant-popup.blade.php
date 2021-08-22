<x-base x-data="{ visible: {{ $currentRestaurant ? 'true' : 'false' }} }"
        x-show="visible"
        class="mt-5 md:order-first md:absolute md:bottom-5 md:top-0 md:right-0 md:w-1/3"
        style="z-index:9999">

    @if ($currentRestaurant)
        <x-restaurant.index-card :restaurant="$currentRestaurant" />
    @endif

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
</x-base>
