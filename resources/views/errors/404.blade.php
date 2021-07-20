<x-bare-layout class="h-screen w-screen flex bg-gray-100">
    <x-slot name="header">404</x-slot>
    <div class="m-auto h-1/2 w-1/2 bg-white shadow-sm flex flex-col justify-center items-center">
        <h2 class="text-primary-500 text-3xl font-bold">404</h2>
        <p>{{ __('misc.404') }}</p>

        <hr class="border-1 border-primary-500 w-4/5 my-5" />
        <x-a :href="route('restaurant.index')">
            <x-application-logo class="h-20 w-20" />
        </x-a>
    </div>
</x-bare-layout>
