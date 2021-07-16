<x-app-layout>
    <x-slot name="header">{{ __('Register') }}</x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />


    <form class="m-5 max-w-md mx-auto"
          method="POST" action="{{ route('restaurant.store') }}">
        @csrf
        <div class="mt-4">
            <x-label name="name">{{ __('Name') }}</x-label>
            <x-input class="w-full" name="name" :value="old('name')" />
        </div>
        <div class="mt-4">
            <x-label name="email" >{{ __('Email') }}</x-label>
            <x-input name="email" :value="old('email')" type="email"
                     class="w-full" />
        </div>
        <div class="mt-4">
            <x-label name="password">{{ __('Password') }}</x-label>
            <x-input name="password" type="password" class="w-full" />
        </div>
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full"
                     type="password"
                     name="password_confirmation" required />
        </div>
        <hr class="border my-8 w-auto" />
        <x-map-block />
        <div class="mt-6">
            <x-label name="restaurant-name">{{ __('Restaurant name') }}</x-label>
            <x-input name="restaurant-name" :value="old('restaurant-name')"
                     class="w-full" />
        </div>
        <div class="mt-4">
            <x-label name="restaurant-description">{{ __('Restaurant description') }}</x-label>
            <x-textarea class="w-full" name="restaurant-description">
                {{  old('restaurant-description') }}
            </x-textarea>
        </div>
        <div class="flex justify-end">
            <x-button class="mt-5">{{ __('Register') }}</x-button>
        </div>
    </form>
</x-app-layout>
