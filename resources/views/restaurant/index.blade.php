<x-guest-layout>
    <h1 class="text-3xl m-3">Restaurants</h1>
    @forelse ($restaurants as $restaurant)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold text-blue-800">
                <a href="{{ route('restaurant.show', compact('restaurant')) }}">
                    {{ $restaurant->name }}
                </a>
            </h2>
            <p>{{ $restaurant->description }}</p>
            <br>
            <a href="{{ route('restaurant.reserve', compact('restaurant')) }}">(Rezervēt tagad)</a>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-guest-layout>
