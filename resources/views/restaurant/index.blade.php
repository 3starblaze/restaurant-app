<x-guest-layout>
    <h1 class="text-xl">Restaurants</h1>
    @forelse ($restaurants as $restaurant)
        <div>
            <h2>{{ $restaurant->name }}</h2>
            <p>{{ $restaurant->description }}</p>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-guest-layout>
