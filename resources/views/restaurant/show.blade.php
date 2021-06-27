<x-guest-layout>
    <h1 class="text-3xl m-3 inline-block">Restaurant {{ $restaurant->name }}</h1>
    @can('update', $restaurant)
    <a href="{{ route('restaurant.edit', compact('restaurant')) }}"
       class="text-gray-400">
        (Edit)
    </a>
    @endcan
    <p class="ml-5 max-w-xl">{{ $restaurant->description }}</p>
</x-guest-layout>
