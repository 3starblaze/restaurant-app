<x-app-layout>
    <x-slot name="header">
        {{ __('Restaurants') }}
    </x-slot>
    @forelse ($restaurants as $restaurant)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold text-blue-800">
                <a href="{{ route('restaurant.show', [
                            'restaurant' => $restaurant,
                            'locale' => App::getLocale(),
                            ]) }}">
                    {{ $restaurant->name }}
                </a>
            </h2>
            <p>{{ $restaurant->description }}</p>
        </div>
    @empty
        <p>No restaurants yet.</p>
    @endforelse
</x-app-layout>
