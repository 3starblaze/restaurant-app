<x-app-layout>
    <x-slot name="header">{{ __('New reservation') }}</x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />


    <form class="m-5 max-w-md mx-auto"
          method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="mt-4 flex gap-2">
            <div class="inline-block flex-2">
                <x-label name="start-day">{{ __('Start day') }}</x-label>
                <x-input class="w-full" type="date" name="start-day" :value="old('start-day')" />
            </div>

            <div class="inline-block flex-1">
                <x-label name="start-time">{{ __('Start time') }}</x-label>
                <x-input class="w-full" type="time" name="start-time" :value="old('start-time')" />
            </div>
        </div>
        <div class="mt-4">
            <x-label name="duration">{{ __('Duration') }} ({{ __('minutes') }})</x-label>
            <x-input class="w-full" type="number" name="duration" :value="old('duration') ?? 0"
                     min="0" />
        </div>
        <div class="mt-4">
            <x-label name="max-person-count" >{{ __('Max guest count') }}</x-label>
            <x-input name="max-person-count" :value="old('max-person-count') ?? 1"
                     type="number" min="1" class="w-full" />
        </div>
        <div class="mt-4">
            <x-label name="description">{{ __('Description') }}</x-label>
            <x-textarea class="w-full" name="description">
                {{  old('description') }}
            </x-textarea>
        </div>
        <div class="flex justify-end">
            <x-button class="mt-5">{{ __('Create') }}</x-button>
        </div>
    </form>
</x-app-layout>
