<x-guest-layout>
    {{ App::setLocale('lv') }}
    <h1 class="m-5 text-3xl">{{ __('Register') }}</h1>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form class="m-5 max-w-md"
          method="POST" action="{{ route('restaurant.store') }}">
        @csrf
        <div class="mt-4">
            <x-label name="name">{{ __('Name') }}</x-label>
            <x-input class="w-full" name="name"/>
        </div>
        <div class="mt-4">
            <x-label name="email">{{ __('Email') }}</x-label>
            <x-input name="email" type="email" class="w-full" />
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
        <div class="mt-6">
            <x-label name="restaurant-name">{{ __('Restaurant name') }}</x-label>
            <x-input name="restaurant-name" class="w-full" />
        </div>
        <div class="mt-4">
            <x-label name="restaurant-description">{{ __('Restaurant description') }}</x-label>
            <textarea class="w-full" name="restaurant-description"></textarea>
        </div>
        <x-button class="mt-5">{{ __('Register') }}</x-button>
    </form>
</x-guest-layout>
