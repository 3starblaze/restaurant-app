<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurant') }} {{ $restaurant->name }}
        @can('update', $restaurant)
        <a href="{{ route('restaurant.edit', compact('restaurant')) }}"
           class="text-gray-400">
            (Edit)
        </a>
        @endcan
    </x-slot>
    <p class="ml-5 max-w-xl">{{ $restaurant->description }}</p>
</x-app-layout>
