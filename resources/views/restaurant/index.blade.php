<x-guest-layout>
    <h1 class="text-3xl m-3">Restaurants</h1>
    @forelse ($restaurants as $restaurant)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold">{{ $restaurant->name }}</h2>
            <p>{{ $restaurant->description }}</p>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-guest-layout>
