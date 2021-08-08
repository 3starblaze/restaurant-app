<x-app-layout>
    <x-slot name="header">{{  __('Reserve') }}</x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class="m-5 max-w-md mx-auto"
          method="POST" action="{{ route('bookings.store', compact('reservation')) }}">
        @csrf
        <div class="mt-4">
            <x-label name="name">{{ __('Name') }}</x-label>
            <x-input class="w-full" name="name" :value="old('name')" />
        </div>
        <div class="mt-4">
            <x-label name="phone-number">{{ __('Phone number') }}</x-label>
            <x-input class="w-full" name="phone-number" :value="old('phone-number')" />
        </div>
        <div class="mt-4">
            <x-label name="notes">{{ __('Notes') }} ({{ __('optional') }})</x-label>
            <x-textarea class="w-full" name="notes" >
                {{ old('notes') }}
            </x-textarea>
        </div>

        <div class="flex justify-end">
            <x-button class="mt-5">{{ __('Submit') }}</x-button>
        </div>
    </form>

    <div class="max-w-md mx-auto">
        <x-h2 class="mb-2">
            <x-a :href="route('restaurant.show', $reservation->restaurant)">
                {{ $reservation->restaurant->name }}
            </x-a>
        </x-h2>
        <x-reservations.card :reservation="$reservation" />
    </div>
</x-app-layout>
