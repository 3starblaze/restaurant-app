<x-guest-layout>
    <h1 class="text-3xl m-3 inline-block">Restaurant {{ $restaurant->name }}</h1>
    <a href="{{ route('restaurant.edit', compact('restaurant')) }}"
       class="text-gray-400">
        (Edit)
    </a>
    <p class="ml-5 max-w-xl">{{ $restaurant->description }}</p>
    <p class="ml-5 mt-5 text-gray-500 text-sm">Contact @ {{ $restaurant->email }}</p>
</x-guest-layout>
