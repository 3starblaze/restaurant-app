<x-bare-layout class="h-screen w-screen flex bg-gray-100">
    <div class="m-auto h-1/2 w-full bg-white shadow-sm flex flex-col justify-center items-center md:w-3/4 lg:w-1/2">
        <h2 class="text-primary-500 text-3xl font-bold">{{ $errorCode }}</h2>
        <p>{{ $slot }}</p>

        <hr class="border-1 border-primary-500 w-4/5 my-5" />
        <x-a :href="route('restaurant.index')">
            <x-application-logo class="h-20 w-20" />
        </x-a>
    </div>
</x-bare-layout>
