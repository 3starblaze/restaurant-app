<x-app-layout>
    <x-slot name="header">{{ __('New reservation') }}</x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />


    <form class="m-5 max-w-md mx-auto"
          method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="mt-4">
            <x-label name="start-time">{{ __('Start time') }}</x-label>
            <x-input class="w-full" type="datetime-local" name="start-time" :value="old('start-time')" />
        </div>
        <div class="mt-4">
            <x-label name="end-time">{{ __('End time') }}</x-label>
            <x-input class="w-full" type="datetime-local" name="end-time" :value="old('end-time')" />
        </div>
        <div class="mt-4">
            <x-label name="max-person-count" >{{ __('Max guest count') }}</x-label>
            <x-input name="max-person-count" :value="old('max-person-count')" type="numeric"
                     class="w-full" />
        </div>
        <div class="mt-4">
            <x-label name="description">{{ __('Description') }}</x-label>
            <x-textarea class="w-full" name="description">
                {{  old('description') }}
            </x-textarea>
        </div>
        <input type="hidden" name="restaurant-id" value="{{ $restaurant->uuid }}">
        <div class="flex justify-end">
            <x-button class="mt-5">{{ __('Create') }}</x-button>
        </div>
    </form>
</x-app-layout>
