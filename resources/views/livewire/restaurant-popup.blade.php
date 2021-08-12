<div>
    <div>
        <p>{{ $currentRestaurant?->name }}</p>
        <p>{{ $currentRestaurant?->description }}</p>
    </div>

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
